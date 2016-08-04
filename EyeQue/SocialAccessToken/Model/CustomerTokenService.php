<?php
/**
 * Copyright © 2016 EyeQue
 * Extend access token service with social login
 */

namespace EyeQue\SocialAccessToken\Model;

use Magento\Customer\Api\AccountManagementInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Integration\Model\CredentialsValidator;
use Magento\Integration\Model\Oauth\Token as Token;
use Magento\Integration\Model\Oauth\TokenFactory as TokenModelFactory;
use Magento\Integration\Model\ResourceModel\Oauth\Token\CollectionFactory as TokenCollectionFactory;
use Magento\Integration\Model\Oauth\Token\RequestThrottler;
use Magento\Framework\Exception\AuthenticationException;

use EyeQue\SocialAccessToken\Model\SAValidate;

class CustomerTokenService implements \Magento\Integration\Api\CustomerTokenServiceInterface
{
    /**
     * Token Model
     *
     * @var TokenModelFactory
     */
    private $tokenModelFactory;

    /**
     * Customer Account Service
     *
     * @var AccountManagementInterface
     */
    private $accountManagement;

    /**
     * @var \Magento\Integration\Model\CredentialsValidator
     */
    private $validatorHelper;

    /**
     * Token Collection Factory
     *
     * @var TokenCollectionFactory
     */
    private $tokenModelCollectionFactory;

    /**
     * @var RequestThrottler
     */
    private $requestThrottler;

    /**
     * @var \EyeQue\SocialAccessToken\Model\SAValidate
     */
    private $saValidatorHelper;


    /**
     * Initialize service
     *
     * @param TokenModelFactory $tokenModelFactory
     * @param AccountManagementInterface $accountManagement
     * @param TokenCollectionFactory $tokenModelCollectionFactory
     * @param \Magento\Integration\Model\CredentialsValidator $validatorHelper
     */

   

    public function __construct(
        TokenModelFactory $tokenModelFactory,
        AccountManagementInterface $accountManagement,
        TokenCollectionFactory $tokenModelCollectionFactory,
        CredentialsValidator $validatorHelper,
        SAValidate $saValidatorHelper
	
    ) {
        $this->tokenModelFactory = $tokenModelFactory;
        $this->accountManagement = $accountManagement;
        $this->tokenModelCollectionFactory = $tokenModelCollectionFactory;
        $this->validatorHelper = $validatorHelper;
        $this->saValidatorHelper = $saValidatorHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function createCustomerAccessToken($username, $password)
    {
	/*
		for user who use facebook
        */
	
	if(substr( $username, 0, 8 ) === "facebook" && $username !== "facebook")
	{
		if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
  			// this is not an email address
			$user_id = substr($username, 8, strlen($username)-8);
			$satokenresult = $this->saValidatorHelper->validateToken("facebook",$user_id,$password);
			if($satokenresult <=0 )$saresult  = 0;
			else $saresult = $this->saValidatorHelper->validate("facebook", $user_id,""); 
			try{
				if($saresult <= 0) 
				{
					$error = 'User does not exist!';
    					throw new AuthenticationException($error);				
				}
			} catch (\Exception $e){
				$this->getRequestThrottler()->logAuthenticationFailure($username, 		RequestThrottler::USER_TYPE_CUSTOMER);
				throw new AuthenticationException(
					__('You did not sign in correctly or your account is temporarily disabled!')
				    );
			}
			$this->getRequestThrottler()->throttle($username, RequestThrottler::USER_TYPE_CUSTOMER);		
			

			return $this->tokenModelFactory->create()->createCustomerToken($saresult)->getToken();
		}	
	}
	if(substr( $username, 0, 10 ) === "googleplus" && $username !== "googleplus")
	{
		if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
  			// this is not an email address
			$user_id = substr($username, 10, strlen($username)-10);
			$satokenresult = $this->saValidatorHelper->validateToken("googleplus",$user_id,$password);
			if($satokenresult <=0 )$saresult  = 0;
			else $saresult = $this->saValidatorHelper->validate("googleplus", $user_id,""); 
			try{
				if($saresult <= 0) 
				{
					$error = 'Sign in error.';
    					throw new AuthenticationException($error);				
				}
			} catch (\Exception $e){
				$this->getRequestThrottler()->logAuthenticationFailure($username, 		RequestThrottler::USER_TYPE_CUSTOMER);
				throw new AuthenticationException(
					__('You did not sign in correctly or your account is temporarily disabled!')
				    );
			}
			$this->getRequestThrottler()->throttle($username, RequestThrottler::USER_TYPE_CUSTOMER);		
			

			return $this->tokenModelFactory->create()->createCustomerToken($saresult)->getToken();
		}	
	}
	
        $this->validatorHelper->validate($username, $password);
        $this->getRequestThrottler()->throttle($username, RequestThrottler::USER_TYPE_CUSTOMER);
        try {
            $customerDataObject = $this->accountManagement->authenticate($username, $password);
        } catch (\Exception $e) {
            $this->getRequestThrottler()->logAuthenticationFailure($username, RequestThrottler::USER_TYPE_CUSTOMER);
            throw new AuthenticationException(
                __('You did not sign in correctly or your account is temporarily disabled!')
            );
        }
        $this->getRequestThrottler()->resetAuthenticationFailuresCount($username, RequestThrottler::USER_TYPE_CUSTOMER);
        return $this->tokenModelFactory->create()->createCustomerToken($customerDataObject->getId())->getToken();
    }

    /**
     * {@inheritdoc}
     */
    public function revokeCustomerAccessToken($customerId)
    {
        $tokenCollection = $this->tokenModelCollectionFactory->create()->addFilterByCustomerId($customerId);
        if ($tokenCollection->getSize() == 0) {
            throw new LocalizedException(__('This customer has no tokens.'));
        }
        try {
            foreach ($tokenCollection as $token) {
                $token->setRevoked(1)->save();
            }
        } catch (\Exception $e) {
            throw new LocalizedException(__('The tokens could not be revoked.'));
        }
        return true;
    }

    /**
     * Get request throttler instance
     *
     * @return RequestThrottler
     * @deprecated
     */
    private function getRequestThrottler()
    {
        if (!$this->requestThrottler instanceof RequestThrottler) {
            return \Magento\Framework\App\ObjectManager::getInstance()->get(RequestThrottler::class);
        }
        return $this->requestThrottler;
    }
}
