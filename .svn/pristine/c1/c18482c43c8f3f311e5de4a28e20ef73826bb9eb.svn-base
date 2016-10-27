<?php

header("Content-type: text/html; charset=utf-8");

/*****************************************************************
 * 导出Excel数据 
 * createExcel() 
 * $title	string
 * $content	string
 *****************************************************************/
 
if( ! function_exists('createExcel'))
{
	function createExcel($title,$content)
	{
		header("Pragma:public");
		header("Expires:0");
		header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
		header("Content-Type:application/force-download");
		
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Type:application/octet-stream");
		header("Content-Type:application/download");
		header("Content-Disposition: attachment; filename=".$title."_".date("Y-m-d_His").".xls");

		header("Content-Transfer-Encoding:binary");
		
		echo "<html xmlns:o='urn:schemas-microsoft-com:office:office'
					 xmlns:x='urn:schemas-microsoft-com:office:excel'
					 xmlns='http://www.w3.org/TR/REC-html40'>
		 <head>
			<meta http-equiv='expires' content='Mon, 06 Jan 1999 00:00:01 GMT'>
			<meta http-equiv=Content-Type content='text/html; charset=utf-8'>
			 <!--[if gte mso 9]><xml>
			<x:ExcelWorkbook>
		   <x:ExcelWorksheets>
					   <x:ExcelWorksheet>
					   <x:Name></x:Name>
					   <x:WorksheetOptions>
									   <x:DisplayGridlines/>
						</x:WorksheetOptions>
					   </x:ExcelWorksheet>
			 </x:ExcelWorksheets>
			 </x:ExcelWorkbook>
			</xml><![endif]-->
		</head>
		 <body>
		<table>";
		echo $content;
		echo "</table></body></html>";
	}
}



/*****************************************************************
 * 导出Txt数据 
 * createTxt() 
 * $title	string
 * $content	string
 *****************************************************************/
 
if( ! function_exists('createTxt'))
{
	function createTxt($title,$content)
	{
		header("Content-Type: application/octet-stream"); 
		header("Content-Disposition: attachment; filename=".$title."_".date("Y-m-d_His").".txt");
		echo $content;
	}
}












