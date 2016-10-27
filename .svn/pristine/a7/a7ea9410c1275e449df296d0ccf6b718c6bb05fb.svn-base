<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// 客户级别修改

class  Member_grade_model  extends  Status_base_model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'member_grade';
		$this->increm = 'grade_id';
	}
	//升降级记录查询,$member_id为假时表示查询全部信息。
	public function get_grade_records($member_id='')
	{
		//if($member_id == '') return array();
		
		if($member_id == '')
		{
			 
			 $query = $this->db->get();
			 
		}else
		{
			$this->db->order_by('create_time','desc');
			$query = $this->db->get_where($this->table, array('member_id' => $member_id));
			
		}
		
        
		return $query->result_array();
	}
	//查询$member_id对应的姓名
	public function get_member_name($table,$id='')
	{
		if($id=='')return '';
		$query = $this->db->get_where("{$table}", array('member_id' => $id));
		$result=$query->row_array();
		return $result=$result?$result['member_name']:'';
	
	}

}
