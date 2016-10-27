<?php if (!defined('BASEPATH')) exit('No direct access allowed.');
// 其他权限控制器

class Authority extends MHT_Controller 
{
	
	public function index()
	{
		echo '404';
	}
	//交易习惯
	public function trade_habit($member_id=0)
	{
		//客户资料
		$row = $this->member_account_model->get_row(array('member_id' => $member_id));	
		$data['row']=$row;
		//交易记录数据
		$tardes_sj=$this->member_tarde_model->gettraderecode($member_id);		
		$data['tardes_sj']=$tardes_sj;
		return $this->load->view('manage/member_account/trade_iframe', $data);	
	}
	//分析师记录
	public function analyst($member_id=0,$update_follow_time=NULL)
	{
		//客户资料
		$row = $this->member_account_model->get_row(array('member_id' => $member_id));	
		$data['row']=$row;
		//查询添加或者修改的的跟进记录follower=analyst;
		$userdata=$this->session->all_userdata();
		$data['analyst_rows']=$this->member_follow_model->get_recode($member_id);
		if($data['analyst_rows'])
		{
			foreach($data['analyst_rows'] as $k=>$item)
			{
				$follower=$this->user_list_model->get_usernamne($item['follower']);
				$data['analyst_rows'][$k]['follower']=$follower;
			}
		}
		$data['user_limits']=$userdata['user_limits'];
		if($update_follow_time)$data['update_follow_time']=$update_follow_time;
		return $this->load->view('manage/member_account/analyst', $data);
	}
	//分析类型添加跟进信息
	public function analyst_add()
	{
		$post=$this->input->post();
		$userdata=$this->session->all_userdata();
		$this->form_validation->set_rules('follow_info', ' ', 'required');
		$this->form_validation->set_rules('follow_type', ' ', 'required');
		if($this->form_validation->run() ==true)
		{
			$data['member_id']=$post['member_id'];
			$data['follower']=$userdata['user_id'];
			$data['follow_time']=$post['follow_time'];
			$data['follow_type']=$post['follow_type'];
			$data['follow_info']=$post['follow_info'];
			$data['follow_status']=1;
			$data['follow_edit']=NULL;
			$data['follow_flag']='analyst';
			$res=$this->member_follow_model->save_anaydata($data);
			if($res>0){
				$data['row']['member_id']=$post['member_id'];
				//查询添加或者修改的的跟进记录follower=analyst;
				$data['analyst_rows']=$this->member_follow_model->get_recode();
				if($data['analyst_rows'])
				{
					foreach($data['analyst_rows'] as $k=>$item)
					{
						$follower=$this->user_list_model->get_usernamne($item['follower']);
						$data['analyst_rows'][$k]['follower']=$follower;
					}
				}
				$data['user_limits']=$userdata['user_limits'];
				$data['update_follow_time']=time();
				$update_follow_time=$data['update_follow_time'];
				redirect('manage/authority/analyst/'.$post['member_id'].'/'.$update_follow_time);			
				}
		}else{
				$data['row']['member_id']=$post['member_id'];
				//查询添加或者修改的的跟进记录follower=analyst;
				$data['analyst_rows']=$this->member_follow_model->get_recode();
				if($data['analyst_rows'])
				{
					foreach($data['analyst_rows'] as $k=>$item)
					{
						$follower=$this->user_list_model->get_usernamne($item['follower']);
						$data['analyst_rows'][$k]['follower']=$follower;
					}
				}else{}
				$data['user_limits']=$userdata['user_limits'];
			return $this->load->view('manage/member_account/analyst', $data);
		}
	
	}
	//修改分析记录跟进类型
	public function edit_follow($follow_id=0)
	{
		$row = $this->member_follow_model->get_follow_record_row($follow_id);
		if(empty($row)) die("Nothing");
		$data['row'] = $row;
		return $this->load->view('manage/member_follow/analystfollow', $data);
	}
	
