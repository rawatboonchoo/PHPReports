<?php
session_start();
unset($_SESSION['dep_id']);
unset($_SESSION['dep_shortname']);
unset($_SESSION['dep_fullname']);
unset($_SESSION['dep_status']);
header("Location:./login.php");
?>