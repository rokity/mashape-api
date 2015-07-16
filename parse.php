<?php

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

?>
