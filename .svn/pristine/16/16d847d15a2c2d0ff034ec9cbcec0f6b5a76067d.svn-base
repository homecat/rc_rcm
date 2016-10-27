<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// 表单验证函数


class MY_Form_validation extends CI_Form_validation
{

	
	public function __construct( $rules = array() )
	{	
		parent::__construct( $rules );
		$this->_error_prefix = '<span class="red">';
		$this->_error_suffix = '</span>';
	}
	
	
	
	public function set_rules_new($field,$rules=NULL)
	{
		$this->set_rules($field,' ',$rules);
	}
	
	
	
	// 验证码
	public function valid_captcha($val)
	{
		$CI = &get_instance();
		$CI->load->model('tools/captcha_model');
		$status = $CI->captcha_model->check_word(trim($val));
		return $status;
	}
	
	
	// 中文和英文字母
	public function valid_letter_chinese($str)
	{
		$regex = "/^([a-zA-Z\ \']|[\x{4e00}-\x{9fa5}])+$/u";
		if(preg_match($regex,$str)){		
			return TRUE;
		}
		return FALSE;	
	}
	
	
	// 大小写英文字母
	public function valid_letter_english($str)
	{
		$regex = "/^([a-zA-Z\ \'])+$/u";
		if (preg_match($regex, $str)){
			return TRUE;
		}
		return FALSE;
	}
	
	
	

	
	
	
	
	
	
}