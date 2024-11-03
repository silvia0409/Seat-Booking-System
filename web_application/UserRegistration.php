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

    <script>

    //performing input validations 

    function ValidatePassword(){
        let y= document.forms["LoginForm"]["password"].value;
        
        if(y.length == 0){
            alert(' **A password is required');
            return false;
            }
        
        //not allowing user to access the next page without inputting a password
        if(y.length < 8){
            alert(' **Password must have at least 8 digits');
            return false;
        }
        return true;
    }
    


    function ValidateEmail(){
        let mail= document.forms["LoginForm"]["email"].value;
        

        if(mail.length == 0){
            alert(' **Email is required');
            return false;
            }
        //checking if the email is appropriate
        if(!mail.match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/)) {
            alert(' **Input the correct email format ');
            return false;
        }
        //not allowing user to access the next page without inputting an email
        if(mail.length < 3){
            alert(' **Input a valid email');
            return false;
        }
        return true;
    }
   
    function Validatename(){
        let Name= document.forms["LoginForm"]["fname"].value;
        
        if(Name.length == 0 && Name.length<2){
            alert(' **A first name of appropriate length is required');
            return false;
            }
            return true;
    }

    function ValidateLastName(){
        let lname= document.forms["LoginForm"]["lastName"].value;
        
        if(lname.length == 0 && lname.length<2){
            alert(' **A last name of appropriate length is required');
            return false;
            }
        return true;
    }

    function ValidateUsername(){
        let userN= document.forms["LoginForm"]["username"].value;

        if (userN.length == 0 || userN.length<3){
            alert("A username of appropriate length is required");
            return false;
        }
        return true;
    }

    function ValidateForm(){
        if (!ValidateUsername()) {
            return false;
        }
        if (!Validatename()) {
            return false;
        }
        if (!ValidateLastName()) {
            return false;
        }
        if (!ValidateEmail()) {
            return false;
        }
        if (!ValidatePassword()) {
            return false;
        }
       

        // All validations passed, finally loading the login page
        return true;
    }
   

    



    </script>
    
    </head>
    <body>
    <section>
        <section id="Register Form">
            <div class ="wrapper">
                <h2>Register your account!</h2><br>
                
            <div class="form-box login ">
                <form name="LoginForm" action="write_json.php" onsubmit="return ValidateForm()" method="post">
                    <div class="input-box">
                    <span class="icon">
                        <ion-icon name="key-outline"></ion-icon>
                    </span>
                        username: <br> <input type = "text" placeholder="Enter a username" name = "username" /><br><br>
                    </div>
                    <div class="input-box">
                    <span class="icon">
                        <ion-icon name="accessibility-outline"></ion-icon>
                    </span>
                        first name: <br><input type= "text" placeholder="Enter your first name" name= "fname" /> <br><br>
                        </div>
                    <div class="input-box">
                    <span class="icon">
                        <ion-icon name="people-outline"></ion-icon>
                    </span>
                        last name: <br> <input type ="text" placeholder="Enter your last name" name="lastName"/> <br><br>
                    </div>
                    <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail-open-outline"></ion-icon>
                    </span>
                        email : <br><input type= "text" placeholder="Enter your email" name="email" /> <br><br>
                       
                    </div>
                    <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </span>
                        password: <br><input type = "text" placeholder= "Enter a password" name ="password" />
                        <br><br><input type="submit" value="Submit"/>
                    

                    <br><br>
                    <p>Already a registered user?
                    <a href="login.php">Login</a></p>
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
$tpagetitle = "User registration";
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
