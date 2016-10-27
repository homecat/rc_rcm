<?php if (!defined('BASEPATH')) exit('No direct access allowed.');
class Memo extends MHT_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('manage/memo_model');
		$this->table = 'memo';
	}
	public function index( $page = 1 , $limit = 20 )
	{
		$search = array(
			'title'  => '',
			'time_start' => '',
			'time_end' => ''
		);
		$this->session->set_userdata(array('search'=>$search));
		if($this->input->post()){
			$search['title']       = $this->input->post('title',TRUE);
			$search['time_start']  = $this->input->post('time_start',TRUE);
			$search['time_end']    = $this->input->post('time_end',TRUE);
			$this->session->set_userdata(array('search'=>$search));
		}
		$search = $this->session->userdata('search');		
		//搜索条件
		$this->db->start_cache();
		if($search['title']) $this->db->where('title',$search['title']);
		if($search['time_start']) $this->db->where('dateandtime >=',$search['time_start']);
		if($search['time_end']) $this->db->where('dateandtime <=',$search['time_end']);
		$this->db->stop_cache();
		//分页查询
		$user_id = $this->session->userdata('user_id');
		$result  = array();
		$result  = $this->memo_model->displayMemo( $page , $limit , $user_id );
		$data['search'] = $search;
		$data['page']   = $page;
		$data['limit']  = abs($limit);
		$data['pages']  = manage_pages(site_url('manage/memo/index/'),$result['total'] , $page , $limit );
		$data['result'] = $result['list'];
		return $this->load->view( 'manage/memo/list', $data );
	}
	
	public function save($id='')
	{
		$user_id   = $this->session->userdata('user_id');
		$title     = $this->input->post('title' , TRUE);
		$content   = $this->input->post('content' , TRUE);
		$id        = $this->input->post('id',TRUE);
		if($id){
			if($content && $title){
				$this->memo_model->update_text($id,$title,$content);
			}
			return redirect(site_url('manage/memo'));
		}else{
			if($content && $title){
				$this->memo_model->add_text($title,$content,$user_id);
				return redirect(site_url('manage/memo'));
			}
			$this->load->view('manage/memo/add');
		}
	}
	public function edit($id)
	{
        $data['result']=$this->memo_model->get_text($id);
		$this->load->view('manage/memo/edit',$data);
	}
	
	public function delete($id)
	{
        $this->memo_model->delete_text($id);
        return redirect(site_url('manage/memo'));
	}
	
}