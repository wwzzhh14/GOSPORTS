<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
    public function hello(){
        $this->load->view('test_view');

    }
    public function json(){
        $id = $this->input->get('id');
        $start_id = $id;
        $end_id = $id + 10;
        $subsql = "id >".$start_id." and id <".$end_id;
        $sql = "select * from tb_wechat_rec WHERE ".$subsql;
        $this->load->database();
        $query = $this->db->query($sql);
        $resultList = "[";
        foreach ($query->result() as $row)
        {
            $resultList = $resultList.json_encode($row).",";
        }
        $resultList=$resultList."]";
//        echo $resultList;
        $this->output->set_content_type('application/json')->set_output($resultList);

    }
}
