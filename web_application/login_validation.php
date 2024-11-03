<?php

function Validate(){

    //reading the data from the json file
    $jsonFilePath = 'json/profile.json';

    $jsonData = file_get_contents($jsonFilePath);

    $user_profile = json_decode($jsonData, true);
    
    $match_found=false;
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $input_username = $_POST["username"];
        $input_password = $_POST["password"];

        foreach ($user_profile as $credential) {
            if ($credential['password'] == $input_password &&  $credential['username']==$input_username) {
                    // Authentication successful
                    $match_found=true;
                    
                    echo '<script>alert("You are now logged in")</script>';
                    echo '<script>window.location.href = "profile.php";</script>';
                }
            } 

        
            if (!$match_found) {
                echo '<script>alert("Invalid username or password. If not a registered user, Register")</script>';
                echo '<script>window.location.href = "login.php";</script>';
                exit;
                
                    
            }
        }       
    
}


    


Validate();



/* if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST["username"];
    $input_password = $_POST["password"];

    if (Validate($input_username, $input_password)) {
        // Authentication successful
         // User gets redirected to the home page when successfully logged in
         header('Location: index.php');
         exit;
    } else {
        // telling user they have inputted an invalid username or password
        echo '<script>alert("Input valid username and password")</script>';
        //header('Location: login.php');
        
        //header("Location: UserRegistration.php");
    }
} */



?>