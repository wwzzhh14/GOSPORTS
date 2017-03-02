<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: wzh
 * Date: 25/11/2016
 * Time: 4:09 PM
 */
class Contact extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->model('contact_model');
        $this->load->model('user_model');
    }
    public function getContacts(){
        $userId = $_SESSION['userId'];
        $query=$this->contact_model->getContactsByUserId($userId);
        $this->output->set_content_type('application/json')->set_output($this->getJsonArrayFromQuery($query));
    }

    public function getContactRequests(){
        $userId = $_SESSION['userId'];
        $query=$this->contact_model->getContactApplicationsByUserId($userId);
        $this->output->set_content_type('application/json')->set_output($this->getJsonArrayFromQuery($query));
    }

    public function sendRequest(){
        $userId_1 = $_SESSION['userId'];
        $account = $this->input->post('userAccount');
        $user = ($this->user_model->getUserByAccount($account));
        $result =array();
        if(empty($user)){
            $result['request_result']=0;
        }else{
            $userId_2=$user['userId'];
            $result=$this->contact_model->addApplication($userId_1,$userId_2);
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function acceptResquest(){
        $userId_1=$_SESSION['userId'];
        $userId_2=$this->input->post('userId');
        $this->contact_model->deleteApplicationRelation($userId_2,$userId_1);
        $result=$this->contact_model->addContactRelation($userId_1,$userId_2);
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function refuseRequest(){
        $userId_1=$_SESSION['userId'];
        $userId_2=$this->input->post('userId');
        $result=$this->contact_model->deleteApplicationRelation($userId_2,$userId_1);
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