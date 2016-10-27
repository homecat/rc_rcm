<?php if (!defined('BASEPATH')) exit('No direct access allowed.');


// 系统管理 - 用户管理组


class Member_sales extends MHT_Controller 
{
	public function index()
	{
		$data['result'] = $this->member_sales_model->get_list();
		$this->load->view('manage/member_sales/list',$data);	
	}
	
	public function add($pid=0)
	{
		if($this->check_data() == FALSE){
			return $this->load->view('manage/member_sales/add');
		}
		$this->member_sales_model->save(0,$this->input_data());
		return redirect(site_url('manage/member_sales/index'));
	}
	
	public function edit($id=1)
	{
		$row = $this->member_sales_model->get_row($id);//print_r($row);die;
		if(empty($row)){
			return redirect(site_url('manage/member_sales/index'));
		}
		if($this->check_data($id) == FALSE){
			$data['row'] = $row;
			return $this->load->view('manage/member_sales/edit',$data);
		}
		$this->member_sales_model->save($id,$this->input_data());
		return redirect(site_url('manage/member_sales/index'));
	}
	
	public function delete($id=1)
	{	
		$this->member_sales_model->delete($id);
		return redirect(site_url('manage/member_sales/index'));
	}
	// 成员列表
	public function item($pid=0)
	{
		$data['pid'] = $pid;
		$data['prow'] = $this->member_sales_model->get_row($pid);
		$data['result'] = $this->member_sales_model->get_list(array('sales_pid'=>$pid));
		return $this->load->view('manage/member_sales/item',$data);
	}
	//-------------------------------------------------------------------------------------------//
	private function check_data()
	{
		$this->form_validation->set_rules_new('sales_pid','required|integer');
		$this->form_validation->set_rules_new('sales_name','required');
		return $this->form_validation->run();
	}
	
	private function input_data()
	{
		$data['sales_pid']  = $this->input->post('sales_pid',TRUE);
		$data['sales_name']  = $this->input->post('sales_name',TRUE);
		//$data['sales_lead']  = $this->input->post('sales_lead',TRUE);
		$data['sales_info']  = $this->input->post('sales_info',TRUE);
		$data['update_time']  = date('Y-m-d H:i:s');
		return $data;
	}
}