<?php if (!defined('BASEPATH')) exit('No direct access allowed.');


// 系统管理 - 用户管理
class User_list extends MHT_Controller 
{
	public function __construct()
	{
    	parent::__construct();
		$this->config->load('permissions');
    }
	private function list_limits()
	{
		
	}
	// 列表数据
	public function index($page=1,$limit=0,$change=0)
	{
		$data['page'] = abs($page);
		if($change)$data['page']=$page=1;
		$total = $this->user_list_model->get_total();
		$data['pages'] = manage_pages(site_url('manage/user_list/index'),$total,$data['page'],$limit);
		$data['result'] = $this->user_list_model->get_list(array('asc'=>'user_limits'),$page,$limit);
		$data['list_limits'] = $this->user_list_model->list_limits();
		$data['limit']=$limit;
		$this->load->view('manage/user_list/list',$data);
	}
	// 添加数据
	public function add()
	{
		
		if($this->check_data() == FALSE){
			$data['manage'] = $this->config->item('manage');
			//print_r($data['manage']);die;
			$data['list_limits'] = $this->user_list_model->list_limits();
			return $this->load->view('manage/user_list/add',$data);
		}
		$this->user_list_model->save(0,$this->input_data());
		return redirect(site_url('manage/user_list/index'));
	}
	//修改数据
	public function edit($page=1,$id=1)
	{
		$row = $this->user_list_model->get_row($id);
		
		if(empty($row)){
			return redirect(site_url('manage/user_list/index'));
		}
		if($this->check_data($id) == FALSE){
			//echo 1;
			$data['row'] = $row;
			$data['page'] = $page;
			$data['manage_perms'] = $this->config->item('manage');
			$data['manage_limits'] = $this->session->userdata('user_limits');
			$data['list_limits'] = $this->user_list_model->list_limits();
			return $this->load->view('manage/user_list/edit',$data);
		}
		$this->user_list_model->save($id,$this->input_data($id));
		//print_r($this->input_data());die;
		return redirect(site_url('manage/user_list/index/'.$page));	
	}
	// 删除数据
	public function delete($page=1,$id=1)
	{	
		$this->user_list_model->delete($id);
		return redirect(site_url('manage/user_list/index/'.$page));		
	}
	//-------------------------------------------------------------------------------------------//
	private function check_data($id=0)
	{
		$this->form_validation->set_rules_new('sales_id','required|integer');
		$this->form_validation->set_rules_new('user_name','required|alpha');
		$this->form_validation->set_rules_new('user_limits','required|integer');
		$this->form_validation->set_rules_new('user_status','required|integer');
		if($id==0){
			$this->form_validation->set_rules_new('user_password','required|matches[user_passwordf]');
			$this->form_validation->set_rules_new('user_passwordf','required');
		}else{
			$this->form_validation->set_rules_new('user_password','matches[user_passwordf]');
		}
		return $this->form_validation->run();
	}
	private function input_data($id=0)
	{
		$data['sales_id']  = $this->input->post('sales_id',TRUE);
		$data['user_name']  = $this->input->post('user_name',TRUE);
		$data['user_info']  = $this->input->post('user_info',TRUE);
		$data['user_limits']  = $this->input->post('user_limits',TRUE);
		$data['user_status']  = $this->input->post('user_status',TRUE);
		$user_password = $this->input->post('user_password',TRUE);
		if($user_password)$data['user_password'] = md5($user_password);
		
		$user_permissions = array();
		$user_manage = $this->input->post('user_manage',TRUE);
		//print_r($user_manage);
		foreach($user_manage as $k)
		{
			/*if($k==json_encode(array('authority/follow_iframe')))
			{
				$user_manage[]=json_encode(array('member_follow'));	
			}*/
			if($k==json_encode(array('authority/analyst')))
			{
				$user_manage[]=json_encode(array('authority/analyst_add'));
				$user_manage[]=json_encode(array('authority/edit_follow'));
				$user_manage[]=json_encode(array('authority/save_follow'));
				$user_manage[]=json_encode(array('authority/confirm'));
			}
			
			if($k==json_encode(array('authority/trade_habit')))
			{
				$user_manage[]=json_encode(array('authority/trade_sub'));
				/*$user_manage[]=array('authority/edit_follow');
				$user_manage[]=array('authority/save_follow');
				$user_manage[]=array('authority/confirm');*/
			}
			if($k==json_encode(array('authority/activity_iframe')))
			{
				$user_manage[]=json_encode(array('member_activity/save'));
				$user_manage[]=json_encode(array('member_activity/edit'));
			
			}
			
		}
		//print_r($user_manage);die;
		foreach($user_manage as $item){$user_permissions[] = (array)json_decode(stripslashes($item),TRUE);}
		$data['user_permissions'] = json_encode($user_permissions,TRUE);
		return $data;
	}
}