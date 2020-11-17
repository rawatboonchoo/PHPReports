<?php
//PHP 7.1
$dbConfig=array(
    "host"      =>"localhost",
    "user"      =>"root",
    "pass"      =>"administrator",
    "dbname"    =>"report",
    "charset"   =>"utf8"
);
$mysqli = @new mysqli($dbConfig["host"],$dbConfig["user"],$dbConfig["pass"],$dbConfig["dbname"]);

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
if(!$mysqli-> set_charset($dbConfig["charset"])){}else{}
?>