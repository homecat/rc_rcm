<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//导入真实账户

class Import_member extends CI_Controller 
{

	public function __construct()
	{
    	parent::__construct();
		$this->load->model('manage/member_account_model');
		
		// 禁止网页访问
		if($this->input->is_cli_request()==FALSE){
			return show_404();
		}
		
		if(function_exists("set_time_limit") == TRUE AND @ini_get("safe_mode") == 0){
			@set_time_limit(0);
		}
    }
	
	
	
	public function index()
	{
		$inserts = 0;
		$insert_fails = '';
		$totalrecord = 0;
		$file_handle = fopen("data.csv", "r");
		while (!feof($file_handle)) {
			$totalrecord++;
   			$line = fgets($file_handle);
			$readline = explode(',',$line);//以逗号
			echo "Reading Line Is : --- ".$totalrecord."<br/>";
			$row = array();
			if($totalrecord >1 && count($readline)>7)
			{
				$newreadline = $this->compoment_file_data($readline);//print_r($newreadline);die;
				if($this->member_account_model->save(0,$newreadline))
				{
					echo "Inserts Line Is : --- ".$totalrecord."<br/>";
					$inserts++;
				}else
				{
					$insert_fails .= $totalrecord.' | ';
				}
			}
		}
		echo "<br />";
		echo "total from file have ".$totalrecord." items  <br />";
		echo "total inserted is : ".$inserts."  ( table : member_account ) <br />";
		echo "total insert_fails is : ".$insert_fails;
		echo "<br />";
		fclose($file_handle);
		@rename("data.csv","data.csv");
	}
	
	
	
	private function compoment_file_data($file_data)
	{
		$data['member_name'] = @trim($file_data[0]);
		$data['member_name'] = mb_convert_encoding($data['member_name'], "UTF-8","GBK"); 
		$data['member_qq'] = @trim($file_data[1]); 
		$data['member_qq'] = mb_convert_encoding($data['member_qq'], "UTF-8","GBK"); 

		$data['member_phone'] = @trim($file_data[2]);
		$data['member_phone2'] = @trim($file_data[3]);
		$data['member_status'] = @trim($file_data[4]);
		$data['member_from'] = @trim($file_data[5]);
		$data['sales_man']  = @trim($file_data[6]);
		if(! $data['sales_man']) $data['sales_man'] = NULL;
		
		$data['updater'] = @trim($file_data[7]);
		$data['update_time']  = @date('Y-m-d H:i:s',strtotime(trim($file_data[8])));
		if(! $data['update_time']) $data['update_time'] = NULL;
		
		$data['member_opener'] = @trim($file_data[9]);
		$data['demo_account'] = @trim($file_data[10]);
		$data['real_account'] = @trim($file_data[11]);
		$data['open_time'] = date('Y-m-d H:i:s',strtotime(trim($file_data[12])));
		if(! $data['open_time']) $data['open_time'] = NULL;
		

		$data['account_type'] = @trim($file_data[13]);
		$data['account_type'] = mb_convert_encoding($data['account_type'], "UTF-8","GBK"); 

		$data['creater'] = @trim($file_data[14]);
		$data['create_time'] = @date('Y-m-d H:i:s',strtotime(trim($file_data[15])));
		if(! $data['create_time']) $data['create_time'] = NULL;
		
		$data['call_start_time'] = @trim($file_data[16]);
		if(! $data['call_start_time']) $data['call_start_time'] = NULL;
		
		$data['member_info'] = @trim($file_data[17]);
		$data['member_info'] = mb_convert_encoding($data['member_info'], "UTF-8","GBK");

		$data['sales_id'] = @trim($file_data[18]);
		if(! $data['sales_id']) $data['sales_id'] = NULL;

		$data['member_weixin'] = @trim($file_data[19]);
		if(! $data['member_weixin']) $data['member_weixin'] = NULL;
		
		return $data;
	}
	
	
	
	public function change_account()
	{
		$file = fopen("temp.csv","r");
		while(! feof($file))
		{
		 	$row = fgetcsv($file);
			if( $row && isset($row[0]) && isset($row[1]) ){
				if(strstr($row[1],'R')==TRUE){
					$this->member_account_model->save($row[0],array('rc_real_account'=>$row[1]));
					echo $row[0]."\r\n";
				}
			}
		}
		fclose($file);
		
	}
	
	
	
}











