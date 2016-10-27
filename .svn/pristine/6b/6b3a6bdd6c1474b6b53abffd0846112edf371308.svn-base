<?php if (!defined('BASEPATH')) exit('No direct access allowed.');


// MT4交易平台 
// SOCK通讯方式


include_once "class.base.php";


class mt4_sock extends base_ptm
{
	
	protected $host;
	protected $port; 
	
	
	public function __construct($parame=NULL)
	{
		parent::__construct($parame);
	}
	
	
	
	
	//------------------------------------------- 真实账号 --------------------------------------------------//
	

	public function CreatNewUser($send)
	{
		$temp['COMMAND'] = 'CreatNewUser';
		$temp['ID'] = strval($send['real_login']);
		$temp['BODY']['LOGIN'] = intval($send['real_login']);
		$temp['BODY']['PASSWORD'] = strval($send['real_password']);
		$temp['BODY']['ENABLE'] = intval($send['real_enable']);
		$temp['BODY']['GROUP'] = strval($send['account_group']);
		$temp['BODY']['NAME'] = strval($send['member_name']);
		$temp['BODY']['PHONE'] = strval($send['phone_number']);
		$temp['BODY']['EMAIL'] = strval($send['member_email']);
		$temp['BODY']['AGENTACCOUNT'] = intval($send['real_login']);   
		$data = $this->connect_mt4($temp);
		return $data;
	}
	
	

	public function DisableUser($send)
	{
		$temp['COMMAND'] = 'DisableUser';
		$temp['ID'] = strval($send['real_login']);
		$temp['BODY']['LOGIN'] = intval($send['real_login']);
		return $this->connect_mt4($temp);
	}
	
	

	public function EnableUser($send)
	{
		$temp['COMMAND'] = 'EnableUser';
		$temp['ID'] = strval($send['real_login']);
		$temp['BODY']['LOGIN'] = intval($send['real_login']);
		return $this->connect_mt4($temp);
	}
	
	

	public function PasswordChange($send)
	{
		$temp['COMMAND'] = 'PasswordChange';
		$temp['ID'] = strval($send['real_login']);
		$temp['BODY']['LOGIN'] = intval($send['real_login']);
		$temp['BODY']['OLDPASSWORD'] = strval($send['real_oldpwd']);
		$temp['BODY']['NEWPASSWORD'] = strval($send['real_newpwd']);
		return $this->connect_mt4($temp);
	}
	
	

	public function PasswordReset($send)
	{
		$temp['COMMAND'] = 'PasswordReset';
		$temp['ID'] = strval($send['real_login']);
		$temp['BODY']['LOGIN'] = intval($send['real_login']);
		$temp['BODY']['NEWPASSWORD'] = strval($send['real_newpwd']);
		$data = $this->connect_mt4($temp);
		return $data;
	}



	public function Deposit($send)
	{
		$temp['COMMAND'] = 'Deposit';
		$temp['ID'] = strval($send['real_login']);
		$temp['BODY']['LOGIN'] = intval($send['real_login']);
		$temp['BODY']['PRICE'] = floatval($send['order_amount']);
		$temp['BODY']['COMMENT'] = strval($send['remark']);
		$data = $this->connect_mt4($temp);
		return $data;
	}
	
	

	public function Withdrawal($send)
	{
		$temp['COMMAND'] = 'Withdrawal';
		$temp['ID'] = strval($send['real_login']);
		$temp['BODY']['LOGIN'] = intval($send['real_login']);
		$temp['BODY']['PRICE'] = floatval($send['order_amount']);
		$temp['BODY']['COMMENT'] = strval($send['remark']);
		$data = $this->connect_mt4($temp);
		return $data;
	}



	public function CancelWithdrawal($send)
	{
		return self::Deposit($send);
	}  



	public function GetMarginLevel($send)
	{
		$temp['COMMAND'] = 'GetMarginLevel';
		$temp['ID'] = strval($send['real_login']);
		$temp['BODY']['LOGIN'] = intval($send['real_login']);
		$data = $this->connect_mt4($temp);
		if($data['code']==9000){
			$temp = $this->GetCredit($send);
			if($temp['code']==9000){
				$data['credit'] = $temp['BODY']['CREDIT'];
				$data['balance_usable'] = sprintf("%01.2f",$data['BODY']['BALANCE']-$temp['BODY']['CREDIT']);
				$data['margin_usable'] = sprintf("%01.2f",$data['BODY']['MARGINFREE']-$temp['BODY']['CREDIT']);
			}else{
				return $temp;
			}
		}
		return $data;
	}
	
	
	
	public function GetOpenPosition($send)
	{
		$temp['COMMAND'] = 'GetOpenPosition';
		$temp['ID'] = strval($send['real_login']);
		$temp['BODY']['LOGIN'] = intval($send['real_login']);
		return $this->connect_mt4($temp);
	}
	
	

	public function GetCredit($send)
	{
		$temp['COMMAND'] = 'GetCredit';
		$temp['ID'] = strval($send['real_login']);
		$temp['BODY']['LOGIN'] = intval($send['real_login']);
		return $this->connect_mt4($temp);
	}
	
	
	
