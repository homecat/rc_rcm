<?php if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
	


class Factory_account
{
	
	public function load($platform_id)
	{
		$host_name = strtolower(HOST_NAME);
		$class_name = $host_name.'_acc_id'.$platform_id;
		$class_file = dirname(__FILE__).'/list/'.$class_name.'.php';
		if(!file_exists($class_file)){
			$class_name = 'base_acc';
			$class_file = dirname(__FILE__).'/list/class/class.base.php';
		}
		include_once($class_file);
		return new $class_name();
	}
	
	
	
}
?>