<?php
   // LOCAL DEVELOPMENT 
   $host        = "localhost:3307";  
   $user        = "root";  
   $password    = "root";  
   $db_name     = "service_record";
   $con         = mysqli_connect($host, $user, $password, $db_name);
   
   if(mysqli_connect_errno()) {  
       die("Failed to connect with Local MySQL: ". mysqli_connect_error());  
   }   

   // LIVE SERVER
   /*
   $host        = "";  
   $user        = "";  
   $password    = "";  
   $db_name     = "";
   $con         = mysqli_connect($host, $user, $password, $db_name);
   
   if(mysqli_connect_errno()) {  
       die("Failed to connect with Online MySQL: ". mysqli_connect_error());  
   }
   */  
?>
