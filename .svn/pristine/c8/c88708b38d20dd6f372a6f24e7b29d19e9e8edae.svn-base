<?php if (!defined('BASEPATH')) exit('No direct access allowed.');


include_once ("class/class.fgl_acc.php");


class fgl_acc_id1 extends fgl_acc
{

	public function __construct()
	{
		parent::__construct();
		$this->platform_id = 1;
	}
	
	
	
	public function rand_real($member_proxy=NULL)
	{
		return $this->fgl_dy_real($member_proxy);
	}

	private function fgl_dy_real($member_proxy)
	{
		$frist = NULL;
		$proxy = NULL;
		$number = NULL;
		if(empty($member_proxy)){
			$frist = 5;
			$length = 6;
		}else{
			$frist = 4;
			$length = 3;
			$temp = substr($member_proxy,1,3);
			$proxy = sprintf("%03s",$temp);
		}
		for($i=0;$i<$length;$i++){
			$number .= rand(0,9);
		}
		$real = $frist.$proxy.$number;
		
		$this->CI->db->where('real_login',$real);
		$this->CI->db->where('platform_id',$this->platform_id);
		$num = $this->CI->db->get('trading_real')->num_rows();
		if($num>0){
			$real = $this->fgl_dy_real($this->platform_id,$proxy_account);
		}
		return $real;
	}
	
	
	
	

	public function rand_demo()
	{
		$sort = $this->demo_sort(); 
		return 9000000+$sort;
	}
	
	private function demo_sort()
	{
		$this->CI->db->where('platform_id',$this->platform_id);
		$row = $this->CI->db->get('trading_platform')->row_array();
		if($row){
			$sort = $row['platform_demo'];
			$this->CI->db->where('platform_id',$this->platform_id);
			$this->CI->db->update('trading_platform',array('platform_demo'=>$sort+1));
			return $sort;
		}	
		return NULL;
	}
	
	
	
}