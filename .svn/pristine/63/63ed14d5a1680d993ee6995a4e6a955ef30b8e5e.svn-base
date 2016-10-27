<?php if (!defined('BASEPATH')) exit('No direct access allowed.');


	header("Content-type: text/html; charset=utf-8");



	// 语言控制器
	class LANG_Controller extends CI_Controller 
	{	
		public function __construct() 
		{
			parent::__construct();
				
			$langs = array('en','zh-cn','zh-tw');
			$lang = $this->session->userdata('language');
			if(in_array($lang,$langs)){
				$this->config->set_item('language',$lang);	
			}else{
				$this->config->set_item('language','zh-cn');
				$this->session->set_userdata('language','zh-cn');
			}	
		}
	}
	
	
	

	
	// 前台控制器
	class QT_Controller extends LANG_Controller 
	{
		public function __construct() 
		{
			parent::__construct();		
		}
	}
	
	

	
	

	// 管理后台控制器
	class MHT_Controller extends LANG_Controller 
	{
		public function __construct()
		{ 
			parent::__construct();
	
			//登录验证
			$user_id = $this->session->userdata('user_id');
			//echo $user_id;die;
			if($user_id<1){
				die("<script>top.location.href='".site_url('manage/login')."';</script>");
			}
			//排除控制器|方法
			$url_class = $this->router->class;
			//echo $url_class;
			$url_method = $this->router->method;
			//echo $url_method;die;
			if($url_class=='welcome'){
				return;
			}
			//if($url_class=='authority'){return;}
			//权限验证
			$permissions = $this->user_list_model->check_permissions($user_id);
			//print_r($permissions);die;
			//echo $this->db->last_query();die;
			if($permissions){
				return;
			}
			//echo 2222;die;
			return redirect('manage/welcome/note');
		}
	}
