<?php
//----INCLUDE APIS------------------------------------
include("api/api.inc.php");


function createPage(){

 //retrieving user profile data
    $profile_data = json_decode(file_get_contents('json/profile.json'), true);

// Check if file contents are not empty
if (!empty($profile_data)) {

    $username = "";
    $firstName="";
    $last_name="";
    $email = "";
    $password = "";

    foreach ($profile_data as $info){
        $username = $info["username"];
        $firstName=$info["fname"];
        $last_name=$info["lastName"];
        $email = $info["email"];
        $password = $info["password"];
    }

} else {
    echo '<script>alert("You must first register an account!")</script>';
    echo '<script>window.location.href = "UserRegistration.php";</script>';
}

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
        let y= document.forms["LoginForm"]["Newpassword"].value;
        
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
        let mail= document.forms["LoginForm"]["Newemail"].value;
        

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
        let Name= document.forms["LoginForm"]["NewFname"].value;
        
        if(Name.length == 0 && Name.length<2){
            alert(' **A first name of appropriate length is required');
            return false;
            }
            return true;
    }

    function ValidateLastName(){
        let lname= document.forms["LoginForm"]["NewlastName"].value;
        
        if(lname.length == 0 && lname.length<2){
            alert(' **A last name of appropriate length is required');
            return false;
            }
        return true;
    }

    function ValidateUsername(){
        let userN= document.forms["LoginForm"]["Newusername"].value;

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

    
    <div class= "profile">
    <h1>Your details</h1><br>
    <h4> Username:<br> $username</h4>
    <h4>First name:<br> $firstName </h4>
    <h4> Last name:<br> $last_name </h4>
    <h4>Email address:<br> $email </h4>
    
</div>


    <section>
        <section id="Register Form">
            <div class ="Profilewrapper">
                <h2>Welcome to your profile!</h2>
                <h3> You can update your details below!</h3><br><br>
            <div class="form-box login ">

                
                
                <form name="LoginForm" action="update_json.php" onsubmit="return ValidateForm()" method="post">
                    <div class="input-box">
                    <span class="icon">
                        <ion-icon name="key-outline"></ion-icon>
                    </span>
                        username: <br> <input type = "text" placeholder="Update username" name = "Newusername" /><br><br>
                    </div>
                    <div class="input-box">
                    <span class="icon">
                        <ion-icon name="accessibility-outline"></ion-icon>
                    </span>
                        first name: <br><input type= "text" placeholder="Update first name" name= "NewFname" /> <br><br>
                        </div>
                    <div class="input-box">
                    <span class="icon">
                        <ion-icon name="people-outline"></ion-icon>
                    </span>
                        last name: <br> <input type ="text" placeholder="Update last name" name="NewlastName"/> <br><br>
                    </div>
                    <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail-open-outline"></ion-icon>
                    </span>
                        email : <br><input type= "text" placeholder="Update your email" name="Newemail" /> <br><br>
                       
                    </div>
                    <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </span>
                        password: <br><input type = "text" placeholder= "Update your password" name ="Newpassword" />
                        
                        <br><br><input type="submit" value="Submit"><br><br><br<br>
                    </div>

                     </div>
                     
            
            </form>
            </div>
            
    </section>

   
   


    <section>
        <section id= "FavouriteAlbum">
            <div class="Selection">
            <br><br><br>
            <h2> Select your favourite album</h2><br><br>
              
                    <div class="Image">
                    <img src = "./albums cover/Miseducation.jpg"
                    width="200"
                    height="200"><br><br>

                    <button id= "button" onclick="NewContent1()">Select as favourite album</button><br><br>
                    <a href="individualAlbum2.php">Visit album page</a>

                    </div>
                    <script>

                    function NewContent1() {
                    var button1 = document.getElementById("button");
                    
                    // Check current text content
                    if (button1.textContent === "Select as favourite album") {
                        // Change to new content
                        button1.textContent = "Favourite album!";
                    } else {
                        // Change back to original content
                        button1.textContent = "Select as favourite album";
                    }
                    }
                </script>
                    
                    
                    
                                        
                    

                    <div class="Image">
                    <img src = "./albums cover/ctrl.jfif"
                    width="200"
                    height="200"><br><br>
                    
                    
                    <button id= "button1" onclick="NewContent()">Select as favourite album</button><br><br>
                    <a href="individualAlbum2.php">Visit album page</a>

                    </div>
                    <script>

                    function NewContent() {
                    var button = document.getElementById("button1");
                    
                    // Check current text content
                    if (button.textContent === "Select as favourite album") {
                        // Change to new content
                        button.textContent = "Favourite album!";
                    } else {
                        // Change back to original content
                        button.textContent = "Select as favourite album";
                    }
                    }
                </script>
                    
                    

                    <div class="Image">
                    <img src = "./albums cover/danCeaser.jfif"
                    width="200"
                    height="200"><br><br>
                    
                    <button id= "button2" onclick="NewContent2()">Select as favourite album</button><br><br>
                    <a href="individualAlbum2.php">Visit album page</a>

                    </div>
                    <script>

                    function NewContent2() {
                    var button2 = document.getElementById("button2");
                    
                    // Check current text content
                    if (button2.textContent === "Select as favourite album") {
                        // Change to new content
                        button2.textContent = "Favourite album!";
                    } else {
                        // Change back to original content
                        button2.textContent = "Select as favourite album";
                    }
                    }
                </script>
                    
                    </div>
                
        </div>   
    </section>
   

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    </body>

PAGE;

    //reading reviews json file to output review on the individual album page
    $reviews_data=json_decode(file_get_contents('json/reviews.json'), true);

    $review_score="";
    $review_comment="";
    
    foreach($reviews_data as $review){

        if ($review['score']){
            $review_score= $review['score'];
            $review_comment=$review['comment'];

    $tcontent.=<<<REVIEW
    <section>
        <div class ="ProfileReview">
            <h3>Your recent review</h3><br>
            <h4>Score given: $review_score </h4><br>
            <h4>Score given: $review_comment </h4>
        </div>
    </section>

    REVIEW;
}

}



return $tcontent;

    //HANDLING ERROR
    // Check if the requested page exists, if not, redirect to the error page
    $requestedPage = basename($_SERVER['REQUEST_URI']); // Get the last part of the URL
    if (!pageExists($requestedPage)) {
        include("error.php"); // Include the error page
        exit; // Stop further execution
}
}






//----BUSINESS LOGIC---------------------------------
//Start up a PHP Session for this user.
session_start();

//Build up our Dynamic Content Items. 
$tpagetitle = "Profile page";
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
