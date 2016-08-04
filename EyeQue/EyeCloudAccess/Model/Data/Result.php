<?php
/**
 * Copyright © 2016 EyeQue. All rights reserved.
 * Yuan Xiong
 */

     
namespace EyeQue\EyeCloudAccess\Model\Data;
     
use EyeQue\EyeCloudAccess\Api\Data\ResultInterface;
     
/**
 * Defines a data structure representing a result object.
 */
class Result implements ResultInterface
{
    public $id;
    public $status_type;
    public $subject_id;
    public $test_condition_id;
    public $duration;
    public $algorithm;
    public $axis_od;
    public $axis_os;
    public $created_at;
    public $cyl_od;
    public $cyl_os;
    public $rmse_od;
    public $rmse_os;
    public $score;
    public $sphe_od;
    public $sphe_os;
    public $sph_od;
    public $sph_os;
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
     * @return int
     */
    public function getStatusType()
    {
	return $this->status_type;
    }

   /**
     * @api
     * @param $value int
     * @return null
     */
    public function setStatusType($value)
    {
	$this->status_type = $value;
    }
    
    

    /**
     * @api
     * @return int
     */
    public function getSubjectID()
    {
	return $this->subject_id;
    }

   /**
     * @api
     * @param $value int
     * @return null
     */
    public function setSubjectID($value)
    {
	$this->subject_id = $value;
    }
    
    /**
     * @api
     * @return int
     */
    public function getTestConditionID()
    {
	return $this->test_condition_id;
    }

   /**
     * @api
     * @param $value int
     * @return null
     */
    public function setTestConditionID($value)
    {
	$this->test_condition_id = $value;
    }

   /**
     * @api
     * @return string
     */
    public function getAlgorithm()
    {
	return $this->algorithm;
    }

   /**
     * @api
     * @param $value string
     * @return null
     */
    public function setAlgorithm($value)
    {
	$this->algorithm = $value;
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
     * @return string
     */
    public function getDuration()
    {
	return $this->duration;
    }

   /**
     * @api
     * @param $value string
     * @return null
     */
    public function setDuration($value)
    {
        $this->duration = $value;
    }


    /**
     * @api
     * @return string
     */
    public function getScore()
    {
	return $this->score;
    }

   /**
     * @api
     * @param $value string
     * @return null
     */
    public function setScore($value)
    {
        $this->score = $value;
    }




    /**
     * @api
     * @return float
     */
    public function getAxisOD()
    {
	return $this->axis_od;
    }

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setAxisOD($value)
    {
        $this->axis_od = $value;
    }


    /**
     *
     * @api
     * @return float
     */
    public function getAxisOS()
    {
	return $this->axis_os;
    }

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setAxisOS($value)
    {
        $this->axis_os = $value;
    }

    
    
    /**
     * @api
     * @return float
     */
    public function getCylOD()
    {
	return $this->cyl_od;
    }

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setCylOD($value)
    {
        $this->cyl_od = $value;
    }

    /**
     *
     * @api
     * @return float
     */
    public function getCylOS()
    {
	return $this->cyl_os;
    }


    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setCylOS($value)
    {
        $this->cyl_os = $value;
    }
    

    /**
     * @api
     * @return float
     */
    public function getRmseOD()
    {
	return $this->rmse_od;
    }

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setRmseOD($value)
    {
	$this->rmse_od = $value;
    }

    /**
     *
     * @api
     * @return float
     */
    public function getRmseOS()
    {
	return $this->rmse_os;
    }

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setRmseOS($value)
    {
	$this->rmse_os = $value;
    }

   
    /**
     * @api
     * @return float
     */
    public function getSpheOD()
    {
	return $this->sphe_od;
    }

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setSpheOD($value)
    {
	$this->sphe_od = $value;
    }

    /**
     *
     * @api
     * @return float
     */
    public function getSpheOS()
    {
	return $this->sphe_os;
    }
    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setSpheOS($value)
    {
	$this->sphe_os = $value;
    }
  
    /**
     * @api
     * @return float
     */
    public function getSphOD()
    {
	return $this->sph_od;
    }

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setSphOD($value)
    {
	$this->sph_od = $value;
    }

    /**
     *
     * @api
     * @return float
     */
    public function getSphOS()
    {
	return $this->sph_os;
    }

    /**
     * @api
     * @param $value float
     * @return null
     */
    public function setSphOS($value)
    {
	$this->sph_os = $value;
    }


}
