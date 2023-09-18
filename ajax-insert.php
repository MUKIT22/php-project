<?php

$name = $_POST["name"];
$date = $_POST["date"];
$ctc = $_POST["ctc"];
$tech = $_POST["tech"];

$conn = mysqli_connect("localhost","root","","phpassingment") or die("Connection Failed");

$sql = "INSERT INTO employee(fullname, dob, current_ctc,technologies) VALUES ('{$name}','{$date}','{$ctc}','{$tech}')";

if(mysqli_query($conn, $sql)){
  echo 1;
}else{
  echo "Error: ". mysqli_error($conn);
}


?>
