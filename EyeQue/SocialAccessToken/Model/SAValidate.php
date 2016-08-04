<?php


/**
 * Copyright 2016 EyeQue. All rights reserved.
 * Yuan Xiong.
 */

namespace EyeQue\SocialAccessToken\Model;

use EyeQue\SocialAccessToken\Api\SocialAccessTokenInterface;
use Magento\Customer\Api\AccountManagementInterface;


$code_root = dirname(dirname(dirname(dirname(__FILE__))));
include_once $code_root.'/google-api-php-client/vendor/autoload.php';
use \Google_Client as Google_Client;



/**
 * Defines the implementaiton class of the social access service contract.
 */
class SAValidate implements SocialAccessTokenInterface
{
     
    protected $modelSocialAccessFactory;
    protected $scopeConfig;
    /**
     * @var AccountManagementInterface
     */
    private $accountManagement;

    public function __construct(
	AccountManagementInterface $accountManagement,
	\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \EyeQue\SocialAccessToken\Model\SocialAccessFactory $modelSocialAccessFactory
    ) {
        $this->modelSocialAccessFactory = $modelSocialAccessFactory;
	$this->scopeConfig = $scopeConfig;
	$this->accountManagement = $accountManagement;
    }
    /**
     * validate the social access.
     *
     * @api
     * @param string $type
     * @param string $social_id
     * @param string $email
     * @return integer
     */
    public function validate($type,$social_id,$email="") {
	
	 /**
         * When Magento get your model, it will generate a Factory class
         * for your model at var/generaton folder and we can get your
         * model by this way
         */
	
	$SocialAccessModel = $this->modelSocialAccessFactory->create();
	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$emailAvailable = -1;
	}
	else $emailAvailable = $this->accountManagement->isEmailAvailable($email,null);	// email available == email does not exist
        // Get sn collection
        
	$saCollection = $SocialAccessModel->getCollection();
	$key = $saCollection->addFieldToFilter('type',$type)->addFieldToFilter('user_id',$social_id)->getData();
	
	if(count($key) === 0)
	{
	    if($emailAvailable === false) return -1; // email exists, social binding does not exist
	    else return 0; // neither social binding nor email exists
	}
	else 
	{	
		if($emailAvailable === false|| $emailAvailable === -1) return intval($key[0]["customer_id"]); //both social binding and email exist
		else return -2; // email does not exist, social binding exist. This is the special case that customer changed their email in social account or the user email account in magento has been deleted by admin by accident.
	}	
    }

	
    /**
     * validate the social access token.
     *
     * @api
     * @param string $type is the type of social media.
     * @param string $social_id is the id of the social media user.
     * @param string $social_token is the access token of the social media user.
     * @return integer
     */

    public function validateToken($type,$social_id,$social_token) {
	
	 /**
         * When Magento get your model, it will generate a Factory class
         * for your model at var/generaton folder and we can get your
         * model by this way
         */
	if($type ==="googleplus")
	{
		$client = new Google_Client();
		$ticket = $client->verifyIdToken($social_token);
  		if ($ticket) {
	    		if($social_id == $ticket['sub']) return 1; // user ID
	  	}
		return 0;
	}
	else if($type === "facebook")
	{
		$app_id = $this->scopeConfig->getValue('psloginfree/facebook/application_id', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
 		
		$params = [
                	'access_token'  => $social_token
            	];
    
            	if($response = $this->_call('https://graph.facebook.com/me', $params)) {
            	    $data = json_decode($response, true);
            	}
		else return -1;
		if(!empty($data['id'])) {
			if($data['id'] == $social_id)return 1;
			else return 0;
		}
		return 0;

	}
	return 0;	
    }

    /**
     * get customer email.
     *
     * @api
     * @param string $type is the type of social media.
     * @param string $social_id is the id of the social media user.
     * @param string $social_token is the access token of the social media user.
     * @return string
     */

    public function getCustomerEmail($type,$social_id,$social_token) {
	
	if($type ==="googleplus")
	{
		$client = new Google_Client();
		$ticket = $client->verifyIdToken($social_token);
  		if ($ticket) {
	    		if($social_id == $ticket['sub']) 
			{
				if(empty($ticket['email'])) {
			    		return "";
			    	}
				return $ticket['email'];
			}
			else return "";
	  	}
		return "";
	}
	else if($type === "facebook")
	{
		$app_id = $this->scopeConfig->getValue('psloginfree/facebook/application_id', \Magento\Store\Model\ScopeInterface::SCOPE_STORE); 
		$fields = ['user_id' => 'id','email' => 'email']; 
		$params = [
                	'access_token'  => $social_token,
			'fields' => implode(',', $fields)
            	];
    
            	if($response = $this->_call('https://graph.facebook.com/me', $params)) {
            	    $data = json_decode($response, true);
            	}
		else return "";
		if(!empty($data['id'])) {
			if($data['id'] == $social_id)
			{
				if(!empty($data['email']))
				{
					return $data['email'];
				}
				else return "";
			}
			else return "";
		}
		return "";

	}
	return "";	
    }





    protected function _call($url, $params = [], $method = 'GET', $curlResource = null)
    {
        $result = null;
        $paramsStr = is_array($params)? urlencode(http_build_query($params)) : urlencode($params);
        if($paramsStr) {
            $url .= '?'. urldecode($paramsStr);
        }
        
        $curl = is_resource($curlResource)? $curlResource : curl_init();

        if($method == 'POST') {
            // POST.
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $paramsStr);
        }else{
            // GET.
            curl_setopt($curl, CURLOPT_URL, $url);
        }

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // if (Mage::getSingleton('plumbase/observer')->customer() == Mage::getSingleton('plumbase/product')->currentCustomer()) {
            $result = curl_exec($curl);
        // }
        curl_close($curl);

        return $result;
    }

}
