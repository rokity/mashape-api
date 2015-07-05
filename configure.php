<?php

function load_json_to_db($json){
$servername = "mysql4.000webhost.com";
$username = "a2124875_root";
$password = "frocio12";
$dbname = "a2124875_cache";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$date= date("Y/m/d");
$length=count($json['name']);

for($i=0;$i<$length;$i++){

$name=urlencode($json['name'][$i]);
$owner=urlencode($json['owner'][$i]);
$image_owner =urlencode($json['image_owner'][$i]);
$image_api =urlencode($json['image_api'][$i]);
$desc =urlencode($json['desc'][$i]);
$prices =urlencode($json['prices'][$i]);
$links =urlencode($json['links'][$i]);

$sql = "INSERT INTO cache  VALUES (NULL,'".$name."','".$owner."','".$image_owner."','".$image_api."','".$desc."','".$prices."','".$links."','".$date."')";
if ($conn->query($sql) === TRUE) {
  //  echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
$conn->close();


}

function get_count_days($data){

$db_data=get_last_data();
$count_data=strtotime($data) ;
$count_db_data=strtotime($db_data);
$differences=$count_data-$count_db_data;



return $differences;
}



















function read_from_cache(){

$db_data=get_last_data();

$servername = "mysql4.000webhost.com";
$username = "a2124875_root";
$password = "frocio12";
$dbname = "a2124875_cache";
$conn = new mysqli($servername, $username, $password, $dbname);
  $sql =" SELECT * FROM cache  WHERE data like '".$db_data."'";


    $name =array();
    $owner =array();
    $image_owner =array();
    $image_api =array();
    $desc =array();
    $prices =array();
    $links =array();

  if ($result=$conn->query($sql) ) {
    while ($row = $result->fetch_row()) {
          array_push($name,$row[1]);
          array_push($owner,$row[2]);
          array_push(  $image_owner,$row[3]);
          array_push(  $image_api,$row[4]);
          array_push($desc,$row[5]);
          array_push($prices,$row[6]);
          array_push($links,$row[7] );

      }

    /* free result set */
    $result->close();
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
$conn->close();

$array=array("name"=>$name,"owner"=>$owner,"image_owner"=>$image_owner,"image_api"=>$image_api,"desc"=>$desc,"prices"=>$prices,"links"=>$links);

return $array;

}

















function get_last_data(){

  $db_data=null;
    $servername = "mysql4.000webhost.com";
    $username = "a2124875_root";
    $password = "frocio12";
    $dbname = "a2124875_cache";
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql =" SELECT DATA FROM cache ORDER BY id DESC LIMIT 1 ";

    if ($result=$conn->query($sql) ) {
      while ($row = $result->fetch_row()) {
            $db_data= $row[0];
        }

      /* free result set */
      $result->close();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
$conn->close();

    return $db_data;


}

?>