	public function SetCredit($send)
	{
		$temp['COMMAND'] = 'SetCredit';
		$temp['ID'] = strval($send['real_login']);
		$temp['BODY']['LOGIN'] = intval($send['real_login']);
		$temp['BODY']['PRICE'] = floatval($send['order_amount']);
		$temp['BODY']['EXPIRATION'] = intval(strtotime('+2 day'));
		$temp['BODY']['COMMENT'] = strval($send['remark']);
		return $this->connect_mt4($temp);
	}
	
	
	
	protected function message()
	{
		return array('code'=>9000,'message'=>'Success No action');
	}
	
	
	
	
	
	
	
	//------------------------------------------- 模拟账号 --------------------------------------------------//
	
	public function CreatDemoUser($send)
	{
		$temp['COMMAND'] = 'CreatNewUser';
		$temp['ID'] = strval($send['demo_login']);
		$temp['BODY']['LOGIN'] = intval($send['demo_login']);
		$temp['BODY']['PASSWORD'] = strval($send['demo_password']);
		$temp['BODY']['ENABLE'] = intval($send['demo_enable']);
		$temp['BODY']['GROUP'] = strval($send['account_group']);
		$temp['BODY']['NAME'] = strval($send['member_name']);
		$temp['BODY']['PHONE'] = strval($send['phone_number']);
		$temp['BODY']['EMAIL'] = strval($send['member_email']);
		$temp['BODY']['AGENTACCOUNT'] = intval($send['demo_login']);   
		$data = $this->connect_mt4($temp);

		if($data['code'] == 9000){
			$temp2['COMMAND'] = 'Deposit';
			$temp2['ID'] = strval($send['demo_login']);
			$temp2['BODY']['LOGIN'] = intval($send['demo_login']);
			$temp2['BODY']['PRICE'] = floatval(100000);
			$temp2['BODY']['COMMENT'] = strval("demo deposit");
			$data = $this->connect_mt4($temp2);
		}
		return $data;
	}
	
	
	
	


	
	
	
	//------------------------------------------- 平台操作 --------------------------------------------------//
	
	// 中文编码
	private function fixChineseUtf8($arr)
	{
		foreach ($arr as $key => $value ) { 
			if(is_numeric($value))continue;
			if(is_array($value)){
				$arr[$key] = $this->fixChineseUtf8($value);
			}else{
        		$arr[$key] = urlencode($value);  
			}
    	}
		return $arr;
	}
	
	
	// 请求三次 
	private function connect_mt4($temp)
	{
		$temp = $this->fixChineseUtf8($temp);
		$out = urldecode(json_encode($temp));
		$this->add_record('MT4 Request',$temp['COMMAND'],$out);
		for($i=1; $i<=3; $i++){
			$json = $this->sock_action($out); 
			$this->add_record('MT4 Return',$temp['COMMAND'],$json);
			$data = $this->decode_result($temp['COMMAND'],$temp['ID'],$json);
			if(in_array($data['code'],array(2,255))==FALSE){
				return $data;
			}
		}
		return $data;
	}
	
	
	
	
	// 连接SOCK
	private function sock_action($out)
	{
		$fp = @fsockopen($this->host,$this->port,$errno,$errstr,30);   
		if ($fp){
			$out = iconv("UTF-8","GB2312//IGNORE",$out);
			fputs($fp, $out); 
			fputs($fp,"\r\n");	 
			$json = fgets($fp);
			fclose($fp); 
			return $json;
		}
		return $errno;    
	}


	// 解析数据
	private function decode_result($commande,$id,$json)
	{
		$data = (array) json_decode($json,true);
		if(empty($data['ID']) || $data['COMMAND']!=$commande || $data['ID']!=$id){
			$data['code'] = 0;
			$data['message'] = $json;
			return $data;
		}
		if($data['RESULT']===0){
			$data['code'] = 9000;
			if(isset($data['BODY']['ORDER'])) $data['order_ref'] = $data['BODY']['ORDER'];
			if(isset($data['BODY']['CREDIT'])) $data['credit'] = $data['BODY']['CREDIT'];
			if(isset($data['BODY']['CURRENCY'])) $data['currency'] = $data['BODY']['CURRENCY'];
			if(isset($data['BODY']['BALANCE'])) $data['balance'] = $data['BODY']['BALANCE'];
			if(isset($data['BODY']['MARGIN'])) $data['margin'] = $data['BODY']['MARGIN'];
			if(isset($data['BODY']['MARGINFREE'])) $data['margin_free'] = $data['BODY']['MARGINFREE'];
		}else{
			$data['code'] = $data['RESULT'];
		}
		$data['message'] = $json;
		return $data;	
	}


	// 保存记录
	private function add_record($effect,$remark,$datajson)
	{
		$this->CI = &get_instance();
		$this->CI->db->insert('trading_logs',array('effect'=>$effect,'remark'=>$remark,'datajson'=>$datajson)); 
	}
	
	

	
}