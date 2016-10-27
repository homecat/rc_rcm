<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MY_Input extends CI_Input{

	function __construct()
	{
		parent::__construct();
	}
	

	function _clean_input_keys($str)
	{
	
		//if ( ! preg_match("/^[a-z0-9:_\/-]+$/i", $str))
		//{
		//	exit('Disallowed Key Characters.');
		//}

		
		$config = &get_config('config');  
		if ( ! preg_match("/^[".$config['permitted_uri_chars']."]+$/i", rawurlencode($str)))   
		{
			exit('Disallowed Key Characters.');
		}

		// Clean UTF-8 if supported
		if (UTF8_ENABLED === TRUE)
		{
			$str = $this->uni->clean_string($str);
		}
		return $str;
		
	}
	
}