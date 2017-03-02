<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: wzh
 * Date: 2016/11/3
 * Time: 上午12:21
 */

class User extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->model('user_model');
        $this->load->model('contact_model');
        $this->load->model('sports_model');
    }

    public function getUserStatus(){
        $result = array();
        if(!empty($_SESSION['userId'])){
            $result['status']=1;
        }else{
            $result['status']=0;
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }
    public function login(){
        $account=$this->input->post('phone_number');
        $password=$this->input->post('password');
        $userList = $this->user_model->getUserByAccount($account);
        $result=array();
        if(count($userList)==0){
            $result['login_result']=0;
        }else{
            if($password==$userList['password']){
                $result['login_result']=1;
                $_SESSION['userId']=$userList['userId'];
                $_SESSION['account']=$account;
            }else{
                $result['login_result']=0;
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($result));

    }
    public function register(){
        $phone_number = $this->input->post('phone_number');
        $password = $this->input->post('password');
        $userList = $this->user_model->getUserByAccount($phone_number);
        $result=array();
        if(count($userList)==0){
            $result=$this->user_model->addUser($phone_number,$password);
        }else{
            $result['register_result']=0;
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function updateDatailInfo(){
        $userId = $_SESSION['userId'];
        $name = $this->input->post('name');
        $birth = $this->input->post('birth');
        $sex = $this->input->post('sex');
        $interest = $this->input->post('interest');
        $city= $this->input->post('city');
        $declaration = $this->input->post('sports_declaration');
        $result=$this->user_model->updateUserInfo($userId,$name,$birth,$sex,$city,$interest,$declaration);
        $this->output->set_content_type('application/json')->set_output(json_encode($result));

    }

    public function getBasicInfo(){
        $userId = $_SESSION['userId'];
        $account = $_SESSION['account'];
        $user = $this->user_model->getUserByAccount($account);
        $result = array();
        $result['name']=$user['userName'];
        $result['city']=$user['city'];
        $result['sex']=$user['sex'];
        $result['birth']=$user['birth'];
        $result['friends_num']=$this->contact_model->getContactNum($userId);
        $walking_distance = $this->sports_model->getTotalDistance("walking",$userId);
        $running_distance = $this->sports_model->getTotalDistance("running",$userId);
        $cycling_distance = $this->sports_model->getTotalDistance("cycling",$userId);
        $distance = (($walking_distance+$running_distance+$cycling_distance)/1000)."km";
        $result['distance']=$distance;
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }
    public function getDetailedInfo(){
        $userId = $_SESSION['userId'];
        $account = $_SESSION['account'];
        $user = $this->user_model->getUserByAccount($account);
        $this->output->set_content_type('application/json')->set_output(json_encode($user));
    }

    public function updateMyHeader(){
        $userId=$_SESSION['userId'];
        $url=$_SESSION['header_url'];
        unset($_SESSION['header_url']);
        $result=$this->user_model->updateHeader($userId,$url);
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

}