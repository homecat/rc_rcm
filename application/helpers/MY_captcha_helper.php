<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('create_captcha_word'))
{
	function create_captcha_word()
	{
		
			$pool = '0123456789';

			$str = '';
			for ($i = 0; $i < 8; $i++)
			{
				$str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
			}

			return $str;
	}
}


// ------------------------------------------------------------------------

/* End of file captcha_helper.php */
/* Location: ./system/heleprs/captcha_helper.php */