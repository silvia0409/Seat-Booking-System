<?php 
//----INCLUDE APIS------------------------------------
include("api/api.inc.php");

//----PAGE GENERATION LOGIC---------------------------

function createPage()
{   
   
    
//retrieving album data from json file
    $albums_data = json_decode(file_get_contents('json/albums.json'), true);
    // Initialize variables
    $album_titles = array();
    $album_artists = array();

    // Loop through each album and extract values
    foreach ($albums_data as $album) {
        // Extract values
        $album_titles[] = $album['Album'];
        $album_artists[] = $album['Artist'];
    }
   
$tcontent = <<<PAGE
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="description">
                    <h4>This website provides a deep insight on a selection of albums. 
                    Here you will be able to find details about  albums such as their genre, artists and so much more.
                    You will also be able to provide a rating and a comment through a form and select your favourite album! </h4>
            </div>
            
            <div class= "album">
                <h1>Album 1</h1>
                <img src = "./albums cover/Miseducation.jpg"
                width="300"
                height="300">
                <h4> Album name: $album_titles[0] </h4>
                <h4>Artist: $album_artists[0] </h4>

                <a href="individualAlbum1.php"></a>
                <button id="1"> Find out More about this album </button>
                
                
                <script>
                        const button1= document.getElementById("1");
            
                    const url = "http://localhost/4222COMP/MUSICREC_WEBSITE/web_application/individualAlbum1.php?";
            
                    const obj= {
                        v1: "id=1",
                        v2:"Miseducation",
                        v3:"Lauryn",
                    
                    };
            
                    const searchParams= new URLSearchParams(obj);
                    console.log(searchParams);
            
                    const queryString=searchParams.toString();
                    console.log(queryString);
            
                    button1.addEventListener("click" , function(){
                        
                        window.location.href =url+ queryString;
            
                    });
            
                </script>
        
                

                <h1>Album 2</h1>
                <img src = "./albums cover/ctrl.jfif"
                width="300"
                height="300">
                <h4> Album name: $album_titles[1] </h4>
                <h4>Artist: $album_artists[1] </h4>

                <a href="individualAlbum2.php"> </a>
                <button id="button2"> Find out More about this album </button>
            
                <script>
                    const button2= document.getElementById("button2");
            
                    const url2 = "http://localhost/4222COMP/MUSICREC_WEBSITE/web_application/individualAlbum2.php?";
            
                    const obj2= {
                        b1: "id=2",
                        b2:"SZA",
                        b3:"CTRL",
                    
                    };
            
                    const searchParams2= new URLSearchParams(obj2);
                    console.log(searchParams2);
            
                    const queryString2=searchParams2.toString();
                    console.log(queryString2);
            
                    button2.addEventListener("click" , function(){
                        
                        window.location.href =url2+ queryString2;
            
                    });
        
                </script>

                <h1>Album 3</h1>
                <img src = "./albums cover/danCeaser.jfif"
                width="300"
                height="300">
                <h4> Album name: $album_titles[2] </h4>
                <h4>Artist: $album_artists[2] </h4>

                <a href="individualAlbum3.php"> </a>
                <button id="button3"> Find out More about this album </button>
            
                <script>
                    const button3= document.getElementById("button3");
            
                    const url3 = "http://localhost/4222COMP/MUSICREC_WEBSITE/web_application/individualAlbum3.php?";
            
                    const obj3= {
                        d1: "id=3",
                        d2:"Freudian",
                        d3:"Dan",
                    
                    };
            
                    const searchParams3= new URLSearchParams(obj3);
                    console.log(searchParams3);
            
                    const queryString3=searchParams3.toString();
                    console.log(queryString3);
            
                    button3.addEventListener("click" , function(){
                        
                        window.location.href =url3+ queryString3;
            
                    });
            
                </script>
        </div>

            
        <div class="row">
            <div class="alert alert-dismissible alert-warning">
                <button class="close" type="button" data-dismiss="alert">&times;</button>
                <h4>Welcome!</h4>
                <p>This site is updated on a weekly basis. Make sure you check back regularly.</p>
                </div>
            </div>
        </div>
            
    </body>

      
PAGE;
return $tcontent;
}

//----BUSINESS LOGIC---------------------------------
//Start up a PHP Session for this user.
session_start();

//Build up our Dynamic Content Items. 
$tpagetitle = "Home Page";
$tpagelead  = "<h3>Welcome! <br><br> Explore albums<br><br>Fall in love with music</h3>";

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