<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// 参数配置


class  Member_params_model  extends  MY_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->table = 'member_params';
		$this->increm = 'parm_id';
	}


    public function get_parm_option($parm_type='',$select='')
	{
		$this->db->order_by('parm_sort','ASC');
        $query = $this->db->get_where($this->table, array('parm_type' => $parm_type));
        foreach ($query->result() as $row){
            if($select == $row->parm_name) echo '<option value="'.$row->parm_name.'" selected="selected">'.$row->parm_name.'</option>';
            else echo '<option value="'.$row->parm_name.'">'.$row->parm_name.'</option>';
        }
    }
	public function get_parm_options($parm_type='',$select='')
	{
		$this->db->order_by('parm_sort','ASC');
		$query = $this->db->get_where($this->table, array('parm_type' => $parm_type));
		$result = $query->result_array();
		$option = array();
		foreach($result as $k=>$item)
		{
			$option[$item['parm_id']] = $item['parm_name'];
		}
		return $option;
	}

}
