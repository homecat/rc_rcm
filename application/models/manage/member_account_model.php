<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// 客户资料总览


class  Member_account_model  extends  Member_base_model
{

	public function __construct()
	{
		parent::__construct();
		$this->table = 'member_account';
		$this->increm = 'member_id';
	}

    public function Is_exists($account){
        $is_exists_num = array('qq'=>0,'phone'=>0,'weixin'=>0);//1000不存在，1100存在的
        if($account['member_qq']!=''){
            $query = $this->db->query("SELECT * FROM member_account WHERE member_qq = ". $account['member_qq']." OR member_qq2 = ".$account['member_qq']);
            if($query->num_rows() > 0) $is_exists_num['member_qq'] = 1100;
            else $is_exists_num['member_qq'] = 1000;
        }
        if($account['member_phone']!=''){
            $query = $this->db->query("SELECT * FROM member_account WHERE member_phone = ". $account['member_phone']." OR member_phone2 = ".$account['member_phone']);
            if($query->num_rows() > 0) $is_exists_num['member_phone'] = 1100;
            else $is_exists_num['member_phone'] = 1000;
        }
        if($account['member_weixin']!=''){
            $query = $this->db->query("SELECT * FROM member_account WHERE member_weixin =". $account['member_weixin']);
            if($query->num_rows() > 0) $is_exists_num['member_weixin'] = 1100;
            $is_exists_num['member_weixin'] = 1000;
        }
        return $is_exists_num;
    }

