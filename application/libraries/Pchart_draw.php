<?php

 //  Pchart
 
 class Pchart_draw 
 {
	/*
	 * 生成图表的数组
	 * @access private
	 * @var    array    $_data
	 */
 	private $_data = array();
 	
 	/*
	 * 图表图片的缓存路径
	 * @access private
	 * @var    array    $_data
	 */
 	private $_cache_dir = '';
 	
 	/*
	 * 生成图片的字体路径
	 * @access private
	 * @var    array    $_data
	 */	
 	private $_font_dir = '';
 	 	
 	/*
	 *  CI 资源
	 * @access private
	 * @var    array    $_ci
	 */	
 	private $_ci = '';
 	
 	/*-------------------------------------------------------------------------------------------------------------*/
 	
 	/*
	 * 构造函数
	 * @access public
	 *  
	 */
	function __construct()
	{
		$this->_ci = &get_instance();
		$this->_ci->load->library('pchart/pdata');
		$this->_ci->load->library('pchart/pchart');
		$this->_ci->load->library('pchart/pcache');
		
		$this->_font_dir = FCPATH.APPPATH.'libraries/pchart/';
		$this->_cache_dir = FCPATH.'assets'.DIRECTORY_SEPARATOR;
		
		if( ! file_exists($this->_cache_dir) ) mkdir($this->_cache_dir,0755);
	}
	
	/*-------------------------------------------------------------------------------------------------------------*/
	
	/*
	 * 设置缓存路径
	 * 
	 * @access public
	 * @param  string   $dir
	 *  
	 */
	function  set_cache_dir( $dir )
	{
		if( ! empty($dir) )
		{
			$this->_cache_dir = $dir;
		}
	}
	
	/*-------------------------------------------------------------------------------------------------------------*/
	
	/*
	 * 设置图片数据
	 * 
	 * @access public
	 * @param  array   $data
	 *  
	 */
	function  set_data( $data )
	{
		if( ! is_array($data) ){
			$this->_data = array($data);
		}else{
			$this->_data =  $data;
		}
	}
	
	/*-------------------------------------------------------------------------------------------------------------*/
	
	/*
	 * 画图
	 * 
	 * @access public
	 * @param  string   $product
	 * @param  string   $size  		{$size='large'|'mini'}
	 * @param  boolean  $debug
	 *  
	 */
	function draw_picture($product='XAGUSD',$size='mini',$debug=FALSE)
	{
		$product_data = array();
		$date 	= array();
		$serieX = array();
		$max    = 0;
		$min 	= 0;
 
		if( ! empty($this->_data) ){
			$quarter = intval(count($this->_data) / 4);
			
			foreach($this->_data as $key =>$value){
				$date[] =  date("H:i",$value[0]);
				$product_data[] = $value[1];
				if( $max <  $value[1]) $max =  $value[1];
				if( $min >  $value[1] || 0 === $key) $min =  $value[1];
			}
			// 不足10个数据时,补齐10
			if( count($date) < 10){	
				$key = count($this->_data)-1;	
				$last_time= $this->_data[$key][0];
					
				for($i= count($date); $i < 10;$i++){
					$last_time +=  300;
					$date[] 		= date("H:i",$last_time);
					$product_data[] = NULL;
				}			
			}
			$dif = ($max - $min)*0.1;
			$max += $dif;
			$min -= $dif;
		}else{
			die('No data!');
		}	

		// Dataset definition
        $DataSet = $this->_ci->pdata;
        $DataSet->initalize();
        $DataSet->AddPoint($product_data,"Serie1");
        $DataSet->AddPoint($date,"Serie2");
        $DataSet->AddSerie("Serie1");
        $DataSet->SetAbsciseLabelSerie("Serie2");
        
        // Initialise the graph
        $draw = $this->_ci->pchart;
        $draw->initalize(900,520);
        $draw->drawBackground(0,0,0);
        $draw->setDateFormat("H:i");
        
        if('large' == $size){
            $pass = count($this->_data)/4;
            $draw->setFixedScale($min,$max,3);
            $draw->setLineStyle(2);
            $draw->setFontProperties($this->_font_dir."Fonts/tahoma.ttf",20);
            $draw->setGraphArea(120,30, $draw->XSize-40,$draw->YSize-40);
        }else{
            $pass = count($this->_data)/3;
            $draw->setFixedScale($min,$max,2);
            $draw->setLineStyle(3);
            $draw->setFontProperties($this->_font_dir."Fonts/tahoma.ttf",35);
            $draw->setGraphArea(190,50, $draw->XSize-70,$draw->YSize-70);
        }
		$pass = ($pass >= 1)?$pass:1; 
		
        $draw->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2,FALSE,$pass,FALSE);      
        $draw->GAreaXOffset = -$draw->DivisionWidth*0.1;
        $draw->drawGrid(8,FALSE,150,150,150,0);
        // Draw the cubic curve graph
        $draw->drawCubicCurve($DataSet->GetData(),$DataSet->GetDataDescription());  
		if(TRUE == $debug){		 		// 输出图片
		  	$draw->Stroke();die();
		}else{		 					// 写图片
		 	$pic_id  = "Pic#".$product.'_'.$size;
		 	
		 	$this->_ci->pcache->initalize( $this->_cache_dir );
		 	$this->_ci->pcache->WriteToCache($pic_id,array(array($product=>1)),$draw);  
		}	
	}
		
	/*-------------------------------------------------------------------------------------------------------------*/
	
	/*
	 * 读图
	 * 
	 * @access public
	 * @param  string   $product
	 * @param  string   $size  		{$size='large'|'mini'}
	 *  
	 */
	function read_picture($product='XAGUSD',$size='mini')
	{
		// 读图片
		$pic_id  = "Pic#".$product.'_'.$size;

		$this->_ci->pcache->initalize( $this->_cache_dir );
		$this->_ci->pcache->GetFromCache($pic_id,array(array($product=>1))); 
	}
	/*-------------------------------------------------------------------------------------------------------------*/
}