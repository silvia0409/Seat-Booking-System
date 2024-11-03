<?php


function SaveReview1() {
    if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
        // Check if the user is on the specific page in oredr to redirect them back to it
        if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'individualAlbum1.php') !== false) {
            // Retrieve data from POST request to ensure security
            $score= $_POST["score"];
            $comment=$_POST["comment"];
        
            
            // Prepare data to be written into JSON file
            $newReviewData = array(
                'score' => $score,
                'comment' => $comment,

            );

            // Read existing JSON file
            $jsonData = file_get_contents('json/reviews.json');

            // Decode JSON file
            $existingData = json_decode($jsonData, true);

            // Append new review data to existing data
            $existingData[] = $newReviewData;

            // Encode updated data to JSON and formatting it for readability
            $updatedJsonData = json_encode($existingData, JSON_PRETTY_PRINT);

            // Write JSON data back to the file
            file_put_contents('json/reviews.json', $updatedJsonData);

            // User gets redirected to the individual album page 
            echo '<script>alert("Your review has been saved!");
                window.location.href = "individualAlbum1.php";</script>';
                
            exit;
        }
    }
}



function SaveReview2() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the user is on the specific page in oredr to redirect them back to it
        if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'individualAlbum2.php') !== false) {
            // Retrieve data from POST request to ensure security
            $score1= $_POST["score1"];
            $comment1=$_POST["comment1"];
        
            
            // Prepare data to be written into JSON file
            $newReviewData = array(
                'score1' => $score1,
                'comment1' => $comment1,

            );

            // Read existing JSON file
            $jsonData = file_get_contents('json/reviews.json');

            // Decode JSON file
            $existingData = json_decode($jsonData, true);

            // Append new review data to existing data
            $existingData[] = $newReviewData;

            // Encode updated data to JSON and formatting it for readability
            $updatedJsonData = json_encode($existingData, JSON_PRETTY_PRINT);

            // Write JSON data back to the file
            file_put_contents('json/reviews.json', $updatedJsonData);

            // User gets redirected to the individual album page 
            
            echo '<script>alert("Your review has been saved!")</script>';
            echo '<script>window.location.href = "individualAlbum2.php";</script>';
            
            exit;
        }
    }

}



function SaveReview3() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the user is on the specific page in oredr to redirect them back to it
        if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'individualAlbum3.php') !== false) {
        // Retrieve data from POST request to ensure security
            $score2= $_POST["score2"];
            $comment2=$_POST["comment2"];
        
            
            // Prepare data to be written into JSON file
            $newReviewData = array(
                'score' => $score2,
                'comment' => $comment2,

            );

            // Read existing JSON file
            $jsonData = file_get_contents('json/reviews.json');

            // Decode JSON file
            $existingData = json_decode($jsonData, true);

            // Append new review data to existing data
            $existingData[] = $newReviewData;

            // Encode updated data to JSON and formatting it for readability
            $updatedJsonData = json_encode($existingData, JSON_PRETTY_PRINT);

            // Write JSON data back to the file
            file_put_contents('json/reviews.json', $updatedJsonData);

            // User gets redirected to the individual album page 
            echo '<script>alert("Your review has been saved!")</script>';
            echo '<script>window.location.href = "individualAlbum3.php";</script>';
            
            exit;
        }
    }

}

SaveReview1();
SaveReview2();
SaveReview3();

?>