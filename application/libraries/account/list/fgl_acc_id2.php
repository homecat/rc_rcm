<?php if (!defined('BASEPATH')) exit('No direct access allowed.');


include_once ("class/class.fgl_acc.php");


class fgl_acc_id2 extends fgl_acc
{
	

	public function __construct()
	{
		parent::__construct();
		$this->platform_id = 2;
	}
	
	
	
	
	
	//------------------------------------------------------------------------//
	
	public function rand_real($member_proxy=NULL)
	{
		if(HOST_DATABASE=='UAT'){
			$sort = $this->uat_sort(); 
			return 30000000+$sort;
		}
		if(strlen($member_proxy)>4){
			$frist = 20000000;
			$proxy = substr($member_proxy,0,4)*1000;
			$sort = $this->proxy_sort($member_proxy);
			return $frist+$proxy+$sort;
		}
		else{
			$sort = $this->real_sort();
			return 20000000+$sort;
		}
	}
	
	// 无代理
	private function real_sort()
	{
		$this->CI->db->where('platform_id',$this->platform_id);
		$row = $this->CI->db->get('trading_platform')->row_array();
		if($row){
			$sort = $row['platform_real'];
			$this->CI->db->where('platform_id',$this->platform_id);
			$this->CI->db->update('trading_platform',array('platform_real'=>$sort+1));
			return $sort;
		}
		return NULL;	
	}
	
	// 有代理
	private function proxy_sort($member_proxy)
	{
		$this->CI->db->where('trad_proxy_login',$member_proxy);
		$row = $this->CI->db->get('trading_proxy')->row_array();
		if($row){
			$sort = $row['trad_proxy_sort'];
			$this->CI->db->where('trad_proxy_login',$member_proxy);
			$this->CI->db->update('trading_proxy',array('trad_proxy_sort'=>$sort+1));
			return $sort;
		}
		return NULL;
	}
	
	
	
	
	
	
	
	//------------------------------------------------------------------------//
	
	public function rand_demo()
	{
		if(HOST_DATABASE=='UAT'){
			$sort = $this->uat_sort(); 
			return 30000000+$sort;
		}
		$sort = $this->demo_sort(); 
		return 10000000+$sort;
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
	
	
	
	
	
	
	
	
	// UAT开立的真实|模拟账号以3开头8位数
	private function uat_sort()
	{
		$this->CI->db->where('platform_id',$this->platform_id);
		$row = $this->CI->db->get('trading_platform')->row_array();
		if($row){
			$sort = $row['platform_uat'];
			$this->CI->db->where('platform_id',$this->platform_id);
			$this->CI->db->update('trading_platform',array('platform_uat'=>$sort+1));
			return $sort;
		}	
		return NULL;
	}
	
	
	
	
	
	
	
	
	
}