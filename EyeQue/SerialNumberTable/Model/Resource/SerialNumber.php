<?php
/**
 * Copyright © 2016 EyeQue. All rights reserved.
 * Yuan Xiong
 */

     
namespace EyeQue\SerialNumberTable\Model\Resource;
 
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
 
class SerialNumber extends AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('EyeQue_SerialNumber', 'id');
    }
}