  //通过用户QQ查询 负责人的id 通过负责人的id 查询负责团队pid
    public function check_qq_sales($member_qq,$member_id=''){
        $this->db->select("a.member_qq as amember_qq,
        		 a.member_id as amember_id,
        		 a.member_qq2 as amember_qq2,
        		 a.sales_id as asales_id ,
        		 a.sales_man as asales_man,
        		 b.user_id as buser_id,
        		 b.sales_id as bsales_id,
        		 b.user_name as busername,
        		 c.sales_pid as csales_pid,
        		 c.sales_name as csales_name
        		");
        $this->db->from('member_account as a');
        $this->db->join('user_list as b','a.sales_man = b.user_id','left');
        $this->db->join('member_sales as c','b.sales_id = c.sales_id','left');
        $this->db->where('a.member_id !=',$member_id);
    	$this->db->where('a.member_qq',$member_qq);
   		$this->db->or_where('a.member_qq2',$member_qq);   	
     	$list=$this->db->get()->result_array();
     	
     	$this->session->set_userdata(array('is_list' => $list));
     	
    	return $this->check_sales_id($list);
    }

    //通过用户手机查询 负责人的id 通过负责人的id 查询负责团队pid
      public function check_phone_sales($member_phone, $member_id='', $isarr = false){
        $this->db->select("a.member_phone as amember_phone,
        		 a.member_id     as amember_id,
        		 a.member_phone2 as amember_phone2,
        		 a.sales_id   as asales_id ,
        		 a.sales_man  as asales_man,
        		 b.user_id    as buser_id,
        		 b.sales_id   as bsales_id,
        		 b.user_name  as busername,
        		 c.sales_pid  as csales_pid,
        		 c.sales_name as csales_name");
        $this->db->from('member_account as a');
        $this->db->join('user_list      as b', 'a.sales_man = b.user_id',  'left');
        $this->db->join('member_sales   as c', 'b.sales_id  = c.sales_id', 'left');
        $this->db->where('a.member_id !=',$member_id);
        $this->db->where('a.member_phone',$member_phone);      	
        $this->db->or_where('a.member_phone2',$member_phone);
    	$list=$this->db->get()->result_array();
    	return $this->check_sales_id($list);
    }

    
    //遍历无限分类负责团队
    public function check_sales_id($list){
    	$num = '';
    	$hk='HK Sales';
    	foreach($list as $key=>$item){
    		// 判断是否是终端	
    		if( $item['csales_pid'] == 1 ){
    			if($item['csales_name'] == $hk){
    				$query =$this->db->get_where('member_sales',array('sales_name'=>$item['csales_name']));
    				$num = $query->num_rows(); 
    			}
    		}else{
     			$query =$this->db->get_where('member_sales',array('sales_id'=>$item['csales_pid'],'sales_name'=>$hk));
    			$num = $query->num_rows(); 
    		}
    	}
    	return $num;
    }
    
	public function get_lists($parmas=array(),$page=0,$limit=0){
		if($page&&$limit){
			$this->db->order_by('update_time','desc');
			$this->db->limit($limit, abs($page - 1) * $limit);
		}else{
			$this->db->select('member_id');
		}
		$this->db->from($this->table.' a');
		$query = $this->db->get();
		$result=$query->result_array();
		return $result;
	}
	//更新部分客户资料
	public function upaccount($id=0,$data=array())
	{
		$res=$this->db->update($this->table, $data, array('member_id' => $id));
		return $res;
	
	}
	public function get_member_status( $params = array(), $edit = false, $statua = array()){

		if(is_array($params) && count($params) > 0){
			$result=$this->checkdata($params);
			if(count($result) == 0)return 2;//无数据通过来源不改变
			if($edit)
			{
                $member_id=$params['member_id'];
                unset($params['member_id']);
				if(count($result)==1){ 
					return 3;
				}else{
					$params['member_id']=$member_id;
					$result=$this->checkdata($params);
					if(!$this->checkdead($result)){
						if($statua['member_status1']=='Dead' || $statua['member_status1']=='predead'){
							return 0;
						}else{
							return 1;
						}
					}else{
						return $this->checkdead($result);
					} 
				}
				
			}else{
				return $this->checkdead($result);
			}		
		}
	
	}


	public function checkdead($result=array()){
		if($result)
		{
			$not_dead=array();//开头不为dead
			foreach($result as $k=>$v){
				if($v['member_status']!='Dead' && $v['member_status']!='predead'){
					array_unshift($not_dead,$v['member_status']);	
				}else{
					$not_dead[]=$v['member_status'];
				}
			}
			if(!in_array('Dead',$not_dead,true) && !in_array('predead',$not_dead,true)){
				return 0;
			}else{
				if($not_dead[0]=='Dead'){
					return 1;				
				}elseif($not_dead[0]=='predead'){
					return 4;
				}else{
					return 0;
				}
			}
		}	
		
	}

	public function checkAllMember($check=array()){
		foreach($check as $k=>$item){
			$this->db->where($k,$item);
		} 
		$this->db->where('member_status !=' , 'Dead');
		$this->db->where('member_status !=' , 'predead');   
		$this->db->from($this->table);
		$this->db->limit(1);
		$row = $this->db->get()->row_array();
		return $row;
	}

	//保存临时改动
	public function save_member($member_id=0,$data=array())
	{
		$this->db->update($this->table, $data, array('member_id' => $member_id));
		return $this->db->affected_rows();	
	}
	//检查用户信息恢复以前的旧数据
	public function member_info($member_id=0)
	{//
		//$num=0;
		if(!$member_id)return;
		$query = $this->db->get_where($this->table, array('member_id' => $member_id));
		$result=$query->row_array();
		$data='';
		if($result)
		{
			
			if($result['member_json'])
			{
				$data=(array)json_decode($result['member_json']);
				$data['member_json']=NULL;
				//print_r($data);
				{
					$res=$this->save_member($member_id,$data);
					//if($res>0)$num++;
				}
			}else{$res=0;}
		}
		return $res;
	}

	//更新最新信息
	public function save_new_info2($member_id=0,$data)
	{
		if(!$member_id)return;
		$query = $this->db->get_where($this->table, array('member_id' => $member_id));
		$result=$query->row_array();
		if($result)
		{
			if($data)
			{
				foreach($data as $v=>$k)
				{
					$result[$v]=$k;
				}
			}
			$res=$this->save_member($member_id,$result);
		}else{$res=0;}
		return $res;
	}
	//保存之后修改修改人及修改时间
	public function updates($member_id=0)
	{
		if( is_numeric($member_id))
		{
			$query = $this->db->get_where($this->table, array('member_id' => $member_id));
			$row=$query->row_array();
			if($row)
			{
				foreach($row as $v=>$k)
				{
				 $data[$v]=$k;
				 if($v=='updater')$data[$v]=$this->session->userdata['user_id'];
				 if($v=='update_time')$data[$v]=date('Y-m-d H:i:s');
				}
				$this->db->update($this->table, $data, array('member_id' => $member_id));
			}
			$res=$this->db->affected_rows();
		}else{$res=0;}
		return $res;
	}
	
	// 编辑输入验证
	public function input_data( $member_id = '')
	{
		//通用表单项
		$account['member_name'] = trim($this->input->post('member_name', true));
		$account['member_qq'] = trim($this->input->post('member_qq', true));
		$account['member_phone'] = trim($this->input->post('member_phone', true));
		$account['member_status'] = trim($this->input->post('member_status', true));
		$account['member_from'] = trim($this->input->post('member_from', true));
		$account['member_info'] = trim($this->input->post('member_info', true));
		$account['updater'] = trim($this->session->userdata['user_id']);
		$account['update_time'] = trim(date('Y-m-d H:i:s'));
		$account['member_weixin'] = trim($this->input->post('member_weixin', true));
		if(! $member_id){//添加功能-表单项
			$account['creater'] = $this->session->userdata['user_id'];
			$account['create_time'] = date('Y-m-d H:i:s');
			//额外添加“负责人”、“负责团队”
			$account['sales_id'] = $this->session->userdata['sales_id'];
			$account['sales_man'] = $this->session->userdata['user_id'];
		}else{
			//修改功能-表单项
			$account['member_qq_addfriend'] = trim($this->input->post('member_qq_addfriend',TRUE));
	
			if(! $account['member_qq_addfriend']) $account['member_qq_addfriend'] = '';
	
			$account['member_qq2'] = trim($this->input->post('member_qq2', true));
			$account['member_qq2_addfriend'] = trim($this->input->post('member_qq2_addfriend',TRUE));
	
			if(! $account['member_qq2_addfriend']) $account['member_qq2_addfriend'] = '';
			$account['expert_qq_invited'] = $this->input->post('expert_qq_invited',TRUE);
	
			if(! $account['expert_qq_invited']) $account['expert_qq_invited'] = '';
	
			$account['expert_qq_added'] = $this->input->post('expert_qq_added',TRUE);
	
			if(! $account['expert_qq_added']) $account['expert_qq_added'] = '';
	
			$account['member_weixin_addfriend'] = trim($this->input->post('member_weixin_addfriend',TRUE));
	
			if(! $account['member_weixin_addfriend']) $account['member_weixin_addfriend'] = NULL;
				
			$account['member_phone2'] = trim($this->input->post('member_phone2',TRUE));
			$account['demo_account'] = trim($this->input->post('demo_account', true));
			$account['call_start_time'] = trim($this->input->post('call_start_time', true));
			$account['wen_order_time'] = trim($this->input->post('wen_order_time', true));
			$account['key_reser_time'] = trim($this->input->post('key_reser_time', true));
			if($account['call_start_time']){
				$account['call_start_time'] = date('Y-m-d H:i:s',strtotime($account['call_start_time']));
			}else{
				$account['call_start_time'] = NULL;
			}
			if($account['wen_order_time']){
				$account['wen_order_time'] = date('Y-m-d H:i:s',strtotime($account['wen_order_time']));
			}else{
				$account['wen_order_time'] = NULL;
			}
			if($account['key_reser_time'] && $account['key_reser_time']==1){
				$account['key_reser_time']='321';
			}else{
				$account['key_reser_time']=NULL;
			}
		}
        //获取隐藏的修改时间值
        $account['is_upgrade'] = trim($this->input->post('is_upgrade', true));
        $account['is_operation'] = trim($this->input->post('is_operation', true));
        $account['re_MGM'] = trim($this->input->post('re_MGM', true));
        $account['is_income'] = trim($this->input->post('is_income', true));
		return $account;
	}

    public function check_input()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_message('min_length', '格式错误');
        $this->form_validation->set_message('max_length', '格式错误');
        $this->form_validation->set_rules_new('member_name'  , 'required|max_length[32]');

        $this->form_validation->set_rules_new('member_qq'    , 'min_length[5]|max_length[11]');
        $this->form_validation->set_rules_new('member_phone' , 'min_length[11]|max_length[11]');
        $this->form_validation->set_rules_new('member_weixin', 'required');

        $this->form_validation->set_rules_new('member_from'  , 'required');
        $this->form_validation->set_rules_new('channel'      , 'required');
        $this->form_validation->set_rules_new('member_status', 'required|max_length[32]');
        $this->form_validation->set_rules_new('member_info'  , 'required');
        return $this->form_validation->run();
    }



}
