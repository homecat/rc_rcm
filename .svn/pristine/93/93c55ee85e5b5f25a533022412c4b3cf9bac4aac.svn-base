<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// 后台用户列表
class User_list_model  extends  User_base_model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'user_list';
		$this->increm = 'user_id';
	}

	public function  list_limits()
	{
		return array (NULL,'管理员','主管','组长','文字销售','电话销售','客服');
	}
	
	//-------------------------------------------- 操作数据 -----------------------------------------//
	public function get_list($parame=array(),$page=0,$limit=0)
	{
		$this->db->select('b.sales_name');
		$this->db->join('member_sales b','b.sales_id=a.sales_id','left');
		//$this->db->order_by('a.user_name','desc');
		return parent::get_list($parame,$page,$limit);
	}
	public function delete($parame=array())
	{
		$this->db->where('user_id >',1);
		return parent::delete($parame);	
	}
    public function get_user_name_option($select='')
    {
        $list = parent::get_list();
        foreach ($list as $row){
            if($select == $row['user_name']) echo '<option value="'.$row['user_name'].'" selected="selected">'.$row['user_name'].'</option>';
            else echo '<option value="'.$row['user_name'].'">'.$row['user_name'].'</option>';
        }
    }
    public function get_user_id_option($user_id='' , $user_status = 0)
    {
    	$params = array();
    	//状态 1未启用 2已启用
    	if($user_status == 2){
	        $params['user_status'] = 2;
    	}
    	$params['asc'] = 'user_name';
       	$list = parent::get_list($params);
        foreach ($list as $row){
            if($user_id == $row['user_id']) echo '<option value="'.$row['user_id'].'" selected="selected">'.$row['user_name'].'</option>';
            else echo '<option value="'.$row['user_id'].'">'.$row['user_name'].'</option>';
        }
    }
	//------------------------------------- 登录验证 -------------------------------------//	
	public function check_login($login,$password)
	{
		$row = MY_Model::get_row(array('user_name'=>$login,'user_password'=>MD5($password),'user_status'=>2));
		if(empty($row)) return FALSE;
		$data['user_id'] = $row['user_id'];
		$data['sales_id'] = $row['sales_id'];
		$data['user_name'] = $row['user_name'];
		$data['user_info'] = $row['user_info'];
		$data['user_limits'] = $row['user_limits'];
		$data['user_loginip'] = $this->input->ip_address();
		$this->session->set_userdata($data);
		return TRUE;
	}
	//------------------------------------- 权限验证 -------------------------------------//
	public function check_permissions($user_id=0)
	{
		$url_class = $this->router->class;
		$url_method = $this->router->method;
		
		$row = parent::get_row($user_id);
		//print_r($row);die;
		$user_permissions = $row['user_permissions'];  
		$permissions = (array) json_decode($user_permissions,true);
		//print_r($permissions);die;
		foreach($permissions as $item){
			if(in_array($url_class,$item)){
				return TRUE;
			}
			$url = $url_class.'/'.$url_method;
			if(in_array($url,$item)){
				return TRUE;
			}
			if($url_class == 'member_follow') return true;
		}
		return FALSE;
	}
	public function check_class($class_urls=NULL,$user_perms=NULL)
	{
		if(is_null($user_perms)){
			$user_perms = $this->user_perms();
		}
		//print_r($class_urls);
		//print_r($user_perms);die;
		foreach((array) $class_urls as $url){
			foreach($user_perms as $item){
				if(in_array($url,$item)){
					return TRUE;
				}
			}
		}
		return FALSE;
	}
	public function user_perms()
	{
		$row = parent::get_row($this->session->userdata('user_id'));
		if(empty($row)) return array();
		//echo $row['user_permissions'];
		$permissions = (array)json_decode($row['user_permissions'],true);
		return $permissions;
	}
	//得到某个的管理员名字
	public function get_usernamne($id='')
	{
		if(!$id)return NULL;
		if($id){
		$query = $this->db->get_where($this->table, array('user_id' => $id));
		$res=$query->row_array();
		return $name=$res?$res['user_name']:'';}
	}
	//得到用户名字
}
















