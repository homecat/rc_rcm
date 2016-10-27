<?php if (!defined('BASEPATH')) exit('No direct access allowed.');

// 参数配置
class Member_params extends MHT_Controller 
{
    public function index($page=1)
    {
        $data['page'] = abs($page);
        $total = $this->member_params_model->get_total();
        $data['pages'] = manage_pages(site_url('manage/member_params/index'),$total,$data['page']);
        $data['result'] = $this->member_params_model->get_list(array('asc'=>'parm_type','desc'=>'parm_time'),$page);
        return $this->load->view('manage/member_params/list',$data);
    }
    // 添加数据
    public function add()
	{
		$data = $this->check_input();
		if($data['code']===TRUE){
			$this->member_params_model->save(0,$this->input_data());
			return redirect(site_url('manage/member_params/index/'));
		}
		return $this->load->view('manage/member_params/add',$data);
	}
	//编辑数据
	public function edit($page=1,$parm_id=0)
	{
		$row = $this->member_params_model->get_row($parm_id);
		if(empty($row)){
			return redirect(site_url('manage/member_params/index'));
		}
		$data = $this->check_input($parm_id);
		if($data['code']===TRUE){
			$this->member_params_model->save($parm_id,$this->input_data($parm_id));
			return redirect(site_url('manage/member_params/index/'.$page));
		}
		$data['row'] = $row;
		$data['page'] = $page;
		return $this->load->view('manage/member_params/edit',$data);
	}
    // 删除数据
    public function delete($page=1,$parm_id=0)
    {
        $this->member_params_model->delete($parm_id);
        return redirect(site_url('manage/member_params/index/'.$page));
    }

    private function check_input($parm_id='')
    {
        $this->form_validation->set_rules_new('parm_type','required');
		$this->form_validation->set_rules_new('parm_sort','required');
        $this->form_validation->set_rules_new('parm_name','required');
        $this->form_validation->set_rules_new('parm_info','required');

        if($this->form_validation->run()==FALSE){
            $data['code'] = NULL;
            return $data;
        }

        $parm_type = $this->input->post('parm_type',TRUE);
        $parm_name = $this->input->post('parm_name',TRUE);
        if($parm_id == '') $total = $this->member_params_model->get_total(array('parm_type'=>$parm_type,'parm_name'=>$parm_name));
        if($parm_id != '') $total = $this->member_params_model->get_total(array('parm_id !='=>$parm_id,'parm_type'=>$parm_type,'parm_name'=>$parm_name));

        if($total>0){
            $data['code'] = 10001;
            return $data;
        }
        $data['code'] = TRUE;
        return $data;
    }
	
	private function input_data($parm_id=NULL)
	{
		$data['parm_type']  = $this->input->post('parm_type',TRUE);
		$data['parm_sort']  = $this->input->post('parm_sort',TRUE);
		$data['parm_name']  = $this->input->post('parm_name',TRUE);
        $data['parm_info']  = $this->input->post('parm_info',TRUE);
		
		if(! $parm_id) $data['parm_time'] = date('Y-m-d H:i:s');
		return $data;
	}
}