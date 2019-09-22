<?php
  $servername = "mysql.fungisto.narxx.com";
  $username = "fungisto";
  $password = "J42Sv6mbXmsLXR8";
  $dbname = "fungisto";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>