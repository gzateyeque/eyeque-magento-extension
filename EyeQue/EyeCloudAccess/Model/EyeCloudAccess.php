<?php
/**
 * Copyright © 2016 EyeQue. All rights reserved.
 * Yuan Xiong
 */

     
namespace EyeQue\EyeCloudAccess\Model;
     
use EyeQue\EyeCloudAccess\Api\EyeCloudAccessInterface;                                                                                                                 
use EyeQue\EyeCloudAccess\Api\Data\TestsInterface;
use EyeQue\EyeCloudAccess\Api\Data\TestsInterfaceFactory;
use EyeQue\EyeCloudAccess\Api\Data\ResultInterface;
use EyeQue\EyeCloudAccess\Api\Data\ResultInterfaceFactory;
use EyeQue\EyeCloudAccess\Api\Data\DeviceInterface;
use EyeQue\EyeCloudAccess\Api\Data\DeviceInterfaceFactory;
use EyeQue\EyeCloudAccess\EyeCloudConstants;
use Magento\User\Model\User as UserModel;
use Magento\Integration\Model\CredentialsValidator;
use Magento\Integration\Model\Oauth\Token\RequestThrottler;
use Magento\Framework\Exception\AuthenticationException;
use Magento\Framework\Exception\LocalizedException;

/**
 * Defines the implementaiton class of the EyeCloudAccess service contract.
 */
class EyeCloudAccess implements EyeCloudAccessInterface
{
    /**
     * User Model
     *
     * @var UserModel
     */
    private $userModel;

    /**
     * @var RequestThrottler
     */
    private $requestThrottler;
 
    /**
     * @var \Magento\Integration\Model\CredentialsValidator
     */
    private $validatorHelper;
   

    /**
     * @var ResultInterfaceFactory
     * Factory for creating new result instances. This code will be automatically
     * generated because the type ends in "Factory".
     */
    private $resultFactory;

    /**
     * @var DeviceInterfaceFactory
     * Factory for creating new result instances. This code will be automatically
     * generated because the type ends in "Factory".
     */
    private $deviceFactory;


    /**
     * Constructor.
     * @param \Magento\Integration\Model\CredentialsValidator $validatorHelper
     * @param ResultInterfaceFactory
     */
    public function __construct(
        DeviceInterfaceFactory $deviceFactory,
        ResultInterfaceFactory $resultFactory,
	UserModel $userModel,
        CredentialsValidator $validatorHelper
    ) {
        $this->deviceFactory = $deviceFactory;
	$this->resultFactory = $resultFactory;
        $this->userModel = $userModel;
	$this->validatorHelper = $validatorHelper;
    }
    /**
     * Upload data to EyeCloud.
     *
     * @api
     * @param int $customerId
     * @param EyeQue\EyeCloudAccess\Api\Data\TestsInterface $testdata
     * @return EyeQue\EyeCloudAccess\Api\Data\ResultInterface
     */
    public function tests($customerId,$testdata)
    {
	 /**
         * When Magento get your model, it will generate a Factory class
         * for your model at var/generaton folder and we can get your
         * model by this way
         */
        


	//$customerId got from session based token authorization, passed in the header;
	if($customerId !== $testdata->getSubjectID())
	{
		throw new LocalizedException(
					__("Error, subjectID in tests does not match the user's token. Access denied.")
				    );
	}
	 	
	
	$response = $this->_call(EyeCloudConstants::EYECLOUD_API_UPLOAD . "?subjectID=".$customerId, json_encode($testdata), 'POST');        

	
        if(!empty(json_decode($response,true))) {
            $test_result = json_decode($response,true);
            $field = ["result" => $test_result];
            $document_response = $this->_call(EyeCloudConstants::DOCUMENT_API_PHP . "?action=updateUser&hash=".$this->_getHash($customerId),json_encode($field), 'POST');
	    if($document_response < 1) 
	    {
		throw new LocalizedException(
				__("Error, cannot update user profile.")
	        );
	    }			
		$return_result = $this->resultFactory->create();
		$return_result->setId($test_result["id"]);
		$return_result->setAlgorithm($test_result["algorithm"]);
		$return_result->setAxisOD($test_result["axisOD"]);
		$return_result->setAxisOS($test_result["axisOS"]);
		$return_result->setCreatedAt($test_result["createdAt"]);
		$return_result->setDuration($test_result["duration"]);
		$return_result->setCylOD($test_result["cylOD"]);
		$return_result->setCylOS($test_result["cylOS"]);
		$return_result->setRmseOD($test_result["rmseOD"]);
		$return_result->setRmseOS($test_result["rmseOS"]);
		$return_result->setSpheOD($test_result["sphEOD"]);
		$return_result->setSpheOS($test_result["sphEOS"]);
		$return_result->setSphOD($test_result["sphOD"]);
		$return_result->setSphOS($test_result["sphOS"]);
		$return_result->setStatusType($test_result["statusType"]);
		$return_result->setSubjectID($test_result["subjectID"]);
		$return_result->setTestConditionID($test_result["testConditionID"]);
		return $return_result;
        }
	else
	{
		throw new LocalizedException(
					__("Error, no response from EyeCloud.")
				    );	
	}

    }

