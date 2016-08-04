<?php
/**
 * Copyright © 2016 EyeQue. All rights reserved.
 * Yuan Xiong
 */

     
namespace EyeQue\SerialNumberTable\Model;
     
use EyeQue\SerialNumberTable\Api\Data\ReturnObjectInterface;
     
/**
 * Defines a data structure representing a return object, to demonstrating passing
 * more complex types in and out of a function call.
 */
class ReturnObject implements ReturnObjectInterface
{
    private $return_code;

    /**
     * Constructor.
     */
    public function __construct() {
        $this->return_code = 0;
    }

    /**
     * Get the return code.
     *
     * @api
     * @return int The return code.
     */
    public function getReturnCode()
    {
	return $this->return_code;
    }

    /**
     * Set the return code.
     *
     * @api
     * @param $value int The new return code.
     * @return null
     */
    public function setReturnCode($value)
    {
	$this->return_code = $value;
    }
}
