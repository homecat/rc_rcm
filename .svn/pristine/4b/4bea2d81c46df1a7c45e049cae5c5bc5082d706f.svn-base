<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// 客户跟进记录


class  Member_follow_model  extends  Follow_base_model
{

	public function __construct()
	{
		parent::__construct();
		$this->table = 'member_follow';
		$this->increm = 'follow_id';
	}
    public function get_records_show_ul($member_id=''){

        if($member_id == '') return false;
        $this->db->order_by('follow_time','desc');
        $query = $this->db->get_where($this->table, array('member_id' => $member_id));
        foreach ($query->result() as $row){
            echo '<ul>';
            echo '<li>'.$row->follow_time.'   '.$row->follow_type.'</li>';
            echo '<li>'.$row->follow_info.'</li>';
            echo '</ul>';
        }
    }
	public function get_records_show_table($member_id=''){

        if($member_id == '') return false;
        $this->db->order_by('follow_time','desc');
        $query = $this->db->get_where($this->table, array('member_id' => $member_id));
        foreach ($query->result() as $row){
			echo '<table cellpadding="0" cellspacing="0" class="inside_tab">';
			echo '<tr>';
			echo '<td width="75">'.$row->follow_time.'</td>';
			echo '<td width="75">'.fcutstr($row->follow_type,0,4).'</td>';
			echo '<td width="75">'.$row->follow_info.'</td>';
			echo '</tr>';
			echo '</table>';
        }
    }
	public function get_follow_records($member_id='',$follow_status=TRUE)
	{
		if($member_id == '') return array();
		//跟进记录状态为已经保存 follow_status=1
		if($follow_status) $this->db->where('follow_status',2);
		
		$this->db->order_by('follow_time','desc');
		$query = $this->db->get_where($this->table, array('member_id' => $member_id,'follow_flag'=>NULL));
		return $query->result_array();
	}
	public function get_follow_record_row($follow_id='')
	{
		if($follow_id == '') return array();
		$this->db->order_by('follow_time','desc');
		$this->db->limit(1);
		$query = $this->db->get_where($this->table, array('follow_id' =>$follow_id));
		return $query->row_array();
	}
	//删除临时记录
	public function del_temp_records($member_id=0)
	{
		$this->db->order_by('follow_time','desc');
		$query = $this->db->get_where($this->table, array('member_id' => $member_id));
		$result = $query->result_array();
		if(!empty($result))
		{
			foreach($result as $k=>$item)
			{
				//删除未保存新增记录
				if($item['follow_status']==1) $this->delete($item['follow_id']);
				//删除未保存修改记录
				if($item['follow_edit'])
				{
					$old_follow = json_decode($item['follow_edit'],true);
					$old_follow['follow_edit'] = NULL;
					$this->save($item['follow_id'],$old_follow);
				}
			}
		}
	}
	//确认保存临时数据
	public function saveChangeFollowStatus($member_id=0)
	{
		$this->db->order_by('follow_time','desc');
		
		$query = $this->db->get_where($this->table, array('member_id' => $member_id));
		$result = $query->result_array();
		$num = 0;
		if(!empty($result))
		{
			foreach($result as $k=>$item)
			{
				//保存新增的记录
				if($item['follow_status']==1)
				{
					$this->save($item['follow_id'],array('follow_status'=>2,'follow_edit'=>NULL));
					$num ++;
				}
				//保存修改的记录
				if($item['follow_edit'])
				{
					$this->save($item['follow_id'],array('follow_edit'=>NULL));
					$num ++;
				}
			}
			//echo $this->db->last_query();
		}
		
		return $num;
	}
	
	//保存分析类型跟进记录
	public function save_anaydata($data=array())
	{
		$this->db->insert($this->table, $data); 	
		$row=$this->db->insert_id();
		return $row;

	}
	//查询记录-》分析类型跟进记录
	public function get_recode($member_id=0)
	{
		$this->db->where(array('follow_flag'=>'analyst','member_id'=>$member_id));
		$this->db->order_by('follow_time desc');
		$query=$this->db->get($this->table);
		return $query->result_array();
	}
	//得到一条固定分析类型根进记录
	public function get_onerecode($id='')
	{
		$query = $this->db->get_where($this->table, array('follow_id' => $id));
		$res=$query->row_array();
		return $res;
	}
	//确定更新记录
	public function update_recode($data=array(),$id='')
	{
	 	if(!is_array($data) || !$id )return false;
		$this->db->update($this->table, $data,array('follow_id' => $id)); 
		$res=$this->db->affected_rows();
		return $res;
	}
	//删除未保存的背景
	public function del_notconfirm()
	{
		$num=0;
		$query = $this->db->get_where($this->table, array('follow_flag' => 'analyst'));
		$res=$query->result_array();
		if($res)
		{
		foreach($res as $v=>$k)
			{
				if($k['follow_btn_bg']==NULL)
				{
					$data=$k;
					$data['follow_confirm']=NULL;
					$ress=$this->update_recode($data,$k['follow_id']);
					if($ress>0)$num++;
				}
				if($k['follow_confirm']==NULL)
				{
					$data=$k;
					$data['follow_btn_bg']=NULL;
					$ress=$this->update_recode($data,$k['follow_id']);
					if($ress>0)$num++;
				}
			}
		}
		return $num;
	}
	//获得所有点击了确认保存背景的信息数量
	public function getnums()
	{
		$query = $this->db->get_where($this->table, array('follow_confirm' => 1,'follow_btn_bg'=>1));
		$res=$query->result_array();
		$data='';
		if($res)
		{
			foreach($res as $v=>$k)
			{
				$data[]=$k['follow_id'];
			}
		}
		return is_array($data)?$data:(array)$data;
	
	}
	//确认信息背景
	public function update_recode_bg($id=0)
	{
		$num=0;
	 	if(!$id )return false;
		$query = $this->db->get_where($this->table, array('follow_id' => $id));
		$res=$query->row_array();
		if($res['follow_btn_bg']==1)
		{
			$data='';
			if($res['follow_confirm']==NULL)
			{
				foreach($res as $v=>$k)
				{
					$data[$v]=$k;
					if($v=='follow_confirm')$data[$v]=1;
					//if($v=='follow_time')$data[$v]=date('Y-m-d H:i:s');
				}
			}else
			{
				foreach($res as $v=>$k)
				{
					$data[$v]=$k;
				}
			
			}
		$ress=$this->update_recode($data,$id);
		if($ress>0)$num++;
		}
		return $num;
	}
	
	
}
