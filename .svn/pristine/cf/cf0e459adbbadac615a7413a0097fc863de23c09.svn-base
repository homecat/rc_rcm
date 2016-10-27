<?php if (!defined('BASEPATH')) exit('No direct access allowed.');


// 多元交易平台 
// SOCK通讯方式


include_once "class.base.php";


class dy_sock extends base_ptm
{
	
	
	public function __construct($parame=NULL)
	{
		parent::__construct($parame);
	}
	
	
	public function Deposit($send)
	{
		$data = $this->message();
		$data['order_ref'] = NULL;
		return $data;
	}
	
	
	public function Withdrawal($send)
	{
		$data = $this->message();
		$data['order_ref'] = NULL;
		return $data;
	}
	
	
	public function CancelWithdrawal($send)
	{
		$data = $this->message();
		$data['order_ref'] = NULL;
		return $data;
	}
	
	
	public function GetMarginLevel($send)
	{
		$data = $this->message();
		$data['currency'] = NULL;
		$data['balance'] = NULL;
		$data['margin'] = NULL;
		$data['margin_free'] = NULL;
		$data['margin_usable'] = NULL;
		$data['balance_usable'] = NULL;
		return $data;
	}
	
	
	
	protected function message()
	{
		return array('code'=>9000,'message'=>'Success No action');
	}

	
}