<?php



header('Content-Type: application/json');
error_reporting(E_ALL);

include("simple_html_dom.php");
include("utils.php");




















//check if "query" parameter exist and it isn't null


if((isset($_GET['query']))&&($_GET['query']!=null)) {


    // query parameter exists
    $query=$_GET['query'];



    switch ($query) {
       case "find":
           find(); // "find" function is in utils.php
           break;

       case "explore":
        explore("https://www.mashape.com/explore");  // "explore" function is in utils.php
           break;

       case "list":
       list_of_tags("https://www.mashape.com/explore");   // "list_of_tags" function is in utils.php
       break;
       
       default :
       error("Query null");

     }



}
else
error("Query null");


















function error($message){
  $data=array('Error'=>$message);
  echo json_encode($data);
}















?>
