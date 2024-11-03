<?php
//----INCLUDE APIS------------------------------------
include("api/api.inc.php");
//Include our HTML Page Class
require_once("oo_page.inc.php");



class MasterPage
{
    //-------FIELD MEMBERS----------------------------------------
    private $_htmlpage;     //Holds our Custom Instance of an HTML Page
    private $_dynamic_1;    //Field Representing our Dynamic Content #1
    private $_dynamic_2;    //Field Representing our Dynamic Content #2
    private $_dynamic_3;    //Field Representing our Dynamic Content #3
    
    //-------CONSTRUCTORS-----------------------------------------
    function __construct($ptitle)
    {
        $this->_htmlpage = new HTMLPage($ptitle);
        $this->setPageDefaults();
        $this->setDynamicDefaults(); 
    }
    
    //-------GETTER/SETTER FUNCTIONS------------------------------
    public function getDynamic1() { return $this->_dynamic_1; }
    public function getDynamic2() { return $this->_dynamic_2; } 
    public function getDynamic3() { return $this->_dynamic_3; }
    public function setDynamic1($phtml) { $this->_dynamic_1 = $phtml; }
    public function setDynamic2($phtml) { $this->_dynamic_2 = $phtml; } 
    public function setDynamic3($phtml) { $this->_dynamic_3 = $phtml; }
    public function getPage(): HTMLPage { return $this->_htmlpage; } 
    
    //-------PUBLIC FUNCTIONS-------------------------------------
                   
    public function createPage()
    {
       //Create our Dynamic Injected Master Page
       $this->setMasterContent();
       //Return the HTML Page..
       return $this->_htmlpage->createPage();
    }
    
    public function renderPage()
    {
       //Create our Dynamic Injected Master Page
       $this->setMasterContent();
       //Echo the page immediately.
       $this->_htmlpage->renderPage();
    }
    
    public function addCSSFile($pcssfile)
    {
        $this->_htmlpage->addCSSFile($pcssfile);
    }
    
    public function addScriptFile($pjsfile)
    {
        $this->_htmlpage->addScriptFile($pjsfile);
    }
    
    //-------PRIVATE FUNCTIONS-----------------------------------    
    private function setPageDefaults()
    {
        $this->_htmlpage->setMediaDirectory("css", "js", "fonts", "img", "");
        $this->addCSSFile("bootstrap.default.css");
        $this->addCSSFile("site.css");
        $this->addScriptFile("jquery-2.2.4.js");
        $this->addScriptFile("bootstrap.js");
        $this->addScriptFile("holder.js");


    }
    
 

   
    private function setDynamicDefaults(){   

         //retrieving username from json file
         $user_data = json_decode(file_get_contents('json/profile.json'), true);

         if (!empty($user_data)){
            foreach ($user_data as $user) {
            $username= $user['username'];
          }
        }else {
            $username= "";
         }
         
        
        $tcurryear = date("Y");
        //Set the Three Dynamic Points to Empty By Default.
        $this->_dynamic_1 = <<<JUMBO
<h1>Music Recommendation Site</h1>
<p class="lead">MUSIC.</p>
JUMBO;
        $this->_dynamic_2 = "";
        $this->_dynamic_3 = <<<FOOTER
<p>@Silvia Nwakamma LJMU {$tcurryear}. All rights reserved</p><br>Contact Us<br>About Us<br>Follow our socials<br> 
<br>Username of logged in user :{$username}

FOOTER;

    
}
    
    
    
    private function setMasterContent()
    {
       //retrieving username from json file
       $isLoggedin=false;
       $user_data = json_decode(file_get_contents('json/profile.json'), true);

        // Check if user data is not empty (user is logged in)
        if (!empty($user_data)) {
            $isLoggedin=true;
        }



        $tmasterpage = <<<MASTER
        
        <link rel="stylesheet" href= "./css/site.css" >
<div class="container">
	<div class="header clearfix">


    <?php include_once("Navigation.php"); 
    echo 'Hello user';
    ?>
    <nav>


    <ul class="nav nav-pills pull-right">
        <li role="presentation"><a href="index.php">Home</a></li>
     
        
            <li role="presentation"><a href="ranking.php">Rank albums</a></li>
            <?php if ($isLoggedin) { ?>
            <li role="presentation"><a href="profile.php">Profile</a></li> <?php }?>
            
            <li role="presentation"><a href="login.php">Login</a></li>
            
			
			</ul>			
			<h3 class="text-muted">MUSIC RECOMMENDATION SITE</h3>

		</nav>
	</div>
	<div class="jumbotron">
		{$this->_dynamic_1}
    </div>
	<div class="row details">
		{$this->_dynamic_2}
    </div>
    <footer class="footer">
		{$this->_dynamic_3}
	</footer>
</div>        
MASTER;
        $this->_htmlpage->setBodyContent($tmasterpage); 
    }

}

?>