<?php if (!defined('BASEPATH')) exit('No direct access allowed.');

// 客户资料总览　2016-5-19
class Member_account extends MHT_Controller
{
	public function __construct()
	{
    	parent::__construct();
		$this->load->model('manage/member_behave_model');
    }
    
    public function index($sign = 0, $page = 1, $limit = 20)
    {
        if ($sign == 0) {
            $search = array(
                'member_name'           => '',
                'member_qq'             => '',
                'member_phone'          => '',
                'member_status'         => '',
                'member_from'           => '',
            	'channel'               => '',                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
				'member_id'             => '',
                'sales_man'             => '',
                'sales_id'              => $this->session->userdata('sales_id'),
                'updater'               => '',
                'member_weixin'         => '',
				'order_by'              => 'create_time',
				'order_by_sort'         => 'DESC',
				'expert_qq'             => '',
                'real_account'          => '',
				'rc_real_account'       =>  '',
                'account_type'          =>  '',
                'demo_account'          => '',
				'member_MGM'            => '',
				'qq_addfriend'          => '',
				'weixin_addfriend'      => '',
                'time_type'             => '',
                'time_start'            => '',
                'time_end'              => '',
				'today_call_start_time' => '',
				'today_wen_order_time'  => '',
				'is_upgrade'            => '',
				'is_operation'          => '',
				're_MGM'                => '',
				'is_income'             => ''
            );
            $sign = 1;
            $this->session->set_userdata(array('search' => $search));
        }
        if ($this->input->post()) {
            $search['member_name']   = trim($this->input->post('member_name'    ,   TRUE));
            $search['member_qq']     = trim($this->input->post('member_qq'      ,   TRUE));
            $search['member_phone']  = trim($this->input->post('member_phone'   ,   TRUE));
            $search['member_status'] = $this->input->post('member_status'       ,   TRUE);
            $search['member_from']   = $this->input->post('member_from'         ,   TRUE);
            $search['channel']       = $this->input->post('channel'             ,   TRUE);
            $search['member_id']     = trim($this->input->post('member_id'      ,   TRUE));
            $search['sales_man']     = $this->input->post('sales_man'           ,   TRUE);
            $search['sales_id']      = $this->input->post('sales_id'            ,   TRUE);
            $search['updater']       = $this->input->post('updater'             ,   TRUE);
            $search['member_weixin'] = trim($this->input->post('member_weixin'  ,   TRUE));
            $search['order_by']      = $this->input->post('order_by'            ,   TRUE);
            $search['order_by_sort'] = $this->input->post('order_by_sort'       ,   TRUE);
            $search['expert_qq'] = $this->input->post('expert_qq'               ,   TRUE);
			if(strstr($this->input->post('real_account' , TRUE) , 'R') == false){
            	$search['real_account']      = trim($this->input->post('real_account'     ,  TRUE));
			}else{
				 $search['rc_real_account']  = trim($this->input->post('real_account'     ,  TRUE));
			}
            $search['account_type']          = $this->input->post('account_type'          ,  TRUE);
            $search['demo_account']          = trim($this->input->post('demo_account'     ,  TRUE));
            $search['member_MGM']            = trim($this->input->post('member_MGM'       ,  TRUE));
            $search['qq_addfriend']          = $this->input->post('qq_addfriend'          ,  TRUE);
            $search['weixin_addfriend']      = $this->input->post('weixin_addfriend'      ,  TRUE);
            $search['time_type']             = $this->input->post('time_type'             ,  TRUE);
            $search['time_start']            = $this->input->post('time_start'            ,  TRUE);
            $search['time_end']              = $this->input->post('time_end'              ,  TRUE);
            $search['today_call_start_time'] = $this->input->post('today_call_start_time' ,  TRUE);
            $search['today_wen_order_time']  = $this->input->post('today_wen_order_time'  ,  TRUE);
            $search['is_upgrade']            = $this->input->post('is_upgrade'            ,  TRUE);
            $search['is_operation']          = $this->input->post('is_operation'          ,  TRUE);
            $search['re_MGM']                = $this->input->post('re_MGM'                ,  TRUE);
            $search['is_income']             = $this->input->post('is_income'             ,  TRUE);
            $this->session->set_userdata(array('search' => $search));
        }
        $search = $this->session->userdata('search');
        
        $data['search'] = $search;
        $data['sign']   = $sign;
        $data['page']   = $page;
        $data['limit']  = abs($limit);
        // 搜索条件开始

		$gst = $this->member_behave_model->low_ids($search['sales_id']);
        $this->db->start_cache();
        
		/*-----------------------------------搜索第一行-----------------------------------------------------*/
        if ($search['member_name']) $this->db->where('member_name', $search['member_name']);
		//QQ查询2个
        if ($search['member_qq']){
			$member_qq_where = "(`member_qq`="."'".$search['member_qq']."'"." OR "."`member_qq2`="."'".$search['member_qq']."')";
			$this->db->where($member_qq_where);
		}
		//手机号码查询2个
        if ($search['member_phone']){
			$member_phone_where = "(`member_phone`="."'".$search['member_phone']."'"." OR "."`member_phone2`="."'".$search['member_phone']."')";
			$this->db->where($member_phone_where);
		}
		//状态筛选
		if($search['member_status'] == 'S1-S5'){
			$member_status_where = "(`member_status` = 'Stage1' OR `member_status` = 'Stage2' OR `member_status` = 'Stage3' OR `member_status` = 'Stage4' OR `member_status` = 'Stage5')";
			$this->db->where($member_status_where);
		}
		else if($search['member_status'] == 'S1-S4'){
			$member_status_where = "(`member_status` = 'Stage1' OR `member_status` = 'Stage2' OR `member_status` = 'Stage3' OR `member_status` = 'Stage4')";
			$this->db->where($member_status_where);
		}
		else if($search['member_status'] == 'S2-S4')
		{
			$member_status_where = "(`member_status` = 'Stage2' OR `member_status` = 'Stage3' OR `member_status` = 'Stage4')";
			$this->db->where($member_status_where);
		}
		else if($search['member_status'] == 'S3-S4'){
			$member_status_where = "(`member_status` = 'Stage3' OR `member_status` = 'Stage4')";
			$this->db->where($member_status_where);
		}
		else if($search['member_status']){
			$this->db->where('member_status', $search['member_status']);
		}
		if($search['member_from']) $this->db->where('member_from' , $search['member_from']);
		if($search['member_id'])   $this->db->where('member_id'   , $search['member_id']);
		
		if($search['channel'])     $this->db->where('channel'     , $search['channel']);
		
		
		/*-------------------------------------搜索第二行---------------------------------------------------*/
        if ($search['sales_man'])     $this->db->where('sales_man', $search['sales_man']);
		$this->db->where_in('sales_id',$gst);
        if ($search['updater'])       $this->db->where('updater', $search['updater']);
        if ($search['member_weixin']) $this->db->where('member_weixin', $search['member_weixin']);
		//时间排序类型
		if($search['order_by'] && $search['order_by_sort']){
			$this->db->order_by($search['order_by'], $search['order_by_sort']);
		}else{
			$data['search']['order_by']      = 'create_time';
			$data['search']['order_by_sort'] = 'DESC';
			$this->db->order_by('create_time','DESC');
		}
		//控制error设置结束
		if($search['expert_qq'] == 1){
			$this->db->where('expert_qq_invited' ,  1);
			$this->db->where('expert_qq_added !=' , 1);
		}elseif($search['expert_qq'] == 2){
			$this->db->where('expert_qq_added',1);
		}
		/*-------------------------------------搜索第三行---------------------------------------------------*/
        if ($search['real_account'])    $this->db->where('real_account'    ,   $search['real_account']);
		if ($search['rc_real_account']) $this->db->where('rc_real_account' ,   $search['rc_real_account']);
        if ($search['account_type'])    $this->db->where('account_type'    ,   $search['account_type']);
        if ($search['demo_account'])    $this->db->like('demo_account'     ,   $search['demo_account']);
        if ($search['member_MGM'])      $this->db->where('member_MGM'      ,   $search['member_MGM']);
		//判断未添加qq
		if($search['qq_addfriend']){
			$member_qq_where  = "(`member_qq_addfriend`   = 0 OR `member_qq_addfriend` IS NULL)";
			$this->db->where($member_qq_where);
			$member_qq2_where = "(`member_qq2_addfriend`  = 0 OR `member_qq2_addfriend` IS NULL)";
			$this->db->where($member_qq2_where);
		}
		if($search['is_upgrade']){
			$this->db->where('is_upgrade', $search['is_upgrade']);
		}
		if($search['is_operation']){
			$this->db->where('is_operation', $search['is_operation']);
		}
		/*-------------------------------------搜索第四行---------------------------------------------------*/
		//建立时间
        if ($search['time_type'] == 'create_time'){
            if ($search['time_start']){
				$this->db->where('create_time !=','');
				$this->db->where('create_time >=', $search['time_start']);
			}
            if ($search['time_end']) $this->db->where('create_time <=', $search['time_end']);
        }
		//修改时间
        if ($search['time_type'] == 'update_time'){
            if ($search['time_start']){
				$this->db->where('update_time !=','');
				$this->db->where('update_time >=', $search['time_start']);
			}
            if ($search['time_end']) $this->db->where('update_time <=', $search['time_end']);
        }
		//电销预约
        if ($search['time_type'] == 'call_start_time'){
            if ($search['time_start'])
			{
				$this->db->where('call_start_time !=','');
				$this->db->where('call_start_time >=', $search['time_start']);
			}
            if ($search['time_end']) $this->db->where('call_start_time <=', $search['time_end']);
        }
		//文销预约
        if ($search['time_type'] == 'wen_order_time'){
            if ($search['time_start']){
				$this->db->where('wen_order_time !=','');
				$this->db->where('wen_order_time >=', $search['time_start']);
			}
            if ($search['time_end']) $this->db->where('wen_order_time <=', $search['time_end']);
        }
		//开户时间
        if ($search['time_type'] == 'open_time'){
            if ($search['time_start']){
				$this->db->where('open_time !=','');
				$this->db->where('open_time >=', $search['time_start']);
			}
            if ($search['time_end']) $this->db->where('open_time <=', $search['time_end']);
        }
		//判断未添加微信好友
		if($search['weixin_addfriend']){
			$this->db->where("(`member_weixin_addfriend` = 0 OR `member_weixin_addfriend` IS NULL)");
		}
		//判断是否选择当天电销预约
		if($search['today_call_start_time']       == 1 ){
			$this->db->where('call_start_time >=' , date('Y-m-d 00:00:00'));
			$this->db->where('call_start_time <=' , date('Y-m-d 23:59:59'));
		}else if($search['today_call_start_time'] == 2 ){
			$today_call_start_time_where = "`call_start_time` IS NULL";
			$this->db->where($today_call_start_time_where);
		}else if($search['today_call_start_time'] == 3 ){
			$today_call_start_time_where = "`key_reser_time` IS NOT NULL";
			$this->db->where($today_call_start_time_where);	
		}
		//判断是否选择当天文销预约
		if($search['today_wen_order_time']){
			$this->db->where('wen_order_time >=',date('Y-m-d 00:00:00'));
			$this->db->where('wen_order_time <=',date('Y-m-d 23:59:59'));
		}
		if($search['re_MGM']){
			$this->db->where('re_MGM', $search['re_MGM']);
		}
		if($search['is_income']){
			$this->db->where('is_income', $search['is_income']);
		}
		/*-----------------------------------额外添加搜索要求-----------------------------------*/
		//登陆权限limits=4(文字销售)=5(电话销售)无法查看Dead客户
		$login_user_limits = $this->session->userdata('user_limits');
		if($login_user_limits == 5) $this->db->where('member_status !=' , 'Dead');
		if($login_user_limits == 5) $this->db->where('member_status !=' , 'predead');
		
        $this->db->stop_cache();
		//搜索条件结束
		$total          =  count($this->member_account_model->get_lists());
		$data['pages']  =  manage_pages(site_url('manage/member_account/index/' . $sign . '/'), $total, $page, $limit);
		$data['result'] =  $this->member_account_model->get_lists(array() , $page , $limit);
		$this->db->flush_cache();
		return $this->load->view('manage/member_account/list' , $data);
    }
	//修改提案嵌入
	public function follow_iframe_show($member_id = 0)
	{
		$data['row']['member_id'] = $member_id;
		return $this->load->view('manage/member_account/follow_iframe_show', $data);
	}

