<?php
    /* include('../public/debug.php'); */
    session_start();      
    include('db_config.php'); 
    
    $username = $_POST['user'];  
    $password = $_POST['pass'];
      
    /* to prevent from mysqli injection */  
    $username = stripcslashes($username);  
    $password = stripcslashes($password);  
    $username = mysqli_real_escape_string($con, $username);  
    $password = mysqli_real_escape_string($con, $password);  
    
    $sql = "SELECT * 
            FROM logins 
            WHERE username = '$username' and password = '$password'";  
    $result = mysqli_query($con, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result);  
    $_SESSION['owner'] = $row['name'];
        
    if($count == 1){  
        /* echo "<h1><center> Login successful </center></h1>"; */
        /* Redirect browser */
        $_SESSION['logged_in'] = TRUE;
        header("Location: ../public/dashboard.php");
        exit();
    }  
    else{  
        echo "<script>alert('Email or password is incorrect!')</script>";
        /* Redirect browser */
        header("Location: ../public/index.php"); 
        exit();  
    }     
?>