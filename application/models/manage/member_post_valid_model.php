<?php 
class Member_post_valid_model extends  Status_base_model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'member_account';
		$this->load->helper(array('form', 'url'));
  		$this->load->library('form_validation');
	}
	
	
	public function valid( $member_id = 0 , $member_post = array() ){
		$this->form_validation->set_message('required', ' %s必填 ');
		$this->form_validation->set_message('min_length', ' %s长度不够 ');
		$this->form_validation->set_message('max_length', ' %s超出长度 ');
		$this->form_validation->set_message('alpha_slash', ' %s含非法字符 ');
		$this->form_validation->set_message('numeric', ' %s含非法字符 ');
		//添加
        $this->form_validation->set_rules('member_name','姓名','required|max_length[32]');
        $this->form_validation->set_rules('member_qq','QQ1','min_length[5]|max_length[11]|numeric');
        $this->form_validation->set_rules('member_qq2','QQ2','min_length[5]|max_length[11]|numeric');
        $this->form_validation->set_rules('member_phone','手机号码1','min_length[11]|max_length[11]|numeric');
        $this->form_validation->set_rules('member_phone2','手机号码2','min_length[11]|max_length[11]|numeric');
        $this->form_validation->set_rules('member_status','状态','required|max_length[32]');
        $this->form_validation->set_rules('member_from','来源','required');
        $this->form_validation->set_rules('demo_account','模拟账户','alpha_slash|max_length[32]');
        $this->form_validation->set_rules('member_info','描述11111','required');
        return $this->form_validation->run();
	}

}