    public function edit($page = 1 , $member_id = 0 , $save_boolean = false)
    {
        $row = $this->member_account_model->get_row(array('member_id' => $member_id));
        $post = $this->input->post(null,true);

        if($post){
            print_r($post);exit();
            $status['member_id'] = $member_id;
            $status['member_status'] = $post['member_status'];
            $status['creater'] = $this->session->userdata['user_id'];
            $status['create_time'] = date('Y-m-d H:i:s');
            $this->member_status_model->save(0,$status); // save status
        }



        $data['row'] = $row;
        $data['page'] = $page;
        return $this->load->view('manage/member_account/edit', $data);
    }

    public function add($sign = 0, $page = 1, $limit = 20)
    {
        $now = date('Y-m-d H:i:s');
        $user_id = $this->session->userdata['user_id'];
        $account = $this->input->post(null, true);
        $account['creater']       = $user_id;
        $account['sales_id']      = $this->session->userdata['sales_id'];
        $account['sales_man']     = $user_id;
        $account['create_time']   = $now;

        $this->member_account_model->save(0, $account);
        //存储状态
        if(!empty($account['member_status'])){
            $status['member_status'] = $account['member_status'];
            $status['member_id'] = $this->db->insert_id();
            $status['creater'] = $user_id;
            $status['create_time'] = $now;
            $this->member_status_model->save(0, $status );
        }
        $data['sign']   = $sign;
        $data['page']   = $page;
        $data['limit']  = abs($limit);
        return redirect(site_url('manage/member_account/index/' . $page));
    }

