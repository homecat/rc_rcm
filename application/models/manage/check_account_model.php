<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Check_account_model  extends  Status_base_model{
	
	public function __construct(){
		parent::__construct();
		$this->table = 'member_account';
	}

	public function is_exists( $accounts = array() ){
		if( !$accounts['member_qq'] &&  !$accounts['member_phone'] )return 1200;
		
		if($accounts['member_qq2'] && $accounts['member_qq']){
			if( $accounts['member_qq2'] == $accounts['member_qq'] ){
				return 1310;
			}else{
				//检查库中是否存在qq
				if( $this->g_check_rows($accounts['member_id']  , 'member_qq'    , $accounts['member_qq'])      >= 1 )return 1300;
				if( $this->g_check_rows($accounts['member_id']  , 'member_qq2'   , $accounts['member_qq'])      >= 1 )return 1300;
				//检查库中是否存在qq2
				if( $this->g_check_rows($accounts['member_id']  , 'member_qq'    , $accounts['member_qq2'])     >= 1 )return 1310;
				if( $this->g_check_rows($accounts['member_id']  , 'member_qq2'   , $accounts['member_qq2'])     >= 1 )return 1310;
			}
		}
		
		if( $accounts['member_phone2']  && $accounts['member_phone'] ){
			if( $accounts['member_phone2'] == $accounts['member_phone'] ){
				return 1330;
			}else{
				//检查库中是否存在phone
				if( $this->g_check_rows($accounts['member_id'] , 'member_phone'   , $accounts['member_phone'])   >= 1 )return 1320;
				if( $this->g_check_rows($accounts['member_id'] , 'member_phone2'  , $accounts['member_phone'])   >= 1 )return 1320;
				//检查库中是否存在phone2
				if( $this->g_check_rows($accounts['member_id'] , 'member_phone'   , $accounts['member_phone2'])  >= 1 )return 1330;
				if( $this->g_check_rows($accounts['member_id'] , 'member_phone2'  , $accounts['member_phone2'])  >= 1 )return 1330;
			}
		}
		return 1000;
	}
	
	//读取数据库中是否存在多条qq & phone记录
	public function g_check_rows( $member_id , $key , $val )
	{
		$this->db->where( 'member_id != ' , $member_id );
		$this->db->where( array($key => $val ) );
		$result = $this->db->get( $this->table )->result_array();
		$nums   = $result ? count( $result ) : 0;
		return $nums;
	}
}
