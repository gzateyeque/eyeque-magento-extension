<?php


/**
 * Copyright 2016 EyeQue. All rights reserved.
 * Yuan Xiong.
 */

namespace EyeQue\SerialNumberTable\Model;

use EyeQue\SerialNumberTable\Api\SerialNumberInterface;
use EyeQue\SerialNumberTable\Api\Data\ReturnObjectInterface;
use EyeQue\SerialNumberTable\Api\Data\ReturnObjectInterfaceFactory;

/**
 * Defines the implementaiton class of the serial number service contract.
 */
class SNCheck implements SerialNumberInterface
{
    
    /**
     * @var ReturnObjectInterfaceFactory
     * Factory for creating new return object instances. This code will be automatically
     * generated because the type ends in "Factory".
     */
    private $returnObjectFactory;


    protected $modelSerialNumberFactory;
    

    /**
     * Constructor.
     *
     * @param ReturnObjectInterfaceFactory Factory for creating new ReturnObject instances.
     */
    public function __construct(
	ReturnObjectInterfaceFactory $returnObjectFactory,
        \EyeQue\SerialNumberTable\Model\SerialNumberFactory $modelSerialNumberFactory
    ) {
        $this->modelSerialNumberFactory = $modelSerialNumberFactory;
	$this->returnObjectFactory = $returnObjectFactory;
    }
    /**
     * check the serial number.
     *
     * @api
     * @param string $sn
     * @return ReturnObjectInterface
     */
    public function check($sn) {
	 /**
         * When Magento get your model, it will generate a Factory class
         * for your model at var/generaton folder and we can get your
         * model by this way
         */


	$serialNumberModel = $this->modelSerialNumberFactory->create();

        // Get sn collection
	$response_data = $this->returnObjectFactory->create();
	$response_data->setReturnCode(0);
 
	$snCollection = $serialNumberModel->getCollection();
	$key = count($snCollection->addFieldToFilter('SN',$sn)->getData());
	
	if($key > 0) $response_data->setReturnCode(1);
	
	
        return $response_data;


    }
}
