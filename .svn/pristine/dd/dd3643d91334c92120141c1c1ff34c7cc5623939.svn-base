<?php


// 抽象类实现所有接口


include_once "interface.api.php";


class base_acc implements api_acc
{
	protected $CI;
	protected $platform_id;
	
	public function __construct()
	{
		$this->CI = &get_instance();
	}

    public function rand_real($member_proxy){
		return $this->message();
	}  
	    
	public function rand_demo(){
		return $this->message();
	} 
	  
    public function rand_password(){
		return $this->message();
	}   
	    
	public function get_orderId($real_login){
		return $this->message();
	}
	     
	
	protected function message(){
		return NULL;
	}
	
	
}