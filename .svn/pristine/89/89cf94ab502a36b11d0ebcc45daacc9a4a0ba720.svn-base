<?php if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
	
	// csv class

class CsvDataFile{
	private $filename='';
	private $datafile='';
	private $Row='';
	private $max='';
	private $delimiter='';
	private $fieldname='';
	private $mode='';
	private $nl='';
	private $haltOnError='';

	// constuctor
	public function svDataFile($filename, $delimiter = ',', $mode = "rb"){
		$haltOnError = false;
		$this->nl = "\n";
		$this->filename = $filename;
		if ($delimiter == ""){
			$delimiter = ",";
		}
		$this->delimiter = $delimiter;

		$this->mode = $mode;
		switch ($mode){
			case "r":
			case "rb":
				if ($filename != ''){
					// find max row length
					$this->datafile = fopen($filename, "rb");
					$maxlength = 0;
					while ($buffer = fgets($this->datafile, 4096)) {
						if (strlen($buffer) > $maxlength)
							$maxlength = strlen($buffer);
					}
					fclose($this->datafile);
					$this->max = ($maxlength +1) * 8;
					$this->datafile = fopen($filename, "rb");
					$this->fieldname = $this->next_row();
				}
			break;
			case "a":
			case "w":
				if ($filename != ''){
					$this->datafile = fopen($filename, "$mode");
				}
			break;
		}
	}

	public function printcell($str){
		$v = $str;
		if (strpos($str, "\"") || strpos($str, $this->delimiter) || strpos($str, $this->nl)){
			$v = str_replace("\"", "\"\"", $str);
		}
		$v = '"'.$v.'"';
		return $v;
	}

	public function printline($line){
		$l = "";
		if (!is_array($line)){
			$this->halt("Not a array! (printline)");
		}
		$line_head = array_slice($line, 0, -1);
		$line_tail = array_slice($line, -1, 1);
		foreach ($line_head as $cell){
			$l .= $this->printcell($cell).$this->delimiter;
		}
		foreach ($line_tail as $cell){
			$l .= $this->printcell($cell).$this->nl;
		}
		/*
		for ($i = 0; $i < sizeof($line)-1; $i++){
			$l .= $this->printcell($line[$i]).$this->delimiter;
		}
		$l .= $this->printcell($line[sizeof($line)-1]).$this->nl;
		*/
		return $l;
	}

	// output to file
	public function printcsv($lines){
		$contents = "";
		if (!is_array($lines)){
			$this->halt("Not a array! (printcsv)");
		}
		/*
		for ($i = 0; $i < sizeof($lines); $i++){
			$contents .= $this->printline($lines[$i]);
		}
		*/
		foreach ($lines as $line){
			$contents .= $this->printline($line);
		}
		if (($this->mode == "w" || $this->mode == "a") && $this->datafile){
			fwrite($this->datafile, $contents);
		}
		return $contents;
	}

	// close file
	public function close(){	
		if ($this->datafile){
			fclose($this->datafile);
		}
	}

	// next row
	public function next_row(){
		$this->Row = array();
		if ($this->datafile){
			if ($data = fgetcsv($this->datafile, $this->max, $this->delimiter)){
				$fieldname = $this->fieldname;
				for ($i = 0; $i < sizeof($fieldname); $i++){
					$celldata = $data[$i];
					if (strlen($celldata) > 0) {
						if (substr($celldata, 0, 1)==='"') {
							$celldata = substr($celldata,1,strlen($celldata)-1);
						}
						if (substr($celldata, strlen($celldata)-1, 1)==='"') {
							$celldata = substr($celldata,0,strlen($celldata));
						}
					}
					$this->Row[strtolower($fieldname[$i])] = trim($data[$i]);
				}
			} else {
				$this->close();
			}
		}
		return $data;
	}

	public function nfrow(){
	}

	public function nf(){
		return sizeof($this->Row);
	}

	public function f($name){
		return $this->Row[strtolower($name)];
	}

	public function halt($msg){
		echo "Error : ".$msg;
		if ($this->haltOnError){
			die();
		}
	}
}
?>