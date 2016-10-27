<?php if (!defined('BASEPATH')) exit('No direct access allowed.');


// 修改密码


class User_pwd extends MHT_Controller 
{
	

	public function index()
	{
		$user_id = $this->session->userdata('user_id');
		$data['row'] = $this->user_list_model->get_row($user_id);
		if(empty($data['row'])){
			return redirect(site_url('manage/login/out'));
		}
		
		$this->form_validation->set_rules_new('password_new','required|matches[password_cfm]');
		$this->form_validation->set_rules_new('password_cfm','required');
		$this->form_validation->set_rules_new('password_old','required');
		if($this->form_validation->run()==FALSE){
			$data['code'] = NULL;
			return $this->load->view('manage/user_pwd/index',$data);
		}
		
		$old = $this->input->post('password_old',TRUE);
		$new = $this->input->post('password_new',TRUE);
		$total = $this->user_list_model->get_total(array('user_id'=>$user_id,'user_password'=>md5($old)));
		if($total==0){
			$data['code'] = 10001;
			return $this->load->view('manage/user_pwd/index',$data);
		}
		$data['code'] = 9000;
		$this->user_list_model->save($user_id,array('user_password'=>md5($new)));
		return $this->load->view('manage/user_pwd/index',$data);
	}
	
	
	
	

}
