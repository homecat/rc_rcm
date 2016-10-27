<?php if (!defined('BASEPATH')) exit('No direct access allowed.');


// 客户资料导出

class Member_export2 extends MHT_Controller 
{
	public function __construct(){
		
		parent::__construct();
    	$this->load->model('manage/Member_export2_model'); 
    	$this->Member_export2_model->setTime_start($this->input->post('time_start',TRUE));
    	$this->Member_export2_model->setTime_end($this->input->post('time_end',TRUE));
    	$this->Member_export2_model->setMember_status($this->input->post('member_status',TRUE));
    	$this->Member_export2_model->setSales_man($this->input->post('sales_man',TRUE));
    	$this->Member_export2_model->setMember_from($this->input->post('member_from',TRUE));
	}
	
    public function index()
    {
    	$search = array(
    			'time_start' => '',
    			'time_end' => '',
      			'sales_man' => '',         
    			'member_status'=>'', 
    			'member_from'=>'',
    	);
    	
    	$this->session->set_userdata(array('search'=>$search));
    	if($this->input->post())
    	{
       	    $search['member_status'] = $this->input->post('member_status', TRUE);    
     		$search['sales_man'] = $this->input->post('sales_man', TRUE);            
    		$search['time_start']  = $this->input->post('time_start',TRUE);
    		$search['time_end']  = $this->input->post('time_end',TRUE);
    		$search['member_from'] = $this->input->post('member_from', TRUE);
    		
    		$this->session->set_userdata(array('search'=>$search));
    	}
    	$search = $this->session->userdata('search');
    	$data['search'] = $search;
    	return $this->load->view('manage/member_export/index2',$data); 
    }
    
    public function crm(){
    	return $this->Member_export2_model->get_member_account(1);
    }
    
    public function bycreated(){
    	return $this->Member_export2_model->get_member_account(2);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
}