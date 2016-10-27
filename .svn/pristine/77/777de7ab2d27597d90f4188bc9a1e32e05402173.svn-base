<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// 验证码


class Captcha_model  extends   MY_Model
{


	public function __construct()
	{
		parent::__construct();
		$this->table = 'captcha';
		$this->increm = 'captcha_id';
	}
	
	
	
	
	public function check_word($word=NULL,$delete=TRUE)
	{
		
		$expiration = time()-1800;
		$this->db->where('captcha_time <',$expiration);
		$this->db->delete('captcha');
	
		$this->db->where('word',$word);
		$row = $this->db->get('captcha')->row_array();
		if(empty($row)){
			return FALSE;
		}
		$captcha = $row['word'];
		if(trim($word) == trim($captcha)){
			if($delete){
				$this->db->where('word',$word);
				$this->db->delete($this->table);
			}
			return TRUE;
		}	
	}
	
	

}
