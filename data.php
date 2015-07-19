<?php




//"get_cur_data" is a function that return the current data in this format
//YY/MM/DD


function get_cur_data(){

  return date("Y/m/d");

}







//"get_count_days" is a function that calculate the difference between two date
//and return only the difference of days
// 1°Parameter : name of table where it places the last date of upload in DB/cache of mashape data
// 2°Parameter : date of today for example


function get_count_days($table,$data){

$db_data=get_last_data($table);

$data1 = $db_data;
$data2 = $data;

$days=get_diff_between_two_date($data1,$data2);




return $days;
}








//"get_diff_between_two_date" is a function that get the days of difference
//between two dates
//1°Parameter : the first date
//2°Parameter : the second date
//return days(second_date - first date)







function get_diff_between_two_date($date1,$date2)
{
  $diff = abs(strtotime($date2) - strtotime($date1));
  $years = floor($diff / (365*60*60*24));
  $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
  $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));






  return $days;
}























?>