    public function ajax(){
        $msg = '';
        $this->load->model('manage/member_account_check_model');

        $key = $this->input->post('key', true);
        $val = $this->input->post('val', true);
        if($key&&$val){
            $condition = array($key => $val);
            $account = $this->member_account_check_model->get_all($condition);

            for($i = 0; $i < count($account); $i++){
//            if($account[$i][$key] == $val && $account[$i]['member_status'] != 'Dead') $msg = '已存在';
                if($account[$i][$key] == $val) $msg = '已存在';
            }
            $arr = array('msg' => $msg);
            echo json_encode($arr);
        }else{
            echo 'Illegal entry';
        }

    }

    // 删除数据
    public function delete($page = 1, $id = 0)
    {
        $this->member_account_model->delete($id);
        return redirect(site_url('manage/member_account/index/' . $page));
    }
    
    // 编辑输入验证
    private function check_edit_input()
    {
    	$this->form_validation->set_message('required', ' %s必填 ');
    	$this->form_validation->set_message('min_length', '%s长度不够 ');
    	$this->form_validation->set_message('max_length', '%s超出长度 ');
    	$this->form_validation->set_message('alpha_slash', '%s含非法字符 ');
    	$this->form_validation->set_message('numeric', '%s含非法字符');
    	//添加
    	$this->form_validation->set_rules('member_name','姓名','required|max_length[32]');
    	$this->form_validation->set_rules('member_qq','QQ1','min_length[5]|max_length[11]|numeric');
    	$this->form_validation->set_rules('member_qq2','QQ2','min_length[5]|max_length[11]|numeric');
    	$this->form_validation->set_rules('member_phone','手机号码1','min_length[11]|max_length[11]|numeric');
    	$this->form_validation->set_rules('member_phone2','手机号码2','min_length[11]|max_length[11]|numeric');
    	$this->form_validation->set_rules('member_status','状态','required|max_length[32]');
    	$this->form_validation->set_rules('member_from','来源','required');
     	$this->form_validation->set_rules('channel','渠道','required');
    	$this->form_validation->set_rules('demo_account','模拟账户','alpha_slash|max_length[32]');
    	$this->form_validation->set_rules('member_info','描述','required');
    	return $this->form_validation->run();
    }

