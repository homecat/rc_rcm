<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// 销售团队


class Member_sales_model  extends  Member_base_model
{
	public function __construct()
	{
		parent::__construct();
		$this->table  = 'member_sales';
		$this->increm = 'sales_id';
		$this->sorta  = 'asc';
	}
	public function get_list($parame=array(),$page=0,$limit=0)
	{
		$this->db->select('b.sales_name as sales_pname');
		$this->db->join('member_sales b','b.sales_id=a.sales_pid','left');
		return parent::get_list($parame,$page,$limit);
	}
	public function delete($parame=array())
	{
		$this->db->where('sales_pid >',0);
		return parent::delete($parame);	
	}
    public function sales_name($sales_id='')
    {
        $query = $this->db->get_where($this->table,array('sales_id'=>$sales_id));
        foreach ($query->result() as $row)
        {
            return $row->sales_name;
        }
    }
	//-------------------------------------------- 当前用户 销售团队权限 -----------------------------------------//
	public function sales_option($sid=0,$mid=0,$level=0)
	{
		$list = parent::get_list(array('asc'=>'sales_id'));
		$sales_id = $this->session->userdata('sales_id');
		//echo $sales_id;
		return $this->option($list,$sales_id,$sid,$mid,$level);
	}
	private function options($list,$iid,$sid,$mid,$level) //mid不可选
	{
        $level++;
		/*$spans = '';
        for($i = 0; $i < $level; $i++){
            $spans.='　';
        }*/
		$option = NULL;
		$showoptin=array();
		//print_r($list);die;
		foreach($list as $key=>$item){//假设是一级
			if($item['sales_id']==$iid){
				$showoptin[]=array('sales_id'=>$item['sales_id'],'spans'=>'&nbsp;');
				unset($list[$key]);
				$a=1;
				}

			
		}
		if(isset($a)&&$a==1)
		{
			foreach($showoptin as $key=>$value){
				
				foreach($list as $k=>$item){//2级
				if($item['sales_pid']==$value['sales_id']){
					$showoptin[]=array('sales_id'=>$item['sales_id'],'spans'=>'&nbsp;&nbsp;&nbsp;&nbsp;');
					unset($list[$k]);
					$a=2;
					
				}
				}	
			}
		}
		
		if(isset($a)&&$a==2)
		{
			foreach($showoptin as $key=>$value){
				
				foreach($list as $k=>$item){//3级
				if($item['sales_pid']==$value['sales_id']){
					$showoptin[]=array('sales_id'=>$item['sales_id'],'spans'=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
					unset($list[$k]);
					$a=3;
				}
				}	
			}
		}
		if(isset($a)&&$a==3)
		{
			foreach($showoptin as $key=>$value){
				
				foreach($list as $k=>$item){//4级
				if($item['sales_pid']==$value['sales_id']){
					$showoptin[]=array('sales_id'=>$item['sales_id'],'spans'=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
					unset($list[$k]);
					$a=3;
				}
				}	
			}
		}
		if($showoptin)
			foreach($showoptin as $v){
				if($v['sales_id']==$sid){
					$option .= '<option value="'.$v['sales_id'].'" selected="selected">'.$v['spans'].$this->get_sales_name($v['sales_id']).'</option>';
				}else{
					$option .= '<option value="'.$v['sales_id'].'" >'.$v['spans'].$this->get_sales_name($v['sales_id']).'</option>';
				}
			}
		return $option;
	}
	
	
	public function get_sales_name($sid=NULL){
		$result=array();
		if($sid){
			$this->db->select('sales_name');
			$this->db->where(array('sales_id' => $sid));
			$qurey=$this->db->get($this->table);
			$result=$qurey->row_array();
		}
		return $result?$result['sales_name']:'';
	}
	private function option($list,$iid,$sid,$mid,$level) //mid不可选
	{
        $level++;
		$spans = '';
        for($i = 0; $i < $level; $i++){
            $spans.='　';
        }
		$option = NULL;
		$showoptin='';
		foreach($list as $item){
			if($level==1){
				if($item['sales_id']==$iid){
					if($item['sales_id']==$sid){
						$option = '<option value="'.$item['sales_id'].'" selected="selected">'.$item['sales_name'].'</option>';
					}elseif($item['sales_id']==$mid){
						$option = '<option value="'.$item['sales_id'].'" readonly = "readonly">'.$item['sales_name'].'</option>';
					}else{
						$option = '<option value="'.$item['sales_id'].'">'.$item['sales_name'].'</option>';
					}
				}
			}
			if($item['sales_pid']==$iid){
				if($item['sales_id']==$sid){
					$option .= '<option value="'.$item['sales_id'].'" selected="selected">'.$spans.$item['sales_name'].'</option>';
				}elseif($item['sales_id']==$mid){
					$option .= '<option value="'.$item['sales_id'].'" readonly = "readonly">'.$spans.$item['sales_name'].'</option>';
				}else{
					$option .= '<option value="'.$item['sales_id'].'">'.$spans.$item['sales_name'].'</option>';
				}
				$option .= $this->option($list,$item['sales_id'],$sid,$mid,$level);
			}	
		}
		return $option;
	}
}