<?php
/**
 * Copyright © 2016 EyeQue. All rights reserved.
 * Yuan Xiong
 */

     
namespace EyeQue\EyeCloudAccess\Model\Data;
     
use EyeQue\EyeCloudAccess\Api\Data\DeviceInterface;
     
/**
 * Defines a data structure representing a result object.
 */
class Device implements DeviceInterface
{
    public $id;
    public $blue_degree;
    public $calc_angles;
    public $created_at;
    public $green_degree;
    public $height;
    public $initial_angle;
    public $initial_distance;
    public $line_length;
    public $line_width;
    public $max_distance;
    public $min_distance;
    public $name;
    public $off_center_x;
    public $off_center_y;
    public $phone_type;
    public $rc_angles;
    public $red_degree;
    public $rotated_angles;
    public $width;
    
    
	
    /**
     * Constructor.
     */
    public function __construct() {
    }
      /**
     * @api
     * @return int
     */
    public function getId()
    {
	return $this->id;
    }

    /**
     * @api
     * @param $value int
     * @return null
     */
    public function setId($value)
    {
	$this->id = $value;
    }

    /**
     * @api
     * @return float
     */
    public function getBlueDegree()
    {
	return $this->blue_degree;
    }

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setBlueDegree($value)
    {
	$this->blue_degree = $value;
    }

     /**
     * @api
     * @return string
     */
    public function getCalcAngles()
    {
	return $this->calc_angles;
    }

    /**
     * @api
     * @param $value string
     * @return null
     */
    public function setCalcAngles($value)
    {
	$this->calc_angles = $value;
    }

     /**
     * @api
     * @return string
     */
    public function getCreatedAt()
    {
	return $this->created_at;
    }

    /**
     * @api
     * @param $value string
     * @return null
     */
    public function setCreatedAt($value)
    {
	$this->created_at = $value;
    }

    /**
     * @api
     * @return float
     */
    public function getGreenDegree()
    {
	return $this->green_degree;
    }

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setGreenDegree($value)
    {
	$this->green_degree = $value;
    }

    /**
     * @api
     * @return float
     */
    public function getHeight()
    {
	return $this->height;
    }

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setHeight($value)
    {
	$this->height = $value;
    }

     /**
     * @api
     * @return float
     */
    public function getInitialAngle()
    {
	return $this->initial_angle;
    }

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setInitialAngle($value)
    {
	$this->initial_angle = $value;
    }

     /**
     * @api
     * @return float
     */
    public function getInitialDistance()
    {
	return $this->initial_distance;
    }

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setInitialDistance($value)
    {
	$this->initial_distance = $value;
    }

    /**
     * @api
     * @return float
     */
    public function getLineLength()
    {
	return $this->line_length;
    }

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setLineLength($value)
    {
	$this->line_length = $value;
    }


    /**
     * @api
     * @return float
     */
    public function getLineWidth()
    {
	return $this->line_width;
    }

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setLineWidth($value)
    {
	$this->line_width = $value;
    }

    /**
     * @api
     * @return float
     */
    public function getMaxDistance()
    {
	return $this->max_distance;
    }

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setMaxDistance($value)
    {
	$this->max_distance = $value;
    }

    /**
     * @api
     * @return float
     */
    public function getMinDistance()
    {
	return $this->min_distance;
    }

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setMinDistance($value)
    {
	$this->min_distance = $value;
    }

    /**
     * @api
     * @return string
     */
    public function getName()
    {
	return $this->name;
    }

    /**
     * @api
     * @param $value string
     * @return null
     */
    public function setName($value)
    {
	$this->name = $value;
    }

    /**
     * @api
     * @return float
     */
    public function getOffCenterX()
    {
	return $this->off_center_x;
    }

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setOffCenterX($value)
    {
	$this->off_center_x = $value;
    }

    /**
     * @api
     * @return float
     */
    public function getOffCenterY()
    {
	return $this->off_center_y;
    }

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setOffCenterY($value)
    {
	$this->off_center_y = $value;
    }


    /**
     * @api
     * @return string
     */
    public function getPhoneType()
    {
	return $this->phone_type;
    }

    /**
     * @api
     * @param $value string
     * @return null
     */
    public function setPhoneType($value)
    {
	$this->phone_type = $value;
    }

    /**
     * @api
     * @return string
     */
    public function getRcAngles()
    {
	return $this->rc_angles;
    }

    /**
     * @api
     * @param $value string
     * @return null
     */
    public function setRcAngles($value)
    {
        $this->rc_angles = $value;
    }

    /**
     * @api
     * @return float
     */
    public function getRedDegree()
    {
	return $this->red_degree;
    }

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setRedDegree($value)
    {
        $this->red_degree = $value;
    }

    /**
     * @api
     * @return string
     */
    public function getRotatedAngles()
    {
	return $this->rotated_angles;
    }

    /**
     * @api
     * @param $value string
     * @return null
     */
    public function setRotatedAngles($value)
    {
	$this->rotated_angles = $value;
    }

    /**
     * @api
     * @return float
     */
    public function getWidth()
    {
	return $this->width;
    }

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setWidth($value)
    {
	$this->width = $value;
    }

   
}
