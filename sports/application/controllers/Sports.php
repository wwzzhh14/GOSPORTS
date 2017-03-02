<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: wzh
 * Date: 2016/11/10
 * Time: 下午8:32
 */
class Sports extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->model('sports_model');
    }
    public function index(){
        echo $_SESSION['userId'];
    }
    public function getCycleDatabyDate(){
        $date = date("Y-m-d");
        $userId = $_SESSION['userId'];
        $type = "cycling";
        $data = $this->sports_model->getDistanceAndEnergyByDate($type,$date,$userId);
        $result = array('distance'=>($data['total_distance']/1000)."km",'energy'=>$data['total_energy']."卡路里");
        $result['total_distance']=(($this->sports_model->getTotalDistance($type,$userId))/1000)."km";
        $result['max_distance']=(($this->sports_model->getMaxDistance($type,$userId))/1000)."km";
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }
    public function getRunningDatabyDate(){
        $date = date("Y-m-d");
        $userId = $_SESSION['userId'];
        $type = "running";
        $data = $this->sports_model->getDistanceAndEnergyByDate($type,$date,$userId);
        $result = array('distance'=>($data['total_distance']/1000)."km",'energy'=>$data['total_energy']."卡路里");
        $result['total_distance']=(($this->sports_model->getTotalDistance($type,$userId))/1000)."km";
        $result['max_distance']=(($this->sports_model->getMaxDistance($type,$userId))/1000)."km";
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }
    public function getWalkingDatabyDate(){
        $date = date("Y-m-d");
        $userId = $_SESSION['userId'];
        $type = "walking";
        $data = $this->sports_model->getDistanceAndEnergyByDate($type,$date,$userId);
        $result = array('distance'=>($data['total_distance']/1000)."km",'energy'=>$data['total_energy']."卡路里");
        $result['total_distance']=(($this->sports_model->getTotalDistance($type,$userId))/1000)."km";
        $result['max_distance']=(($this->sports_model->getMaxDistance($type,$userId))/1000)."km";
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }


    public function getWeekSportsEnergy(){
        $userId = $_SESSION['userId'];
        $start_time = date("Y-m-d");
        $end_time=date("Y-m-d",strtotime("-7 day"));
        $query = $this->sports_model->getWeekData($userId,$start_time,$end_time);
        $this->output->set_content_type('application/json')->set_output($this->getJsonArrayFromQuery($query));
    }

    public function getHistoryData(){
        $userId = $_SESSION['userId'];
        $start_time = date("Y-m-d");
        $end_time=date("Y-m-d",strtotime("-30 day"));
        $query = $this->sports_model->getHistoryDataByType('cycling',$userId,$start_time,$end_time);
        $cycling_data = $this->getJsonArrayFromQuery($query);
        $query = $this->sports_model->getHistoryDataByType('running',$userId,$start_time,$end_time);
        $running_data = $this->getJsonArrayFromQuery($query);
        $query = $this->sports_model->getHistoryDataByType('walking',$userId,$start_time,$end_time);
        $walking_data = $this->getJsonArrayFromQuery($query);

        $result = array('run'=>$running_data,'walk'=>$walking_data,'cycle'=>$cycling_data);
        $this->output->set_content_type('application/json')->set_output(json_encode($result));

    }

    public function getHistoryEnergy(){
        $userId = $_SESSION['userId'];
        $query=$this->sports_model->getHistoryEnergyByUserId($userId);
        $this->output->set_content_type('application/json')->set_output($this->getJsonArrayFromQuery($query));
    }

    public function getDetailEnergy(){
        $userId = $_SESSION['userId'];
        $end_time = date("Y-m-d");
        $start_time=date("Y-m-d",strtotime("-7 day"));
        $query=$this->sports_model->getDetailHistoryEnergy($userId,$start_time,$end_time);
        $this->output->set_content_type('application/json')->set_output($this->getJsonArrayFromQuery($query));
    }

//    public function getTotalDistanceByTime(){
//        $userId = $_SESSION['userId'];
//        $data = $this->input->post('data');
//        $start_time = $data['start_time'];
//        $end_time = $data['end_time'];
//
//    }

    public function data(){
       $userId = $this->input->post('userId');
       $date = $this->input->post('date');
       $start_time = $this->input->post('start_time');
       $endtime = $this->input->post('end_time');
       $distance = $this->input->post('distance');
       $type = $this->input->post('type');
       $energy = $this->input->post('energy');
        $result=$this->sports_model->addSportsInfo($userId,$date,$start_time,$endtime,$distance,$type,$energy);
        $this->output->set_content_type('application/json')->set_output(json_encode($result));

    }

    private function getJsonArrayFromQuery($query){
        $result = "[";
        foreach ($query->result() as $row)
        {
            $result = $result.json_encode($row).",";
        }

        if(strlen($result)>1){
            $result = substr($result,0,strlen($result)-1);
        }
        $result = $result."]";
        return $result;
    }

}