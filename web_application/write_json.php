<?php

//saving user profile information onto json file
function SaveOntoJson() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve data from POST request to ensure security
        $username = $_POST["username"];
        $firstName=$_POST["fname"];
        $last_name=$_POST["lastName"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        
        // Prepare data to be written into JSON
        $newUserData = array(
            'username' => $username,
            'fname' => $firstName,
            'lastName'=> $last_name,
            'email' => $email,
            'password' => $password
        );

        // Read existing JSON file
        $jsonData = file_get_contents('json/profile.json');

        // Decode JSON file
        $existingData = json_decode($jsonData, true);

        // Append new user data to existing data
        $existingData[] = $newUserData;

        // Encode updated data to JSON and formatting it for readability
        $updatedJsonData = json_encode($existingData, JSON_PRETTY_PRINT);

        // Write JSON data back to the file
        file_put_contents('json/profile.json', $updatedJsonData);

        // User gets redirected to the login page where they will be able to input this information
        header('Location: login.php');
        exit;
    }

}
SaveOntoJson();
?>