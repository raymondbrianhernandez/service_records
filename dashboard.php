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

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Dashboard - Service Records</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" media="all" href="./stylesheets/charts.min.css?"/>
        <link rel="stylesheet" media="all" href="./stylesheets/styles.min.css?v=1"/>
        <link rel="stylesheet" media="all" href="./stylesheets/phpvariables.php?v=1"/>
        
        <!-- Map Libre -->
        <script src='https://unpkg.com/maplibre-gl@2.4.0/dist/maplibre-gl.js'></script>
        <link href='https://unpkg.com/maplibre-gl@2.4.0/dist/maplibre-gl.css' rel='stylesheet' />
    </head>
    
    <body>
        <header>
            <!-- Start: Navbar Right Links (Dark) -->
            <nav class="navbar navbar-dark navbar-expand-md bg-dark py-3">
                <div class="container">
                    <a class="navbar-brand d-flex align-items-center" href="#">
                        <span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor">
                                <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M384 0H96C60.65 0 32 28.65 32 64v384c0 35.35 28.65 64 64 64h288c35.35 0 64-28.65 64-64V64C448 28.65 419.3 0 384 0zM240 128c35.35 0 64 28.65 64 64s-28.65 64-64 64c-35.34 0-64-28.65-64-64S204.7 128 240 128zM336 384h-192C135.2 384 128 376.8 128 368C128 323.8 163.8 288 208 288h64c44.18 0 80 35.82 80 80C352 376.8 344.8 384 336 384zM496 64H480v96h16C504.8 160 512 152.8 512 144v-64C512 71.16 504.8 64 496 64zM496 192H480v96h16C504.8 288 512 280.8 512 272v-64C512 199.2 504.8 192 496 192zM496 320H480v96h16c8.836 0 16-7.164 16-16v-64C512 327.2 504.8 320 496 320z"></path>
                            </svg>
                        </span>
                        
                        <span>Service Records</span>
                    </a>
                    <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-5">
                        <span class="visually-hidden">Toggle navigation</span>
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="navcol-5">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item"><a class="nav-link active" href="dashboard.php">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="territories.php">Territories</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Hours</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Notes</a></li>
                            <li class="nav-item"><a class="nav-link" href="logout.php">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End: Navbar Right Links (Dark) -->
            
            <main>
                <!-- Start: Login Form Basic -->
                <section class="position-relative py-4 py-xl-5">
                    <div class="container">
                        <div class="row d-flex justify-content-center"> 
                        <!-- MAIN CONTENT HERE -->
                        <div class="welcome">
                            <p><h4> Welcome <?php echo $_SESSION['owner']; ?> </h4></p>
                        </div>
                    </div>    
                </section>
                
                <section class="position-relative py-4 py-xl-5">
                    <div class="container">
                        <div class="row d-flex justify-content-center">
                            <table class="charts-css bar show-labels show-heading data-spacing-10" id="territories">
                                <caption><h5>Territories Summary</h5></caption>
                                <tbody>
                                    <tr>
                                        <th scope="row"> New </th>
                                        <td style="--size: calc( <?php echo $newAddr/$total ?> ); --color: lightblue"> 
                                            <span class="data"><?php echo $newAddr; ?></span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> Valid </th>
                                        <td style="--size: calc( <?php echo $validAddr/$total ?> ); --color: lightgreen"> 
                                            <span class="data"><?php echo $validAddr; ?></span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> Invalid </th>
                                        <td style="--size: calc( <?php echo $invalidAddr/$total ?> ); --color: orange"> 
                                            <span class="data"><?php echo $invalidAddr; ?></span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> Do not call </th>
                                        <td style="--size: calc( <?php echo $blockedAddr/$total ?> ); --color: red"> 
                                            <span class="data"><?php echo $blockedAddr; ?></span> 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>   
                        </div>
                    
                </section>
                <!-- End: Login Form Basic -->
            </main>
        </header>
        
        <footer>
            <footer class="text-center">
                <div class="container text-muted py-4 py-lg-5">
                    <p class="mb-0">&copy; 
                        <?php echo date('Y'); ?> Service Records | <a href="https://www.arbhie.com" target="_blank">arbhie.com</a> by Raymond Hernandez
                    </p>
                </div>
            </footer>
        <!-- End: Footer Basic -->
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
