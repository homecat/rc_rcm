<?php if (!defined('BASEPATH')) exit('No direct access allowed.');


// 客户管理后台 - 默认页


class Welcome extends MHT_Controller 
{
	
	public function __construct()
	{
    	parent::__construct();
		$this->config->load('permissions');
    }
	
	public function index()
	{
		return $this->load->view('manage/welcome/index');
	}
	
	
	public function head()
	{
		$data['user_id'] = $this->session->userdata('user_id');
		$data['user_name'] = $this->session->userdata('user_name');
		$data['user_loginip'] = $this->session->userdata('user_loginip');
		$data['language'] = $this->session->userdata('language');
		return $this->load->view('manage/welcome/head',$data);
	}

	public function left()
	{
		$data['manage_perms'] = $this->config->item('manage');
		$data['user_perms'] = $this->user_list_model->user_perms();
		return $this->load->view('manage/welcome/left',$data);
	}
	
	public function right()
	{
		return $this->load->view('manage/welcome/right');		
	}
	
	public function note()
	{
		return $this->load->view('manage/welcome/note');
	}

}