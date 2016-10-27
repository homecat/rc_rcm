<?php


// 抽象类实现所有接口


include_once "interface.api.php";


class base_ptm implements api_ptm
{
	
	protected $CI;
	
	public function __construct()
	{
		$this->CI = &get_instance();
	}

    public function CreatNewUser($send){
		return $this->message();
	}  
	    
	public function EditRealUser($send){
		return $this->message();
	} 
	  
    public function DisableUser($send){
		return $this->message();
	}   
	    
	public function EnableUser($send){
		return $this->message();
	} 
	      
	public function SuspendUser($send){
		return $this->message();
	} 
	     
	public function ActivateUser($send){
		return $this->message();
	}  
	    
	public function PasswordChange($send){
		return $this->message();
	} 
	     
	public function PasswordReset($send){
		return $this->message();
	} 
	          
	public function Deposit($send){
		return $this->message();
	}  
	             		 
	public function Withdrawal($send){
		return $this->message();
	}
	
	public function CancelWithdrawal($send){
		return $this->message();
	} 
	
	public function DepoWithStatus($send){
		return $this->message();
	} 
	                 
	public function GetMarginLevel($send){
		return $this->message();
	} 
	              
	public function GetOpenPosition($send){
		return $this->message();
	} 
	
	public function GetCredit($send){
		return $this->message();
	}
	
	public function SetCredit($send){
		return $this->message();
	}
	

	public function CreatDemoUser($send){
		return $this->message();
	} 
	
	
	protected function message(){
		return array('code'=>10000,'message'=>'No such operator interface');
	}
	
	
}