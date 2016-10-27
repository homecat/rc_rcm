<?php if (!defined('BASEPATH')) exit('No direct access allowed.');

class Member_edits extends MHT_Controller 
{
	/* 页面分辨码code 1200=已经存在修改提案需要审核
		1100=真实账号已经存在
		1000=修改成功
		1300=修改失败
		1400==没有需要保存的修改
	*/
    public function index($code=NULL)
    {
		//print_r($this->ss());
		$search_data = $this->search();
		
		$data['code'] = $search_data['code'];
		$data['search'] = $search_data['search'];
		$data['row'] = $search_data['row'];
        
		if($code) $data['code'] = $code;
        return $this->load->view('manage/member_edits/index',$data);
    }
	public function search()
	{
		$search = array(
            'member_qq' => '',
            'member_phone' => '',
            'real_account' => '',
			'rc_real_account' => '',
			'member_id' => ''
        );
		if($this->input->post())
		{
			
            $search['member_qq'] = trim($this->input->post('search_member_qq',TRUE));
            $search['member_phone'] = trim($this->input->post('search_member_phone',TRUE));
			if(strstr($this->input->post('search_real_account',TRUE),'R')==false){
            $search['real_account'] = $this->input->post('search_real_account',TRUE);
			}else{$search['rc_real_account'] = $this->input->post('search_real_account',TRUE);}
			//echo $search['rc_real_account'];
            $search['member_id'] = trim($this->input->post('search_member_id',TRUE));
        }
		$search_data['search'] = $search;
        $search_data['row'] = array();
        $search_data['code'] = 0;
		//定义一条数据
		$member_row = array();
		
		if($search['member_qq'])
		{
			$where1 = "(`member_qq`="."'".$search['member_qq']."'"." OR "."`member_qq2`="."'".$search['member_qq']."')";
			$this->db->where($where1);
		}
		if($search['member_phone'])
		{
			$where2 = "(`member_phone`="."'".$search['member_phone']."'"." OR "."`member_phone2`="."'".$search['member_phone']."')";
			$this->db->where($where2);
		}
		if($search['real_account'])
		{
			$this->db->where('real_account', $search['real_account']);
		}
		if($search['rc_real_account'])
		{
			$this->db->where('rc_real_account', $search['rc_real_account']);
		}
		if($search['member_id'])
		{
			$this->db->where('member_id', $search['member_id']);
		}
		//echo $search['rc_real_account'];
		if($search['member_qq'] || $search['member_phone'] || $search['real_account'] ||  $search['rc_real_account']|| $search['member_id'])
		{
			$member_row = $this->member_account_model->get_row();
			//echo $this->db->last_query();
		}
		if(! empty($member_row))
		{
			$edit_record_row = $this->member_edits_model->get_row(array('member_id'=>$member_row['member_id'],'check_status'=>1));
			if(! empty($edit_record_row)) $search_data['code'] = 1200;
		}
		$search_data['row'] = $member_row;
		//print_r($member_row);
		return $search_data;
	}
    //编辑数据
    public function submit($member_id='')
    {
        if($this->check_input())
		{
			if(! $this->check_member_real_account($member_id)) return $this->index(1100);
			if(! $this->check_member_rc_real_account($member_id)) return $this->index(1600);
			if(! $this->check_member_edits($member_id)) return $this->index(1200);
            $row = $this->member_account_model->get_row(array('member_id' => $member_id));
			$new_data = $this->input_data($row);
			
			//print_r($new_data);die;
			//如果没有修改 || $row['rc_real_account']==$new_data['real_account']) 
			if( $row['sales_man']==$new_data['sales_man'] && 
				$row['member_opener']==$new_data['member_opener'] && 		
				$row['real_account'] == $new_data['real_account']&&
				$row['rc_real_account'] == $new_data['rc_real_account']&&	
				$row['open_time']==$new_data['open_time'] && 
				$row['account_type']==$new_data['account_type'] && 
				$row['member_MGM']==$new_data['member_MGM']
			) //die('1111');
			return $this->index(1400);
			
			$user = $this->user_list_model->get_row(array('user_id'=>$new_data['sales_man']));
			$new_data['sales_id'] = $user['sales_id'];
            $save['member_id'] = $row['member_id'];
            $save['edit_time'] = date('Y-m-d H:i:s');
            $save['edit_people'] = $this->session->userdata('user_id');
            $save['old_data'] = json_encode($row);
            $save['new_data'] = json_encode($new_data);
			
            $status = $this->member_edits_model->save(0,$save);
			if($status)
			{
				$code = 1000;
			}else
			{
				$code = 1300;
			}
           return $this->index($code);
        }
		return $this->index();
    }
    // 输入验证
    private function check_input()
    {
		$this->form_validation->set_message('required', ' %s必填 ');
		$this->form_validation->set_message('min_length', ' %s长度不够 ');
		$this->form_validation->set_message('max_length', ' %s超出长度 ');
		$this->form_validation->set_message('alpha_numeric', ' %s含非法字符 ');
		
        $this->form_validation->set_rules('sales_man','负责人','required');
        $this->form_validation->set_rules('member_opener','开户人','max_length[32]');
        //$this->form_validation->set_rules('real_account','真实账户','alpha_numeric|min_length[8]|max_length[9]');
        $this->form_validation->set_rules('account_type','账户类别','max_length[32]');
        $this->form_validation->set_rules('member_MGM','MGM','alpha_numeric|max_length[32]');
        $this->form_validation->set_rules('open_time','开户时间','max_length[64]');
        return $this->form_validation->run();
    }
	//验证提案
	private function check_member_edits($member_id)
	{
		$member_edits_row = $this->member_edits_model->get_row(array('member_id'=>$member_id,'check_status'=>1));
		if(! empty($member_edits_row)) return false;
		return true;
	}
	//验证MT4账号唯一性
	private function check_member_real_account($member_id)
	{
		$real_account = $this->input->post('real_account',TRUE);
		if(! $real_account) return TRUE;
        $informate = $this->member_account_model->get_row(array('real_account'=>$real_account,'member_id !='=>$member_id));
        if(empty($informate)) return TRUE;
        return FALSE;
	}
	//验证RC账号唯一性
	private function check_member_rc_real_account($member_id)
	{
		$real_account = $this->input->post('rc_real_account',TRUE);
		if(! $real_account) return TRUE;
        $informate = $this->member_account_model->get_row(array('rc_real_account'=>$real_account,'member_id !='=>$member_id));
        if(empty($informate)) return TRUE;
        return FALSE;
	}
    private function input_data($row=NULL)
	{
        $account['sales_man'] = $this->input->post('sales_man', true);
        $account['member_opener'] = $this->input->post('member_opener', true);
		//分rc账户mt4账户
		$account['real_account']=trim($this->input->post('real_account', true));
		$account['rc_real_account']=strtoupper($this->input->post('rc_real_account', true));
        $account['open_time'] = $this->input->post('open_time', true);
        $account['account_type'] = $this->input->post('account_type', true);
        $account['member_MGM'] = $this->input->post('member_MGM', true);
        return $account;
    }
}