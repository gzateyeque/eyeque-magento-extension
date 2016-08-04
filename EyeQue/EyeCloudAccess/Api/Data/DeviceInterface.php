<?php

/**
 * Copyright 2016 EyeQue. All rights reserved.
 * Yuan Xiong
 */

namespace EyeQue\EyeCloudAccess\Api\Data;

/**
 * Defines a data structure representing the device parameter
 */
interface DeviceInterface
{
     /**
     * @api
     * @return int
     */
    public function getId();

    /**
     * @api
     * @param $value int
     * @return null
     */
    public function setId($value);

    /**
     * @api
     * @return float
     */
    public function getBlueDegree();

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setBlueDegree($value);

     /**
     * @api
     * @return string
     */
    public function getCalcAngles();

    /**
     * @api
     * @param $value string
     * @return null
     */
    public function setCalcAngles($value);

     /**
     * @api
     * @return string
     */
    public function getCreatedAt();

    /**
     * @api
     * @param $value string
     * @return null
     */
    public function setCreatedAt($value);

    /**
     * @api
     * @return float
     */
    public function getGreenDegree();

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setGreenDegree($value);

    /**
     * @api
     * @return float
     */
    public function getHeight();

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setHeight($value);

     /**
     * @api
     * @return float
     */
    public function getInitialAngle();

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setInitialAngle($value);

     /**
     * @api
     * @return float
     */
    public function getInitialDistance();

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setInitialDistance($value);

    /**
     * @api
     * @return float
     */
    public function getLineLength();

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setLineLength($value);


    /**
     * @api
     * @return float
     */
    public function getLineWidth();

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setLineWidth($value);

    /**
     * @api
     * @return float
     */
    public function getMaxDistance();

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setMaxDistance($value);

    /**
     * @api
     * @return float
     */
    public function getMinDistance();

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setMinDistance($value);

    /**
     * @api
     * @return string
     */
    public function getName();

    /**
     * @api
     * @param $value string
     * @return null
     */
    public function setName($value);

    /**
     * @api
     * @return float
     */
    public function getOffCenterX();

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setOffCenterX($value);

    /**
     * @api
     * @return float
     */
    public function getOffCenterY();

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setOffCenterY($value);

    /**
     * @api
     * @return string
     */
    public function getPhoneType();

    /**
     * @api
     * @param $value string
     * @return null
     */
    public function setPhoneType($value);

    /**
     * @api
     * @return string
     */
    public function getRcAngles();

    /**
     * @api
     * @param $value string
     * @return null
     */
    public function setRcAngles($value);

    /**
     * @api
     * @return float
     */
    public function getRedDegree();

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setRedDegree($value);

    /**
     * @api
     * @return string
     */
    public function getRotatedAngles();

    /**
     * @api
     * @param $value string
     * @return null
     */
    public function setRotatedAngles($value);

    /**
     * @api
     * @return float
     */
    public function getWidth();

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setWidth($value);

}
