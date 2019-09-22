<?php
  header("Access-Control-Allow-Origin: *");
  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);

  include 'db_connect.php';
  $sql = "SELECT * FROM participants";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
    // output data of each row
    while($r = mysqli_fetch_assoc($result)) {
      $rows[] = $r;
    }
    print json_encode($rows);
  }

?>
