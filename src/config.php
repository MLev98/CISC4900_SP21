<?php
function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'planner');
   $link = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

   if (!$link) {
       console_log("Error: Unable to connect to MySQL.");
       console_log("Debugging errno: " . mysqli_connect_errno());
       console_log("Debugging error: " . mysqli_connect_error());
       exit;
   }

   console_log("Success: A proper connection to MySQL was made! The my_db database is great.");
   console_log("Host information: " . mysqli_get_host_info($link));
?>