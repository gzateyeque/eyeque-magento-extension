<?php

/**
 * Copyright 2016 EyeQue. All rights reserved.
 * Yuan Xiong
 */

namespace EyeQue\SocialAccessToken\Api;
use Magento\Customer\Api\Data\CustomerInterface;

/**
 * Defines the service contract for some simple api functions. 
 * 
 */
interface SocialAccountInterface
{
   
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
    public function createAccount(CustomerInterface $customer, $password = null, $redirectUrl = '',$type, $social_id, $social_token);

}
