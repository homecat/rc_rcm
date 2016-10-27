<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class MY_Email extends  CI_Email
{
	
	
	//中文标题乱码问题
	public function subject($subject) 
    { 
            //$subject = $this->_prep_q_encoding($subject); 
            $subject = '=?'. $this->charset .'?B?'. base64_encode($subject) .'?='; 
            //$this->_set_header('Subject', $subject); 
			$this->_headers['Subject'] = $subject;
            return $this; 
    } 

}