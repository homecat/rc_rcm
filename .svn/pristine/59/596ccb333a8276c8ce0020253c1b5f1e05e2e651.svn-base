<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// 客户跟进记录

class  Member_activity_model  extends  Follow_base_model
{

	public function __construct()
	{
		parent::__construct();
		$this->table = 'member_activity';
		$this->increm = 'activity_id';
	}
	public function get_activity_records($member_id='')
	{
		if($member_id == '') return array();
		
		$this->db->order_by('activity_time','desc');
		$this->db->order_by('activity_id','desc');
		$query = $this->db->get_where($this->table, array('member_id' => $member_id));
		return $query->result_array();
	}
	public function get_activity_record_row($activity_id='')
	{
		if($activity_id == '') return array();
		$this->db->limit(1);
		$query = $this->db->get_where($this->table, array('activity_id' =>$activity_id));
		return $query->row_array();
	}
}
