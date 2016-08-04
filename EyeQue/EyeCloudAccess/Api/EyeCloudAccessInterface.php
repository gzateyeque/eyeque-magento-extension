<?php

/**
 * Copyright 2016 EyeQue. All rights reserved.
 * Yuan Xiong
 */

namespace EyeQue\EyeCloudAccess\Api;


/**
 * Defines the service contract for api functions. 
 * 
 */
interface EyeCloudAccessInterface
{
    
    /**
     * Upload data to EyeCloud. The return object will include the calculated result if successfully uploaded.
     *
     * @api
     * @param int $customerId
     * @param EyeQue\EyeCloudAccess\Api\Data\TestsInterface $testdata
     * @return EyeQue\EyeCloudAccess\Api\Data\ResultInterface
     */
    public function tests($customerId,$testdata);

    /**
     * Get device parameters.
     *
     * @api
     * @param string $name
     * @param string $phoneType
     * @return EyeQue\EyeCloudAccess\Api\Data\DeviceInterface
     */
    public function devices($name,$phoneType);

    /**
     * Get test result based on $customerID and $testID. This may not be 
     *
     * @api
     * @param int $customerId
     * @param int $testID The test condition id, different from results id(curved or averaged results id)
     * @return EyeQue\EyeCloudAccess\Api\Data\ResultInterface
     */
    public function results($customerId,$testID);

    /**
     * Get the vision record by given the customerID. Only one result with score > 100 will be returned. 
     *
     * @api
     * @param int $customerId
     * @return EyeQue\EyeCloudAccess\Api\Data\ResultInterface
     */
    public function getrecord($customerId);

    /**
     * Get the url of the profile. 
     *
     * @api
     * @param int $customerId
     * @return string
     */
    public function getprofile($customerId);
    
    /**
     * Refresh all user profiles from EyeCloud.
     *
     * @api
     * @param string $username The admin username
     * @param string $password The admin password
     * @return string
     */
    public function refreshall($username,$password);

    


}
