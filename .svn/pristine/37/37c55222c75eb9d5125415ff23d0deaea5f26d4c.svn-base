<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Upload extends CI_Controller 
{

	private $floder;
	
	public function __construct()
	{
    	parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->floder = 'assets/tmps';
    }
	
	public function form($type='image',$id='file')
	{
		$data['url'] = site_url('tools/upload/submit/'.$type.'/'.$id);
		$data['id'] = $id;
		return $this->load->view('tools/upload_form',$data);
	}
	
	public function submit($type=NULL,$id=NULL)
	{
		$data = $this->_submit($type);
		$data['id'] = $id;
		$data['url'] = site_url('tools/upload/form/'.$type.'/'.$id);
		return $this->load->view('tools/upload_submit',$data);
	}
	
	

	private function _submit($type)
	{
		$urlpath = $this->urlpath($type);
		$this->remove_image();
 			
		if($type=='image')
		{
			$config['upload_path'] = $urlpath['path'];
			$config['allowed_types'] = 'jpg|jpeg|gif|png'; 
			$config['max_size'] = 5120;
			$config['max_width'] = 1024;
			$config['max_height'] = 768;
			$config['remove_spaces'] = TRUE;
			$config['file_name'] = date('mHis');
			$this->upload->initialize($config); 
		}else{
			$config['upload_path'] = $urlpath['path'];
			$config['allowed_types'] = 'swf|flv|csv|txt'; 
			$config['max_size'] = 1024*5;
			$config['remove_spaces'] = TRUE;
			$config['file_name'] = date('mHis');
			$this->upload->initialize($config); 
		}
		if (!$this->upload->do_upload('file'))
		{
			$data['code'] = 8999;
			$data['message'] = $this->upload->display_errors();
			return $data;
		} else{
			$data = $this->upload->data();
			$data['code'] = 9000;
			$data['file_url'] = $urlpath['url'];
			return 	$data;
		}	
	}
	

	private function remove_image(){
		$image_url = $this->input->post('image',TRUE);
		if( file_exists($image_url) ){
			$image_url = FCPATH.trim($image_url); 
			file_exists( $image_url ) && unlink( $image_url );
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	
	
	private function urlpath($type)
	{
		$time = date('Ym');
		$url = $this->floder.'/'.$type.'/'.$time.'/';
		$path = FCPATH .$this->floder.DIRECTORY_SEPARATOR.$type.DIRECTORY_SEPARATOR.$time.DIRECTORY_SEPARATOR;
		$this->make_dir($path);
		return array('url'=>$url,'path'=>$path);
	}
	private function  make_dir($path)
	{	
		if(is_dir($path))
		{
			return TRUE;
		}
		$paths = explode(DIRECTORY_SEPARATOR,$path);
		if( empty($paths) )
		{
			return file_exists($path);
		}
		$dir = NULL;
		foreach($paths as $key => $val)
		{
			$dir .= $val.DIRECTORY_SEPARATOR;
			! file_exists($dir) AND ! empty($dir) AND  @mkdir($dir,0755);
		}	
	}
	
	private function _create_thumb($image,$path)
	{
		$config['image_library'] = 'gd2';
		$config['maintain_ratio'] = TRUE;
		$config['create_thumb'] = TRUE;
		$config['thumb_marker'] = '_s';
		$config['width'] = 100;
		$config['height'] = 100;
		$config['new_image'] = $path;
		$config['source_image'] = $image;
		$this->image_lib->initialize($config); 
		$this->image_lib->resize();
	}
	
}