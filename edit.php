<?php
require("../private/secure.php");
require_once("../private/db_config.php");
/* include("debug.php"); */
session_start();



$id = $_GET['name'];

$query = 'SELECT @i:=@i+1 AS num, householders.* FROM householders, (SELECT @i:=0) i WHERE owner="'.$_SESSION['owner']. '" ORDER BY Address_ID LIMIT ?,?';

echo $_GET['id'];
echo $_GET['name'];
echo $_GET['address'];
echo $_GET['telephone'];
?>
test