        /**
     * Get device parameters.
     *
     * @api
     * @param string $name
     * @param string $phoneType
     * @return EyeQue\EyeCloudAccess\Api\Data\DeviceInterface
     */
    public function devices($name = "",$phoneType = "")
    {

	$response = $this->_call(EyeCloudConstants::EYECLOUD_API_GET_DEVICE_PARAMETERSN . "?name=".$name."&phoneType=".$phoneType, [], 'GET');    




        if(!empty(json_decode($response,true))) {
		$data =  json_decode($response,true); 
		$return_result = $this->deviceFactory->create();
		$return_result->setId($data[0]["id"]);
		$return_result->setBlueDegree($data[0]["blueDegree"]);
		$return_result->setCalcAngles($data[0]["calcAngles"]);
		$return_result->setCreatedAt($data[0]["createdAt"]);
		$return_result->setGreenDegree($data[0]["greenDegree"]);
		$return_result->setHeight($data[0]["height"]);
		$return_result->setInitialAngle($data[0]["initialAngle"]);
		$return_result->setInitialDistance($data[0]["initialDistance"]);
		$return_result->setLineLength($data[0]["lineLength"]);
		$return_result->setLineWidth($data[0]["lineWidth"]);
		$return_result->setMaxDistance($data[0]["maxDistance"]);
		$return_result->setMinDistance($data[0]["minDistance"]);
		$return_result->setName($data[0]["name"]);
		$return_result->setOffCenterX($data[0]["offCenterX"]);
		$return_result->setOffCenterY($data[0]["offCenterY"]);
		$return_result->setPhoneType($data[0]["phoneType"]);
		$return_result->setRcAngles($data[0]["rcAngles"]);
		$return_result->setRedDegree($data[0]["redDegree"]);
		$return_result->setRotatedAngles($data[0]["rotatedAngles"]);
		$return_result->setWidth($data[0]["width"]);
		return $return_result;
        }
	else
	{
	    throw new LocalizedException(
		__("Error, no response from EyeCloud.")
	    );
	}

    }

