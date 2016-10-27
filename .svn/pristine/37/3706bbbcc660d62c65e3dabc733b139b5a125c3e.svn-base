<?php if (!defined('BASEPATH')) exit('No direct access allowed.');


// 设置视图路径 多语言


class MY_Loader extends CI_Loader 
{



    public function __construct() 
    {
		
        parent::__construct();
		
		$CI = &get_instance();
		
		$lang = $CI->config->item('language');
		
		$this->_ci_view_path .= $lang. DIRECTORY_SEPARATOR;
		
    }





    public function switch_theme_on()
    {
    	$this->_ci_view_path = FCPATH . 'assets'. DIRECTORY_SEPARATOR .'templates' . DIRECTORY_SEPARATOR;
    }


    public function switch_theme_off()
    {
    	
    }
	
	
	

	
    public function view($view, $vars = array(), $return = FALSE)
	{
		return parent::view($view, $vars, $return);
	}
    
    
}
