<?php

/**
 * Copyright 2016 EyeQue. All rights reserved.
 * Yuan Xiong
 */

namespace EyeQue\SerialNumberTable\Api;
use EyeQue\SerialNumberTable\Api\Data\ReturnObjectInterface;

/**
 * Defines the service contract for some simple api functions. 
 * calculator design.
 */
interface SerialNumberInterface
{
    /**
     * check the serial number.
     *
     * @api
     * @param string $sn is the serial number to be checked.
     * @return EyeQue\SerialNumberTable\Api\Data\ReturnObjectInterface
     */
    public function check($sn);
}
