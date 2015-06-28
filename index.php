<?php



error_reporting(E_ALL);

include("simple_html_dom.php");
include("utils.php");























header('Content-Type: application/json');
 
if((isset($_GET['query']))&&($_GET['query']!=null)) {
    // query index exists
    $query=$_GET['query'];
   sw($query);
    
   
   //     print_r(error_get_last());
    
}
else{
    
    header('Content-Type: application/json');
   
    $data=array('Error'=>'Query Null');
    
echo json_encode($data);
  
    
 //   print_r(error_get_last());
    
}


















function sw($q)
{
    
    
 switch ($q) {
    case "find":     
        find();
        break;
     
    case "explore":
     explore("https://www.mashape.com/explore");
        break;
     
}
    
    
  //  print_r(error_get_last());
}








?>


