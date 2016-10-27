<?php if (!defined('BASEPATH')) exit('No direct access allowed.');
// 导入交易记录

class Importrade extends MHT_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('manage/member_account_model');
	}
	public function index()
	{
	
		$data=array();
		return $this->load->view('manage/importrade/index', $data);
	}
	//csv上传文件
	public function submit($id=0)
	{
		$data=array();
		if($id==1){
			$flag='';
			if($this->input->post('sub',true)&&$this->input->post('sub',true)=='提交')
			{
				$path=$this->input->post()?$this->input->post('fileBrowser',true):'';
				$filename = $path; 
				$handle = fopen("$filename","r");
				$row=0;
			while ($data = fgetcsv($handle, 1000, ","))
			 {
				$data[0]=iconv('GBK','UTF-8//IGNORE',$data[0]);
				$data[1]=iconv('GBK','UTF-8//IGNORE',$data[1]);
				$data[2]=iconv('GBK','UTF-8//IGNORE',$data[2]);
				if($data[0]=='真实账号')continue;
				$row++;	
				$user_id=$this->member_account_model->userid($data[0]);
					if($user_id)
					{
						$sj=array('member_id'=>$user_id,'trade_num'=>$data[2],'recode_time'=>$data[1],'add_time'=>date('Y-m-d H:i:s'),'rec_flag'=>$data[0]);
						$res=$this->member_tarde_model->save($sj);
						if($res>0)
						{
							$data['row']=$row;
						}else{
							$data['info']=2;
							$data['row']=$row;						
							return $this->load->view('manage/importrade/index', $data);
							
						}
					}else{
						$data['info']=3;
						$data['row']=$row;						
						return $this->load->view('manage/importrade/index', $data);
					}	
			}
			   fclose($handle);
			   $data['info']=1;
			   return $this->load->view('manage/importrade/index', $data);
			}
		}elseif($id==2){
			//新增导入功能
			if($this->input->post('fileBrowser1',true)){
				$fileBrowser=$this->input->post('fileBrowser1',true);
				$handle = fopen("$fileBrowser","r");
				$row=0;
				while ($data = fgetcsv($handle, 1000, ","))
				{
					$data[0]=iconv('GBK','UTF-8//IGNORE',$data[0]);
					$data[1]=iconv('GBK','UTF-8//IGNORE',$data[1]);
					$data[2]=iconv('GBK','UTF-8//IGNORE',$data[2]);
					$data[3]=iconv('GBK','UTF-8//IGNORE',$data[3]);
					$data[4]=iconv('GBK','UTF-8//IGNORE',$data[4]);
					$data[5]=iconv('GBK','UTF-8//IGNORE',$data[5]);
					$data[6]=iconv('GBK','UTF-8//IGNORE',$data[6]);
					$data[7]=iconv('GBK','UTF-8//IGNORE',$data[7]);
					$data[8]=iconv('GBK','UTF-8//IGNORE',$data[8]);
					$data[9]=iconv('GBK','UTF-8//IGNORE',$data[9]);
					$data[10]=iconv('GBK','UTF-8//IGNORE',$data[10]);
					$data[11]=iconv('GBK','UTF-8//IGNORE',$data[11]);
					$data[12]=iconv('GBK','UTF-8//IGNORE',$data[12]);
					$data[13]=iconv('GBK','UTF-8//IGNORE',$data[13]);
					$data[14]=iconv('GBK','UTF-8//IGNORE',$data[14]);
					if($data[0]=='MT4账号')continue;
					if($data[7]==NULL)break;
//20023333,,张三,2015/5/28,卓越,18,18,13,13714712323,61222575,Coldcall,Stage5,18,641098831,15572533227
					$parm_array=array(
						'real_account'=>$data[0],
						'rc_real_account'=>$data[1],
						'member_name'=>$data[2],
						'open_time'=>$data[3],
						'account_type'=>$data[4],
						'member_opener'=>$data[5],
						'sales_man'=>$data[6],
						'sales_id'=>$data[7],
						'member_phone'=>$data[8],
						'member_qq'=>$data[9],
						'member_from'=>$data[10],
						'member_status'=>$data[11],
						'creater'=>$data[12],
						'member_qq2'=>$data[13],
						'member_phone2'=>$data[14],
						'create_time'=>date('Y-m-d H:i:s')
					);
					$res=$this->member_account_model->save(0,$parm_array);
					if($res)$row++;
				}
				fclose($handle);
				$data['row']=$row;
			}elseif(!$this->input->post('fileBrowser1',true) && $this->input->post('sub',true)){
				$data['row']='a';	
			}
			return $this->load->view('manage/importrade/index', $data);
		}
			
	}
	

}