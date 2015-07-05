    <?php
error_reporting(E_ALL);
include("configure.php");

function parse($url){
  $html = file_get_html($url);



  $name=array();
  $owner=array();
  $image_owner=array();
  $image_api=array();
  $desc=array();
  $prices=array();
  $links=array();
  $i=0;
  foreach($html->find('h4') as $element) {
      if( $element->class =="name"){
          //echo $element->plaintext."<br>";
          array_push($name, $element->plaintext);

      }

  }
  foreach($html->find('div') as $element) {
  if( $element->class =="owner"){
          //echo $element->plaintext."<br>";
          array_push($owner, $element->plaintext);
      array_push($links,"https://www.mashape.com/".$element->plaintext."/".$name[$i]);
      $i++;
      foreach($element->find('img') as $img)
          array_push($image_owner,$img->src);
      }
      if($element->class=="panel-body"){
          foreach($element->find("div") as $div){


             foreach($div->find("img") as $img)
              array_push($image_api,$img->src);

              if($div->class=="description"){
                  foreach($div->find("p") as $p)
                 array_push($desc,$p->plaintext);

                  foreach($div->find("div") as $price)
                      if($price->class=="price text-center")
                      array_push($prices,$price->plaintext);
             }

          }
      }
  }


  $array=array("name"=>$name,"owner"=>$owner,"image_owner"=>$image_owner,"image_api"=>$image_api,"desc"=>$desc,"prices"=>$prices,"links"=>$links);

  return $array;
}


function explore($url){




header('Content-Type: application/json');

 $date= date("Y/m/d");
 $diff=get_count_days($date);
 if($diff>3){
 $array=parse('https://www.mashape.com/explore');
 load_json_to_db($array);
 echo json_encode($array);
 }
 else {
   echo "else";
 }
  //  print_r($array);





}



function find(){

    header('Content-Type: application/json');
    if((isset($_GET['type']))&&($_GET['type']!=null)&&((isset($_GET['parameter']))&&($_GET['parameter']!=null)) ) {
    //echo "find aperto";

  $array=parse('https://www.mashape.com/explore'.switch_type($_GET['type']).$_GET['parameter']);

echo json_encode($array);




         }
    else{

         $data=array('Error'=>'Erorr in Query');

echo json_encode($data);
    }

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





?>