    private function input_data($member_id = '')
    {
        //通用表单项
        $account['member_name']   = trim($this->input->post('member_name', true));
        $account['member_qq']     = trim($this->input->post('member_qq', true));
        $account['member_phone']  = trim($this->input->post('member_phone', true));
        $account['member_status'] = trim($this->input->post('member_status', true));
        $account['member_from']   = trim($this->input->post('member_from', true));
        $account['member_info']   = trim($this->input->post('member_info', true));
        $account['channel']       = trim($this->input->post('channel', true));
        $account['updater']       = trim($this->session->userdata['user_id']);
        $account['update_time']   = trim(date('Y-m-d H:i:s'));
        if(! $member_id)
        {//添加功能-表单项
            $account['creater'] = $this->session->userdata['user_id'];
            $account['create_time'] = date('Y-m-d H:i:s');
            //额外添加“负责人”、“负责团队”
            $account['sales_id'] = $this->session->userdata['sales_id'];

            $account['sales_man'] = $this->session->userdata['user_id'];
        }else
        {//修改功能-表单项
            $account['member_habit'] = trim($this->input->post('member_habit', true));
            $account['member_qq_addfriend'] = trim($this->input->post('member_qq_addfriend',TRUE));
            if(! $account['member_qq_addfriend']) $account['member_qq_addfriend'] = 0;
            $account['member_qq2'] = trim($this->input->post('member_qq2', true));
            $account['member_qq2_addfriend'] = trim($this->input->post('member_qq2_addfriend',TRUE));
            if(! $account['member_qq2_addfriend']) $account['member_qq2_addfriend'] = 0;
            $account['member_weixin'] = trim($this->input->post('member_weixin',TRUE));
            $account['expert_qq_invited'] = $this->input->post('expert_qq_invited',TRUE);
            if(! $account['expert_qq_invited']) $account['expert_qq_invited'] = 0;
            $account['expert_qq_added'] = $this->input->post('expert_qq_added',TRUE);
            if(! $account['expert_qq_added']) $account['expert_qq_added'] = 0;
            $account['member_weixin_addfriend'] = trim($this->input->post('member_weixin_addfriend',TRUE));
            if(! $account['member_weixin_addfriend']) $account['member_weixin_addfriend'] = 0;
            $account['member_phone2'] = trim($this->input->post('member_phone2',TRUE));
            $account['demo_account'] = trim($this->input->post('demo_account', true));
            $account['call_start_time'] = trim($this->input->post('call_start_time', true));
            $account['wen_order_time'] = trim($this->input->post('wen_order_time', true));
            $account['key_reser_time'] = trim($this->input->post('key_reser_time', true));
            if($account['call_start_time'])
            {
                $account['call_start_time'] = date('Y-m-d H:i:s',strtotime($account['call_start_time']));
            }else
            {
                $account['call_start_time'] = NULL;
            }
            if($account['wen_order_time'])
            {
                $account['wen_order_time'] = date('Y-m-d H:i:s',strtotime($account['wen_order_time']));
            }else
            {
                $account['wen_order_time'] = NULL;
            }
            if($account['key_reser_time'] && $account['key_reser_time']==1){

                $account['key_reser_time']='`';
            }else{
                $account['key_reser_time']=NULL;

            }
            //获取隐藏的修改时间值
            //$account['update_follow_time'] = $this->input->post('update_time', true);
            $account['is_upgrade'] = trim($this->input->post('is_upgrade', true));
            $account['is_operation'] = trim($this->input->post('is_operation', true));
            $account['re_MGM'] = trim($this->input->post('re_MGM', true));
            $account['is_income'] = trim($this->input->post('is_income', true));
        }
        return $account;
    }
    

    
    
