<?php
/**
 * Copyright © 2016 EyeQue. All rights reserved.
 * Yuan Xiong
 */

     
namespace EyeQue\SerialNumberTable\Model;
     
use Magento\Framework\Model\AbstractModel;
     
class SerialNumber extends AbstractModel
{
/**
 * Define resource model
 */
	protected function _construct()
	{
	    $this->_init('EyeQue\SerialNumberTable\Model\Resource\SerialNumber');
	}
}
