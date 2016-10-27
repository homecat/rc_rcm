<?php if (!defined('BASEPATH')) exit('No direct access allowed.');

// 客户活动记录

class Member_activity extends MHT_Controller 
{
    public function index()
    {
		echo "noactivity";
    }
	public function edit($activity_id=0)
	{
		$row = $this->member_activity_model->get_activity_record_row($activity_id);
		if(empty($row)) die("Nothing");
		$data['row'] = $row;
		return $this->load->view('manage/member_account/edit_activity', $data);
	}
	//保存数据
	public function save()
	{
		$this->form_validation->set_message('required', ' %s必填 ');
		$this->form_validation->set_rules('activity_time','时间','required');
		$this->form_validation->set_rules('activity_name','名称','required');
		$this->form_validation->set_rules('activity_amount','金额','required');
		$this->form_validation->set_rules('activity_trades','手数','required');
		$this->form_validation->set_rules('activity_result','结果','required');
		$post = $this->post();
		if(TRUE === $this->form_validation->run() && $post['member_id'])
		{
			if(isset($post['activity_id']))
			{
				$temp['activity_time'] = $post['activity_time'];
				$temp['activity_name'] = $post['activity_name'];
				$temp['activity_amount'] = $post['activity_amount'];
				$temp['activity_trades'] = $post['activity_trades'];
				$temp['activity_result'] = $post['activity_result'];
				
				$this->member_activity_model->save(array('activity_id'=>$post['activity_id']),$temp);
				redirect('manage/authority/activity_iframe/'.$post['member_id']);
			}else
			{
				$this->member_activity_model->save(0,$post);
				redirect('manage/authority/activity_iframe/'.$post['member_id']);
			}
		}else
		{
			$data['row'] = $post;
			if(isset($post['activity_id']))
			{
				return $this->load->view('manage/member_account/edit_activity',$data);
			}else
			{
				return $this->load->view('manage/member_account/activity_iframe',$data);
			}
			
		}
	}
	public function post()
	{
		$post['member_id'] = $this->input->post('member_id',TRUE);
		$activity_id = $this->input->post('activity_id',TRUE);
		if($activity_id)
		{
			$post['activity_id'] = $activity_id;
			$post['updater'] = $this->session->userdata('user_id');
			$post['update_time'] = date('Y-m-d H:i:s');
		}else
		{
			$post['creater'] = $this->session->userdata('user_id');
			$post['create_time'] = date('Y-m-d H:i:s');
			$post['updater'] = $post['creater'];
			$post['update_time'] = $post['create_time'];
		}
		$post['activity_time'] = trim($this->input->post('activity_time',TRUE));
		$post['activity_name'] = trim($this->input->post('activity_name',TRUE));
		$post['activity_amount'] = trim($this->input->post('activity_amount',TRUE));
		$post['activity_trades'] = trim($this->input->post('activity_trades',TRUE));
		$post['activity_result'] = trim($this->input->post('activity_result',TRUE));
		return $post;
	}
}