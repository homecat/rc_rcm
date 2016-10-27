<?php if (!defined('BASEPATH')) exit('No direct access allowed.');


include_once ("class/class.mt4_sock.php");


class fgl_ptm_id2 extends mt4_sock
{
	

	public function __construct($parame=NULL)
	{

		parent::__construct($parame);
		
		$this->CI->load->model('message/message_task_model');
		
		if(empty($parame['real']))
		{
			$this->host = '115.160.133.87';
			$this->port = '10003';
		}
		else
		{
			$this->host = '115.160.133.87';
			$this->port = '10002';
		}
		
	}
	
	
	
	public function PasswordReset($send)
	{
		$data = parent::PasswordReset($send);
		if($data['code']==9000){
			$this->CI->message_task_model->email_trade_pwd($send['member_email'],$send['real_login'],$send['real_newpwd']);
		}
		return $data;
	}
	
	
	
	public function Deposit($send)
	{
		$data = parent::Deposit($send);
		if($data['code']==9000){ 
			$this->CI->message_task_model->email_trade_deposit($send['member_email'],$send['real_login'],$send['order_amount']);
			$this->CI->message_task_model->phone_trade_deposit($send['phone_number'],$send['real_login'],$send['order_amount']);
		}
		return $data;
	}
	
	
	
	public function DepoWithStatus($send)
	{
		$data = parent::DepoWithStatus($send);
		if($send['order_status']==3){ // 取款状态:已完成
			$this->CI->message_task_model->phone_trade_deposit($send['phone_number'],$send['real_login'],$send['order_amount']);
		}
		return $data;
	} 
	
	
	public function CreatDemoUser($send)
	{
		$data = parent::CreatDemoUser($send);
		if($data['code'] == 9000){
			if($send['not_send_email']==FALSE)
			$this->CI->message_task_model->email_trade_demo($send['member_email'],$send['demo_login'],$send['demo_password']);
		}
		return $data;
	} 
	
	
	
}