<?php if (!defined('BASEPATH')) exit('No direct access allowed.');

$config = array(

    'member_account'=>array(
    array(
        'field' => 'member_id',
        'label' => '客户ID',
        'rules' => 'integer'
    ),
    array(
        'field' => 'member_name',
        'label' => '姓名',
        'rules' => 'required|max_length[32]'
    ),
    array(
        'field' => 'member_qq',
        'label' => 'QQ',
        'rules' => 'required|max_length[32]'
    ),
    array(
        'field' => 'member_phone',
        'label' => '手机号码',
        'rules' => 'required|max_length[32]'
    ),
    array(
        'field' => 'member_info',
        'label' => '描述',
        'rules' => 'required|max_length[256]'
    ),
    array(
        'field' => 'member_from',
        'label' => '来源',
        'rules' => 'required|max_length[32]'
    ),
    array(
        'field' => 'member_opener',
        'label' => '开户人',
        'rules' => 'max_length[32]'
    ),
    array(
        'field' => 'real_account',
        'label' => '真实账户',
        'rules' => 'max_length[64]'
    ),
    array(
        'field' => 'account_type',
        'label' => '账户类别',
        'rules' => 'max_length[32]'
    ),
    array(
        'field' => 'demo_account',
        'label' => '模拟账户',
        'rules' => 'max_length[64]'
    ),
    array(
        'field' => 'open_time',
        'label' => '开户时间',
        'rules' => ''
    ),
    array(
        'field' => 'sales_id',
        'label' => '团队ID',
        'rules' => 'required|integer'
    ),
    array(
        'field' => 'member_status',
        'label' => '状态',
        'rules' => 'required|max_length[32]'
    ),
    array(
        'field' => 'creater',
        'label' => '创建人',
        'rules' => 'max_length[32]'
    ),
    array(
        'field' => 'create_time',
        'label' => '创建时间',
        'rules' => ''
    ),
    array(
        'field' => 'updater',
        'label' => '修改人',
        'rules' => 'max_length[32]'
    ),
    array(
        'field' => 'update_time',
        'label' => '修改时间',
        'rules' => ''
    ),
    array(
        'field' => 'follower',
        'label' => '跟进人',
        'rules' => 'max_length[32]'
    ),
    array(
        'field' => 'follow_type',
        'label' => '跟进类型',
        'rules' => 'max_length[32]'
    ),
    array(
        'field' => 'follow_info',
        'label' => '跟进详情',
        'rules' => 'max_length[256]'
    ),
    array(
        'field' => 'call_start_time',
        'label' => '预约开始时间',
        'rules' => ''
    ),
    array(
        'field' => 'follow_time',
        'label' => '跟进时间',
        'rules' => ''
    )
)
);



