<?php
   ob_start();
   SESSION_start();
?>
<?php require_once 'styleLogin.php';
      require_once 'inc/manager-db.php';

      
?>

<html lang = "en">
   
   <head>
      <title>Geoworld</title>
      <link href = "css/bootstrap.min.css" rel = "stylesheet"> 
   </head>



	
   <body>
      
     
    
         
         <?php
                     
                     if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {

                        $connect = getUsers($_POST['username'],$_POST['password']);
                        if($connect != ""){

                           $_SESSION['username']=$_POST['username'] ;
                           echo "<script type='text/javascript'>window.top.location='index.php';</script>";
                        }else{
                           echo 'Username or password incorrect';
                        }
                     
                        
                     
                  }
         ?>

  
         
  <div class="loginbox">
      <img src="images/avatar5.png" class="avatar">
      <h1 class="login-title">Log in</h1>
      <form class="form" method="post" name="login">
          <input type="text" class="login-input" name="username" placeholder="Nom d'utilisateur" autofocus="true" required/>
          <input type="password" class="login-input" name="password" placeholder="Mot de passe" required/>
          <input type="submit" value="Connexion" name="login" class="login-button" />         
          <a href = "register.php" style= "text-align: center">register
  </div>
  














      
   </body>
</html>