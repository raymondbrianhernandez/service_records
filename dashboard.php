<?php

require("../private/secure.php");
require_once("../private/db_config.php");
/* include("debug.php"); */
session_start();

$newAddr     = $con->query('SELECT COUNT(status) FROM householders WHERE owner='.'"'.$_SESSION['owner'].'" AND status="new"')->fetch_row()[0];
$validAddr   = $con->query('SELECT COUNT(status) FROM householders WHERE owner='.'"'.$_SESSION['owner'].'" AND status="valid"')->fetch_row()[0];
$invalidAddr = $con->query('SELECT COUNT(status) FROM householders WHERE owner='.'"'.$_SESSION['owner'].'" AND status="invalid"')->fetch_row()[0];
$blockedAddr = $con->query('SELECT COUNT(status) FROM householders WHERE owner='.'"'.$_SESSION['owner'].'" AND status="do not call"')->fetch_row()[0];
$total = $newAddr + $validAddr + $invalidAddr + $blockedAddr;

$accountOwner = $con->query('SELECT COUNT(status) FROM householders WHERE owner='.'"'.$_SESSION['owner'].'" AND status="new"')->fetch_row()[0];

?>

<!DOCTYPE html>
<html lang="en">
<!-- 
________________________________________________________
__|____|____|______|___|____|____|_____|___|_______|____
___|__|______|____|___|___/\__|____|__|___|__/\__|___|__
____|__|___|__|__\  |____|  |____|__|___|____)/_|___|___
_\__  \__\    _ \_| __ \_|  |  \_|  |_/  _ \____/  ___/_
__/ __ \__|  |_\/_| \_\ \|      \|  |\   __/____\__  \__
_(____  /_|__|____|___  /|___|  /|__|_\___  /|_/____  \_
___|__\/___|__________\/______\/__|_______\/_____|__\/__
_____|______|______|_______|___|___|___|___________|____
________________________________________________________
______|_____|___|____|_____|___|_|_____|__|____|___|____
____|___|__|___|______|______|_____|__|____|__|___|_____
__|___|_____|______|__|___|___|_|__|___|_______|________
___/  ___/_/  _ \_\    _ \\  \/ /|  |_/ ___\__/  _ \____
___\__  \_\   __/__|  |_\/_\   /_|  |\  \____\   __/____
__/____  \_\___  /_|__|___|_\_/__|__|_\___  /_\___  /___
____|__\/______\/___|_______|_____|_______\/______\/____
______|_____|________|________|____|____|______|________
________________________________________________________
___|______|___|___|__|_______|_____|______|___|_____|___
____|____|___|___|____|___|_________|____|___|____|___|_
__|__|_____|_______|_______|______|__|______|  /_|___|__
\    _ \_/  _ \__/ ___\__/ __ \_\    _ \_/ __ |__/  ___/
_|  |_\/\   __/_\  \____(  \_\ )_|  |_\// /_/ |__\__  \_
_|__|____\___  /_\___  /_\____/__|__|___\____ |_/____  \
__|__________\/______\/___|_______|__________\/___|__\/_
___|______|________|________|______|______|_________|___ 
-->
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Service Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" media="all" href="./stylesheets/charts.min.css" />
    <link rel="stylesheet" media="all" href="./stylesheets/phpvariables.php" />
    <link rel="stylesheet" media="all" href="./stylesheets/dashboard.css?v=1" />
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
                        <p><h4><b>
                        <?php
                            date_default_timezone_set("America/Los_Angeles");  
                            $h = date('G');

                            if ($h>=5 && $h<=11) {
                                echo "Good morning, " . $_SESSION['owner'];
                            } else if ($h>=12 && $h<=15) {
                                echo "Good afternoon, " . $_SESSION['owner'];
                            } else {
                                echo "Good evening, " . $_SESSION['owner'];
                            }
                        ?>  
                        </b></h4></p>
                        <br>
                    </div>
                </div>

                <!-- ACCOUNT INFORMATION -->
                <button type="button" class="collapsible">
                    <h5><b> Click to view account information </b></h5>
                </button>
                <div class="content" id="update-info">
                    <form action="account.php" method="post"> 
                        <br>
                        <p><span><b> Name: </b></span><?= $_SESSION['owner']; ?></p>
                        <p><span><b> Username: </b></span><?= $_SESSION['username']; ?></p>
                        <p><span><b> Goal: </b></span><?= $_SESSION['goal']; ?></p>
                        <p><b> Change goal: </b><span style="font-size:medium; color:red;">
                        </p>
                        <p>
                            <?php include ( 'goals.php' ); ?>
                        </p>
                        <hr>
                        <p style="text-align:center"><b> Overseer Contact Information </b></p>
                        <div class="row">
                            <div class="col-25">
                                <label for="elder-name"> Overseer's name: </label>
                            </div>
                            <div class="col-75">
                                <input type="text" name="elder_name" value="<?= $_SESSION['elder_name']; ?>" >
                            </div>
                            <div class="col-25">
                                <label for="elder-email"> Overseer's Email: </label>
                            </div>
                            <div class="col-75">
                                <input type="email" name="elder_email" value="<?= $_SESSION['elder_email']; ?>" >
                            </div>
                            <div class="col-25">
                                <label for="elder-phone"> Overseer's Phone: </label>
                            </div>
                            <div class="col-75">
                                <input type="tel" name="elder_phone" value="<?= $_SESSION['elder_phone']; ?>" >
                            </div>
                            <div class="col-25">
                                <label for="carrier"> Phone Carrier: </label>
                            </div>
                            <div class="col-75">
                                <select name="carrier">
                                    <option value=""> </option>    
                                    <option value="@msg.fi.google.com"> Google Fi </option>
                                    <option value="@vtext.com"> Verizon </option>
                                    <option value="@txt.att.net"> AT&T </option>
                                    <option value="@tmomail.net"> T-Mobile </option>
                                    <option value="@messaging.sprintpcs.com"> Sprint </option>
                                </select>
                                <p style="color:red;font-size:14px;"><i> Verizon have delays. </i></p>
                            </div>
                            
                        </div>
                        <hr>
                        <p style="text-align:center"><b> Change Email </b></p>
                        <div class="row">
                            <div class="col-25">
                                <label for="email"> Type New Email: </label>
                            </div>
                            <div class="col-75">
                                <input type="text" name="email" value=<?= $_SESSION['email']; ?> >
                            </div>
                        </div>

                        <p style="text-align:center"><b> Change password </b></p>
                        <div class="row">
                            <div class="col-25">
                                <label for="owner-password"> Type New Password: </label>
                            </div>
                            <div class="col-75">
                                <input type="password" name="owner-password" value=<?= $_SESSION['password']; ?> required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-25">
                                <label for="owner-password2"> Re-type Password: </label>
                            </div>
                            <div class="col-75">
                                <input type="password" name="owner-password2" value=<?= $_SESSION['password']; ?> required>
                            </div>
                        </div>

                        <div class="row" style="justify-content:center;">
                            <br>
                                <button id="greenbutton" type="submit" style="width:50%"> Update </button>
                            <br>
                        </div>

                    </form>
                    <br>
                </div>
                <!-- END ACCOUNT INFORMATION -->
                <hr>
                <?php include("../private/blog.php"); ?>
                <hr>
                <div class="row d-flex justify-content-center">
                    <h4><b> Territories Summary </b></h4>
                    <!-- PIE CHART -->
                    <div class="piechart">
                        <style>
                            .piechart {
                                margin-top: 0px;
                                display: block;
                                width: 200px;
                                height: 200px;
                                border-bottom: 10px;
                                border-radius: 50%;

                                <?php if ( $total == 0 ) { ?>
                                    background-image: conic-gradient(
                                        purple 0 90deg
                                    );
                                <?php } else { ?>
                                    background-image: conic-gradient(
                                        lightblue   <?= ($newAddr/$total)*100 ?>%, 
                                        lightgreen  <?= ($newAddr/$total)*100 ?>% <?= (($newAddr + $validAddr)/$total) * 100 ?>%, 
                                        orange      <?= (($newAddr + $validAddr)/$total) * 100 ?>% <?= (($newAddr + $validAddr + $invalidAddr)/$total) * 100 ?>%,
                                        red         <?= (($newAddr + $validAddr + $invalidAddr)/$total) * 100 ?>% <?= (($newAddr + $validAddr + $invalidAddr + $blockedAddr)/$total) * 100 ?>%
                                    );
                                <?php } ?>
                            }
                        </style>
                    
                    </div>
                    <div style="text-align:center">
                        <br>
                        <p style="color:lightblue"><b> New: <?php echo $newAddr; ?></b><p>
                        <p style="color:lightgreen"><b> Valid: <?php echo $validAddr; ?></b><p> 
                        <p style="color:orange"><b> Invalid: <?php echo $invalidAddr; ?></b><p>
                        <p style="color:red"><b> Do not call: <?php echo $blockedAddr; ?></b><p>
                    </div>
                
                <hr>
                
                <!-- ADD NEW RECORD -->
                <button type="button" class="collapsible">
                    <h5><b> Click to add new record </b></h5>
                </button>
                <div class="content">
                    <br>
                    <form action="insert.php" method="post">
                        <!-- Get the hidden values -->
                        <input type="hidden" name="id" value="<?= $row['Address_ID']; ?>" >
                        <input type="hidden" name="dropdown" value="<?= $row['Status']; ?>" >
                    
                        <div class="row">
                            <div class="col-25">
                                <label for="status"> Status: </label>
                            </div>
                            <div class="col-75">
                                <select name = "status">
                                    <option value = "New"> New </option>
                                    <option value = "Valid"> Valid </option>
                                    <option value = "Invalid"> Invalid </option>
                                    <option value = "Do not call"> Do not call </option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-25">
                                <label for="name"> Name: </label>
                            </div>
                            <div class="col-75">
                                <input type="text" name="name" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-25">
                                <label for="suite"> Suite: </label>
                            </div>
                            <div class="col-75">
                                <input type="text" name="suite" >
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-25">
                                <label for="address"> Address: </label>
                            </div>
                            <div class="col-75">
                                <input type="text" name="address" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-25">
                                <label for="city"> City: </label>
                            </div>
                            <div class="col-75">
                                <input type="text" name="city" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-25">
                                <label for="province"> State: </label>
                            </div>
                            <div class="col-75">
                                <select name="province">
                                    <option value="CA">California</option>
                                    <option value="AL">Alabama</option>
                                    <option value="AK">Alaska</option>
                                    <option value="AZ">Arizona</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="CO">Colorado</option>
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="DC">District Of Columbia</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="HI">Hawaii</option>
                                    <option value="ID">Idaho</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IN">Indiana</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NV">Nevada</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="OH">Ohio</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="OR">Oregon</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="TX">Texas</option>
                                    <option value="UT">Utah</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WA">Washington</option>
                                    <option value="WV">West Virginia</option>
                                    <option value="WI">Wisconsin</option>
                                    <option value="WY">Wyoming</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-25">
                                <label for="postal_code"> Zip code: </label>
                            </div>
                            <div class="col-75">
                                <input type="text" name="postal_code" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-25">
                                <label for="telephone"> Telephone: </label>
                            </div>
                            <div class="col-75">
                                <input type="text" name="telephone" >
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-25">
                                <label for="notes"> Notes: </label>
                            </div>
                            <div class="col-75">
                                <textarea rows="4" cols="auto" name="notes" required></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row" style="justify-content:center;">
                            <br>
                            <button id="greenbutton" type="submit" style="width:50%"> Add </button>
                            <br>
                        </div>

                    </form>
                    <br>
                </div>
                <!-- END ADD NEW RECORD -->
            </div> <!-- main body -->
            <hr>
            
            <div>
                <?php include("../private/shared/footer.php"); ?>
            </div>

        </div> <!-- Parent -->
    </header>   

</body>
</html>

<script>
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }
</script>