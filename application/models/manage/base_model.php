<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Base_model  extends  MY_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function get_list($parame=array(),$page=0,$limit=0)
	{
		$this->query_in_sales();
		return parent::get_list($parame,$page,$limit);
	}
	public function get_select($parame=array())
	{
		$this->query_in_sales();
		return parent::get_select($parame);
	}
	public function get_row($parame=array())
	{
		$this->query_in_sales();
		return parent::get_row($parame);
	}
	public function get_sum($parame=array())
	{
		$this->query_in_sales();
		return parent::get_sum($parame);
	}
	public function get_total($parame=array())
	{
		$this->query_in_sales();
		return parent::get_total($parame);
	}
	public function save($parame=array(),$row=array())
	{
		$this->savdel_in_sales();
		return parent::save($parame,$row);
	}
	public function delete($parame=array())
	{
		$this->savdel_in_sales();
		return parent::delete($parame);
	}
	protected function query_in_sales()
	{
	}
	protected function savdel_in_sales()
	{
	}
	public function getUserGlobal($user_id,$field=NULL)
	{
		$this->db->from('user_list');
		$this->db->where('user_id',$user_id);
		$row = $this->db->get()->row_array();
		if(empty($row)) return "";
		if($field)
		{
			if(isset($row[$field]))
			{
				return $row[$field];
			}else
			{
				return "";
			}
		}
		return $row['user_name'];
	}
	//---------------------------------- 当前用户 销售团队权限 ---------------------------------------//
	public function low_ids($sales_id=NULL)
	{
		$sql = 'SELECT * FROM (`member_sales`) ORDER BY `sales_id` asc';
		$result = $this->db->query($sql)->result_array();
		if(empty($sales_id)) $sales_id = $this->session->userdata('sales_id');
		return $this->ids($result,$sales_id);
	}
	private function ids($result,$id,$sign=0)
	{
		$sign++;
		if($sign==1){
			$ids = array($id);
		}else{
			$ids = array();
		}
		foreach($result as $item){
			if($item['sales_pid']==$id){
				$ids[] = $item['sales_id'];
				$sid = $this->ids($result,$item['sales_id'],$sign);
				$ids = array_merge($ids,$sid);
			}
		}
		return $ids;
	}
}
//-------------------------------------------- 后台用户列表 -----------------------------------------//
class  User_base_model  extends  Base_model
{
	public function __construct()
	{
		parent::__construct();
	}
	protected function query_in_sales()
	{
		$low_ids = $this->low_ids();
		$this->db->where('a.sales_id IN ('.implode(',',$low_ids).')');
	}
}
//-------------------------------------------- 客户资料列表 -----------------------------------------//

class  Member_base_model  extends  Base_model
{
	public function __construct()
	{
		parent::__construct();
	}
	protected function query_in_sales()
	{
		$low_ids = $this->low_ids(); 
		$this->db->where('a.sales_id IN ('.implode(',',$low_ids).')');
	}
}
//-------------------------------------------- 客户资料修改 -----------------------------------------//
class  Edits_base_model  extends  Base_model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	
	protected function query_in_sales()
	{
		$low_ids = $this->low_ids(); 
		$this->db->join('member_account b','b.member_id=a.member_id','left');
		$this->db->where('b.sales_id IN ('.implode(',',$low_ids).')');
	}
	
}
//-------------------------------------------- 客户状态修改 -----------------------------------------//
class  Status_base_model  extends  Base_model
{
	public function __construct()
	{
		parent::__construct();
	}	
	protected function query_in_sales()
	{
		$low_ids = $this->low_ids(); 
		$this->db->join('member_account b','b.member_id=a.member_id','left');
		$this->db->where('b.sales_id IN ('.implode(',',$low_ids).')');
	}
}
//-------------------------------------------- 客户跟进记录 -----------------------------------------//
class  Follow_base_model  extends  Base_model
{
	public function __construct()
	{
		parent::__construct();
	}
	protected function query_in_sales()
	{
		$low_ids = $this->low_ids(); 
		$this->db->join('member_account b','b.member_id=a.member_id','left');
		$this->db->where('b.sales_id IN ('.implode(',',$low_ids).')');
	}
}
//-------------------------------------------- 销售表现记录 -----------------------------------------//
class  Behave_base_model  extends  Base_model
{
	public function __construct()
	{
		parent::__construct();
	}
	protected function query_in_sales()
	{
		$low_ids = $this->low_ids(); 
		$this->db->where('a.sales_id IN ('.implode(',',$low_ids).')');
	}
}