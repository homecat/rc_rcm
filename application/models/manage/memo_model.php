<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Memo_model extends Base_model {
	
	public function __construct()
	{
		parent::__construct();
		$this->table = 'memo';
	}
	
	public function displayMemo( $page , $limit , $user_id )
	{ 
		$res= array();
		$res['total'] = $this->get_total( array('user_id'=>$user_id) );
		$res['list']  = $this->get_list( array('user_id'=>$user_id) , $page , $limit );
		return  $res;
	}
	public function get_text($id)
	{
		$this->db->where('id',$id);
		$this->db->from($this->table);
		$result = $this->db->get()->result_array();
		return $result;
	}
	public function add_text( $title , $content , $user_id )
	{
		$data = array(
				'title'    =>  $title,
				'content'  =>  $content,
				'user_id'  =>  $user_id,
		            );
	   return $this->db->insert($this->table, $data); 
	}
	public function update_text( $id , $title , $content )
	{
		$data = array(
				'title'   => $title,
				'content' => $content,
		);
		return $this->db->update($this->table, $data, array('id' => $id));
	} 
	public function delete_text($id)
	{
        return $this->db->delete($this->table, array('id' => $id));
	}
	
}

?>