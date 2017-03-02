<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: wzh
 * Date: 25/11/2016
 * Time: 11:08 PM
 */
class File extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function uploadImages(){
        //不存在当前上传文件则上传

        $path = "upload/".uniqid().".png";
        $_SESSION['img_url']="/sports/".$path;
        move_uploaded_file($_FILES['upload_file']['tmp_name'],$path);
        echo "<img src='"."/sports/".$path."'/>";

    }
    public function uploadHeader(){
        //不存在当前上传文件则上传

        $path = "upload/".uniqid().".png";
        $_SESSION['header_url']="/sports/".$path;
        move_uploaded_file($_FILES['upload_file']['tmp_name'],$path);
        echo "<img src='"."/sports/".$path."'/>";

    }
}