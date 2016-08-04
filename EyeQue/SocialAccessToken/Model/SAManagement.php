<?php


/**
 * Copyright 2016 EyeQue. All rights reserved.
 * Yuan Xiong.
 */

namespace EyeQue\SocialAccessToken\Model;

use EyeQue\SocialAccessToken\Api\SocialAccountInterface;
use EyeQue\SocialAccessToken\Model\SAValidate;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Integration\Model\CredentialsValidator;
/**
 * Defines the implementaiton class of the social acccount service contract.
 */
class SAManagement implements SocialAccountInterface
{
     
    protected $modelSocialAccessFactory;
     /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;
    
     /**
     * @var AccountManagementInterface
     */
    private $accountManagement;
    /**
     * @var \EyeQue\SocialAccessToken\Model\SAValidate
     */
    private $saValidatorHelper;
    /**
     * @var \Magento\Integration\Model\CredentialsValidator
     */
    private $validatorHelper;
    

    /**
    * @param CustomerRepositoryInterface $customerRepository
    * @param \Magento\Integration\Model\CredentialsValidator $validatorHelper
    */
    public function __construct(
	AccountManagementInterface $accountManagement,
	CustomerRepositoryInterface $customerRepository,
        \EyeQue\SocialAccessToken\Model\SocialAccessFactory $modelSocialAccessFactory,
	SAValidate $saValidatorHelper,
	CredentialsValidator $validatorHelper
    ) {
	$this->accountManagement = $accountManagement;
        $this->modelSocialAccessFactory = $modelSocialAccessFactory;
	$this->customerRepository = $customerRepository;
	$this->validatorHelper = $validatorHelper;
	$this->saValidatorHelper = $saValidatorHelper;
    }
    /**
     * create new social account. bundle social user id with this account. 
     *
     * @api
     * @param \Magento\Customer\Api\Data\CustomerInterface $customer
     * @param string $password
     * @param string $redirectUrl
     * @param string $type is the type of social media.
     * @param string $social_id is the id of the social media user.
     * @param string $social_token is the token of the social media user.
     * @return \Magento\Customer\Api\Data\CustomerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function createAccount(CustomerInterface $customer, $password = null, $redirectUrl = '',$type, $social_id, $social_token)
    {
	// social email verification
	$satokenresult = $this->saValidatorHelper->validateToken($type,$social_id,$social_token);

	if($satokenresult <= 0) 
	{
		throw new LocalizedException(__('You did not sign in your social account correctly. Please check your social type, id and token'));				
	}
	
	$social_email = $this->saValidatorHelper->getCustomerEmail($type,$social_id,$social_token);
	$customer_return = $customer;
	$user_email = $customer->getEmail();
	$register_email = $user_email;
	
	//if the social email is different from user email
	if($social_email!=$user_email)
	{
		//if social_email is not empty, throw error, bad call
		if($social_email != "")
		{
			throw new LocalizedException(__('Bad call. Social login email is not empty and different from customer email.'));
		}
		//the social email is empty.User email from input has to be validated using password
		else
		{
			$emailAvailable = $this->accountManagement->isEmailAvailable($customer->getEmail(),null);	
			$SocialAccessModel = $this->modelSocialAccessFactory->create();        
			$saCollection = $SocialAccessModel->getCollection();
			$key = $saCollection->addFieldToFilter('type',$type)->addFieldToFilter('user_id',$social_id)->getData();		

			if($emailAvailable) //no such a user
			{
				//if no social link, create new user
				if(count($key) === 0)
				{
				    $customer = $this->accountManagement->createAccount($customer, $password, $redirectUrl);
				    $customer_return = $customer;
				    // social link does not exist, create a new one;
				    $data = array('type'=>$type,'user_id'=>$social_id,'customer_id'=>$customer->getId());
				    $SocialAccessModel->setData($data);
				    try {
					$insertId = $SocialAccessModel->save()->getId();
				    } 
				    catch (Exception $e){
					echo $e->getMessage(); 
				    }
				    return $customer_return;
				}
				//if there is a social link, throw error.
				else 
				{	
				    throw new LocalizedException(__('Bad call. Social login email already exist and different from customer email.'));
				} 
			}
			else //user already exist, verify the password
			{	
				 try {
				    $this->validatorHelper->validate($user_email, $password);
				    $customerDataObject = $this->accountManagement->authenticate($user_email, $password);
				} catch (\Exception $e) {
				    throw new LocalizedException(
					__('Email account already exist and you did not sign in correctly, or your account is temporarily disabled!')
				    );
				}
				$customer = $this->customerRepository->get($customer->getEmail());
				$customer_return = $customer;
				
				//bind social link
				if(count($key) === 0)
				{
				    // social link does not exist, create a new one;
				    $data = array('type'=>$type,'user_id'=>$social_id,'customer_id'=>$customer->getId());
				    $SocialAccessModel->setData($data);
				    try {
					$insertId = $SocialAccessModel->save()->getId();
				    } 
				    catch (Exception $e){
					echo $e->getMessage(); 
				    }
				    return $customer_return;
				}
				//if there is a social link, do nothing.
				else 
				{	
				    return $customer_return;
				} 
			}
			
		}
			
	}
	else //social email is same as customer email(not empty)
	{
		$emailAvailable = $this->accountManagement->isEmailAvailable($customer->getEmail(),null);	
		if($emailAvailable) //no such a user, just register a new one
		{
			$customer = $this->accountManagement->createAccount($customer, $password, $redirectUrl);
			$customer_return = $customer;
		}
		else //user already exist, ignore password
		{
			$customer = $this->customerRepository->get($customer->getEmail());
			$customer_return = $customer;
		}
		//bind social link
		$SocialAccessModel = $this->modelSocialAccessFactory->create();        
		$saCollection = $SocialAccessModel->getCollection();
		$key = $saCollection->addFieldToFilter('type',$type)->addFieldToFilter('user_id',$social_id)->getData();
		if(count($key) === 0)
		{
		    // social link does not exist, create a new one;
		    $data = array('type'=>$type,'user_id'=>$social_id,'customer_id'=>$customer->getId());
		    $SocialAccessModel->setData($data);
		    try 
		    {
			$insertId = $SocialAccessModel->save()->getId();
		    } 
		    catch (Exception $e)
		    {
			echo $e->getMessage(); 
		    }
		}
		else{} //social link exists, do nothing
		return $customer_return;
	}
	return $customer_return;

    }




}
