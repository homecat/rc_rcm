<?php if (!defined('BASEPATH')) exit('No direct access allowed.');


// 管理后台登录


class Login extends QT_Controller 
{
	
	
	public function __construct()
	{
    	parent::__construct();
    }



	public function index()
	{
		if($this->session->userdata('user_id')>0){
			return redirect(site_url('manage/login/out'));
		}
		
		
		$this->form_validation->set_rules_new('login','required');
		$this->form_validation->set_rules_new('password','required');
		$this->form_validation->set_rules_new('captcha','required|valid_captcha');
		if ($this->form_validation->run() == FALSE){
			$data['code'] = 0;
			$data['lang'] = $this->session->userdata('language');
			return $this->load->view('manage/login/index',$data);
		}
		
		$login = $this->input->post('login',TRUE);
		$password = $this->input->post('password',TRUE);
		if($this->user_list_model->check_login($login,$password) == FALSE){
			$data['code'] = 1; 
			$data['lang'] = $this->session->userdata('language');
			return $this->load->view('manage/login/index',$data);
		}
		
		return redirect(site_url('manage/welcome'));
	}
	
	
	
	
	public function out()
	{	
		$session = $this->session->all_userdata();
		$this->session->unset_userdata($session);
		die("<script>top.location.href='".site_url('manage/login')."';</script>");
	}
	
	
	
	
	public function lang($lang=NULL)
	{	
		$this->session->set_userdata('language',$lang);
		$user_id = $this->session->userdata('user_id');
		$url = $user_id > 0 ? site_url('manage/welcome') : site_url('manage/login');
		die("<script>top.location.href='".$url."';</script>");
	}
	

}
