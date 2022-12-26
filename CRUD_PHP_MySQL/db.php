<?php
//phpinfo();

   session_start();

   $conn = mysqli_connect(
      "localhost",
      "root",
      "12345678",
      "crud_php_mysql"
   );
   /*
   if(isset($conn)){
      echo "DB is connected";
   }
   */
?>

