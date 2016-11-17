<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-11-16
 * Time: 下午12:07
 */

class Member_account_check_model extends  Member_base_model{

    public function __construct()
    {
        parent::__construct();
        $this->table='member_account';
    }

    public function Is_exists($account){
        if($account){
            $is_exists_num = array('member_qq'=>0,'member_phone'=>0,'member_weixin'=>0,'add'=>'Enable');//1000不存在，1100存在的
            if($account['member_qq']!=''){
                $query = $this->db->query("SELECT * FROM member_account WHERE member_status != 'Dead' AND member_qq = ". $account['member_qq']." OR member_qq2 = ".$account['member_qq']);
                if($query->num_rows() > 0){
                    $is_exists_num['member_qq'] = 1100;
                    $is_exists_num['add'] = 'Disable';
                }
                else{
                    $is_exists_num['member_qq'] = 1000;
                }
            }
            if($account['member_phone']!=''){
                $query = $this->db->query("SELECT * FROM member_account WHERE member_status != 'Dead' AND member_phone = ". $account['member_phone']." OR member_phone2 = ".$account['member_phone']);
                if($query->num_rows() > 0){
                    $is_exists_num['member_phone'] = 1100;
                    $is_exists_num['add'] = 'Disable';
                }
                else{
                    $is_exists_num['member_phone'] = 1000;
                }
            }
            if($account['member_weixin']!=''){
                $query = $this->db->query("SELECT * FROM member_account WHERE member_weixin =". $account['member_weixin']." AND member_status != 'Dead'");
                if($query->num_rows() > 0) {
                    $is_exists_num['member_weixin'] = 1100;
                    $is_exists_num['add'] = 'Disable';
                }
                else {
                    $is_exists_num['member_weixin'] = 1000;

                }
            }
            if($is_exists_num['add'] == 'Disable') return array_merge($is_exists_num, $this->GetSalesInfo($query->result_array()));
            else return $is_exists_num;
        }else{
            return false;
        }

    }

    private function GetSalesInfo( $result = array() ){
        if(is_array($result)){
            $sales_id = ($result[0]['sales_id']);
            $updated = ($result[0]['update_time']);
            $created = ($result[0]['create_time']);
            $real_account = ($result[0]['real_account']);
            $query = $this->db->query("SELECT * FROM user_list WHERE user_id= ".$sales_id);
            $res = $query->result_array();
            return array('sales_info'=>array('name'=>$res[0]['user_name'],'updated'=>$updated,'created'=>$created,'real_account'=>$real_account));
        }else{
            return false;
        }
    }

    public function checkdata($params=array()){
        $result='';
        if($params){
            $key=array_keys($params);
            $this->db->select("member_status");
            if(isset($key[1]) && $key[1] && $params[$key[1]]){
                $this->db->where(array('member_id !='=>$params[$key[1]]));
                if($key[0]=='member_qq' || $key[0]=='member_qq2'){
                    $where="`member_qq`=".$params[$key[0]]." OR `member_qq2`=".$params[$key[0]];
                    $this->db->where("($where)");
                }elseif($key[0]=='member_phone' || $key[0]=='member_phone2'){
                    $where="`member_phone`=".$params[$key[0]]." OR `member_phone2`=".$params[$key[0]];
                    $this->db->where("($where)");
                }
            }else{
                if($key[0]=='member_qq'){
                    $this->db->where(array('member_qq'=>$params[$key[0]]));
                    $this->db->or_where(array('member_qq2'=>$params[$key[0]]));
                }else{
                    $this->db->where(array('member_phone'=>$params[$key[0]]));
                    $this->db->or_where(array('member_phone2'=>$params[$key[0]]));
                }

            }
            $query=$this->db->get($this->table);
            $result=$query->result_array();
        }
        return $result;
    }

    public function get_all(){
        $this->db->select('*');
        $this->db->from('member_account');
        $res = $this->db->get();
        return $res->result_array();
    }

}