<?php
    /* Paste on all pages that needs to be logged in first */
   session_start();
   if(empty($_SESSION['logged_in'])) {
      header('Location: index.php');
      exit;
   }
   /* End of secure script */
?>