    /**
     * Get test result.
     *
     * @api
     * @param int $customerId
     * @param int $testID The test condition id, different from results id(curved or averaged results id)
     * @return EyeQue\EyeCloudAccess\Api\Data\ResultInterface
     */
    public function results($customerId,$testID)
    {
	$response = $this->_call(EyeCloudConstants::EYECLOUD_API_GET_TEST_RESULT . "?testID=".$testID, "", 'GET');    
        if(!empty(json_decode($response,true))) {
		$data = json_decode($response,true);
		if($data && $data[0]["id"] && $data[0]["subjectID"]) 
		{
			if($data[0]["subjectID"] === $customerId){
			
				$return_result = $this->resultFactory->create();
				$return_result->setId($data[0]["id"]);
				$return_result->setAlgorithm($data[0]["algorithm"]);
				$return_result->setAxisOD($data[0]["axisOD"]);
				$return_result->setAxisOS($data[0]["axisOS"]);
				$return_result->setCreatedAt($data[0]["createdAt"]);
				$return_result->setDuration($data[0]["duration"]);
				$return_result->setCylOD($data[0]["cylOD"]);
				$return_result->setCylOS($data[0]["cylOS"]);
				$return_result->setRmseOD($data[0]["rmseOD"]);
				$return_result->setRmseOS($data[0]["rmseOS"]);
				$return_result->setSphEOD($data[0]["sphEOD"]);
				$return_result->setSphEOS($data[0]["sphEOS"]);
				$return_result->setSphOD($data[0]["sphOD"]);
				$return_result->setSphOS($data[0]["sphOS"]);
				$return_result->setStatusType($data[0]["statusType"]);
				$return_result->setSubjectID($data[0]["subjectID"]);
				$return_result->setTestConditionID($data[0]["testConditionID"]);
			 
				return $return_result;
			}

			else
			{	
				throw new LocalizedException(
					__("Error, subjectID in tests does not match the user's token. Access denied.")
			    	);
			}
		}
		else throw new LocalizedException(
			__('Error, no such a result matching the subject and testID.')
	    	);    
        }
	else
	{
	    throw new LocalizedException(
		__('Error, invalid testID.')
	    );
	}


    }

    /**
     * Get the vision record by given the customerID. Only one result with score > 100 will be returned. 
     *
     * @api
     * @param int $customerId
     * @return EyeQue\EyeCloudAccess\Api\Data\ResultInterface
     */

    public function getrecord($customerId)
    {
	$response = $this->_call(EyeCloudConstants::EYECLOUD_API_GET_VISION_RECORD . "?subjectID=".$customerId, "", 'GET');    

        if(!empty(json_decode($response,true))) {
		$data = json_decode($response,true);
		if($data && $data[0]["id"] && $data[0]["subjectID"]) 
		{
			if($data[0]["subjectID"] === $customerId){
			
				$return_result = $this->resultFactory->create();
				$return_result->setId($data[0]["id"]);
				//$return_result->setAlgorithm($data[0]["algorithm"]);
				$return_result->setAxisOD($data[0]["axisOD"]);
				$return_result->setAxisOS($data[0]["axisOS"]);
				$return_result->setCreatedAt($data[0]["createdAt"]);
				//$return_result->setDuration($data[0]["duration"]);
				$return_result->setCylOD($data[0]["cylOD"]);
				$return_result->setCylOS($data[0]["cylOS"]);
				//$return_result->setRmseOD($data[0]["rmseOD"]);
				//$return_result->setRmseOS($data[0]["rmseOS"]);
				//$return_result->setSphEOD($data[0]["sphEOD"]);
				//$return_result->setSphEOS($data[0]["sphEOS"]);
				$return_result->setSphOD($data[0]["sphOD"]);
				$return_result->setSphOS($data[0]["sphOS"]);
				//$return_result->setStatusType($data[0]["statusType"]);
				$return_result->setSubjectID($data[0]["subjectID"]);
				//$return_result->setTestConditionID($data[0]["testConditionID"]);
			 
				return $return_result;
			}

			else
			{	
				throw new LocalizedException(
					__("Error, subjectID in tests does not match the user's token. Access denied.")
			    	);
			}
		}
        }
	else
	{
	    throw new LocalizedException(
		__('Error, EyeCloud no response.')
	    );
	}
	
	
        return "";


    }
    
     /**
     * Get the url of the profile. 
     *
     * @api
     * @param int $customerId
     * @return string
     */
    public function getprofile($customerId)
    {
	$return_value = EyeCloudConstants::DOCUMENT_USER_PROFILE ."&hash=".$this->_getHash($customerId);
	return $return_value;
    }

