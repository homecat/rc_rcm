<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// 客户状态修改


class  Member_status_model  extends  Status_base_model
{

	public function __construct()
	{
		parent::__construct();
		$this->table = 'member_status';
		$this->increm = 'status_id';
	}


    public function get_records_show_ul($member_id=''){

        if($member_id == '') return false;
        $this->db->order_by('create_time','desc');
        $query = $this->db->get_where($this->table, array('member_id' => $member_id));
        foreach ($query->result() as $row){
            echo '<ul>';
            echo '<li>'.$row->member_status.' / '.$row->create_time.'</li>';
            echo '</ul>';
        }
    }
	public function get_status_records($member_id='')
	{
		if($member_id == '') return array();
		$this->db->order_by('create_time','desc');
        $query = $this->db->get_where($this->table, array('member_id' => $member_id));
		return $query->result_array();
	}
}
