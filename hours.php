<?php

require("../private/secure.php");
require_once("../private/db_config.php");
/* include("debug.php"); */
session_start();

$newAddr     = $con->query('SELECT COUNT(status) FROM householders WHERE owner='.'"'.$_SESSION['owner'].'" AND status="new"')->fetch_row()[0];
$validAddr   = $con->query('SELECT COUNT(status) FROM householders WHERE owner='.'"'.$_SESSION['owner'].'" AND status="valid"')->fetch_row()[0];;
$invalidAddr = $con->query('SELECT COUNT(status) FROM householders WHERE owner='.'"'.$_SESSION['owner'].'" AND status="invalid"')->fetch_row()[0];;
$blockedAddr = $con->query('SELECT COUNT(status) FROM householders WHERE owner='.'"'.$_SESSION['owner'].'" AND status="do not call"')->fetch_row()[0];;
$total = $newAddr + $validAddr + $invalidAddr + $blockedAddr;

$accountOwner = $con->query('SELECT COUNT(status) FROM householders WHERE owner='.'"'.$_SESSION['owner'].'" AND status="new"')->fetch_row()[0];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Service Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" media="all" href="./stylesheets/charts.min.css" />
    
    <link rel="stylesheet" media="all" href="./stylesheets/phpvariables.php" />
    <link rel="stylesheet" media="all" href="./stylesheets/dashboard.css?v=1" />
    <link rel="stylesheet" media="all" href="./stylesheets/global_overides.css" />
    <!-- Map Libre -->
    <script src='https://unpkg.com/maplibre-gl@2.4.0/dist/maplibre-gl.js'></script>
    <link href='https://unpkg.com/maplibre-gl@2.4.0/dist/maplibre-gl.css' rel='stylesheet' />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header>
        <?php include("../private/shared/navigation.php"); ?>
    
        <div class="parent">
            <div class="leftborder"></div>
            <div class="rightborder"></div>

            <div class="mainbody">
                <!-- Start: Login Form Basic -->
                <div class="container">
                    <div class="row d-flex justify-content-center"> 
                    <!-- MAIN CONTENT HERE -->
                    <div class="welcome">
                        <p><h4><b> Welcome, <?= $_SESSION['owner']; ?> </b></h4></p><hr>
                    </div>
                </div>    
                
                <div class="row d-flex justify-content-center">
                    <table class="charts-css bar show-labels show-heading data-spacing-10" id="territories">
                        <caption><h4><b> Territories Summary </b></h4></caption>
                        <tbody>
                            <tr>
                                <th scope="row"> New </th>
                                <td style="--size: calc( <?php echo ($newAddr)/$total ?> ); --color: lightblue"> 
                                    <span class="data"><?php echo $newAddr; ?></span> 
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"> Valid </th>
                                <td style="--size: calc( <?php echo ($validAddr)/$total ?> ); --color: lightgreen"> 
                                    <span class="data"><?php echo $validAddr; ?></span> 
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"> Invalid </th>
                                <td style="--size: calc( <?php echo ($invalidAddr)/$total ?> ); --color: orange"> 
                                    <span class="data"><?php echo $invalidAddr; ?></span> 
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"> Do not call </th>
                                <td style="--size: calc( <?php echo ($blockedAddr)/$total ?> ); --color: red"> 
                                    <span class="data"><?php echo $blockedAddr; ?></span> 
                                </td>
                            </tr>
                        </tbody>
                    </table>   
                </div>
                
                <hr>
                
                <form action="insert.php" method="post">
                    <table class="add-entry">
                    <h4><b> Add new record </b></h4>
                        <tr>
                            <td>
                                <label for="status"> Status: </label>
                                <select name = "status">
                                    <option value = "New"> New </option>
                                    <option value = "Valid"> Valid </option>
                                    <option value = "Invalid"> Invalid </option>
                                    <option value = "Do not call"> Do not call </option>
                                </select><br>

                                <label for="name"> Name: </label>
                                <input type="text" name="name"><br>            
                                
                                <label for="suite"> Suite: </label>
                                <input type="text" name="suite"><br>
                                
                                <label for="address"> Address: </label>
                                <input type="text" name="address"><br>
                                
                                <label for="city"> City: </label>
                                <input type="text" name="city"><br>
                                
                                <label for="province"> State: </label>
                                <input type="text" name="province"><br>
                                
                                <label for="postal_code"> Zipcode: </label>
                                <input type="text" name="postal_code"><br>
                                
                                <label for="telephone"> Telephone: </label>
                                <input type="text" name="telephone"><br>
                                
                                <!-- Get the readonly values -->
                                <input type="hidden" name="id" value="<?= $row['Address_ID']; ?>" >
                                <input type="hidden" name="dropdown" value="<?= $row['Status']; ?>" >
                            
                                <label for="notes"> Notes: </label>
                                <textarea rows="4" cols="70" name="notes"></textarea><br>
                            </td>
                        </tr>
                    </table>
                    <div style="text-align: center;">
                        <br>
                        <button id="greenbutton" type="submit"> Add new record </button>
                    </div>
                </form>

                <hr>

                <div class="row d-flex justify-content-center">
                    <form action="account.php" method="post">
                        <table class="add-entry" >
                            <h4><b> Account Information </b></h4><br>   
                            <tr>
                            <td width="50%">
                                    <p>
                                        <span><b> Name: </b></span><?= $_SESSION['owner']; ?>
                                    </p>
                                    <p>
                                        <span><b> Username: </b></span><?= $_SESSION['username']; ?>
                                    </p>
                                    <p>
                                        <span><b> E-mail: </b></span><?= $_SESSION['email']; ?>
                                    </p>
                                </td>
                                <td width="50%">
                                    <p>
                                        <b> Change password </B>
                                    </p>
                                    <label for="owner-password"> Type New Password: </label>
                                    <input type="password" name="owner-password"><br>
                                    
                                    <label for="owner-password2"> Re-type Password: </label>
                                    <input type="password" name="owner-password2"><br>
                                
                                </td>
                            </tr>
                        </table>
                        <div style="text-align: center;">
                            <br>
                            <button id="greenbutton" type="submit"> Change password </button>
                        </div>
                    </form>
                </div>
            </div>

            <div>
                <footer class="text-center">
                    <div class="container text-muted py-4 py-lg-5">
                        <p class="mb-0">&copy; 
                            <?php echo date('Y'); ?> Service Records | <a href="https://www.arbhie.com" target="_blank">arbhie.com</a> by Raymond Hernandez
                        </p>
                    </div>
                </footer>
            </div>

        </div> <!-- Parent -->
    </header>   

</body>
</html>