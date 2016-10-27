<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// 权限配置
$config['manage'] = array(	
	array(
		'title'=>'客户资料管理',
		'folder'=>'manage',
		'list'=>array(
					array(
						'title'=>'客户资料总览',
						'menus'=>true,
						'value'=>array(
							'member_account'
						)
					),
				array(
						'title'=>'销售表现记录',
						'menus'=>true,
						'value'=>array(
								'member_behave'
						)
				),
				array(
						'title'=>'客户资料导出',
						'menus'=>true,
						'value'=>array(
								'member_export'
						)
				),
				array(
						'title'=>'客户资料全部导出',
						'menus'=>true,
						'value'=>array(
							    'member_alldata'
						)
				),

					array(
						'title'=>'客户活动记录',
						'menus'=>false,
						'value'=>array(
							'authority/activity_iframe'
						)
					),
					array(
						'title'=>'客户内容',
						'menus'=>false,
						'value'=>array(
							'authority/customer_content'
						)
					),
					array(
						'title'=>'跟进记录',
						'menus'=>false,
						'value'=>array(
							'authority/follow_iframe'
						)
					),
					array(
						'title'=>'升降级记录',
						'menus'=>false,
						'value'=>array(
							'authority/grade_iframe'
						)
					),
					array(
						'title'=>'分析师记录',
						'menus'=>false,
						'value'=>array(
							'authority/analyst'
						)
					),
					array(
						'title'=>'交易习惯',
						'menus'=>false,
						'value'=>array(
							'authority/trade_habit'
						)
					),
		),
	),
	array(
		'title'=>'客户资料修改',
		'folder'=>'manage',
		'list'=>array(
					
					array(
						'title'=>'修改提案',
						'menus'=>true,
						'value'=>array(
							'member_edits'
						)
					),
					array(
						'title'=>'修改审批',
						'menus'=>true,
						'value'=>array(
							'member_checks'
						)
					)

		),
	),
	array(
		'title'=>'系统管理',
		'folder'=>'manage',
		'list'=>array(
					array(
							'title'=>'参数设置',
							'menus'=>true,
							'value'=>array(
									'member_params'
							)
					),
					array(
							'title'=>'删除记录',
							'menus'=>true,
							'value'=>array(
									'member_delete'
							)
					),
					array(
						'title'=>'销售团队',
						'menus'=>true,
						'value'=>array(
							'member_sales'
						)
					),
					array(
						'title'=>'系统数据导出',
						'menus'=>true,
						'value'=>array(
							'member_export2'
						)
					),
					array(
						'title'=>'导入交易记录',
						'menus'=>true,
						'value'=>array(
							'importrade'
						)
					),
					array(
						'title'=>'用户管理',
						'menus'=>true,
						'value'=>array(
							'user_list'
						)
					),
					array(
						'title'=>'修改密码',
						'menus'=>true,
						'value'=>array(
							'user_pwd'
						)
					),
					array(
						'title'=>'数据修改',
						'menus'=>true,
						'value'=>array(
							'date_update'
						)
					),
					
			),
	),
	array(
			'title'=>'文本管理',
			'folder'=>'manage',
			'list'=>array(
						
					array(
							'title'=>'日志存档',
							'menus'=>true,
							'value'=>array(
									'memo'
							)
					),
	
			),
	),
	
	
);