    /**
     * Refresh all user profiles from EyeCloud.
     *
     * @api
     * @param string $username The admin username
     * @param string $password The admin password
     * @return string
     */
    public function refreshall($username,$password)
    {
	$this->validatorHelper->validate($username, $password);
	$this->getRequestThrottler()->throttle($username, RequestThrottler::USER_TYPE_ADMIN);
        $this->userModel->login($username, $password);
        if (!$this->userModel->getId()) {
            $this->getRequestThrottler()->logAuthenticationFailure($username, RequestThrottler::USER_TYPE_ADMIN);
            /*
             * This message is same as one thrown in \Magento\Backend\Model\Auth to keep the behavior consistent.
             * Constant cannot be created in Auth Model since it uses legacy translation that doesn't support it.
             * Need to make sure that this is refactored once exception handling is updated in Auth Model.
             */
            throw new AuthenticationException(
                __('You did not sign in correctly or your account is temporarily disabled.')
            );
        }
        $this->getRequestThrottler()->resetAuthenticationFailuresCount($username, RequestThrottler::USER_TYPE_ADMIN);
	
	$response = $this->_call(EyeCloudConstants::EYECLOUD_API_GET_MAX_TESTID, "", 'GET');
	$data = json_decode($response,true);
	if(!empty($data)) {
		$max_tasks = $data["maxID"];	

	}
	else
	{
	    throw new LocalizedException(
		__('Error, EyeCloud no response.')
	    );
	}
	if(empty($max_tasks)||$max_tasks<=0)
		return "No result to update."; 	

	$percentage_massage = "";
	$error_result = 0; 
	for($i = 1; $i <=$max_tasks; $i++)
	{
		$test_response = $this->_call(EyeCloudConstants::EYECLOUD_API_GET_TEST_RESULT . "?testID=".$i, "", 'GET');    
        	$test_result = json_decode($test_response,true);
		
		if(!empty($test_result) && !empty($test_result[0]) && !empty($test_result[0]["subjectID"]))
		{	
			$customerId = $test_result[0]["subjectID"];
		}
		else 
		{
			$error_result ++;
			continue;
		}
            	$field = ["result" => $test_result[0]];
            	$document_response = $this->_call(EyeCloudConstants::DOCUMENT_API_PHP . "?action=updateUser&hash=".$this->_getHash($customerId),json_encode($field), 'POST');
		print_r($document_response);echo PHP_EOL;
	    	if($document_response < 1) 
		{
			$error_result ++;
			continue;
		}
	
		for($j = 0; $j< 15; $j++)echo ".";
		$percentage_massage = "\r".round($i*100.0/$max_tasks,2)."% done.";
		print_r ($percentage_massage);
		for($j = 0; $j< 15-strlen($percentage_massage); $j++)echo ".";
	}
	echo PHP_EOL;
	return "All jobs done! ".($max_tasks - $error_result)." test result refreshed. Errors:".$error_result;
	
    }


   
    protected function _getHash($userID)
    {
	$padding="EyeQue is a company with one simple focus – provide cool vision technologies to the world at the lowest possible cost. We specialize in vision assessments and founded on the company on the simple belief that it is possible to make use of the internet to improve eye care. Optical Vision Devices will soon be joining the growing array of the Internet of Things.";
	$salt = md5($userID).$padding;
	return sha1($salt);	
    }

    protected function _call($url, $params = [], $method = 'GET', $curlResource = null)
    {
        $result = null;
        $paramsStr = $params;

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
	
	$headers = array(
	    'Content-Type:application/json',
	    'Authorization: Bearer '.EyeCloudConstants::EYECLOUD_HARD_CODE_ACCESS_TOKEN
	);

	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // if (Mage::getSingleton('plumbase/observer')->customer() == Mage::getSingleton('plumbase/product')->currentCustomer()) {
            $result = curl_exec($curl);
        // }
        curl_close($curl);

        return $result;
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
