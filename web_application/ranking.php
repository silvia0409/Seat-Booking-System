<?php 
//----INCLUDE APIS------------------------------------
include("api/api.inc.php");

function DisplayPage()
{

$albums_data = json_decode(file_get_contents('json/albums.json'), true);

    // Sorting albums by recommendation score
    
        usort($albums_data, function($a, $b) {
            return $b['PersonalRecScore'] <=> $a['PersonalRecScore']; // Sort in descending order
        });
        
    

    // Initialize the HTML content
    $tcontent = <<<PAGE
    <link rel="stylesheet" href= "./css/site.css">
    <section>
        <section id="Table">
            <div class="ranking">   
                <table>
                    <h4>This is a ranking page displaying a table of the albums from highest to lowest score. Here, you will be able to find information about albums and access their individual pages. </h4>
                    <tr>
                        <th>Cover</th><br>
                        <th>Singer</th><br>
                        <th>Album name</th><br>
                        <th>Genre</th><br>
                        <th>Year</th><br>
                        <th>Recommendation Score  
                        <br>(descending order)</th>
                      
                    </tr>
    PAGE;

    // initiating variable to act as index to loop through pages
    $count=4;

    // Looping through sorted albums and rendering HTML dynamically, if albums get added to the json file they will be reflected on the page
    foreach ($albums_data as $album) {
        $album_title = $album['Album'];
        $album_artist = $album['Artist'];
        $album_genre = $album['Genre'];
        $album_year = $album['ReleaseYear'];
        $album_score = $album['PersonalRecScore'];
        $album_cover=$album["Cover"];

        // incrementing it
        $count --;

        // Appending HTML for each album
        $tcontent .= <<<ALBUM
        <tr>

            <td><img src="{$album_cover}" width="200"
                    height="200"></td>
            <td>{$album_artist}</td>
            <td>{$album_title}<br>
                <a href="individualAlbum{$count}.php">
                <button type="button"> Find out More about this album </button></td>
            <td>{$album_genre}</td>
            <td>{$album_year}</td>
            <td>{$album_score}</td>

        </tr>
    ALBUM;
    }

    // Closing the HTML content
    $tcontent .= <<<PAGE
                </table>
            </div>
        </section>
    </section>
    PAGE;

    return $tcontent;
}

//----BUSINESS LOGIC---------------------------------
//Start up a PHP Session for this user.
session_start();
//Build up our Dynamic Content Items. 
$tpagetitle = "Ranking Page";
$tpagelead  = "<h3><br>Album ranking</h3>";

$tpagecontent = DisplayPage();
// Output the page content

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

