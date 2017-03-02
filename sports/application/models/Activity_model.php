<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: wzh
 * Date: 2016/11/11
 * Time: 下午4:34
 */
class Activity_model extends CI_Model
{
    function __construct()
    {
        $this->load->database();
    }

    public function addActivity($userId,$title,$type,$start_date,$end_date,$user_num,$profile){
        $date = date("Y-m-d");
        $sql="insert into tb_activity VALUES (NULL ,$userId,'$date','$title','$type','$start_date','$end_date',$user_num,'$profile')";
        $query = $this->db->query($sql);
        $sql2="select max(activityId) as id from tb_activity";
        $query = $this->db->query($sql2);
        $array = $query->row_array();
        $activityId=$array['id'];
        $sql3="insert into tb_participation_relation VALUES ($activityId,$userId,'$date',NULL )";
        $query = $this->db->query($sql3);
        $result=array("add_result"=>1);
        return $result;
    }

    public function addParticipateRelation($userId,$activityId,$date){
        $result=array();
        $sql = "select count(*) as num from tb_participation_relation WHERE userId=$userId and activityId=$activityId";
        $query = $this->db->query($sql);
        $array = $query->row_array();
        $num=$array['num'];
        if($num>0){
            $result['participate_result']=0;
            return $result;
        }

        $sql="insert into tb_participation_relation VALUES ($activityId,$userId,'$date',NULL )";
        $query = $this->db->query($sql);
        $result['participate_result']=1;
        return $result;
    }

    public function getParticipatedAcitivitiesByUserId($userId){
        $sql="select count(tpr.userId)  as participated_num,ta.activityId as activityId,tu.header_url as user_header_url,tu.userName as userName,ta.title as title,ta.profile as content,ta.type
         as `type`,ta.user_num as num,ta.start_date as start_date,ta.end_date as end_date,tpr.participate_date as participate_date,tpr.exit_date as exit_date
         from tb_participation_relation tpr,tb_activity ta,tb_user tu 
         where tpr.userId=$userId and tpr.activityId=ta.activityId and ta.userId=tu.userId
         GROUP BY tpr.activityId";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getAllAcitivitiesByUserId($userId,$now){
        $sql="select ta.activityId as activityId,tu.header_url as user_header_url,tu.userName as userName,ta.title as title,ta.profile as content,ta.type
         as `type`,ta.user_num as num,ta.start_date as start_date,ta.end_date as end_date,COUNT (tpr.userId) as participated_num
         from tb_contact_relation tcr,tb_participation_relation tpr,tb_activity ta,tb_user tu
         where tcr.userId_1=$userId and tcr.userId_2=ta.userId and tcr.userId_2=tu.userId and ta.activityId=tpr.activityId and ta.end_date>='$now' GROUP by ta.activityId ORDER BY ta.activityId DESC ";
        $query = $this->db->query($sql);
        return $query;
    }
    public function getMyAcitivitiesByUserId($userId){
        $sql="select ta.activityId as activityId,tu.header_url as user_header_url,tu.userName as userName,ta.title as title,ta.profile as content,ta.type
         as `type`,ta.user_num as num,ta.start_date as start_date,ta.end_date as end_date 
         from tb_activity ta,tb_user tu
         where $userId=ta.userId and $userId=tu.userId ORDER BY ta.activityId DESC";
        $query = $this->db->query($sql);
        return $query;
    }
    public function setExitDate($userId,$activityId,$date){
        $sql = "update tb_participation_relation set exit_date = '$date' WHERE activityId=$activityId and userId=$userId";
        $query = $this->db->query($sql);
        $result=array("exit_result"=>1);
        return $result;
    }
    public function deleteActivity($userId,$activityId){
        $sql = "delete from tb_activity WHERE activityId=$activityId and userId=$userId";
        $query = $this->db->query($sql);
        $result=array("delete_result"=>1);
        return $result;

    }
    public function setExitDateByActivityId($activityId,$date){
        $sql = "update tb_participation_relation set exit_date ='$date' WHERE activityId=$activityId";
        $query = $this->db->query($sql);
        $result=array("exit_result"=>1);
        return $result;

    }

    public function getMemberByActivityId($activityId){
        $sql = "select * from tb_participation_relation WHERE activityId=$activityId";
        $query = $this->db->query($sql);
        return $query;
    }
    public function getActivityResult($userId,$start_date,$end_date,$type){
        $sql="select tu.userName as name,tu.header_url as header_url,sum(ts.distance) as distance,ts.`type` as type from tb_sportsinfo ts,tb_user tu
              WHERE tu.userId=$userId and tu.userId=ts.userId and `type`='$type' and ts.`date`>='$start_date' and ts.`date`<='$end_date' GROUP by ts.userId";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
}