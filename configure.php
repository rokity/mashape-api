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
$value=serialize($json);
$sql = "INSERT INTO a2124875_cache (id,json,data) VALUES (NULL,$value,$date)";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
}






?>
