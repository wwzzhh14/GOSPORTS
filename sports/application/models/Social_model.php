<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: wzh
 * Date: 25/11/2016
 * Time: 11:17 PM
 */
class Social_model extends CI_Model
{
    function __construct()
    {
        $this->load->database();
    }

    public function addMessage($userId,$content,$date){
        $sql="insert into tb_message VALUES (NULL ,$userId,'$content','$date')";
        $query = $this->db->query($sql);
        $sql2="select max(messageId) as id from tb_message";
        $query = $this->db->query($sql2);
        $array = $query->row_array();
        $id=$array['id'];
        return $id;
    }

    public function insertPics($messageId,$url){
        $sql = "insert into tb_message_pic VALUES (NULL ,$messageId,'$url')";
        $query = $this->db->query($sql);
        $result=array("result"=>1);
        return $result;
    }

    public function getAllContactsMessages($userId){
        $sql = "select tm.messageId as messageId,tu.userName as userName,tu.header_url as userheader_url,tm.content as content,tm.create_time as `time` 
        from tb_user tu,tb_contact_relation tcr,tb_message tm WHERE tcr.userId_1=$userId and tu.userId=tcr.userId_2 and tm.userId=tu.userId ORDER BY tm.messageId DESC";
        $query = $this->db->query($sql);
        return $query;
    }
    public function getAllMyMessages($userId){
        $sql = "select tm.messageId as messageId,tu.userName as userName,tu.header_url as userheader_url,tm.content as content,tm.create_time as `time` 
        from tb_user tu,tb_message tm WHERE tm.userId=tu.userId and tm.userId=$userId ORDER BY tm.messageId DESC";
        $query = $this->db->query($sql);
        return $query;
    }
    public function addFabulous($userId,$messageId){
        $sql="insert into tb_fabulous VALUES ($messageId,$userId)";
        $query = $this->db->query($sql);
        $result=array("fabulous_result"=>1);
        return $result;
    }

    public function getFabulousNum($messageId){
        $sql = "select count(*) as num from tb_fabulous where messageId=$messageId";
        $query = $this->db->query($sql);
        $array = $query->row_array();
        $num=$array['num'];
        return $num;
    }
    public function getMyFabulousNum($messageId,$userId){
        $sql = "select count(*) as num from tb_fabulous where messageId=$messageId and userId=$userId";
        $query = $this->db->query($sql);
        $array = $query->row_array();
        $num=$array['num'];
        return $num;
    }

    public function getFabulousByUserId($userId){
        $sql = "select tu.userName as userName,tm.content as content from tb_user tu,tb_message tm,tb_fabulous tfr WHERE 
                tm.userId=$userId and tm.messageId=tfr.messageId and tfr.userId=tu.userId";
        $query = $this->db->query($sql);
        return $query;

    }

    public function getPicsByMessageId($messageId){

        $sql = "select url from tb_message_pic WHERE messageId=$messageId";
        $query = $this->db->query($sql);
        $array = $query->row_array();
        $url=$array['url'];
        return $url;
    }
}