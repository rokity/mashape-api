    <?php



error_reporting(E_ALL);
include("configure.php");
include("parse.php");
include("data.php");








//explore


function explore($url){






 $date= get_cur_data();
 echo $date;


 $diff=get_count_days("cache",$date);

 if($diff>6){
 $array=parse('https://www.mashape.com/explore');
 $table="cache";
 load_json_to_db($table,$array);
 echo json_encode($array);
 }
 else {
   $array=read_from_cache("cache");
   echo json_encode($array);
 }
  //  print_r($array);





}



function find(){

    header('Content-Type: application/json');
    if((isset($_GET['type']))&&($_GET['type']!=null)&&((isset($_GET['parameter']))&&($_GET['parameter']!=null)) ) {
    //echo "find aperto";
    if($_GET['type']=="tags"){
find_for_tags();
}
if($_GET['type']=="search"){
find_for_name();
}

if($_GET['type']=="owner")
{
  find_for_owner();
}
         }
    else{


         $data=array('Error'=>'Erorr in Query');

echo json_encode($data);
    }

}






function find_for_owner(){
  echo 'https://www.mashape.com/'.$_GET['parameter'];
  $array=parse('https://www.mashape.com/'.$_GET['parameter']);
  echo json_encode($array);

}























function find_for_tags(){

  $response=check_table_exist(strtolower($_GET['parameter']));

  if($response=="FALSE"){
    $array=parse('https://www.mashape.com/explore'.switch_type($_GET['type']).$_GET['parameter']);
  create_table(strtolower($_GET['parameter']),$array);
  echo json_encode($array);

  }else{

    $date= date("Y/m/d");

    $diff=get_count_days(strtolower($_GET['parameter']),$date);
  //  echo "diff".$diff;
    if($diff>6){
    $array=parse('https://www.mashape.com/explore'.switch_type($_GET['type']).$_GET['parameter']);
    $table=$_GET['parameter'];
    load_json_to_db($table,$array);
    echo json_encode($array);
  }
  else {
    $array=read_from_cache(strtolower($_GET['parameter']));
    echo json_encode($array);
  }
  }

}








function find_for_name(){
  $array=parse('https://www.mashape.com/explore'.switch_type($_GET['type']).$_GET['parameter']);
  echo json_encode($array);

}




























function switch_type($t){

    switch($t)
    {
     case "tags":
       return "?tags=";
        break;

    case "search":
     return "?query=";
        break;
    }

}
























function list_of_tags($url){

  $tags = list_($url);
  echo json_encode($tags);
}



























function list_($url){
  $html = file_get_html($url);

  $tags=array();

//aside
foreach($html->find('aside') as $element) {
    if( $element->class =="page-sidebar thin"){
        //page-sidebar thin
        foreach($element->find('ul') as $ul)  //ul
        foreach($ul->find('li') as $li)       //li
        foreach($li->find('a') as $a){
        //  print_r($a);  //a
          array_push($tags,$a->plaintext);

        }

    }

}

return $tags;
}




?>
