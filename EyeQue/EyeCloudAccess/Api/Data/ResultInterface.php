<?php

/**
 * Copyright 2016 EyeQue. All rights reserved.
 * Yuan Xiong
 */

namespace EyeQue\EyeCloudAccess\Api\Data;

/**
 * Defines a data structure representing the vision record result
 */
interface ResultInterface
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
     * @return int
     */
    public function getStatusType();

   /**
     * @api
     * @param $value int
     * @return null
     */
    public function setStatusType($value);
    
    

    /**
     * @api
     * @return int
     */
    public function getSubjectID();

   /**
     * @api
     * @param $value int
     * @return null
     */
    public function setSubjectID($value);
    
    /**
     * @api
     * @return int
     */
    public function getTestConditionID();

   /**
     * @api
     * @param $value int
     * @return null
     */
    public function setTestConditionID($value);

   /**
     * @api
     * @return string
     */
    public function getAlgorithm();

   /**
     * @api
     * @param $value string
     * @return null
     */
    public function setAlgorithm($value);


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
     * @return string
     */
    public function getDuration();

   /**
     * @api
     * @param $value string
     * @return null
     */
    public function setDuration($value);


    /**
     * @api
     * @return string
     */
    public function getScore();

   /**
     * @api
     * @param $value string
     * @return null
     */
    public function setScore($value);




    /**
     * @api
     * @return float
     */
    public function getAxisOD();

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setAxisOD($value);

    /**
     *
     * @api
     * @return float
     */
    public function getAxisOS();

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setAxisOS($value);

    
    
    /**
     * @api
     * @return float
     */
    public function getCylOD();

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setCylOD($value);

    /**
     *
     * @api
     * @return float
     */
    public function getCylOS();

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setCylOS($value);
    

    /**
     * @api
     * @return float
     */
    public function getRmseOD();

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setRmseOD($value);

    /**
     *
     * @api
     * @return float
     */
    public function getRmseOS();

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setRmseOS($value);

   
    /**
     * @api
     * @return float
     */
    public function getSpheOD();

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setSpheOD($value);

    /**
     *
     * @api
     * @return float
     */
    public function getSpheOS();

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setSpheOS($value);
  
    /**
     * @api
     * @return float
     */
    public function getSphOD();

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setSphOD($value);

    /**
     *
     * @api
     * @return float
     */
    public function getSphOS();

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setSphOS($value);

}
