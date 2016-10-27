<?php


// 定义接口


interface api_ptm
{


	/*
	 * 创建账号
	 * account_first  首次入金
	 * real_login
	 * real_password  
	 * account_group
	 * member_name
	 * phone_number
	 * member_email
	 * member_proxy
	 */
    function CreatNewUser($send);      
	
	
	/*
	 * 修改账号
	 * real_login
	 * real_password  
	 * account_group
	 * member_name
	 * phone_number
	 * member_email
	 */
	function EditRealUser($send);		   
	
	
	/*
	 * 冻结账号
	 * real_login
	 */
    function DisableUser($send); 
	
	
	/*
	 * 解冻账号
	 * real_login
	 */
	function EnableUser($send); 
	
	
	/*
	 * 锁定账号
	 * real_login
	 */
	function SuspendUser($send); 
	
	
	 /*
	 * 激活账号
	 * real_login
	 */    
	function ActivateUser($send); 
	
	
	/*
	 * 修改密码
	 * real_login
	 * real_newpwd
	 * real_oldpwd
	 */
	function PasswordChange($send); 
	
	
	/*
	 * 重置密码
	 * real_login
	 * member_email
	 * real_newpwd
	 */
	function PasswordReset($send); 
	
	
	/*
	 * 存款操作
	 * real_login
	 * member_email
	 * order_amount
	 * remark
	 * type
	 */
	function Deposit($send); 
	
	
	/*
	 * 取款操作
	 * real_login
	 * member_email
	 * order_amount
	 * bank_card
	 * remark
	 * type
	 */
	function Withdrawal($send);  
	
	
	/*
	 * 取消取款操作
	 * real_login
	 * order_amount
	 * remark
	 * type
	 */
	function CancelWithdrawal($send);
	
	
	/*
	 * 存取款状态
	 * real_login
	 * order_status
	 * order_refxuyao
	 */
	function DepoWithStatus($send); 
	
	
	/*
	 * 查询账号
	 * real_login
	 */ 
	function GetMarginLevel($send);
	
	
	/*
	 * 查询持仓单列表
	 * real_login
	 */ 
	function GetOpenPosition($send); 
	
	
	
	/*
	 * 查询信用资金
	 * real_login
	 */ 
	function GetCredit($send);
	
	
	/*
	 * 设置信用资金
	 * real_login
	 * order_amount
	 * remark
	 */ 
	function SetCredit($send); 
	
	
	
	
	
	
	/*
	 * 创建模拟账号
	 * real_login
	 * real_password  
	 * account_group
	 * member_name
	 * phone_number
	 * member_email
	 */
    function CreatDemoUser($send);  
	
	
}