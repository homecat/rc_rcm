<?php if (!defined('BASEPATH')) exit('No direct access allowed.');


// 默认页


class Index extends QT_Controller 
{
	
	
	public function __construct()
	{
    	parent::__construct();
    }


	public function index()
	{
		echo date_default_timezone_get();
		echo ": ".date('Y-m-d H:i:s');
	}
	
	
	
	
	

	
	

}
