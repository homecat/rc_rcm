<?php if (!defined('BASEPATH')) exit('No direct access allowed.');


// 客户资料导出

class Date_update extends MHT_Controller 
{
    public function index($sign=0)
    {
        $data=array();
        return $this->load->view('manage/date_update/index',$data);
    }
    public function update(){
        $oldsaid=$this->input->post('oldsaid',true);
        $newsaid=$this->input->post('newsaid',true);
        $member_status=$this->input->post('member_status',true);
        $fileBrowser=$this->input->post('fileBrowser',true);
        $newsaid=explode('/',$newsaid);
        $oldsaid=explode('/',$oldsaid);
        if(count($newsaid)<2)die('请填写新的负责人及销售团队id');
        if($fileBrowser){
            if($newsaid && !$oldsaid[0] &&!$member_status){
                $ids=file($fileBrowser);
            if($ids){
                foreach($ids as $k=>$v){
                    $this->set_data($v,$newsaid);
                }
                    die('修改完毕');
                }else{
                 echo '文件不存在'; die; 
                }   
            }else{
                die('请填写正确的修改方式1');
            }  
        }
        if($oldsaid[0]){
            $sql="UPDATE `member_account` SET";
            if($newsaid && $member_status){
                $sql.=" `sales_id`='$newsaid[1]',`sales_man`='$newsaid[0]' ";
                if(count($oldsaid)==1){
                    $sql.="WHERE `sales_man`='$oldsaid[0]'";    
                }else{
                    $sql.="WHERE `sales_man`='$oldsaid[0]' and `sales_id`='$oldsaid[1]'";   
                }
                $sql.=" and `member_status` in(";
                foreach($member_status as $k=>$v){
                    $sql.="'$v' ,";
                }
                $sql=substr($sql, 0 ,-2);
                $sql.=')';
                $query=$this->db->query($sql);
               //echo $this->db->last_query();
                die("{$this->db->affected_rows()}条记录修改成功");
            }else{
               die('请填写正确的修改方式2');
            }   
        }
        die('fail_edit');
       
        // `sales_id`='103',`sales_man`='155' WHERE `sales_man`='167' and `sales_id`='115' and `member_status` in('Stage1','Stage2','Stage3','Stage4') ;
    }
    function set_data($id=NULL,$newsaid=array()){
        if(!$id || count($newsaid)<2) die('error:102');
        $sql="UPDATE `member_account` SET 
        `sales_id`='$newsaid[1]',`sales_man`='$newsaid[0]' 
        WHERE `member_id`='".$id."'";
        $query = $this->db->query($sql);
        $i=$this->db->affected_rows();
        if($i){
            echo $i.'个客户负责人已修改<br/>';
        }    /*  echo 'ID为'.$id.'的客户负责人修改失败<br/>'; */
    }
}