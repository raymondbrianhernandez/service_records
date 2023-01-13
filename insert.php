<?php

require("../private/secure.php");
require_once("../private/db_config.php");
/* include("debug.php"); */ 
session_start();

$owner      = $_SESSION['owner'];
$language   = 'Tagalog';
$status     = $_POST['status'];
$name       = $_POST['name'];
$suite      = $_POST['suite'];
$address    = $_POST['address'];
$city       = $_POST['city'];
$province   = $_POST['province'];
$postal_code= $_POST['postal_code'];
$country    = 'USA';
$latitude   = '0';
$longitude  = '0';
$telephone  = $_POST['telephone'];
$notes      = $_POST['notes'];
$notes_private = "";

$add_query  = "INSERT INTO householders ";
$add_query .= "(Owner, Language, Status, Name, Suite, "; 
$add_query .= "Address, City, Province, Postal_code, Country, "; 
$add_query .= "Latitude, Longitude, Telephone, Notes, Notes_private) ";
$add_query .= "VALUES (";
$add_query .= "'" . $owner . "',"; 
$add_query .= "'" . $language . "',";
$add_query .= "'" . $status . "',";
$add_query .= "'" . $name . "',";
$add_query .= "'" . $suite . "',";
$add_query .= "'" . $address . "',";
$add_query .= "'" . $city . "',";
$add_query .= "'" . $province . "',";
$add_query .= "'" . $postal_code . "',";
$add_query .= "'" . $country . "',";
$add_query .= "'" . $latitude . "',";
$add_query .= "'" . $longitude . "',";
$add_query .= "'" . $telephone . "',";
$add_query .= "'" . $notes . "',";
$add_query .= "'" . $notes_private . "'";
$add_query .= ")";

$result = mysqli_query($con, $add_query);

if($result){
    header("Location: territories.php");
} else {
    echo mysqli_error($con);
    /* echo $add_query; */
}

?>