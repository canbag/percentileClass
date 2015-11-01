<?php
/**
* Baby Percentile Calculator Class
* 
* @author Can Bağdiken <canbagdiken@gmail.com>
* @version 1.0
*/

class percentile{
	public $data,$sex,$type,$lastMonth,$lastValueIndex;
	public $overLimit = '@';
	public $overLimitBool = false;
	function __construct($importData){
		$this->data = $importData;
	}
	function set($sex,$type){
		$this->sex = $sex;
		$this->type = $type;
	}
	function findMonth($row){
		$this->overLimitBool = false;
		$x = 0;
		$available = null;
		foreach($this->data[$this->sex][$this->type] as $tmp){
			if($tmp[0] > $row){
				$this->lastMonthIndex = $x-1;
				return $available;
			}
			$available = $tmp[0];
			$x++;
		}
		$this->lastMonthIndex = $x-1;
		return $available;
	}
	
	function findValue($value){
		$available = null;
		$dataProccess = $this->data[$this->sex][$this->type][$this->lastMonthIndex];
		$dataProccess = array_slice($dataProccess, 1);
		
		
		if(end($dataProccess) < $value){
			$this->lastValueIndex = count($dataProccess)-1;
			$this->overLimitBool = true;
			$this->overLimit	 = '@ kesimin üzerinde!';
			return $dataProccess[count($dataProccess)-1];
		}
				
		if($dataProccess[0] > $value){
			$this->lastValueIndex = 0;
			$this->overLimitBool = true;
			$this->overLimit	 = '@ kesimin altında!';
			return $dataProccess[0];
		}
		
		$x=-1;
		foreach($dataProccess as $tmp){
			if($tmp > $value){
				$this->lastValueIndex = $x;
				return $available;
			}
			$available = $tmp;
			$x++;
		}
		$this->lastValueIndex = $x;
		return $available;
	}
	function getPercent($sex='',$type='',$ay='',$value=''){
		if($sex != ''){
			$this->set($sex,$type);
			$this->findMonth($ay);
			$this->findValue($value);
		}
		$result = $this->data['cols'][$this->lastValueIndex];
		$result = str_replace('@',$result,$this->overLimit);
		return $result;
	}
}