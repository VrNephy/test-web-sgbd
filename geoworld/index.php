<?php
/**
 * Home Page
 *
 * PHP version 7
 *
 * @category  Page
 * @package   Application
 * @author    SIO-SLAM <sio@ldv-melun.org>
 * @copyright 2019-2021 SIO-SLAM
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      https://github.com/sio-melun/geoworld
 */

?>

<?php  
require_once 'header.php'; 
require_once 'inc/manager-db.php'; 
?>

<?php

SESSION_start();
if(!isset($_SESSION['username'])){

  echo "<script type='text/javascript'>window.top.location='login.php';</script>";
}
if(isset($_SESSION['username'])){

  echo "<h1>Welcome ".$_SESSION['username']."</h1>";
}

else{
    echo "titi";

}


if(isset($_GET['continent'])){ 
  
  $continent = $_GET['continent'];
}
else{
  $continent = "";
  
}
  if($continent != ""){
    
  
$desPays = getCountriesByContinent($continent);
?>

<main role="main" class="flex-shrink-0">

  <div class="container">
  <h1>Les pays en <?PHP echo $continent?> </h1>
    
    <div>
     <table class="table">
         <tr>
           <th>Name</th>
           <th>Population</th>
           <th>Continent</th>
           <th>Lifespan</th>
           <th>Language</th>
           <th>Capital</th>
           <?php if ($_SESSION['username'] == "root"){
             ?>
             <th>Action</th>
             
             <?php
           }
           ?>
           
         </tr>
       <?php foreach ($desPays as $pays): ?>
          <tr>
            <td> <?php echo $pays->Name ?></td>
            <td> <?php echo $pays->Population ?></td>
            <td> <?php echo $pays->Continent ?></td>
            <td> <?php echo $pays->LifeExpectancy ,' years'; ?></td>
            <td> <?php $Languages = getNameLanguage( $pays->id);echo $Languages['Name'];?></td>
            <td> <?php $Capital = getNameCapital( $pays->Capital); echo $Capital['Name'];?></td>
            <?php if ($_SESSION['username'] == "root"){
             ?>
             <td> <a href = "edit.php?name=<?php echo $pays->Name ?>&population=<?php echo $pays->Population ?>&continent=<?php echo $pays->Continent ?>&life=<?php echo $pays->LifeExpectancy; ?>&langue=<?php $Languages = getNameLanguage( $pays->id);echo $Languages['Name'];?>&capital=<?php $Capital = getNameCapital( $pays->Capital); echo $Capital['Name'];?>" >Edit</td>
             
             <?php
           }
           ?>

            
          </tr>
          <?PHP endforeach; ?>
     </table>
    </div>
    <p>
        <code>
      
        </code>
    </p>    
  </div>
</main>

<?php
}
require_once 'javascripts.php';
require_once 'footer.php';
?>
