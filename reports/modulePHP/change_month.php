<?php
function formatDate($param) {
  $year           =substr("$param",0,4);

  $month          =substr("$param",5,2);

  $day            =substr("$param",8,2);

  $_monthPad      =sprintf("%01d", $month);

  $_day           =sprintf("%01d", $day);

  $_year          = getYear($year);

  $_month         = getMonth($_monthPad);

  $dateformat     = $_day." ".$_month." ".$_year;

  return $dateformat;
}
function getYear($param){

  $result = $param + 543;

  return $result;
}
function getMonth($param){

  $monthTH = [null,'มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'];
  
  return $monthTH[$param];
}
?>