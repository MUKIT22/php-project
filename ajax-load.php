<?php

$conn = mysqli_connect("localhost","root","","phpassingment") or die("Connection Failed");

$sql = "SELECT * FROM employee";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
$output = "";
if(mysqli_num_rows($result) > 0 ){
  $output = '<table border="1" width="100%" cellspacing="0" cellpadding="10px">
              <tr>
                <th width="60px">Id</th>
                <th>Name</th>
                <th>Date</th>
                <th>CTC</th>
                <th>Technologies</th>
                <th width="90px">Edit</th>
                <th width="90px">Delete</th>
              </tr>';

              while($row = mysqli_fetch_assoc($result)){
                               
               //$output .= "<tr><td align='center'>{$row["id"]}</td><td>{$row["first_name"]} {$row["last_name"]}</td><td align='center'><button class='edit-btn' data-eid='{$row["id"]}'>Edit</button></td><td align='center'><button Class='delete-btn' data-id='{$row["id"]}'>Delete</button></td></tr>";
               $output .= "<tr>
               <td align='center'>{$row["id"]}</td>
               <td align='center'>{$row["fullname"]}</td>
               <td align='center'> {$row["dob"]}</td>
               <td align='center'> {$row["current_ctc"]}</td>
               <td align='center'> {$row["technologies"]}</td>
               <td align='center'><button class='edit-btn' data-eid='{$row["id"]}'>Edit</button></td>
               <td align='center'><button Class='delete-btn' data-id='{$row["id"]}'>Delete</button></td
               ></tr>";
              }
    $output .= "</table>";

    mysqli_close($conn);

    echo $output;
}else{
    echo "<h2>No Record Found.</h2>";
}
?>
