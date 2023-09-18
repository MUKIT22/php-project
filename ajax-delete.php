<?php

$student_id = $_POST["id"];

$conn = mysqli_connect("localhost","root","","phpassingment") or die("Connection Failed");

$sql = "DELETE FROM employee WHERE id = {$student_id}";

if(mysqli_query($conn, $sql)){
  echo 1;
}else{
  echo 0;
}

?>
