<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: wzh
 * Date: 2016/11/3
 * Time: 上午12:41
 */
class user_model extends CI_Model
{
    function __construct()
    {
        $this->load->database();
    }

    function addUser($account,$password){
        $header_url="image/aaa.png";
        $name="未命名";
        $sql = "insert into tb_user VALUES (NULL,'$account','$name','$header_url','$password',NULL,NULL,NULL,NULL,NULL )";
        $query = $this->db->query($sql);

        $sql2="select max(userId) as id from tb_user";
        $query = $this->db->query($sql2);
        $array = $query->row_array();
        $userId = $array['id'];

        $sql3 = "insert into tb_contact_relation VALUES ($userId,$userId)";
        $query = $this->db->query($sql3);
        $result=array("register_result"=>1);
        return $result;
    }

    function updateUserInfo($userId,$name,$birth,$sex,$city,$interest,$declaration){
        $sql = "update tb_user set userName='$name',birth='$birth',sex='$sex',city='$city',interest='$interest',declaration='$declaration' WHERE userId=$userId";
        $query = $this->db->query($sql);
        $result=array("register_result"=>1);
        return $result;
    }
    function getUserByAccount($account){
        $sql = "select * from tb_user WHERE account='$account'";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
    }
    function updateHeader($userId,$url){
        $sql = "update tb_user set header_url='$url' WHERE userId=$userId";
        $query = $this->db->query($sql);
        $result=array("update_result"=>1);
        return $result;
    }

}