<?php

/**
 * Copyright 2016 EyeQue. All rights reserved.
 * Yuan Xiong
 */

namespace EyeQue\EyeCloudAccess\Api\Data;

/**
 * Defines a data structure representing the tests, including measures and test condition
 */
interface TestsInterface
{
   /**
     * Get the accomPattern.
     *
     * @api
     * @return string The accomPattern.
     */
    public function getAccomPattern();

   /**
     * Set the accomPattern.
     *
     * @api
     * @param $value string The new value.
     * @return null.
     */
    public function setAccomPattern($value);


   /**
     * Get the binoOp.
     *
     * @api
     * @return string The binoOp.
     */
    public function getBinoOp();

   /**
     * Set the binoOp.
     *
     * @api
     * @param $value string The new value.
     * @return null.
     */
    public function setBinoOp($value);


    /**
     * Get the lineLength.
     *
     * @api
     * @return float The lineLength.
     */
    public function getLineLength();

    /**
     * Set the lineLength.
     *
     * @api
     * @param $value float The new value.
     * @return null.
     */
    public function setLineLength($value);
    

    /**
     * Get the deviceName.
     *
     * @api
     * @return string The deviceName.
     */
    public function getDeviceName();

   /**
     * Set the deviceName.
     *
     * @api
     * @param $value string The new value.
     * @return null.
     */
    public function setDeviceName($value);


    /**
     * Get the testType.
     *
     * @api
     * @return string The testType.
     */
    public function getTestType();

   /**
     * Set the testType.
     *
     * @api
     * @param $value string The new value.
     * @return null.
     */
    public function setTestType($value);


     /**
     * Get the phoneType.
     *
     * @api
     * @return string The phoneType.
     */
    public function getPhoneType();

   /**
     * Set the phoneType.
     *
     * @api
     * @param $value string The new value.
     * @return null.
     */
    public function setPhoneType($value);


    /**
     * Get the measures.
     *
     * @api
     * @return EyeQue\EyeCloudAccess\Api\Data\MeasureInterface[] The measurements.
     */
    public function getMeasures();

   /**
     * Set the measures.
     *
     * @api
     * @param $value EyeQue\EyeCloudAccess\Api\Data\MeasureInterface[] The new value.
     * @return null.
     */
    public function setMeasures($value);


    /**
     * Get the subjectID.
     *
     * @api
     * @return int The phoneType.
     */
    public function getSubjectID();

   /**
     * Set the subjectID.
     *
     * @api
     * @param $value int The new value.
     * @return null.
     */
    public function setSubjectID($value);


    /**
     * Get the lineWidth.
     *
     * @api
     * @return float The lineWidth.
     */
    public function getLineWidth();

    /**
     * Set the lineWidth.
     *
     * @api
     * @param $value float The new value.
     * @return null.
     */
    public function setLineWidth($value);

    /**
     * Get the screenProtect.
     *
     * @api
     * @return boolean The screenProtect.
     */
    public function getScreenProtect();

    /**
     * Set the screenProtect.
     *
     * @api
     * @param $value boolean The new value.
     * @return null.
     */
    public function setScreenProtect($value);

    /**
     * Get the wearGlasses.
     *
     * @api
     * @return boolean The wearGlasses.
     */
    public function getWearGlasses();

    /**
     * Set the wearGlasses.
     *
     * @api
     * @param $value boolean The new value.
     * @return null.
     */
    public function setWearGlasses($value);


}
