<?php
    require("../private/secure.php");
    require_once("../private/db_config.php");
    include("./php/php_functions.php");
    /* include("debug.php"); */
    session_start();

    $query = 'SELECT @i:=@i+1 AS num, householders.* FROM householders, (SELECT @i:=0) i WHERE owner="'.$_SESSION['owner']. '" ORDER BY Address_ID DESC LIMIT ?,?';

    // Google Maps API
    // $googlemap = "https://www.google.com/maps/search/?api=1&query=";
    $googlemap = "https://www.google.com/maps/dir//";

    // Pagination
    $total_pages = $con->query('SELECT COUNT(status) FROM householders WHERE owner='.'"'.$_SESSION['owner'].'"')->fetch_row()[0];
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
    $_SESSION['page'] = $page;
    $num_results_on_page = 25;
    $_SESSION['offset'] = $num_results_on_page;

    // Magic table happens...
    if ($stmt = $con->prepare($query)) { // closing brackets at the bottom of HTML
        // Calculate the page to get the results we need from our table.
        $calc_page = ($page - 1) * $num_results_on_page;
        $stmt->bind_param('ii', $calc_page, $num_results_on_page);
        $stmt->execute();
        
        // Get the results...
        $result = $stmt->get_result();
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
    <title>Territories - Service Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> 
    <link rel="stylesheet" media="all" href="./stylesheets/webapp_styles.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./src/javascript.js"></script>
    <!-- Map Libre -->
    <script src='https://unpkg.com/maplibre-gl@2.4.0/dist/maplibre-gl.js'></script>
    <link href='https://unpkg.com/maplibre-gl@2.4.0/dist/maplibre-gl.css' rel='stylesheet' />
</head>
    
<body>
    <header>
        <?php include("../private/shared/navigation.php"); ?>

        <main>
            <!-- Start: Login Form Basic -->
            <section class="position-relative py-4 py-xl-5">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-md-8 col-xl-6 text-center mx-auto">
                            <h2 style="color:black"> House-to-house Records </h2>
                        </div>
                    </div>
                    
                    <div class="map-container">
                        <div id='map'>
                            <script> mapLibre() </script>
                        </div>
                    </div>
                    
                    <br>
                    <div class="row d-flex justify-content-center" id=search>
                        <div class="search-bar">
                            <input type="text" id="search" onkeyup="search()" style="width:100%" placeholder="Search for names...">
                        </div>
                        <hr>
                        <table id="address-table">
                            <tr id="column-header">
                                <th> STATUS     </th>
                                <th> NAME       </th>
                                <th> ADDRESS    </th>
                                <th> MAP        </th>
                                <th> TELEPHONE  </th>
                                <th> NOTES      </th>
                                <th> ACTIONS    </th>
                            </tr>
                            
                        <?php 
                            while ($row = $result->fetch_assoc()):
                            $tempAddr = $row['Address'].' '.$row['City'].' '.$row['Province'].' '.$row['Postal_code'];
                        ?>
                            
                            <tr>
                                <!-- Index Numbers -->  
                                <!-- <td style="text-align:center; width:1px;"> 
                                    //<= $row['num'] + ($page-1) * $num_results_on_page; ?>
                                </td> -->
                                <td style="text-align:center; width:1px;">
                                    <b>
                                    <?php
                                        if ($row['Status'] == "New") { ?>
                                            <span style="color:blue"><?= $row['Status']; ?></span> 
                                    <?php  
                                        } else if ($row['Status'] == "Valid") { ?>
                                            <span style="color:green"><?= $row['Status']; ?></span>
                                    <?php  
                                        } else if ($row['Status'] == "Invalid") { ?>
                                            <span style="color:black"><?= $row['Status']; ?></span>
                                    <?php  
                                        } else if ($row['Status'] == "Do not call") { ?>
                                            <span style="color:red"><?= $row['Status']; ?></span>        
                                    <?php } ?>
                                    </b>
                                </td>
                                <td style="width:80px;">
                                    <b><?= $row['Name']; ?></b>
                                </td>
                                <td style="width:100px;">
                                    <?= $tempAddr; ?>
                                </td>
                                <td style="text-align:center; width:5px;">
                                    <a href="<?= $googlemap.$tempAddr?>" target="_blank"> Directions </a>
                                </td>
                                <td style="text-align:center; width:5px;">
                                    <a href="tel:<?= $row['Telephone']; ?>"><?= $row['Telephone']; ?></a>
                                </td>
                                <td style="width:300px;">
                                    <?= $row['Notes']; ?>
                                </td>
                                <td style="text-align:center; width:100px;">
                                    <button id="greenbutton" data-toggle="toggle"> Edit </button>
                                    <!-- <button id="redbutton" onclick="showOnMap(<?= $tempAddr; ?>);"> Mark </button> -->
                                </td>   
                            </tr>  
                             
                            <tr class="hideTr">
                                <form action="edit.php" method="post">
                                    <td colspan="6">
                                        <label for="name"> Name: </label>
                                        <input type="text" name="name" value="<?= $row['Name']; ?>" ><br>            
                                        
                                        <label for="suite"> Suite: </label>
                                        <input type="text" name="suite" value="<?= $row['Suite']; ?>"><br>
                                        
                                        <label for="address"> Address: </label>
                                        <input type="text" name="address" value="<?= $row['Address']; ?>"><br>
                                        
                                        <label for="city"> City: </label>
                                        <input type="text" name="city" value="<?= $row['City']; ?>"><br>
                                        
                                        <label for="province"> State: </label>
                                        <input type="text" name="province" value="<?= $row['Province']; ?>"><br>
                                        
                                        <label for="postal_code"> Zipcode: </label>
                                        <input type="text" name="postal_code" value="<?= $row['Postal_code']; ?>"><br>
                                        
                                        <label for="telephone"> Telephone: </label>
                                        <input type="text" name="telephone" value="<?= $row['Telephone']; ?>"><br>
                                        
                                        <!-- Get the readonly values -->
                                        <input type="hidden" name="address_id" value="<?= $row['Address_ID']; ?>" >
                                        <input type="hidden" name="dropdown" value="<?= $row['Status']; ?>" >
                                    
                                        <label for="dropdown"> Status: </label>
                                        <select name = "dropdown">
                                            <option value = "Valid"> Valid </option>
                                            <option value = "New"> New </option>
                                            <option value = "Invalid"> Invalid </option>
                                            <option value = "Do not call"> Do not call </option>
                                        </select><br>
                                        <label for="notes"> Notes: </label>
                                        <textarea rows="7" cols="40" name="notes" value=<?= $row['Notes']; ?>><?= $row['Notes']; ?></textarea><br>
                                        <label for="gps"> Geotag: </label>
                                        <input type="text" name="gps" value="<?= $row['Latitude'] .' '.  $row['Longitude']; ?>"><br>
                                    </td>
                                    <td style="text-align:center;">
                                        <button id="greenbutton" type="submit"> Save </button>
                                        <!-- <button id="bluebutton" onclick=<//?php geocode($tempAddr) ?> > Geotag </button> --> 
                                        <button id="redbutton" type="submit" formaction="delete.php"> Delete</button>   
                                    </td>
                                </form>
                            </tr>
                            
                        <?php endwhile; ?>

                        </table>
    
                    </div>

                    <footer>
                        <?php 
                            include('../private/shared/pagination.php');
                            include("../private/shared/footer.php"); 
                        ?>
                    <!-- End: Footer Basic -->
                    </footer>
                                
                </div> <!-- Container -->
            </section>
        <!-- End: Login Form Basic -->
        </main>
    </header>

<?php } ?>
<?php $stmt->close(); ?>

</body>
</html>