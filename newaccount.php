<?php
    /* include('../public/debug.php'); */
    session_start();      
    include('db_config.php'); 
    
    $username  = $_POST['user'];
    $fullname  = $_POST['name'];  
    $email     = $_POST['email'];  
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $goal      = $_POST['goal'];

    if ($password1 == $password2) {
        /* to prevent from mysqli injection */  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($con, $username);  
        $password = mysqli_real_escape_string($con, $password);

        $sql = "INSERT INTO logins (username, password, name, email, goal) VALUES ('$username', '$password1', '$fullname', '$email', '$goal')";
        mysqli_query($con, $sql);

        ?>
        <script type = "text/javascript">
            alert("Account created. Thank you for registering.");
            window.location = "../public/index.php";
        </script>
    <?php } else { ?>
        <script type = "text/javascript">
            alert("Password doesn't match.");
            window.location = "../public/registration.php";
        </script>
    <?php } ?>