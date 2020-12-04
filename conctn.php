<?php
$conn = mysqli_connect('localhost', 'aayush', '', 'dbms');

if(!$conn){
  echo 'Connection error: '. mysqli_connect_error();

}
else {
//echo "connected";
}
?>
