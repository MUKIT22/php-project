<?php

$id = $_POST["id"];

$conn = mysqli_connect("localhost","root","","phpassingment") or die("Connection Failed");

$sql = "SELECT * FROM employee WHERE id = {$id}";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
$output = "";
if(mysqli_num_rows($result) > 0 ){

  while($row = mysqli_fetch_assoc($result)){
    $output .= "<tr>
      <td width='90px'>Name</td>
      <td><input type='text' id='edit-fname' value='{$row["fullname"]}'>
          <input type='text' id='edit-id' hidden value='{$row["id"]}'>
      </td>
    </tr>
    <tr>
      <td>DOB</td>
      <td><input type='text' id='edit-dob' value='{$row["dob"]}'></td>
    </tr>

    <tr>
    <td>CTC</td>
    <td><input type='text' id='edit-ctc' value='{$row["current_ctc"]}'></td>
    </tr>

    <tr>
    <td>Technologies</td>
    <td><input type='text' id='edit-tech' value='{$row["technologies"]}'></td>
    </tr>


    <tr>
    
      <td></td>
      <td><input type='submit' id='edit-submit' value='save'></td>
    </tr>";

  }

    mysqli_close($conn);

    echo $output;
}else{
    echo "<h2>No Record Found.</h2>";
}

?>
