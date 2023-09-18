<?php

$id = $_POST["id"];
$name = $_POST["name"];
$date = $_POST["date"];
$ctc = $_POST["ctc"];
$tech = $_POST["tech"];

$conn = mysqli_connect("localhost","root","","phpassingment") or die("Connection Failed");

$sql = "UPDATE employee SET fullname = '{$name}',dob= '{$date}',current_ctc= '{$ctc}',technologies= '{$tech}' WHERE id = {$id}";

if(mysqli_query($conn, $sql)){
  echo 1;
}else{
  echo 0;
}

?>
