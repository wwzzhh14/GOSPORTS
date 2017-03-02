<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: wzh
 * Date: 30/11/2016
 * Time: 3:41 PM
 */
class Admin_model extends CI_Model
{
    function __construct()
    {
        $this->load->database();
    }

    function getAllUsers(){
        $sql = "select * from tb_user where account<>'admin'";
        $query = $this->db->query($sql);
        return $query;
    }

    function getAllActivities(){
        $sql = "select ta.activityId as activityId,tu.header_url as user_header_url,tu.userName as userName,ta.title as title,ta.profile as content,ta.type
         as `type`,ta.user_num as num,ta.start_date as start_date,ta.end_date as end_date from tb_activity ta,tb_user tu WHERE tu.userId=ta.userId";
        $query = $this->db->query($sql);
        return $query;
    }

    function deleteUserById($userId){
        $sql = "delete from tb_user where userId=$userId";
        $this->db->query($sql);
        $result=array("delete_result"=>1);
        return $result;
    }

    function deleteActivityById($activityId){
        $sql = "delete from tb_activity where activityId=$activityId";
        $this->db->query($sql);
        $result=array("delete_result"=>1);
        return $result;
    }


}