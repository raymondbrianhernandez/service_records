<!doctype html>

<html lang="en">    
  <head>
    <title>Service Records by arbhie.com</title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="./stylesheets/webapp_styles.css?v=11"/>
  </head>

  <body>
    <header>
      <h2>Service Records</h2>
        &copy; <?php echo date('Y'); ?> arbhie.com
    </header>
    <br>

<?php
    require('../private/db_config.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $name     = stripslashes($_REQUEST['name']);
        $name     = mysqli_real_escape_string($con, $name);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password2= stripslashes($_REQUEST['password2']);
	    $password = mysqli_real_escape_string($con,$password);

       /*  $verifyName = mysqli_query("SELECT name FROM `logins` WHERE name = $name");
        if(mysqli_num_rows($verifyName) >= 1) {
            echo "<div class='form'>
                  <h3>Name already exists.</h3><br/>
                  <p style=text-align:center class='link'>Click <a href='registration.php'>here</a> to try again.</p>
                  </div>";
        } */

        if ($password == $password2){
            $query    = "INSERT INTO `logins` (username, password, name, email) VALUES ('$username', '$password', '$name', '$email')";
            $result   = mysqli_query($con, $query);
        }
        
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p style=text-align:center class='link'>Click here to <a href='index.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Password does not match.</h3><br/>
                  <p style=text-align:center class='link'>Click <a href='registration.php'>here</a> to try again.</p>
                  </div>";
        }
    } else {
?>
    <h2><b>Register new account</b></h2>
    <form class="form" action="" method="post">
        <p>  
            <label>Name:</label>  
            <input type="text" name="name" required/>  
        </p>
        <p>  
            <label>Username:</label>  
            <input type="text" name="username" required/>  
        </p>
        <p>  
            <label>E-mail:</label>  
            <input type="email" name="email" required/>  
        </p>
        <p>  
            <label>Password:</label>  
            <input type="password" name="password" required/>  
        </p>
        <p>  
            <label>Re-type Password:</label>  
            <input type="password" name="password2" required/>  
        </p> 
        <input type="submit" id="btn" value="Register"/>
        <p style="text-align:center; color:white">Already registered? <a href='index.php'>Login Here</a></p>
    </form>
    
<?php } ?>
</body>
</html>