<?php if (!defined('BASEPATH')) exit('No direct access allowed.');


// 客户状态修改


class Member_status extends MHT_Controller 
{


    public function index($sign=0,$page=1,$limit=20)
    {
        if( $sign==0 )
        {
            $search = array(
                'member_id'  => '',
                'member_name'  => '',
                'member_status'  => '',
                'creater'  => '',
                'time_start' => '',
                'time_end' => ''
            );
            $sign = 1;
            $this->session->set_userdata(array('search'=>$search));
        }
        if($this->input->post()){

            $search['member_name']  = $this->input->post('member_name',TRUE);
            if($search['member_name']) $search['member_id'] = $this->member_account_model->member_ids($search['member_name']);
            $search['member_status']  = $this->input->post('member_status',TRUE);
            $search['creater']  = $this->input->post('creater',TRUE);
            $search['time_start']  = $this->input->post('time_start',TRUE);
            $search['time_end']  = $this->input->post('time_end',TRUE);

            $this->session->set_userdata(array('search'=>$search));
        }

        $search = $this->session->userdata('search');
        $data['search'] = $search;
        $data['sign'] = $sign;
        $data['page'] = $page;
        $data['limit'] = abs($limit);

        // 搜索条件
        $this->db->start_cache();
        if($search['member_id']){
            $this->db->where_in('a.member_id',$search['member_id']);
        }
        if($search['member_status']) $this->db->where('a.member_status',$search['member_status']);
        if($search['creater']) $this->db->where('a.creater',$search['creater']);

        if($search['time_start']) $this->db->where('a.create_time >=',$search['time_start']);
        if($search['time_end']) $this->db->where('a.create_time <=',$search['time_end']);
        $this->db->stop_cache();

        if($sign < 2)
        {
            // 列表数据
//            $total = $this->db->get('member_status')->num_rows();
            $total = $this->member_status_model->get_total();
            $data['pages'] = manage_pages(site_url('manage/member_status/index/'.$sign.'/'),$total,$page,$limit);

            $this->db->order_by('create_time','desc')->limit($limit,abs($page-1)*$limit);
//            $data['result'] = $this->db->get('member_status')->result_array();
            $data['result'] = $this->member_status_model->get_list();
            $this->db->flush_cache();

            return $this->load->view('manage/member_status/list',$data);

        }else{

            // 导出数据
            $title = 'member_status';
            $lang=$this->session->userdata('lang');
            $content = '<tr>';
            $content .= '<td>客户姓名</td>';
            $content .= '<td>状态记录</td>';
            $content .= '<td>创建人</td>';
            $content .= '<td>创建时间</td>';
            $content .= '</tr>';

//            $query = $this->db->get('member_status');
//            $result = $query->result_array();
            $result = $this->member_status_model->get_list();
            foreach($result as $item)
            {
                $content .= '<tr>';
                $content .= '<td>'.$this->member_account_model->member_name($item['member_id']).'</td>';
                $content .= '<td>'.$item['member_status'].'</td>';
                $content .= '<td>'.$item['creater'].'</td>';
                $content .= '<td>'.$item['create_time'].'</td>';
                $content .= '</tr>';
            }
            $this->load->helper('excel_helper');
            createExcel($title,$content);
        }
    }


	public function delete($page=1,$id=0)
	{
		$this->member_status_model->delete($id);
		return redirect(site_url('manage/member_status/index/'.$page));
	}
}