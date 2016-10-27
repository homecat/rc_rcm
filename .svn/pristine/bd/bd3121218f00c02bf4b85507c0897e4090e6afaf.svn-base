<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class captcha extends CI_Controller
{

	public function __construct()
	{
    	parent::__construct();
		$this->load->helper('captcha');
		$this->load->model('tools/captcha_model');
	}
	
	
	
	public function index()
	{
		$img_url = base_url().'assets/tmps/captcha/';
		$img_path = FCPATH.'assets'.DIRECTORY_SEPARATOR.'tmps'.DIRECTORY_SEPARATOR.'captcha'.DIRECTORY_SEPARATOR;
		$this->make_dir($img_path);
		
		$vals['word'] = create_captcha_word();
		$vals['img_path'] = $img_path;
		$vals['img_url'] = $img_url;
		$vals['img_width'] = 150;
		$vals['img_height'] = 30;
		$vals['expiration'] = 600;
		$cap = create_captcha($vals);
		
		$data['word'] = $cap['word'];
		$data['captcha_time'] = $cap['time'];
		$data['ip_address'] = $this->input->ip_address();
		$this->db->insert('captcha',$data);

		Header("Content-type: image/jpg");
		echo file_get_contents($vals['img_path'].$cap['time'].'.jpg');
	}
	
	
	
	
	public function check($word=NULL)
	{
		if(empty($word)) $word = $this->input->get('captcha',TRUE);
		$status = $this->captcha_model->check_word($word,FALSE);
		die(strval($status ? 1 : 0));
	}
	
	
	
	
	
	
	private function make_dir($path)
	{	
		if(is_dir($path)){
			return TRUE;
		}
		$paths = explode(DIRECTORY_SEPARATOR,$path);
		if( empty($paths) ){
			return file_exists($path);
		}
		$dir = NULL;
		foreach($paths as $key => $val){
			$dir .= $val.DIRECTORY_SEPARATOR;
			! file_exists($dir) AND ! empty($dir) AND @mkdir($dir,0755);
		}	
	}
	
	
	
	
}
