<?php if (!defined('BASEPATH')) exit('No direct access allowed.');


/**
 * rand_real()       交易真实账号
 * rand_demo()       交易模拟账号
 * rand_password()   交易随机密码
 * get_orderId()     存款订单号
 */


include_once "class.base.php";


class fgl_acc extends base_acc
{
	
	
	public function __construct()
	{
		parent::__construct();
	}
	
	
	public function rand_real($member_proxy)
	{
		return $this->message();
	}
	
	

	public function rand_demo()
	{
		return $this->message();
	}
	
	

	public function rand_password()
	{
		$password = 'a';
		for($i=1; $i<8; $i++) $password .= rand(0,9);
		return $password;
	}
	
	
	
	public function get_orderId($real_login)
	{
		$this->CI->db->where('platform_id',$this->platform_id);
		$row = $this->CI->db->get('trading_platform')->row_array();
		if(empty($row)) return NULL;

		$first = $row['platform_pfx'];
		
		$this->CI->db->where('platform_id',$this->platform_id);
		$this->CI->db->where('real_login',$real_login);
		$total = $this->CI->db->get('record_deposit')->num_rows();
		
		$sort = substr((100001+$total),1);
		$order = $first.$real_login.$sort;
		
		return $order;
	}
	
	
	
	protected function message()
	{
		return NULL;
	}
	

	
}