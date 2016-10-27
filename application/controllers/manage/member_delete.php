<?php if (!defined('BASEPATH')) exit('No direct access allowed.');

class Member_delete extends MHT_Controller 
{
	/* 页面分辨码code
		1100=数据不存在
		1000=操作成功
		1200=操作失败
	*/
    public function index($code=NULL,$member_id=NULL)
    {
		$search_data = $this->search();
		$data['code'] = $search_data['code'];
		$data['search'] = $search_data['search'];
		$data['row'] = $search_data['row'];
		
		if($member_id) $data['search']['member_id'] = $member_id;
		if($code) $data['code'] = $code;
        return $this->load->view('manage/member_edits/delete',$data);
    }
	public function search()
	{
		$search = array(
			'member_id' => ''
        );
		//定义一条数据
		$member_row = array();
        $search_data['code'] = 0;
        $search_data['row'] = array();
		if($this->input->post())
		{
            $search['member_id'] = $this->input->post('search_member_id',TRUE);
			$this->db->where('member_id', $search['member_id']);
			$member_row = $this->member_account_model->get_row();
			if(empty($member_row))
			{
				$search_data['code'] = 1100;
			}
        }
		$search_data['search'] = $search;
		$search_data['row'] = $member_row;
		return $search_data;
	}
    //编辑数据
    public function submit($member_id='')
    {
        $row = $this->member_account_model->get_row(array('member_id' => $member_id));
        if(empty($row)){
            return redirect(site_url('manage/member_delete/index').'/1100'.'/'.$member_id);
        }
		if($this->member_account_model->delete(array('member_id'=>$member_id)))
		{
			return redirect(site_url('manage/member_delete/index').'/1000'.'/'.$member_id);
		}
		
        return redirect(site_url('manage/member_delete/index').'/1200'.'/'.$member_id);
    }
}