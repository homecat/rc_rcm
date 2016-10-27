<?php if (!defined('BASEPATH')) exit('No direct access allowed.');


// 客户资料修改审批

class Member_checks extends MHT_Controller 
{
    public function index($page=1,$limit=20)
    {
		$search = array(
			'real_account'  => '',
			'rc_real_account'  => '',
			'check_status'  => '',
			'time_type'  => '',
			'time_start' => '',
			'time_end' => ''
		);
		$this->session->set_userdata(array('search'=>$search));
		
        if($this->input->post()){
			if(strstr($this->input->post('real_account',TRUE),'R')==false){
            	$search['real_account']  = $this->input->post('real_account',TRUE);
			}else{
				$search['rc_real_account']  = $this->input->post('real_account',TRUE);
			}
            $search['check_status']  = $this->input->post('check_status',TRUE);

            $search['time_type']  = $this->input->post('time_type',TRUE);
            $search['time_start']  = $this->input->post('time_start',TRUE);
            $search['time_end']  = $this->input->post('time_end',TRUE);

            $this->session->set_userdata(array('search'=>$search));
        }
        $search = $this->session->userdata('search');
        $data['search'] = $search;
        $data['page'] = $page;
        $data['limit'] = abs($limit);

        // 搜索条件
        $this->db->start_cache();
        if($search['real_account']) $this->db->where('real_account',$search['real_account']);
		if($search['rc_real_account']) $this->db->where('rc_real_account',$search['rc_real_account']);
        if($search['check_status']) $this->db->where('check_status',$search['check_status']);
        if($search['time_type'] == 1){
            if($search['time_start']) $this->db->where('edit_time >=',$search['time_start']);
            if($search['time_end']) $this->db->where('edit_time <=',$search['time_end']);
        }
        if($search['time_type'] == 2){
            if($search['time_start']) $this->db->where('check_time >=',$search['time_start']);
            if($search['time_end']) $this->db->where('check_time <=',$search['time_end']);
        }
        $this->db->stop_cache();
		
		// 列表数据
		$total = $this->member_edits_model->get_total();//echo $this->db->last_query();die;
		$data['pages'] = manage_pages(site_url('manage/member_checks/index/'),$total,$page,$limit);

		$this->db->order_by('edit_time','desc')->limit($limit,abs($page-1)*$limit);
		$data['result'] = $this->member_edits_model->get_list();
		$this->db->flush_cache();

		return $this->load->view('manage/member_checks/list',$data);
    }
    // 显示信息
    public function show($page=1,$edit_id=0)
    {
        $row = $this->member_edits_model->get_row(array('edit_id' => $edit_id));

        if(empty($row)){
            return redirect(site_url('manage/member_checks/index'));
        }

        $data['edit_id'] = $edit_id;
        $data['page'] = $page;

        $data['old'] = json_decode($row['old_data'],true);
        $data['new'] = json_decode($row['new_data'],true);
        $data['check_status'] = $row['check_status'];

        return $this->load->view('manage/member_checks/show',$data);
    }
    // 提交审核
    public function submit($page=1,$edit_id=0)
    {
        $row = $this->member_edits_model->get_row(array('edit_id' => $edit_id));
        if(empty($row) || $row['check_status']>1){
            return redirect(site_url('manage/member_checks/index/'.$page));
        }

        $new = json_decode($row['new_data'],true);
        //更新账户资料
		foreach($new as $k=>$item)
		{
			if($item =='') $new[$k] = NULL;
		}
		
		//添加升降级记录
		$old_data = json_decode($row['old_data'],true);
		
		if(isset($new['account_type']) && !empty($new['account_type'])){
			$grade['account_type'] = $new['account_type'];
			$grade['member_id'] = $row['member_id'];
			$grade['sales_man'] = $old_data['sales_man'];
			$grade['creater'] = $row['edit_people'];
			$grade['create_time'] = $row['edit_time'];
			
			if($old_data['account_type'] == $new['account_type'] || $old_data['account_type'] == ''){
				$grade['grade_status'] = 0;
				$this->member_grade_model->save(0,$grade);
			}else{
				($old_data['account_type'] != $new['account_type']);
				$grade['grade_status'] = $this->compare_grade($old_data['account_type'],$new['account_type']);
				$this->member_grade_model->save(0,$grade);
			}
		}
		

		
		//更新"修改客户资料的时间"
		$new['updater'] = $row['edit_people'];
		$new['update_time'] = date('Y-m-d H:i:s');
        $this->member_account_model->save($row['member_id'],$new);

        //更新记录状态
        $status['check_status'] = 2;
        $status['check_time'] = date('Y-m-d H:i:s');
        $status['check_people'] = $this->session->userdata('user_id');
        $this->member_edits_model->save($edit_id,$status);
		
        return redirect(site_url('manage/member_checks/index/'.$page));
	}

	
	// 放弃审核
	public function forgo($page=1,$edit_id=0)
	{
        $row = $this->member_edits_model->get_row(array('edit_id' => $edit_id));
		
        if(empty($row) || $row['check_status']>1){
			return redirect(site_url('manage/member_checks/index/'.$page));		
		}

		$data['check_status'] = 3;
		$data['check_time'] = date('Y-m-d H:i:s');
		$data['check_people'] = $this->session->userdata('user_id');
		$this->member_edits_model->save($edit_id,$data);
		return redirect(site_url('manage/member_checks/index/'.$page));
	}
	//比较账户升降级
	//1升级2降级
	private function compare_grade($last,$new)
	{
		$grades = array('迷你'=>1,'标准'=>2,'卓越'=>3,'至尊'=>4);
		if(! $last) return 1;
		if(! $new) return 2;
		if($last && $new)
		{
			if($grades[$last] > $grades[$new])
			{
				return 2;
			}else
			{
				return 1;
			}
		}
	}
	
}