<?php
$mysqli = new mysqli("localhost","root","","dbtest1");

// Check connection
if ($mysqli -> connect_errno) {
  echo "ket noi loi " . $mysqli -> connect_error;
  exit();
}
?>