<?php
/**
 * Plumrocket Inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the End-user License Agreement
 * that is available through the world-wide-web at this URL:
 * http://wiki.plumrocket.net/wiki/EULA
 * If you are unable to obtain it through the world-wide-web, please
 * send an email to support@plumrocket.com so we can send you a copy immediately.
 *
 * @package     Plumrocket_SocialLoginFree
 * @copyright   Copyright (c) 2015 Plumrocket Inc. (http://www.plumrocket.com)
 * @license     http://wiki.plumrocket.net/wiki/EULA  End-user License Agreement
 */
namespace Plumrocket\SocialLoginFree\Model;
$code_root = dirname(dirname(dirname(dirname(__FILE__))));
include_once $code_root.'/google-api-php-client/vendor/autoload.php';
use \Google_Client as Google_Client;



class Googleplus extends Account
{
	protected $_type = 'googleplus';
	
    protected $_url = 'https://accounts.google.com/o/oauth2/auth';


	protected $_fields = [
					'user_id' => 'id',
		            'firstname' => 'first_name',
		            'lastname' => 'last_name',
		            'email' => 'email',
		            'dob' => 'birthday',
                    'gender' => 'gender',
                    'photo' => 'picture',
				];

	protected $_buttonLinkParams = [
					'scope' => 'email%20profile%20openid'
				];

    protected $_popupSize = [650, 350];

	public function _construct()
    {      
        parent::_construct();
        $oauth_nonce = md5(uniqid(rand(), true)); 

        $this->_buttonLinkParams = array_merge($this->_buttonLinkParams, [
            'client_id'     => $this->_applicationId,
            'redirect_uri'  => $this->_redirectUri,
            'response_type' => $this->_responseType,
	    'nonce' => $oauth_nonce
        ]);
    }

    public function loadUserData($response)
    {
    	if(empty($response)) {
    		return false;
    	}
        //$message = json_encode($response);echo "<SCRIPT>alert('$message');</SCRIPT>";
        $data = [];
	
        $params = [
            'client_id' => $this->_applicationId,
            'client_secret' => $this->_secret,
            'code' => $response,
            'redirect_uri' => $this->_redirectUri
        ];

	$code_root = dirname(dirname(dirname(dirname(__FILE__))));
	$client = new Google_Client();
	$client->setAuthConfigFile($code_root.'/google-api-php-client/client_secrets.json');
	$client->addScope("https://www.googleapis.com/auth/userinfo.profile");
	$client->addScope("https://www.googleapis.com/auth/userinfo.email");
	$client->setRedirectUri($this->_redirectUri);
	$client->authenticate($_GET['code']);	
	$token = $client->getAccessToken();
        $this->_setLog($response, true);
        $this->_setLog($token, true);
	//$message = json_encode($token);echo "<SCRIPT>alert('$message');</SCRIPT>";    

        if (isset($token['access_token'])) {
            $params = [
                'access_token'  => $token['access_token']
            ];
    
            if($response = $this->_call('https://www.googleapis.com/plus/v1/people/me', $params)) {
                $data = json_decode($response, true);
            }
            foreach ( $data['emails'] as $emails)
	    {
		if($emails['type']==='account')//primary email
		{
			$data['email']=$emails['value'];
			break;
		}
	    }

            if(!empty($data['image'])) {
                $data['picture'] = $data['image']['url'];
            }

	    if(!empty($data['name'])) {
                $data['firstname'] = $data['name']['givenName'];
		$data['lastname'] = $data['name']['familyName'];
            }

            
            $this->_setLog($data, true);
        }
 
        if(!$this->_userData = $this->_prepareData($data)) {
        	return false;
        }

        $this->_setLog($this->_userData, true);

        return true;
    }

    protected function _prepareData($data)
    {
    	if(empty($data['id'])) {
    		return false;
    	}

        return parent::_prepareData($data);
    }

}
