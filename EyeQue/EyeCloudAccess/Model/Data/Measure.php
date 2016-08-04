<?php
/**
 * Copyright © 2016 EyeQue. All rights reserved.
 * Yuan Xiong
 */

     
namespace EyeQue\EyeCloudAccess\Model\Data;
     
use EyeQue\EyeCloudAccess\Api\Data\MeasureInterface;
     
/**
 * Defines a data structure representing a measurement.
 */
class Measure implements MeasureInterface
{
    public $subjectID;
    public $power;
    public $angle;
    public $rightEye;
    public $distance;
    public $duration;
    /**
     * Constructor.
     */
    public function __construct() {
    }

    /**
     * Get the subjectID.
     *
     * @api
     * @return int The subjectID.
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
     * @return null
     */
    public function setSubjectID($value)
    {
        $this->subjectID = $value;
    }


	
    /**
     * Get the power.
     *
     * @api
     * @return float The power.
     */
    public function getPower()
    {
	return $this->power;
    }

    /**
     * Set the power.
     *
     * @api
     * @param $value float The new value.
     * @return null
     */
    public function setPower($value) 
    {
        $this->power = $value;
    }



    /**
     * Get the angle.
     *
     * @api
     * @return float The angle.
     */
    public function getAngle()
    {
	return $this->angle;
    }

    /**
     * Set the angle.
     *
     * @api
     * @param $value float The new value.
     * @return null
     */
    public function setAngle($value)
    {
        $this->angle = $value;
    }


    /**
     * Get the rightEye.
     *
     * @api
     * @return bool The rightEye.
     */
    public function getRightEye()
    {
	return $this->rightEye;
    }

    /**
     * Set the rightEye.
     *
     * @api
     * @param $value bool The new value.
     * @return null
     */
    public function setRightEye($value)
    {
        $this->rightEye = $value;
    }   


    /**
     * Get the distance.
     *
     * @api
     * @return float The distance.
     */
    public function getDistance()
    {
	return $this->distance;
    }

    /**
     * Set the distance.
     *
     * @api
     * @param $value float The new value.
     * @return null
     */
    public function setDistance($value)
    {
        $this->distance = $value;
    }

    
    /**
     * Get the duration.
     *
     * @api
     * @return float The duration.
     */
    public function getDuration()
    {
	return $this->duration;
    }

    /**
     * Set the duration.
     *
     * @api
     * @param $value float The new value.
     * @return null
     */
    public function setDuration($value)
    {
        $this->duration = $value;
    }
}
