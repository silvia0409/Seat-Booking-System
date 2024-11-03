<?php
//----INCLUDE APIS------------------------------------
include("api/api.inc.php");

function createPage(){
    
$tcontent=  <<<PAGE
    <link rel="stylesheet" href= "./css/site.css" >

  
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    </head>


    <body>
    <section>
    <section id="Login Form">
    <div class ="wrapper">
         <div class="form-box login">
            <h2>Login</h2><br><br>
            <form action="login_validation.php" method="post">
                <div class="input-box">
                <span class="icon">
                    <ion-icon name="key-outline"></ion-icon>
                </span>
                  username:<br> <input type = "text" placeholder="Enter your username" name = "username" /><br><br>
                </div>
                <div class="input-box">
                    <span class="icon">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                </span>
                    password:<br> <input type = "text" placeholder=" Enter your password" name = "password" />
                    <a href= "profile.php">
                    <br><br><br>
                    <input type="submit" value="Submit"/>
                
                <br><br><br>
                
                <a href= "UserRegistration.php">If not a registered user, register here.</a>
                <br>
                </div>
                
         </form>
        </div>
       
       </section>
    </div>
   

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>

PAGE;
return $tcontent;
}

//----BUSINESS LOGIC---------------------------------
//Start up a PHP Session for this user.
session_start();

//Build up our Dynamic Content Items. 
$tpagetitle = "Login Page";
$tpagelead  = "<h3>.</h3>";;

$tpagecontent = createPage();
$tpagefooter = "";

//----BUILD OUR HTML PAGE----------------------------
//Create an instance of our Page class
$tpage = new MasterPage($tpagetitle);
//Set the Three Dynamic Areas (1 and 3 have defaults)
if(!empty($tpagelead))
    $tpage->setDynamic1($tpagelead);
$tpage->setDynamic2($tpagecontent);
if(!empty($tpagefooter))
    $tpage->setDynamic3($tpagefooter);
//Return the Dynamic Page to the user.    
$tpage->renderPage();


?>
