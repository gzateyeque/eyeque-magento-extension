<?php
/**
 * Copyright © 2016 EyeQue. All rights reserved.
 * Yuan Xiong
 */

     
namespace EyeQue\EyeCloudAccess\Model\Data;
     
use EyeQue\EyeCloudAccess\Api\Data\TestsInterface;
     
/**
 * Defines a data structure representing a tests object.
 */
class Tests implements TestsInterface
{
    public $accomPattern;
    public $binoOp;
    public $lineLength;
    public $deviceName;
    public $testType;
    public $phoneType;
    public $measures;
    public $subjectID;
    public $lineWidth;
    public $screenProtect;
    public $wearGlasses;
    /**
     * Constructor.
     */
    public function __construct() {
            $this->screenProtect = false;
            $this->wearGlasses = false;
    }

     /**
     * Get the accomPattern.
     *
     * @api
     * @return string The accomPattern.
     */
    public function getAccomPattern()
    {
	return $this->accomPattern;
    }

   /**
     * Set the accomPattern.
     *
     * @api
     * @param $value string The new value.
     * @return null.
     */
    public function setAccomPattern($value)
    {
        $this->accomPattern = $value;
    }


     /**
     * Get the binOp.
     *
     * @api
     * @return string The binOp.
     */
    public function getBinoOp()
    {
	return $this->binoOp;
    }

   /**
     * Set the binOp.
     *
     * @api
     * @param $value string The new value.
     * @return null.
     */
    public function setBinoOp($value)
    {
        $this->binoOp = $value;
    }


    /**
     * Get the lineLength.
     *
     * @api
     * @return float The lineLength.
     */
    public function getLineLength()
    {
	return $this->lineLength;
    }

    /**
     * Set the lineLength.
     *
     * @api
     * @param $value float The new value.
     * @return null.
     */
    public function setLineLength($value)
    {
        $this->lineLength = $value;
    }
    

    /**
     * Get the deviceName.
     *
     * @api
     * @return string The deviceName.
     */
    public function getDeviceName()
    {
	return $this->deviceName;
    }

   /**
     * Set the deviceName.
     *
     * @api
     * @param $value string The new value.
     * @return null.
     */
    public function setDeviceName($value)
    {
        $this->deviceName = $value;
    }


    /**
     * Get the testType.
     *
     * @api
     * @return string The testType.
     */
    public function getTestType()
    {
	return $this->testType;
    }

   /**
     * Set the testType.
     *
     * @api
     * @param $value string The new value.
     * @return null.
     */
    public function setTestType($value)
    {
        $this->testType = $value;
    }


     /**
     * Get the phoneType.
     *
     * @api
     * @return string The phoneType.
     */
    public function getPhoneType()
    {
	return $this->phoneType;
    }

   /**
     * Set the phoneType.
     *
     * @api
     * @param $value string The new value.
     * @return null.
     */
    public function setPhoneType($value)
    {
        $this->phoneType = $value;
    }


    /**
     * Get the measures.
     *
     * @api
     * @return EyeQue\EyeCloudAccess\Api\Data\MeasureInterface[] The measurements.
     */
    public function getMeasures()
    {
	return $this->measures;
    }

   /**
     * Set the measures.
     *
     * @api
     * @param $value EyeQue\EyeCloudAccess\Api\Data\MeasureInterface[] The new value.
     * @return null.
     */
    public function setMeasures($value)
    {
        $this->measures = $value;
    }


    /**
     * Get the subjectID.
     *
     * @api
     * @return int The phoneType.
     */
    public function getSubjectID()
    {
	return $this->subjectID;
    }

   /**
     * Set the subjectID.
     *
     * @api
     * @param $value int The new value.
     * @return null.
     */
    public function setSubjectID($value)
    {
        $this->subjectID = $value;
    }


    /**
     * Get the lineWidth.
     *
     * @api
     * @return float The lineWidth.
     */
    public function getLineWidth()
    {
	return $this->lineWidth;
    }

    /**
     * Set the lineWidth.
     *
     * @api
     * @param $value float The new value.
     * @return null.
     */
    public function setLineWidth($value)
    {
        $this->lineWidth = $value;
    }

     /**
     * Get the screenProtect.
     *
     * @api
     * @return boolean The screenProtect.
     */
    public function getScreenProtect()
    {
	return $this->screenProtect;
    }

    /**
     * Set the screenProtect.
     *
     * @api
     * @param $value boolean The new value.
     * @return null.
     */
    public function setScreenProtect($value)
    {
        $this->screenProtect = $value;
    }

    /**
     * Get the wearGlasses.
     *
     * @api
     * @return boolean The wearGlasses.
     */
    public function getWearGlasses()
    {
	return $this->wearGlasses;
    }

    /**
     * Set the wearGlasses.
     *
     * @api
     * @param $value boolean The new value.
     * @return null.
     */
    public function setWearGlasses($value)
    {
        $this->wearGlasses = $value;
    }


}
