<?php
require_once 'percentileData.php';
require_once 'percentileClass.php';

$p = new percentile($data);


// LOW
$kilo = 1;

// NORMAL
// $kilo = 15;	

// HIGH
// $kilo = 155;

$month = 30;

$p->getPercent('kiz','kilo',$month,$kilo);
if($p->overLimitBool){
	echo 'SORUN VAR!';
}














