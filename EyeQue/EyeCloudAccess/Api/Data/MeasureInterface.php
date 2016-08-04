<?php

/**
 * Copyright 2016 EyeQue. All rights reserved.
 * Yuan Xiong
 */

namespace EyeQue\EyeCloudAccess\Api\Data;

/**
 * Defines a data structure representing a measurement.
 */
interface MeasureInterface
{
    /**
     * Get the subjectID.
     *
     * @api
     * @return int The subjectID.
     */
    public function getSubjectID();

    /**
     * Set the subjectID.
     *
     * @api
     * @param $value int The new value.
     * @return null
     */
    public function setSubjectID($value);


	
    /**
     * Get the power.
     *
     * @api
     * @return float The power.
     */
    public function getPower();

    /**
     * Set the power.
     *
     * @api
     * @param $value float The new value.
     * @return null
     */
    public function setPower($value);



    /**
     * Get the angle.
     *
     * @api
     * @return float The angle.
     */
    public function getAngle();

    /**
     * Set the angle.
     *
     * @api
     * @param $value float The new value.
     * @return null
     */
    public function setAngle($value);


    /**
     * Get the rightEye.
     *
     * @api
     * @return bool The rightEye.
     */
    public function getRightEye();

    /**
     * Set the rightEye.
     *
     * @api
     * @param $value bool The new value.
     * @return null
     */
    public function setRightEye($value);    


    /**
     * Get the distance.
     *
     * @api
     * @return float The distance.
     */
    public function getDistance();

    /**
     * Set the distance.
     *
     * @api
     * @param $value float The new value.
     * @return null
     */
    public function setDistance($value);

    
    /**
     * Get the duration.
     *
     * @api
     * @return float The duration.
     */
    public function getDuration();

    /**
     * Set the duration.
     *
     * @api
     * @param $value float The new value.
     * @return null
     */
    public function setDuration($value);
    

}
