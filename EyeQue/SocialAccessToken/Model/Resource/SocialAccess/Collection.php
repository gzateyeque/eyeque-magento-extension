<?php
/**
 * Copyright © 2016 EyeQue. All rights reserved.
 * Yuan Xiong
 */

     

namespace EyeQue\SocialAccessToken\Model\Resource\SocialAccess;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
/**
 * Define model & resource model
 */
	protected function _construct()
	{
	    $this->_init(
		'EyeQue\SocialAccessToken\Model\SocialAccess',
		'EyeQue\SocialAccessToken\Model\Resource\SocialAccess'
	    );
	}
}
