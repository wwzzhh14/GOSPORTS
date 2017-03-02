<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: wzh
 * Date: 25/11/2016
 * Time: 4:10 PM
 */
class Contact_model extends CI_Model
{
    function __construct()
    {
        $this->load->database();
    }

    public function getContactsByUserId($userId){
        $sql="select tu.userId as userId,tu.username as userName,tu.header_url as header_url 
              from tb_contact_relation tcr,tb_user tu 
              where tcr.userId_1=$userId and tu.userId=tcr.userId_2";
        $query = $this->db->query($sql);
        return $query;
    }
    public function getContactApplicationsByUserId($userId){
        $sql="select tu.userId as userId,tu.username as userName,tu.header_url as header_url 
              from tb_application_relation tar,tb_user tu 
              where tar.userId_2=$userId and tu.userId=tar.userId_1";
        $query = $this->db->query($sql);
        return $query;
    }

    public function addApplication($userId_1,$userId_2){
        $sql = "insert into tb_application_relation VALUES ($userId_1,$userId_2)";
        $query = $this->db->query($sql);
        $result=array("request_result"=>1);
        return $result;
    }
    public function addContactRelation($userId_1,$userId_2){
        $sql = "insert into tb_contact_relation VALUES ($userId_1,$userId_2)";
        $query = $this->db->query($sql);
        $sql = "insert into tb_contact_relation VALUES ($userId_2,$userId_1)";
        $query = $this->db->query($sql);
        $result=array("request_result"=>1);
        return $result;
    }
    public function deleteApplicationRelation($userId_1,$userId_2){
        $sql = "delete from tb_application_relation WHERE userId_1=$userId_1 and userId_2=$userId_2";
        $query = $this->db->query($sql);
        $result=array("request_result"=>1);
        return $result;
    }

    public function getContactNum($userId){
        $sql = "select count(*) as num from tb_contact_relation WHERE userId_1=$userId";
        $query = $this->db->query($sql);
        $array = ($query->row_array());
        return $array['num'];
    }


}