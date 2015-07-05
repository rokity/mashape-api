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
echo $length;
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






?>
