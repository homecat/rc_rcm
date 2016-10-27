<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// 客户资料总览
class  Member_behave_model  extends  Behave_base_model
{

	public function __construct()
	{
		parent::__construct();
		$this->table = 'user_list';
		$this->increm = 'user_id';
		
	}
	
	public function getBehave($search=array(),$page,$limit)
	{ 
		$results = array('total'=>0,'result'=>array());
		if(count($search)>0&&$page>0&&$limit>0)
		{
				$temp=$search;
				unset($temp['time_start']);	
				unset($temp['time_end']);
					
				//获取总数
				$lists = $this->get_use_list($temp);	
				$results['total'] = count($lists);
				//获取数据
				$lists = $this->get_use_list($temp,$page,$limit);
					
				foreach($lists as $k=>$item)
				{
					$row = $this->getDataNum($item['user_id'],$search['time_start'],$search['time_end']);
					//echo $this->db->last_query();
					$row['sales_man'] = $item['user_id'];
					$row['user_status'] = $item['user_status'];
					$results['result'][] = $row;
				}
			}	
		
		
		
		return $results;
	}

	public function get_use_list($search=array(),$page=NULL,$limit=NULL){	
		$results =array();
			$where_array='';
			foreach($search as $k=>$v){
				if($v){
					if($k=='sales_id'){
						$k='c.'.$k;
						$this->db->where_in($k,$this->low_ids($v));
						
					}elseif($k=='sales_man'){
						$k='c.user_id';
						$where_array[$k]=$v;
					}elseif($k=='user_status'){
						$k='c.user_status';
						$where_array[$k]=$v;
					}
				}
			}
			if($page>0&&$limit>0){
				$this->db->select('c.user_id,c.sales_id ,c.user_status ,a.*');
				$this->db->limit($limit,($page-1)*$limit);
			}else{
				$this->db->select('a.sales_pid');
			}
			if($where_array)$this->db->where($where_array);
			
				$this->db->order_by('a.update_time','desc');
				$this->db->join($this->table.' c', 'c.sales_id = a.sales_id','left');
	
				
				$query=$this->db->get('member_sales a');
				//获得数据
				$results=$query->result_array();
				//echo $this->db->last_query();
			
		
		return $results;
	}
	
	
	
	
	public function getall_sales($flag=false){
		$sales_id_array='';
		$this->db->select('sales_id,sales_pid');
		$this->db->from('member_sales');
		$query=$this->db->get();
		$sales_id=$query->result_array();
		if($sales_id){
			if($flag==false){
				foreach($sales_id as $k=>$v){
					$sales_id_array[]=$v['sales_id'];
				}
			}else{
				
				$sales_id_array=$sales_id;
			}
	
		}
		return $sales_id_array;
	}
	//获取销售的表现
	public function getDataNum($user_id,$start=NULL,$end=NULL)
	{
		$row = array('newCreate'=>0,'newOpen'=>0,'Dead'=>0,'Stage1'=>0,'Stage2'=>0,'Stage3'=>0,'Stage4'=>0,'nums'=>0);
		if($user_id && $start && $end)
		{
			$temp = array();
			$list = array();
			//新增CRM总数
			$temp['sales_man'] = $user_id;
			$temp['create_time > '] = $start;
			$temp['create_time < '] = $end;
			$this->table = 'member_account';
			$this->increm = 'member_id';
			$list=parent::get_list($temp);
			$row['newCreate'] = count($list);
			//成功开户总数
			$temp = array();
			$list = array();
			$temp['sales_man'] = $user_id;
			//$temp['open_time !=' ] = '';
			$temp['open_time > '] = $start;
			$temp['open_time < '] = $end;
			$this->table = 'member_account';
			$this->increm = 'member_id';
			$list=parent::get_list($temp);
			$row['newOpen'] = count($list);
			
			//Dead Lead
			$list = array();
			$this->db->select('ms.status_id');
			$this->db->from('member_status ms');
			$this->db->where('ma.sales_man',$user_id);
			$this->db->where('ms.member_status','Dead');
			//$this->db->where('ms.create_time >',$start);
			//$this->db->where('ms.create_time <',$end);
			$this->db->join('member_account ma','ma.member_id = ms.member_id');
			$list = $this->db->get()->result_array();
			$row['Dead'] = count($list);
			
			//Stage1
			$temp = array();
			$list = array();
			/*$this->db->select('ms.status_id');
			$this->db->from('member_status ms');
			$this->db->where('ma.sales_man',$user_id);
			$this->db->where('ms.member_status','Stage1');
			$this->db->where('ms.create_time <',$end);
			$this->db->join('member_account ma','ma.member_id = ms.member_id');*/
			$this->db->select('member_id');
			$this->db->from('member_account');
			$this->db->where('member_status','Stage1');
			$this->db->where('sales_man',$user_id);
			//$this->db->where('update_time > ',$start);
			//$this->db->where('update_time < ',$end);
			$list = $this->db->get()->result_array();
			$row['Stage1'] = count($list);
			
			//Stage2
			$list = array();
			$this->db->select('member_id');
			$this->db->from('member_account');
			$this->db->where('member_status','Stage2');
			$this->db->where('sales_man',$user_id);
			//$this->db->where('update_time > ',$start);
			//$this->db->where('update_time < ',$end);
			$list = $this->db->get()->result_array();
			$row['Stage2'] = count($list);
			
			//Stage3
			$list = array();
			$this->db->select('member_id');
			$this->db->from('member_account');
			$this->db->where('member_status','Stage3');
			$this->db->where('sales_man',$user_id);
			//$this->db->where('update_time > ',$start);
			//$this->db->where('update_time < ',$end);
			$list = $this->db->get()->result_array();
			$row['Stage3'] = count($list);
			//Stage4
			$list = array();
			$this->db->select('member_id');
			$this->db->from('member_account');
			$this->db->where('member_status','Stage4');
			$this->db->where('sales_man',$user_id);
			//$this->db->where('update_time > ',$start);
			//$this->db->where('update_time < ',$end);
			$list = $this->db->get()->result_array();
			$row['Stage4'] = count($list);
			//合共
			$row['nums'] = $row['Stage1']+$row['Stage2']+$row['Stage3']+$row['Stage4'];
		}
		return $row;
	}
}
