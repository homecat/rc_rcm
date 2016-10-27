<?php if (!defined('BASEPATH')) exit('No direct access allowed.');

// 销售表现记录
class Member_behave extends MHT_Controller
{
	public function __construct()
	{
    	parent::__construct();
		$this->load->model('manage/member_behave_model');
    }
    public function index($sign = 0,$page = 1, $limit = 20)
    {
	 if ($sign == 0) {
            $search = array(
				'user_status' => '2',
                'sales_man' => '',
                'sales_id' => $this->session->userdata('sales_id'),
				
                'time_start' => date('Y-m-d 00:00:00'),
                'time_end' =>date('Y-m-d 23:59:59')
            );
            $sign = 1;
            $this->session->set_userdata(array('search' => $search));
        }
        if ($this->input->post())
		{
            $search['user_status'] = $this->input->post('user_status', TRUE);
            $search['sales_man'] = $this->input->post('sales_man', TRUE);
            $search['sales_id'] = $this->input->post('sales_id', TRUE);
            $search['time_start'] = $this->input->post('time_start', TRUE);
            $search['time_end'] = $this->input->post('time_end', TRUE);
            $this->session->set_userdata(array('search' => $search));
        } 
        $search = $this->session->userdata('search');
        $data['search'] = $search;
        $data['sign'] = $sign;
        $data['page'] = $page;
        $data['limit'] = abs($limit);
		
		$results = $this->member_behave_model->getBehave($search,$page,$limit);
		
		$total = $results['total'];
		$data['pages'] = manage_pages(site_url('manage/member_behave/index/' . $sign . '/'), $total, $page, $limit);
		$data['result'] = $results['result'];
		
		return $this->load->view('manage/member_behave/list', $data);
    }

}
