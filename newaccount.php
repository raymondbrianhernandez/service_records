<?php
    /* include('../public/debug.php'); */
    session_start();      
    include('db_config.php'); 
    
    $username    = $_POST['user'];
    $fullname    = $_POST['name'];  
    $email       = $_POST['email'];  
    $password1   = $_POST['password1'];
    $password2   = $_POST['password2'];
    $goal        = $_POST['goal'];
    $elder_name  = ''; 
    $elder_email = '';
    $elder_phone = '';

    if ($password1 == $password2) {
        /* to prevent from mysqli injection */  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($con, $username);  
        $password = mysqli_real_escape_string($con, $password);

        $sql  = "INSERT INTO logins ";
        $sql .= "(`username`, `password`, `name`, `email`, `goal`, `elder_name`, `elder_email`, `elder_phone`) "; 
        $sql .= "VALUES ";
        $sql .= "('$username', '$password1', '$fullname', '$email', '$gocal', '$elder_name', '$elder_email', '$elder_phone')";
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