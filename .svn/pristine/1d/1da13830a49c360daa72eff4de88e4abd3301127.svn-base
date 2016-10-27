<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// 客户交易模型


class  Member_tarde_model  extends  Member_base_model
{

	public function __construct()
	{
		parent::__construct();
		$this->table = 'trade_recode';
		$this->increm = 'trade_id';
	}
	public function gettraderecode($member_id='')
	{
		if(!$member_id)return array();
		$this->db->order_by('add_time','desc');
		$query = $this->db->get_where($this->table, array('member_id' => $member_id));
		return $query->result_array();	
	}
	//插入交易记录
	public function save($data='')
	{
		$this->db->insert($this->table,$data);
		$res=$this->db->insert_id();
		return $res;
	}
}