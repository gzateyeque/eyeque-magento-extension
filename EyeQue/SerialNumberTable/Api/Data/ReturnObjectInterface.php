<?php

/**
 * Copyright 2016 EyeQue. All rights reserved.
 * Yuan Xiong
 */

namespace EyeQue\SerialNumberTable\Api\Data;

/**
 * Defines a data structure representing a return object, to demonstrating passing
 * more complex types in and out of a function call.
 */
interface ReturnObjectInterface
{
    /**
     * Get the return code.
     *
     * @api
     * @return int The return code.
     */
    public function getReturnCode();

    /**
     * Set the return code.
     *
     * @api
     * @param $value int The new return code.
     * @return null
     */
    public function setReturnCode($value);

}
