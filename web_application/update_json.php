<?php

//updating the user information
function UpdateJson() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve data from POST request to ensure security
        $username = $_POST["Newusername"];
        $firstName=$_POST["NewFname"];
        $last_name=$_POST["NewlastName"];
        $email = $_POST["Newemail"];
        $password = $_POST["Newpassword"];

        
        // Prepare data to be written into JSON
        $newUserData = array(
            'username' => $username,
            'fname' => $firstName,
            'lastName'=> $last_name,
            'email' => $email,
            'password' => $password
        );

        // Read existing JSON file
        $jsonData = file_get_contents('profile.json');

        // Decode JSON file
        $existingData = json_decode($jsonData, true);

        // Append new user data to existing data
        $existingData[] = $newUserData;

        // Encode updated data to JSON and formatting it for readability
        $updatedJsonData = json_encode($existingData, JSON_PRETTY_PRINT);

        // Write JSON data back to the file
        file_put_contents('json/profile.json', $updatedJsonData);

        // user recieves alert to make them aware their information has been changed
        echo '<script>alert("Your details have been updated!")</script>';
        echo '<script>window.location.href = "profile.php";</script>';
    
        exit;
        
    }

}
UpdateJson();
?>