<?php
 
   $conn = mysqli_connect('localhost', 'admin', '12345678', 'university');

   if(!$conn){
      echo 'Connection Error ' . mysqli_connect_error();
   }
?>