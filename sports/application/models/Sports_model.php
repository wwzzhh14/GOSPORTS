<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: wzh
 * Date: 2016/11/10
 * Time: 下午8:35
 */
class Sports_model extends CI_Model
{

    function __construct()
    {
    $this->load->database();
    }

    public function getDistanceAndEnergyByDate($type,$date,$userId){
        $sql = "select sum(distance) as total_distance ,sum(energy) as total_energy from tb_sportsinfo where userId=$userId and `date`='$date' and `type`='$type'";
        $query = $this->db->query($sql);
        return ($query->row_array());

    }

    public function getTotalDistance($type,$userId){
        $sql = "select sum(distance) as total_distance from tb_sportsinfo where userId=$userId  and `type`='$type'";
        $query = $this->db->query($sql);
        $array = ($query->row_array());
        return $array['total_distance'];
    }

    public function getMaxDistance($type,$userId){
        $sql = "select MAX(d) as max_distance FROM (select SUM(distance) as d from tb_sportsinfo where `type`='$type' and userId=$userId GROUP BY date) ";
        $query = $this->db->query($sql);
        $array = ($query->row_array());
        return $array['max_distance'];
    }

    public function getWeekData($userId,$start_time,$end_time){
        $sql = "select energy,end_time from tb_sportsinfo where userId=$userId and $end_time>=end_time and $start_time<=end_time order by end_time ASC ";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getHistoryDataByType($type,$userId,$start_date,$end_date){
        $sql = "select sum(distance) as distance,`date` from tb_sportsinfo where userId=$userId and $end_date>=`date` and $start_date<=`date` and `type`=$type group by `date`order by `date` ASC ";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getHistoryEnergyByUserId($userId){
        $sql = "select sum(energy) as energy,`date` as `date` from tb_sportsinfo where userId=$userId group by `date`order by `date` ASC ";
        $query = $this->db->query($sql);
        return $query;
    }
    public function getDetailHistoryEnergy($userId,$start_date,$end_date){
        $sql = "select energy from tb_sportsinfo where userId=$userId AND `date` BETWEEN '$start_date' AND '$end_date'";
        $query = $this->db->query($sql);
        return $query;
    }
    public function addSportsInfo($userId,$date,$start_time,$end_time,$distance,$type,$energy){
        $sql = "insert into tb_sportsinfo VALUES (NULL,'$userId','$date','$start_time','$end_time','$distance','$type','$energy')";
        echo $sql;
        $query = $this->db->query($sql);
        $result=array("register_result"=>1);
        return $result;
    }

}