<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: wzh
 * Date: 25/11/2016
 * Time: 11:16 PM
 */
class Social extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->model('social_model');
    }
    public function addMessage(){
        $userId = $_SESSION['userId'];
        $content = $this->input->post('content');

        $date = date("Y-m-d");
        $messageId = $this->social_model->addMessage($userId,$content,$date);
        if(!empty($_SESSION['img_url'])){
            $pics = $_SESSION['img_url'];
            $this->social_model->insertPics($messageId,$pics);
            unset($_SESSION['img_url']);
        }
        $result=array("add_result"=>1);
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function getAllMessages(){
        $userId = $_SESSION['userId'];
        $query = $this->social_model->getAllContactsMessages($userId);
        $result = "[";
        foreach ($query->result_array() as $row)
        {
            $result=$result."{";
            $messageId = $row['messageId'];
            $result=$result."\"messageId\":".$messageId.",";
            $result=$result."\"user\":"."\"".$row['userName']."\"".",";
            $result=$result."\"userheader_url\":"."\"".$row['userheader_url']."\"".",";
            $result=$result."\"content\":"."\"".$row['content']."\"".",";
            $result=$result."\"time\":"."\"".$row['time']."\"".",";
            $result=$result."\"fabulous_num\":".$this->social_model->getFabulousNum($messageId).",";
            $result=$result."\"has_fabuloused\":".$this->social_model->getMyFabulousNum($messageId,$userId).",";
            $result=$result."\"pic_urls\":"."\"".$this->social_model->getPicsByMessageId($messageId)."\"";
            $result=$result."},";
        }
        $result = substr($result,0,strlen($result)-1);
        $result = $result."]";
        $this->output->set_content_type('application/json')->set_output($result);
    }


    public function getMyMessages(){
        $userId = $_SESSION['userId'];
        $query = $this->social_model->getAllMyMessages($userId);
        $result = "[";
        foreach ($query->result_array() as $row)
        {
            $result=$result."{";
            $messageId = $row['messageId'];
            $result=$result."\"messageId\":".$messageId.",";
            $result=$result."\"user\":"."\"".$row['userName']."\"".",";
            $result=$result."\"userheader_url\":"."\"".$row['userheader_url']."\"".",";
            $result=$result."\"content\":"."\"".$row['content']."\"".",";
            $result=$result."\"time\":"."\"".$row['time']."\"".",";
            $result=$result."\"fabulous_num\":".$this->social_model->getFabulousNum($messageId).",";
            $result=$result."\"pic_urls\":"."\"".$this->social_model->getPicsByMessageId($messageId)."\"";
            $result=$result."},";
        }
        $result = substr($result,0,strlen($result)-1);
        $result = $result."]";
        $this->output->set_content_type('application/json')->set_output($result);
    }
    public function getMyFabulous(){
        $userId = $_SESSION['userId'];
        $query = $this->social_model->getFabulousByUserId($userId);
        $this->output->set_content_type('application/json')->set_output($this->getJsonArrayFromQuery($query));
    }
    public function fabulous(){
        $userId = $_SESSION['userId'];
        $messageId = $this->input->post('messageId');
        $result = $this->social_model->addFabulous($userId,$messageId);
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