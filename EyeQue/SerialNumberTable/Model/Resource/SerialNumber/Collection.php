<?php
/**
 * Copyright © 2016 EyeQue. All rights reserved.
 * Yuan Xiong
 */

     

namespace EyeQue\SerialNumberTable\Model\Resource\SerialNumber;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
/**
 * Define model & resource model
 */
	protected function _construct()
	{
	    $this->_init(
		'EyeQue\SerialNumberTable\Model\SerialNumber',
		'EyeQue\SerialNumberTable\Model\Resource\SerialNumber'
	    );
	}
}
