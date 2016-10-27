<?php


// 定义接口


interface api_acc
{


	/*
	 * 交易真实账号
	 * platform_id  
	 * member_proxy
	 */
    function rand_real($member_proxy);      
	
	
	/*
	 * 交易模拟账号
	 * platform_id
	 */
	function rand_demo();		   
	
	
	/*
	 * 交易密码
	 * first_alpha 第一个字母
	 */
    function rand_password(); 
	
	
	/*
	 * 存款订单号
	 * platform_id
	 * real_login
	 */
	function get_orderId($real_login); 
	

	
}