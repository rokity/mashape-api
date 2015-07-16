<?php










function load_json_to_db($table,$json){
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

$sql = "INSERT INTO ".$table."  VALUES (NULL,'".$name."','".$owner."','".$image_owner."','".$image_api."','".$desc."','".$prices."','".$links."','".$date."')";
if ($conn->query($sql) === TRUE) {
  //  echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
$conn->close();


}





















function read_from_cache($table){

$db_data=get_last_data($table);

$servername = "mysql4.000webhost.com";
$username = "a2124875_root";
$password = "frocio12";
$dbname = "a2124875_cache";
$conn = new mysqli($servername, $username, $password, $dbname);
  $sql =" SELECT * FROM ".$table."  WHERE data like '".$db_data."'";


    $name =array();
    $owner =array();
    $image_owner =array();
    $image_api =array();
    $desc =array();
    $prices =array();
    $links =array();

  if ($result=$conn->query($sql) ) {
    while ($row = $result->fetch_row()) {
          array_push($name,urldecode($row[1]));
          array_push($owner,urldecode($row[2]));
          array_push(  $image_owner,urldecode($row[3]));
          array_push(  $image_api,urldecode($row[4]));
          array_push($desc,urldecode($row[5]));
          array_push($prices,urldecode($row[6]));
          array_push($links,urldecode($row[7]) );

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

















function get_last_data($table){

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

    $sql =" SELECT DATA FROM ".$table." ORDER BY id DESC LIMIT 1 ";

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












function check_table_exist($tag){
  $servername = "mysql4.000webhost.com";
  $username = "a2124875_root";
  $password = "frocio12";
  $dbname = "a2124875_cache";
  $conn = new mysqli($servername, $username, $password, $dbname);
  $result = $conn->query("SHOW TABLES LIKE '".$tag."'");
if( $result->num_rows > 0){
return "TRUE";
}
else {
  return "FALSE";
}

}

















function create_table($tag,$array){

  $servername = "mysql4.000webhost.com";
  $username = "a2124875_root";
  $password = "frocio12";
  $dbname = "a2124875_cache";
  $conn = new mysqli($servername, $username, $password, $dbname);
  $sql = "CREATE TABLE ".$tag." (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,name LONGTEXT NOT NULL,owner LONGTEXT NOT NULL,image_owner LONGTEXT NOT NULL,image_api LONGTEXT NOT NULL,description LONGTEXT NOT NULL,prices LONGTEXT NOT NULL,links LONGTEXT NOT NULL,data LONGTEXT NOT NULL)";


  if ($conn->query($sql) === TRUE) {
    //  echo "Table MyGuests created successfully";
  } else {
      echo "Error creating table: " . $conn->error;
  }

  load_json_to_db($tag,$array);

  $conn->close();
}











?>
