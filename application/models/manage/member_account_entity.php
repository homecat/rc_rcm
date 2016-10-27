<?php 
/*
 * 
 * @author Jacky
 * @date 2016/01/22
 * Only part account field 
 * 
 */
class Member_account_entity
{
    public $member_id = '';                //int(11)
    public $member_name = '';              //varchar(64)
    public $member_qq = '';                //varchar(32)
    public $member_qq_addfriend = 0;       //varchar(1)添加qq好友
    public $member_qq2 = '';               //varchar(32)
    public $member_qq2_addfriend = 0;      //varchar(32)添加qq2好友
    public $expert_qq_invited    = 0;      //varchar(1)专家qq已邀请
    public $expert_qq_added      = 0;      //varchar(1)专家qq已添加
    public $member_phone  = '';            //varchar(32)
    public $member_phone2 = '';            //varchar(32)手机号码2
    public $member_weixin = '';            //varchar(64)微信
    public $member_weixin_addfriend = 0;   //int(1)添加微信好友
    public $member_info   = '';            //text客户详情
    public $member_habit  = '';            //text客户习惯性
    public $member_from   = '';            //varchar(32)客户来源
    public $member_opener = '';            //varchar(32)开户人
    public $real_account  = '';            //varchar(64)mt4账号
    public $rc_real_account = '';          //varchar(64)rc账号
    public $account_type    = '';          //varchar(32)
    public $demo_account    = '';          //varchar(64)
    public $open_time = '';                //datetime
    public $sales_id  = '';                //int(11)负责团队
    public $sales_man = '';                //int(10)负责人
    public $member_status = '';            //varchar(32)会员状态
    public $creater = '';                  //varchar(32)创建人
    public $create_time = '';              //timestamp
    public $updater = '';                  //varchar(32)
    public $update_time = '';              //datetime
    public $follower = '';                 //varchar(32)
    public $follow_type = '';              //varchar(32)
    public $follow_info = '';              //varchar(256)
    public $call_start_time = NULL;        //datetime
    public $wen_order_time  = NULL;        //varchar(32)文销预约
    public $key_reser_time  = NULL;        //varchar(35)重点预约
    public $follow_time = '';              //timestamp
    public $member_MGM = '';               //varchar(32)
    public $member_tradehabit = '';        //text交易习惯
    public $member_json = '';              //text
    public $is_upgrade = '';               //tinyint(1)夹升级
    public $is_operation = '';             //tinyint(1)夹操作
    public $re_MGM = '';                   //tinyint(1)回访MGM
    public $is_income = '';                //tinyint(1)将入金
}
?>
