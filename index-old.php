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

        
    <div id="frm">
        <br><br>    
        <form name="form" action="../private/authentication.php" onsubmit = "return validation()" method="POST">  
            <p>  
                <label>Username:</label>  
                <input type="text" id="user" name="user"/>  
            </p>  
            <p>  
                <label>Password:</label>  
                <input type="password" id="pass" name="pass"/>  
            </p>  
            <p>     
                <input type="submit" id="btn" value="Login"/>
                <p style="text-align:center; color:white">Not registered yet? 
                    <a href='registration.php'>Register Here</a>
                </p>  
            </p>  
        </form>
        
    </div>
        
<!-- <?php include('../private/shared/footer.php'); ?> -->