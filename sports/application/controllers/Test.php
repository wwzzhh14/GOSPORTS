<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: wzh
 * Date: 2016/9/28
 * Time: 下午11:23
 */
class test extends CI_Controller
{
    public function hello(){
        $this->load->view('test_view');

    }


}