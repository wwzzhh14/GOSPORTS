<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: wzh
 * Date: 2016/11/11
 * Time: 下午4:32
 */
class Activity extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->model('activity_model');
    }

    public function addActivity(){
        $userId = $_SESSION['userId'];
        $title = $this->input->post('title');
        $type = $this->input->post('type');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $user_num = $this->input->post('num');
        $profile = $this->input->post('profile');
        $now = date("Y-m-d");
        $result=array();
        if(strtotime($end_date)<strtotime($start_date)||strtotime($start_date)<strtotime($now)){
            $result['add_result']=0;
        }else{
            $result=$this->activity_model->addActivity($userId,$title,$type,$start_date,$end_date,$user_num,$profile);
        }


        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function participateActivity(){
        $userId = $_SESSION['userId'];
        $activityId = $this->input->post('activityId');
        $date = date("Y-m-d");
        $result=$this->activity_model->addParticipateRelation($userId,$activityId,$date);
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function getParticipatedActivities(){
        $userId = $_SESSION['userId'];
        $query = $this->activity_model->getParticipatedAcitivitiesByUserId($userId);
        $this->output->set_content_type('application/json')->set_output($this->getJsonArrayFromQuery($query));

    }
    public function getAllActivities(){
        $userId = $_SESSION['userId'];
        $now = date("Y-m-d");
        $query = $this->activity_model->getAllAcitivitiesByUserId($userId,$now);
        $this->output->set_content_type('application/json')->set_output($this->getJsonArrayFromQuery($query));

    }
    public function getMyAcitivities(){
        $userId = $_SESSION['userId'];
        $query = $this->activity_model->getMyAcitivitiesByUserId($userId);
        $this->output->set_content_type('application/json')->set_output($this->getJsonArrayFromQuery($query));
    }
    public function exitActivity(){
        $userId = $_SESSION['userId'];
        $activityId = $this->input->post('activityId');
        $date = date("Y-m-d");
        $result =$this->activity_model->setExitDate($userId,$activityId,$date);
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function deleteActivity(){
        $userId = $_SESSION['userId'];
        $activityId = $this->input->post('activityId');
        $date = date("Y-m-d");
        $result_1 =$this->activity_model->setExitDateByActivityId($activityId,$date);
        $result_2 =$this->activity_model->deleteActivity($userId,$activityId);
        $result=array('delete_result'=>1);
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function getActivityResult()
    {
        $activityId = $_SESSION['activityId'];
        $type  = $this->input->post('type');
        $query = $this->activity_model->getMemberByActivityId($activityId);
        $result = "[";
        foreach ($query->result_array() as $row)
        {
            $userId=$row['userId'];
            $start_date=$row['participate_date'];
            $end_date=$row['exit_date'];
            if(empty($end_date)){
                $end_date=date("Y-m-d");
            }
            $array = $this->activity_model->getActivityResult($userId,$start_date,$end_date,$type);
            $result = $result.json_encode($array).",";

        }
        $result = substr($result,0,strlen($result)-1);
        $result = $result."]";
        $this->output->set_content_type('application/json')->set_output($result);

    }
    public function saveActivityId(){
        $activityId = $this->input->post('activityId');
        $_SESSION['activityId']=$activityId;
        $result=array("save_result"=>1);
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