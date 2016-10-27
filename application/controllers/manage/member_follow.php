<?php if (!defined('BASEPATH')) exit('No direct access allowed.');

// 客户跟进记录

class Member_follow extends MHT_Controller 
{
    public function index($sign=0,$page=1,$limit=20)
    {
    }
	public function edit_follow($follow_id=0)
	{
		$row = $this->member_follow_model->get_follow_record_row($follow_id);
		if(empty($row)) die("Nothing");
		$data['row'] = $row;
		return $this->load->view('manage/member_follow/edit_follow', $data);
	}
    public function delete($page=1,$id=0)
    {
        $this->member_follow_model->delete($id);
        return redirect(site_url('manage/member_follow/index/'.$page));
    }
	//保存数据但是状态为未保存
	public function save_follow()
	{//echo 1;die;
		$post = $this->post();
		//print_r($post);die;
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
				$post['follow_edit'] = json_encode($old_follow);
				
				//保存来显示修改的数据，json保存旧数据
				$this->member_follow_model->save(array('follow_id'=>$post['follow_id']),$post);
				$update_follow_time = time();
				redirect('manage/authority/follow_iframe/'.$post['member_id'].'/'.$update_follow_time);
			}else
			{
				
				$data['row'] = $this->member_follow_model->get_follow_record_row($post['follow_id']);
				return $this->load->view('manage/member_follow/edit_follow',$data);
			}
		}else
		{
			if(isset($post['follow_time']))
			{
				//echo 1;die;
				$this->member_follow_model->save(0,$post);
				$update_follow_time = time();
				redirect('manage/authority/follow_iframe/'.$post['member_id'].'/'.$update_follow_time);
			}else
			{
				$data['row']['member_id'] = $post['member_id'];
				return $this->load->view('manage/member_account/follow_iframe',$data);
			}
		}
	}
	public function post()
	{
		$this->form_validation->set_rules_new('follow_time', 'required');
		$this->form_validation->set_rules_new('follow_type', 'required');
		$this->form_validation->set_rules_new('follow_info', 'required');
		$post['member_id'] = $this->input->post('member_id',TRUE);
		$post['follower'] = $this->session->userdata('user_id');
		$follow_id = $this->input->post('follow_id',TRUE);
		if($follow_id)
		{
			$post['follow_id'] = $follow_id;
		}
		if(TRUE === $this->form_validation->run())
		{
			$post['follow_time'] = trim($this->input->post('follow_time',TRUE));
			$post['follow_type'] = trim($this->input->post('follow_type',TRUE));
			$post['follow_info'] = trim($this->input->post('follow_info',TRUE));
		}
		return $post;
	}
}