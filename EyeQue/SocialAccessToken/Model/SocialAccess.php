<?php


/**
 * Copyright 2016 EyeQue. All rights reserved.
 * Yuan Xiong.
 */
     
namespace EyeQue\SocialAccessToken\Model;
     
use Magento\Framework\Model\AbstractModel;
     
class SocialAccess extends AbstractModel
{
/**
 * Define resource model
 */
	protected function _construct()
	{
	    $this->_init('EyeQue\SocialAccessToken\Model\Resource\SocialAccess');
	}
}
