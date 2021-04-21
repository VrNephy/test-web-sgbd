<?php
   ob_start();
   session_start();
?>
<?php 
      require_once 'inc/manager-db.php';
      require_once 'styleLogin.php';
?>

<html lang = "en">
   
   <head>
      <title>Geoworld</title>
      <link href = "css/bootstrap.min.css" rel = "stylesheet">      
   </head>
	
   <body>
      
     
     
         
         <?php
            
            if (isset($_POST['signin']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirmpassword'])  && $_POST['password']== $_POST['confirmpassword']){
    
               
                $insert = insertUser($_POST['username'],$_POST['password']);
                
                   echo "<script type='text/javascript'>window.top.location='login.php';</script>";
                
    
                  
               
            }
         ?>
     
      
      <div class = "loginbox">
      
         <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <h1 class="login-title" style="  color: white">Register</h1>
            <input type = "text" class = "form-control" 
               name = "username" placeholder = "username" 
               required autofocus></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "password" required>
            <input type = "password" class = "form-control"
               name = "confirmpassword" placeholder = "confirm password" required>   
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "signin">register</button>
               <a href = "login.php" >Login
         </form>
			
        
         
      </div> 
      
   </body>
</html>