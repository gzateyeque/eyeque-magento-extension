<?php

/**
 * Copyright 2016 EyeQue. All rights reserved.
 * Yuan Xiong
 */

namespace EyeQue\SocialAccessToken\Api;


/**
 * Defines the service contract for some simple api functions. 
 * 
 */
interface SocialAccessTokenInterface
{
    /**
     * validate the social access id.
     *
     * @api
     * @param string $type is the type of social media.
     * @param string $social_id is the id of the social media user.
     * @param string $email
     * @return integer
     */
    public function validate($type, $social_id,$email="");

    /**
     * validate the social access token.
     *
     * @api
     * @param string $type is the type of social media.
     * @param string $social_id is the id of the social media user.
     * @param string $social_token is the access token of the social media user.
     * @return integer
     */
    public function validateToken($type, $social_id, $social_token);
    
    /**
     * get customer email.
     *
     * @api
     * @param string $type is the type of social media.
     * @param string $social_id is the id of the social media user.
     * @param string $social_token is the access token of the social media user.
     * @return string
     */
    public function getCustomerEmail($type, $social_id, $social_token);


}
