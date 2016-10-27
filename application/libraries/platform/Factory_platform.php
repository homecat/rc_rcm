<?php if (!defined('BASEPATH')) exit('No direct access allowed.');



class Factory_platform
{

	
	public function load($platform_id,$real=FALSE)
	{
		$host_name = strtolower(HOST_NAME);
		$class_name = $host_name.'_ptm_id'.$platform_id;
		$class_file = dirname(__FILE__).'/list/'.$class_name.'.php';
		if(!file_exists($class_file)){
			$class_name = 'base_ptm';
			$class_file = dirname(__FILE__).'/list/class/class.base.php';
		}
		include_once($class_file);
		return new $class_name(array('real'=>$real));
	}
	


}