    // 验证QQ
    private function check_member_qq($member_id=NULL)
    {
    	$member_qq = $this->input->post('member_qq'  , TRUE);
    	$member_qq2 = $this->input->post('member_qq2', TRUE);
    	
    	//如果同时为空
    	if(! $member_qq && !$member_qq2) return true;
    	//如果相等
    	if($member_qq == $member_qq2) return false;
    	if($member_id)
    	{
    		//不等于其他客户的qq qq2
    		$informate3 = array();
    		$informate4 = array();
    		$informate5 = array();
    		$informate6 = array();
    		if($member_qq)
    		{
    			$informate3 = $this->member_account_model->checkAllMember(array('member_qq' => $member_qq,'member_id !='=>$member_id));
    			$informate4 = $this->member_account_model->checkAllMember(array('member_qq2' => $member_qq,'member_id !='=>$member_id));
    		}
    		if($member_qq2)
    		{
    			$informate5 = $this->member_account_model->checkAllMember(array('member_qq'=>$member_qq2,'member_id !='=>$member_id));
    			$informate6 = $this->member_account_model->checkAllMember(array('member_qq2'=>$member_qq2,'member_id !='=>$member_id));
    		}
    		if(empty($informate3) && empty($informate4) && empty($informate5) && empty($informate6)) return true;
    	}else
    	{
    		$informate1 = $this->member_account_model->checkAllMember(array('member_qq'=>$member_qq));
    		$informate2 = $this->member_account_model->checkAllMember(array('member_qq2'=>$member_qq));
    		if (empty($informate1) && empty($informate2)) return true;
    	}
    	return false;
    }
    // 验证手机member_phone
    private function check_member_phone($member_id=NULL)
    {
    	$member_phone = $this->input->post('member_phone', TRUE);
    	$member_phone2 = $this->input->post('member_phone2', TRUE);
    	
    	//如果同时为空
    	if(! $member_phone && !$member_phone2) return true;
    	//如果相等
    	if($member_phone == $member_phone2) return false;
    	if($member_id)
    	{
    		//不等于其他客户的phone phone2
    		$informate3 = array();
    		$informate4 = array();
    		$informate5 = array();
    		$informate6 = array();
    		if($member_phone)
    		{
    			$informate3 = $this->member_account_model->checkAllMember(array('member_phone'=>$member_phone,'member_id !='=>$member_id));
    			$informate4 = $this->member_account_model->checkAllMember(array('member_phone2'=>$member_phone,'member_id !='=>$member_id));
    		}
    		if($member_phone2)
    		{
    			$informate5 = $this->member_account_model->checkAllMember(array('member_phone'=>$member_phone2,'member_id !='=>$member_id));
    			$informate6 = $this->member_account_model->checkAllMember(array('member_phone2'=>$member_phone2,'member_id !='=>$member_id));
    		}
    		if(empty($informate3) && empty($informate4) && empty($informate5) && empty($informate6)) return true;
    	}else
    	{
    		$informate1 = array();
    		$informate2 = array();
    		$informate1 = $this->member_account_model->checkAllMember(array('member_phone'=>$member_phone));
    		$informate2 = $this->member_account_model->checkAllMember(array('member_phone2'=>$member_phone));
    		if (empty($informate1) && empty($informate2)) return true;
    	}
    	return false;
    }

    
}
