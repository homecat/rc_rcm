<?php if (!defined('BASEPATH')) exit('No direct access allowed.');


// 客户资料导出

class Member_export extends MHT_Controller 
{
    public function index($sign=0)
    {
        if( $sign==0 )
        {
            $search = array(
                'time_start' => '',
                'time_end' => ''
            );
            $sign = 1;
            $this->session->set_userdata(array('search'=>$search));

        }
        if($this->input->post())
		{
            $search['time_start']  = $this->input->post('time_start',TRUE);
            $search['time_end']  = $this->input->post('time_end',TRUE);
            $this->session->set_userdata(array('search'=>$search));
        }
        $search = $this->session->userdata('search');
        $data['search'] = $search;
        
		if($sign == 2 && $search['time_start'] && $search['time_end'])
		{
            // 导出跟进记录数据
            $title = 'member_follow_info';
            $lang=$this->session->userdata('lang');
            $content = '<tr>';
            $content .= '<td>ID</td>';
            $content .= '<td>日期及时间</td>';
            $content .= '<td>姓名</td>';
            $content .= '<td>MT4账号</td>';
			$content .= '<td>RC账号</td>';
            $content .= '<td>账号类别</td>';
            $content .= '<td>跟进类型</td>';
            $content .= '<td>跟进人</td>';
            $content .= '<td>跟进信息</td>';
            $content .= '</tr>';
			
			// 搜索条件
			$param = array();
			$this->db->start_cache();
			if($search['time_start'] && $search['time_end'])
			{
				$param['follow_time >= '] = $search['time_start'];
				$param['follow_time <= '] = $search['time_end'];
				$param['DESC'] = 'follow_time';
			}
			$this->db->stop_cache();
			$this->db->select('b.member_name,b.real_account,b.account_type,b.rc_real_account,a.*');
// 			$this->db->where('a.follow_flag',NULL);
            $result = $this->member_follow_model->get_list($param);
			if(count($result))
			{
				foreach($result as $item)
				{
					$content .= '<tr>';
					$content .= '<td>'.$item['member_id'].'</td>';
					$content .= '<td style="vnd.ms-excel.numberformat:yyyy-mm-dd hh:mm:ss">'.$item['follow_time'].'</td>';
					$content .= '<td>'.$item['member_name'].'</td>';
					$content .= '<td style="vnd.ms-excel.numberformat:#">'.$item['real_account'].'</td>';
					$content .= '<td>'.$item['rc_real_account'].'</td>';
					$content .= '<td>'.$item['account_type'].'</td>';
					$content .= '<td>'.$item['follow_type'].'</td>';
					$content .= '<td>'.$this->user_list_model->getUserGlobal($item['follower']).'</td>';
					$content .= '<td>'.$item['follow_info'].'</td>';
					$content .= '</tr>';
				}
				$this->load->helper('excel_helper');
				createExcel($title,$content);
				return;
			}
        }else if($sign == 3 && $search['time_start'] && $search['time_end'])
		{
			// 导出真实账户数据
            $title = 'member_account';
            $lang=$this->session->userdata('lang');
            $content = '<tr>';
            $content .= '<td>ID</td>';
            $content .= '<td>MT4账号</td>';
			$content .= '<td>RC账号</td>';
            $content .= '<td>MGM</td>';
            $content .= '<td>账号类别</td>';
            $content .= '<td>开户人</td>';
            $content .= '<td>负责人</td>';
            $content .= '<td>开户时间</td>';
            $content .= '</tr>';
			
			$param = array();
			$param['open_time >='] = $search['time_start'];
			$param['open_time <='] = $search['time_end'];
            $result = $this->member_account_model->get_list($param);
			if(count($result))
			{
				foreach($result as $item)
				{
					$content .= '<tr>';
					$content .= '<td style="vnd.ms-excel.numberformat:#">'.$item['member_id'].'</td>';
					$content .= '<td style="vnd.ms-excel.numberformat:#">'.$item['real_account'].'</td>';
					$content .= '<td>'.$item['rc_real_account'].'</td>';
					$content .= '<td>'.$item['member_MGM'].'</td>';
					$content .= '<td>'.$item['account_type'].'</td>';
					$content .= '<td>'.$this->user_list_model->getUserGlobal($item['member_opener']).'</td>';
					$content .= '<td>'.$this->user_list_model->getUserGlobal($item['sales_man']).'</td>';
					$content .= '<td style="vnd.ms-excel.numberformat:yyyy-mm-dd hh:mm:ss">'.$item['open_time'].'</td>';
					$content .= '</tr>';
				}
				$this->load->helper('excel_helper');
				createExcel($title,$content);
				return;
			}
		}elseif($sign == 4 && $search['time_start'] && $search['time_end'])
		{
			// 导出电销跟进记录
            $title = 'member_call_time_record';
            $lang=$this->session->userdata('lang');
            $content = '<tr>';
            $content .= '<td>ID</td>';
            $content .= '<td>建立时间</td>';
            $content .= '<td>姓名</td>';
            $content .= '<td>状态</td>';
            $content .= '<td>MT4账号</td>';
			$content .= '<td>RC账号</td>';
            $content .= '<td>账户类别</td>';
            $content .= '<td>跟进记录时间</td>';
            $content .= '<td>跟进类型</td>';
            $content .= '<td>跟进人</td>';
            $content .= '<td>跟进信息</td>';
            $content .= '<td>电销预约日期</td>';
            $content .= '<td>文销预约日期</td>';
            $content .= '</tr>';
			
			 // 搜索条件
			$this->db->where('a.follow_time >=',$search['time_start']);
			$this->db->where('a.follow_time <=',$search['time_end']);
			$this->db->order_by('b.member_id','DESC');
			$this->db->order_by('a.follow_time','DESC');
			$this->db->select('b.member_id,b.create_time,b.member_name,b.member_status,b.real_account,b.account_type,b.call_start_time as call_time,b.wen_order_time as wen_time,b.rc_real_account,a.*');
            $result = $this->member_follow_model->get_list();
			if(count($result))
			{
				foreach($result as $item)
				{
					$content .= '<tr>';
					$content .= '<td style="vnd.ms-excel.numberformat:#">'.$item['member_id'].'</td>';
					$content .= '<td style="vnd.ms-excel.numberformat:yyyy-mm-dd hh:mm:ss">'.$item['create_time'].'</td>';
					$content .= '<td>'.$item['member_name'].'</td>';
					$content .= '<td>'.$item['member_status'].'</td>';
					$content .= '<td style="vnd.ms-excel.numberformat:#">'.$item['real_account'].'</td>';
					$content .= '<td>'.$item['rc_real_account'].'</td>';
					$content .= '<td>'.$item['account_type'].'</td>';
					$content .= '<td style="vnd.ms-excel.numberformat:yyyy-mm-dd hh:mm:ss">'.$item['follow_time'].'</td>';
					$content .= '<td>'.$item['follow_type'].'</td>';
					$content .= '<td>'.$this->user_list_model->getUserGlobal($item['follower']).'</td>';
					$content .= '<td>'.$item['follow_info'].'</td>';
					$content .= '<td style="vnd.ms-excel.numberformat:yyyy-mm-dd hh:mm:ss">'.$item['call_time'].'</td>';
					$content .= '<td style="vnd.ms-excel.numberformat:yyyy-mm-dd hh:mm:ss">'.$item['wen_time'].'</td>';
					$content .= '</tr>';
				}
				$this->load->helper('excel_helper');
				createExcel($title,$content);
				return;
			}
		}elseif($sign == 5 && $search['time_start'] && $search['time_end'])
		{
			// 导出升降级记录
            $title = 'member_grade_record';
            $lang=$this->session->userdata('lang');
            $content = '<tr><td>ID</td><td>MT4账号</td><td>RC账号</td><td>当前账户类别</td><td>负责同事</td><td>升降级时间</td><td>升降/降级</td><td>账户类别</td><td>升降级负责同事</td></tr>';
			 // 搜索条件
			$this->db->where('a.create_time >=',$search['time_start']);
			$this->db->where('a.create_time <=',$search['time_end']);
			$this->db->start_cache();
			$this->db->order_by('a.create_time','DESC');
			$this->db->select("a.member_id as amember_id,b.sales_man as bsales_man,b.real_account as real_account,b.account_type as baccount_type,b.rc_real_account as rc_real_account,a.sales_man as asales_man,a.account_type as aaccount_type,a.create_time,a.grade_id,a.grade_status");
			$this->db->from('member_grade as a');
			$this->db->join('member_account as b' , 'a.member_id = b.member_id' , 'left');
			$this->db->stop_cache();
			$grade_records = $this->member_grade_model->get_grade_records();
			$this->db->flush_cache();
			if($grade_records)
			{
				foreach($grade_records as $item)
				{
					if($item['grade_status'] != 0){
						$content .= '<tr><td style="vnd.ms-excel.numberformat:#">'.$item['amember_id'].'</td><td style="vnd.ms-excel.numberformat:#">'.$item['real_account'].'</td><td>'.$item['rc_real_account'].'</td><td>'.$item['baccount_type'].'</td><td>'.$this->user_list_model->getUserGlobal($item['bsales_man']).'</td><td style="vnd.ms-excel.numberformat:yyyy-mm-dd hh:mm:ss">'.$item['create_time'].'</td>';
						if($item['grade_status'] == 2){
							$content .= '<td>降级</td>';
						}else{
							$content .= '<td>升级</td>';
						}
						$content .= '<td>'.$item['aaccount_type'].'</td><td>'.$this->user_list_model->getUserGlobal($item['asales_man']).'</td></tr>';
					}
				}
				$this->load->helper('excel_helper');
				createExcel( $title , $content );
				return;
			}
		}elseif($sign == 6 && $search['time_start'] && $search['time_end'])
		{
            // 导出跟进记录数据
            $title = 'member_tarde_follow_info';
            $lang=$this->session->userdata('lang');
            $content = '<tr>';
            $content .= '<td>ID</td>';
            $content .= '<td>MT4账号</td>';
			$content .= '<td>RC账号</td>';
            $content .= '<td>账户类别</td>';
			$content .= '<td>负责同事</td>';
			$content .= '<td>分析师记录时间</td>';
			$content .= '<td>分析师</td>';
            $content .= '<td>分析类型</td>';
            $content .= '<td>跟进信息</td>';
            $content .= '</tr>';
			
			// 搜索条件
			$param = array();
			$this->db->start_cache();
			if($search['time_start'] && $search['time_end'])
			{
				$param['follow_time >= '] = $search['time_start'];
				$param['follow_time <= '] = $search['time_end'];
				$param['DESC'] = 'follow_time';
			}
			$this->db->stop_cache();
			$this->db->select('b.member_name,b.sales_man,b.real_account,b.account_type,b.rc_real_account,a.*');
			$this->db->where('a.follow_flag','analyst');
            $result = $this->member_follow_model->get_list($param);
			$getperson=$this->user_list_model->get_usernamne();
			if(count($result))
			{
				foreach($result as $item)
				{
					$content .= '<tr>';
					$content .= '<td>'.$item['member_id'].'</td>';
					$content .= '<td style="vnd.ms-excel.numberformat:#">'.$item['real_account'].'</td>';
					$content .= '<td>'.$item['rc_real_account'].'</td>';
					$content .= '<td>'.$item['account_type'].'</td>';
					$content .= '<td>'.$this->user_list_model->get_usernamne($item['sales_man']).'</td>';
					$content .= '<td style="vnd.ms-excel.numberformat:yyyy-mm-dd hh:mm:ss">'.$item['follow_time'].'</td>';
					$content .= '<td>'.$this->user_list_model->getUserGlobal($item['follower']).'</td>';	
					$content .= '<td>'.$item['follow_type'].'</td>';
					$content .= '<td>'.$item['follow_info'].'</td>';
					$content .= '</tr>';
				}
				$this->load->helper('excel_helper');
				createExcel($title,$content);
				return;
			}
        }
		return $this->load->view('manage/member_export/index',$data);
    }
}