	//保存数据但是状态为未保存
	public function save_follow()
	{
		$post = $this->post();
		
		if(isset($post['follow_id']))
		{
			if(isset($post['follow_time']))
			{
				$data['row'] = $this->member_follow_model->get_follow_record_row($post['follow_id']);
				$old_follow['follower'] = $data['row']['follower'];
				$old_follow['follow_time'] = $data['row']['follow_time'];
				$old_follow['follow_type'] = $data['row']['follow_type'];
				$old_follow['follow_info'] = $data['row']['follow_info'];
				$old_follow['follow_status'] = $data['row']['follow_status'];
				$old_follow['follow_flag'] = $data['row']['follow_flag'];
				$old_follow['follow_confirm'] = $data['row']['follow_confirm'];
				$old_follow['follow_btn_bg'] = $data['row']['follow_btn_bg'];
				$post['follow_status'] = $data['row']['follow_status'];
				$post['follow_edit'] = json_encode($old_follow);
				$post['follow_flag'] = $data['row']['follow_flag'];
				$post['follow_confirm'] = $data['row']['follow_confirm'];
				$post['follow_btn_bg'] = $data['row']['follow_btn_bg'];
				
				//保存来显示修改的数据，json保存旧数据
				$this->member_follow_model->save(array('follow_id'=>$post['follow_id']),$post);
				$update_follow_time = time();
				redirect('manage/authority/analyst/'.$post['member_id'].'/'.$update_follow_time);
			}else
			{
				$data['row'] = $this->member_follow_model->get_follow_record_row($post['follow_id']);
				return $this->load->view('manage/authority/analyst',$data);
			}
		}else
		{
			if(isset($post['follow_time']))
			{
				$this->member_follow_model->save(0,$post);
				$update_follow_time = time();
				redirect('manage/authority/analyst/'.$post['member_id'].'/'.$update_follow_time);
			}else
			{
				$data['row']['member_id'] = $post['member_id'];
				return $this->load->view('manage/authority/analyst',$data);
			}
		}
	}
	private function post()
	{
		$this->form_validation->set_rules_new('follow_time', 'required');
		$this->form_validation->set_rules_new('follow_type', 'required');
		$this->form_validation->set_rules_new('follow_info', 'required');
		$follow_id = $this->input->post('follow_id',TRUE);
		if($follow_id)
		{
			$post['follow_id'] = $follow_id;
		}
		$post['member_id'] = $this->input->post('member_id',TRUE);
		$post['follower'] = $this->session->userdata('user_id');
		
		if(TRUE === $this->form_validation->run())
		{
			$post['follow_time'] = trim($this->input->post('follow_time',TRUE));
			$post['follow_type'] = trim($this->input->post('follow_type',TRUE));
			$post['follow_info'] = trim($this->input->post('follow_info',TRUE));
		}
		return $post;
	}
	public function confirm($follow_id='')
	{
		if(!$follow_id)die('空记录');
		$row=$this->member_follow_model->get_onerecode($follow_id);
		if($row)
		{
			if($row['follow_btn_bg']==NULL)$row['follow_btn_bg']=1;
			$res=$this->member_follow_model->update_recode($row,$follow_id);
			if($res>0)
			{
				$data['con_bg']=1;
			}else
			{
				$data['con_bg']=2;
			}
		}
		//客户资料
		$rows = $this->member_account_model->get_row(array('member_id' => $row['member_id']));	
		$data['row']=$rows;
		//查询添加或者修改的的跟进记录follower=analyst;
		$userdata=$this->session->all_userdata();
		if($rows){
		$data['analyst_rows']=$this->member_follow_model->get_recode($rows['member_id']);}
		if($data['analyst_rows'])
		{
			foreach($data['analyst_rows'] as $k=>$item)
			{
				$follower=$this->user_list_model->get_usernamne($item['follower']);
				$data['analyst_rows'][$k]['follower']=$follower;
			}
		
		}
		$data['user_limits']=$userdata['user_limits'];
		$data['update_follow_time']=time();
		return $this->load->view('manage/member_account/analyst', $data);
	}
	//资料修改页面嵌入跟进记录
	public function follow_iframe($member_id = 0,$update_follow_time=NULL)
	{
		$user_id = $this->session->userdata('user_id');
		$permissions = $this->user_list_model->check_permissions($user_id);
			
		$data['row']['member_id'] = $member_id;		
		if($update_follow_time) $data['update_follow_time'] = $update_follow_time;
		return $this->load->view('manage/member_account/follow_iframe', $data);
	}
	//升降级页面嵌入
	public function grade_iframe($member_id=0)
	{
		$data['row']['member_id'] = $member_id;
		return $this->load->view('manage/member_account/grade_iframe',$data);
	}
	//客户内容
	public function customer_content($member_id=0)
	{
		$row = $this->member_account_model->get_row(array('member_id' => $member_id));
        if (empty($row)) return redirect(site_url('manage/member_account/index/0/'.$page));
		$data['row']=$row;
		return $this->load->view('manage/member_account/customer_content',$data);
	}
	//资料修改页面嵌入活动记录
	public function activity_iframe($member_id = 0)
	{
		$data['row']['member_id'] = $member_id;
		return $this->load->view('manage/member_account/activity_iframe', $data);
	}

}