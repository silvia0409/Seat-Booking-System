<?php
//----INCLUDE APIS------------------------------------
include("api/api.inc.php");


function LoadPage(){
    
    
    //reading album json file to output album information
    $albums_data = json_decode(file_get_contents('json/albums.json'), true);
    
    // Initialize variables
    $album_titles = array();
    $album_artists = array();
    $album_genres=array();
    $album_genres=array();
    $album_time=array();
    $album_titles=array();
    $album_year=array();
    $album_score=array();

    // Loop through each album and extract values
    foreach ($albums_data as $album) {
        // Extract values
        $album_titles[] = $album['Album'];
        $album_artists[] = $album['Artist'];
        $album_genres[]=$album['Genre'];
        $album_year[]=$album['ReleaseYear'];
        $album_score[]=$album['PersonalRecScore'];
        $album_producer[]=$album["Producer"];
        $album_time[]=$album["TotalTimeOfalbum"];
        $album_critique[]=$album["PersonalCritique"];
        
    }

    
    

    $isLoggedin = false; // Initialize $isLoggedin to false as user is not logged in
    $user_data = null;

    $user_data = json_decode(file_get_contents('json/profile.json'), true);

    // Check if user data is not empty (user is logged in)
    if ($user_data !== null && is_array($user_data)) {
        $isLoggedin = true;
    } else {
        $isLoggedin = false;
    }


         

    
    $tcontent=<<<PAGE
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <script>

    // ensuring that the user inputs a numerical value for the score
  
    function ValidateScore() {
        let y = document.forms["ReviewForm"]["score"].value; 
    
        if (y.length == 0) {
            alert('** A score is required');
            return false;
        }
        if (isNaN(y)) {
            alert('** A numerical value is required for the score');
            return false;
        }
    
        return true;
    }
    
    function ValidateComment() {
        let x = document.forms["ReviewForm"]["comment"].value; 
    
        if (x.length == 0) {
            alert('** A comment is required');
            return false;
        }
        return true;
    }

    //validating form by checking that both the score and comment have been validated
    
        function ValidateReview() {
            if (!ValidateScore()) {
                return false;
            }
            if (!ValidateComment()) {
                return false;
            }
            return true;
        }

    </script>
    
    </head>
    <body>

    
   

    <div class= "album">
        <h1>Album 1</h1>
        <img src = "./albums cover/Miseducation.jpg"
        width="300"
        height="300">
        <h4> Album name:<br> $album_titles[0] </h4>
        <h4>Artist:<br> $album_artists[0] </h4>
        <h4> Album genre:<br> $album_genres[0] </h4>
        <h4>Album release year:<br> $album_year[0] </h4>
        <h4> Album producer:<br> $album_producer[0] </h4>
        <h4>Album runtime:<br>$album_time[0] </h4>
        <h4> Personal score:<br>$album_score[0] </h4>
        <h4>Personal critique:<br> $album_critique[0] </h4>
    </div>
    

    <?php

    if ($isLoggedin){

    ?>

    <section>
        <section id= "ReviewSystem">
            <div class="reviewWrapper"><br>
                <h2>Leave a review for the album</h2><br><br>
                <form name ="ReviewForm" action="writeReview_json.php" onsubmit="return ValidateReview()" method="post">
                    <div class="input-box">
                    <span class="icon">
                        <ion-icon name="heart-half-outline"></ion-icon>
                    </span>
                        score: <br><input type = "text" placeholder="Enter a rating score for the album" name= "score"/>
                        <br><br>
                    </div>
                    <div class="input-box">
                    <span class="icon">
                        <ion-icon name="clipboard-outline"></ion-icon>
                    </span>
                        comment: <br><input type= "text" placeholder="Enter a comment about the album" name= "comment" /> 
                        <br><br><br>
                        <input type="submit" value="Submit review"/>
                    </div>
                </form>
             </div>
    </section>
    <?php
    }
    ?>
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
        <div class ="UserReviews">
            <h3>Recent review</h3><br>
            <h4>Score given: $review_score </h4><br>
            <h4>Score given: $review_comment </h4>
        </div>
    </section>

        
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>
    REVIEW;
    }

}


    return $tcontent;


}
//----BUSINESS LOGIC---------------------------------
//Start up a PHP Session for this user.
session_start();

//Build up our Dynamic Content Items. 
$tpagetitle = "Album Page";
$tpagelead  = "<h3>'90s throwback</h3>";

$tpagecontent = LoadPage();
$tpagefooter = "";

//CREATING HTML PAGE
//CREATING INSTANCE OF PAGE
$tpage = new MasterPage($tpagetitle);

//Set the Three Dynamic Areas (1 and 3 have defaults)
if(!empty($tpagelead))
    $tpage->setDynamic1($tpagelead);
$tpage->setDynamic2($tpagecontent);
if(!empty($tpagefooter))
    $tpage->setDynamic3($tpagefooter);
//Return the Dynamic Page to the user.    
$tpage->renderPage();

//  <?php if (isset($_SESSION[$username])); 



?>