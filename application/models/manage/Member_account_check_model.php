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

    private function GetSalesInfo( $result = array() ){
        if(is_array($result)){
            $sales_id = ($result[0]['sales_id']);
            $updated = ($result[0]['update_time']);
            $created = ($result[0]['create_time']);
            $real_account = ($result[0]['real_account']);
            $query = $this->db->query("SELECT * FROM user_list WHERE user_id= ".$sales_id);
            $res = $query->result_array();
            return array('sales_info'=>array('sales_man'=>$res[0]['user_name'],'update_time'=>$updated,'create_time'=>$created,'real_account'=>$real_account));
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

    public function get_all($condition){
        $this->db->select('*');
        $this->db->from('member_account');
        $this->db->where($condition);
        $this->db->cache_on();
        $this->db->cache_off();
        $res = $this->db->get();

        $total_row = $res->num_rows();
        if ($total_row < 1) return false;
        else return $res->result_array();
    }

    public function get_sale_man($id){
        if(!$id) return false;
        $this->db->select('sales_name');
        $this->db->from('member_sales');
        $this->db->where(array('sales_id' => $id));
        $this->db->cache_on();
        $res = $this->db->get();
        $this->db->cache_off();
        return $res->result_array();
    }

}