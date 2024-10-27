<?php
   session_start();

   unset($_SESSION['loginUser']);

   header("location: home.php");
?>