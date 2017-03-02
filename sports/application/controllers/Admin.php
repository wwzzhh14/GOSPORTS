<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: wzh
 * Date: 30/11/2016
 * Time: 3:39 PM
 */
class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->model('admin_model');
    }

    function getAllUsers(){
        $result="";
        if($_SESSION['account']=="admin"){
            $query=$this->admin_model->getAllUsers();
            $result=$this->getJsonArrayFromQuery($query);
        }
        $this->output->set_content_type('application/json')->set_output($result);
    }

    function getAllActivities(){
        $result="";
        if($_SESSION['account']=="admin"){
            $query=$this->admin_model->getAllActivities();
            $result=$this->getJsonArrayFromQuery($query);
        }
        $this->output->set_content_type('application/json')->set_output($result);
    }

    function deleteUser(){
        $userId=$this->input->post('userId');
        $result = $this->admin_model->deleteUserById($userId);
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }
    function deleteActivity(){
        $activity=$this->input->post('activityId');
        $result = $this->admin_model->deleteActivityById($activity);
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    private function getJsonArrayFromQuery($query){
        $result = "[";
        foreach ($query->result() as $row)
        {
            $result = $result.json_encode($row).",";
        }
        $result = substr($result,0,strlen($result)-1);
        $result = $result."]";
        return $result;
    }

}