<?php if (!defined('BASEPATH')) exit('No direct access allowed.');


// 导出客户资料导出

class Member_alldata extends MHT_Controller 
{
    public function index()
    {
    		$search = array(
    				'time_start' => '',
    				'time_end' => '',
    				'member_status' => ''
    		);
    		$this->session->set_userdata(array('search'=>$search));
    		
	    	if($this->input->post())
	    	{
	    		$search['member_status'] = $this->input->post('member_status', TRUE);
	    		$search['time_start']  = $this->input->post('time_start',TRUE);
	    		$search['time_end']  = $this->input->post('time_end',TRUE);
	    		$this->session->set_userdata(array('search'=>$search));
	    	}
	    	$search = $this->session->userdata('search');
	    	
	    	$data['search'] = $search;
		    if($search['time_start'] && $search['time_end'])
			{
	            // 导出跟进记录数据
	            $title = 'member_account';
	            $lang=$this->session->userdata('lang');
	            $content = '<tr>';
	            $content .= '<td>ID</td>';
	            $content .= '<td>姓名</td>';
	            $content .= '<td>手机-1</td>';
	            $content .= '<td>手机-2</td>';
				$content .= '<td>状态</td>';
	            $content .= '<td>来源</td>';
	            $content .= '<td>渠道</td>';
	            $content .= '<td>负责人</td>';
	            $content .= '<td>创建日期</td>';
	            $content .= '<td>最后修改时间</td>';
	            $content .= '</tr>';
				// 搜索条件
				$param = array();
				$param['create_time >='] = $search['time_start'];
				$param['create_time <='] = $search['time_end'];
				if($search['member_status']){
		    		switch ($search['member_status']){
		    			case 'S1-S5':
		    				$status = array( 'Stage1' , 'Stage2' , 'Stage3' , 'Stage4' , 'Stage5' );
		    				$this->db->where_in( 'member_status' , $status );
		    				break;
		    			case 'S1-S4':
		    				$status = array( 'Stage1' , 'Stage2' , 'Stage3' , 'Stage4' );
		    				$this->db->where_in( 'member_status' , $status );
		    				break;
		    			default:
		    				$this->db->where( 'member_status' , $search['member_status'] );
		    				break;
		    		}
		    	}
		       
	            $result = $this->member_account_model->get_list($param);
				if(count($result))
				{
					foreach($result as $item)
					{
						$content .= '<tr>';
						$content .= '<td>'.$item['member_id'].'</td>';
		    			$content .= '<td>'.$item['member_name'].'</td>';
		    			$content .= '<td>'.$item['member_phone'].'</td>';
		    			$content .= '<td>'.$item['member_phone2'].'</td>';
		    			$content .= '<td>'.$item['member_status'].'</td>';
		    			$content .= '<td>'.$item['member_from'].'</td>';
		    			$content .= '<td>'.$item['channel'].'</td>';
						$content .= '<td>'.$this->user_list_model->get_usernamne($item['sales_man']).'</td>';
						$content .= '<td style="vnd.ms-excel.numberformat:yyyy-mm-dd hh:mm:ss">'.$item['create_time'].'</td>';
						$content .= '<td style="vnd.ms-excel.numberformat:yyyy-mm-dd hh:mm:ss">'.$item['update_time'].'</td>';
						$content .= '</tr>';
					}
					$this->load->helper('excel_helper');
					createExcel($title,$content);
					return;
				}

            }
			return $this->load->view('manage/member_export/index3',$data);
	  }
}