<?php if (!defined('BASEPATH')) exit('No direct access allowed.');


include_once ("class/class.dy_sock.php");


class fgl_ptm_id1 extends dy_sock
{
	

	public function __construct($parame=NULL)
	{
		parent::__construct($parame);
		$this->CI->load->model('message/message_task_model');
	}
	
	
	public function Deposit($send)
	{
		$data = parent::Deposit($send);
		if($data['code']==9000){ 
			if(isset($send['order_id'])){
				$this->CI->message_task_model->email_cs_real_deposit($send['order_id']);
			}
		}
		return $data;
	}
	
}