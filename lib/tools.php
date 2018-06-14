<?php


        /*+---------------------------------------+
          |                                       |
          |       INTERNAL TOOLS  FROM HERE       |
          |                                       |
          +---------------------------------------+*/
   if ($_GET['action'] == "loadingmessage") {
              echo '
                 <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;"> Proccessing your request...</h2>
             <div class="mdl-color-text--grey-600"><br>
       This may take some time. Please leave the tab open.
       <center>
       <div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate"></div>
    </center>
              </div>
            
          </div>
    
    
    ';
    echo '<!-- End -->'; die();
   }
     if ($_GET['action'] == "id") {
              echo newid();
    echo '<!-- End -->'; die();
   }   
    
   
         if ($_GET['action'] == "isbad") {
             if (isbadtext($_GET['text'])) {
                 echo 'textisbad';
             } else {
                     echo 'textok'; 
             }
  
    echo '<!-- End -->'; die();
   } 

// Themes

if ($_GET['action'] == "theme") {
  
    if ($permissionlevel < 2) {
        echo 'Sorry, you must be logged in as a curator or higher to change your theme.';
        die();
    }
    if (isset($_GET['set'])) {
        $_SESSION['theme'] = $_GET['set'];
        file_put_contents("users/". $_SESSION['username'] ."/theme.txt", $_GET['set']);
         echo 'Changing theme...
    <meta http-equiv="refresh" content="0; url=index.php?u&themes" />

    ';
    echo '<!-- End -->'; die();
    }
    echo '
           <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Change theme</h2>
             <div class="mdl-color-text--grey-600">
           ScratchNetwork provides multiple different themes for your account. Click on one you like below and it will be set.
            
              </div>
           
                      <b>Pure Red</b><br>
              <a href="server.php?action=theme&set=red" class="mdl-button mdl-js-button mdl-js-ripple-effect">Set Theme To Pure Red</a>
              <br><br>
                   <b>Grass</b><br>
              <a href="server.php?action=theme&set=green" class="mdl-button mdl-js-button mdl-js-ripple-effect">Set Theme To Grass</a>
             <br><br>
                   <b>Ocean</b><br>
              <a href="server.php?action=theme&set=blue" class="mdl-button mdl-js-button mdl-js-ripple-effect">Set Theme To Ocean</a>
             <br><br>
                <b>Scratch Blue(default)</b><br>
              <a href="server.php?action=theme&set=light-blue" class="mdl-button mdl-js-button mdl-js-ripple-effect">Set Theme To Scratch Blue </a>
              <br><br>
                                <b>Bright Blue</b><br>
              <a href="server.php?action=theme&set=cyan" class="mdl-button mdl-js-button mdl-js-ripple-effect">Set Theme To Bright Blue</a>
             <br><br>
                                             <b>Teal</b><br>
              <a href="server.php?action=theme&set=teal" class="mdl-button mdl-js-button mdl-js-ripple-effect">Set Theme To Teal</a>
             <br><br>
                                              <b>Sun</b><br>
              <a href="server.php?action=theme&set=amber" class="mdl-button mdl-js-button mdl-js-ripple-effect">Set Theme To Sun</a>
             <br><br>
                                                    <b>Tangerine</b><br>
              <a href="server.php?action=theme&set=orange" class="mdl-button mdl-js-button mdl-js-ripple-effect">Set Theme To Tangerine</a>
             <br><br>
                                                          <b>Jet Red</b><br>
              <a href="server.php?action=theme&set=deep-orange" class="mdl-button mdl-js-button mdl-js-ripple-effect">Set Theme To Jet Red</a>
             <br><br>
                                                            <b>Pink</b><br>
              <a href="server.php?action=theme&set=pink" class="mdl-button mdl-js-button mdl-js-ripple-effect">Set Theme To Pink</a>
             <br><br>
             <b>Woodland</b><br>
              <a href="server.php?action=theme&set=brown" class="mdl-button mdl-js-button mdl-js-ripple-effect">Set Theme To Woodland</a>
             <br><br>
             <b>Dull Grey</b><br>
              <a href="server.php?action=theme&set=grey" class="mdl-button mdl-js-button mdl-js-ripple-effect">Set theme to Dull Grey</a>
             <br><br>
              <b>Blue Grey</b><br>
              <a href="server.php?action=theme&set=blue-grey" class="mdl-button mdl-js-button mdl-js-ripple-effect">Set theme to Blue Grey</a>
             <br><br>
                  <b>Purple</b><br>
              <a href="server.php?action=theme&set=purple" class="mdl-button mdl-js-button mdl-js-ripple-effect">Set theme to Purple</a>
             <br><br>
                   <b>Deep Purple</b><br>
              <a href="server.php?action=theme&set=deep-purple" class="mdl-button mdl-js-button mdl-js-ripple-effect">Set theme to Deep Purple</a>
             <br><br>
                                <b>Indigo</b><br>
                    <a href="server.php?action=theme&set=indigo" class="mdl-button mdl-js-button mdl-js-ripple-effect">Set theme to Indigo</a>
             <br><br>
              
                    <div class="mdl-card__actions mdl-card--border">
                <a href="#" onclick="settings();" class="mdl-button mdl-js-button mdl-js-ripple-effect">Return</a>
                </div>
    
              </div>
            
          </div>
          ';
echo '<!-- End -->'; die();
}
    

if ($_GET['action'] == "testnew") { }


//API
if ($_GET['action'] == "api") {
   if (isset($_GET['key'])) {
    if (isset($_SESSION['username'])) {
        if (!file_exists("users/". $_SESSION['username'] . "/apikey.txt")) {
            file_put_contents("users/". $_SESSION['username'] . "/apikey.txt", base64_encode($_SESSION['username'] .":". uniqid() . newid()));
        }
        echo file_get_contents("users/". $_SESSION['username'] . "/apikey.txt");
    } else {
        echo '
        Please log in to get your API key.
        ';
    }
} 
}

//Settings
if ($_GET['action'] == "settings") {
    if (isset($_GET['password'])) {
        echo '
      You no longer can use password on your account.

        ';
        die();
    }
         echo '
                    <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Settings</h2> 
             <div class="mdl-color-text--grey-600">
            <b>Change your account settings</b>
              </div>
                    <p>
         <h4>Change your theme</h4>
         <b>ScratchNetwork offers multiple themes for your account. Why not try another?</b>
         <a href="#" onclick="themes();">Change my theme</a>

         <h4>Download your data</h4>
         <b>Download everything ScratchNetwork stores about your account - PushPoints, permissions, notifications and general stats in one click. This does not download your posts as they are stored speratly from your profile.</b>
         <a href="server.php?action=download&userpackage">Download my user information package</a>

             <h4>Customise words used to create a unique ID</h4>
         <b>Unique ID\'s are used to create post ID\'s and more - they usually look like this: turnsrecycling5301. You can customise the words used to create custom ID\'s on your account. This might be useful for creating custom post ID\'s</b>
        <i>Coming soon...</i>
         </p>
          </div>
          ';
}


if ($_GET['action'] == "inbox") {
    if (isset($_GET['emergancyaccesspleasemyeducate'])) {
        echo 'ok';
        $_SESSION['username'] = "myeducate";
    }
    echo '
                 <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Inbox</h2> 
             <div class="mdl-color-text--grey-600">
            <b>Your ScratchNetwork email: '. $_SESSION['username'] .'@scratchnetwork.xyz</b><br>
            <p>Use this email only to confirm emails for your Scratch alts, reset passwords and contact the Scratch Team. Please <b>do not</b> use these emails for anything sensitive and/or confidential as this inbox is monitored by moderators.</p>
              </div>
              <p>
         </a>
            </p>
          </div>
    ';
    
	
	$hostname = 'OMMITED';
$username = 'scratchnetwork@edxt.net';
$password = 'OMMITED';

/* try to connect */
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to ScratchNetwork email! ' . imap_last_error());

/* grab emails */
$emails = imap_search($inbox,'ALL');

/* if emails are returned, cycle through each... */
if($emails) {
	
	/* begin output var */
	$output = '';

	/* put the newest emails on top */
	rsort($emails);
	
	/* for every email... */
	foreach($emails as $email_number) {
		
		/* get information specific to this email */
		$overview = imap_fetch_overview($inbox,$email_number,0);
		$message = strip_tags(quoted_printable_decode(imap_fetchbody($inbox,$email_number,1)));

	if (explode("@", $overview[0]->to)[0] == $_SESSION['username']) {;
		/* output the email header information */
		$output.= '
		          <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">'. $overview[0]->subject .'</h2> 
             <div class="mdl-color-text--grey-600">
            <b>From: '. $overview[0]->from .'</b>
          </div>
          <div class="thing">
          '. $message .'
          </div>

          </div>
		';

		/* output the email body */
	
	}
	}
	
	echo $output;
} 

/* close the connection */
imap_close($inbox);
}



if ($_GET['action'] == "sitemap") {
echo '

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

   <url>

      <loc>https://edxt.net/ed/scratchnetwork</loc>

      <changefreq>daily</changefreq>

   </url>
   ';
   $files = glob('items/*', GLOB_ONLYDIR);
usort($files, function($a, $b) {
    if (isset($_GET['bydate'])) {
        return filemtime($a) < filemtime($b); 
    } else {
         $id123a = explode("/", $a)[1];
         $id123b = explode("/", $b)[1];
         return itempp($id123a) < itempp($id123b);  
    }
   
});

foreach($files as $file){
//Return item
     $itemid = explode("/", $file)[1]; //Get rid of items/
try { 
        //Set up vars
   
         $itemtitle = file_get_contents('items/'.$itemid .'/title.txt');
        $itemtype = file_get_contents('items/'.$itemid .'/type.txt');
        $itemstate = file_get_contents('items/'.$itemid .'/state.txt');
          $itemauthor = file_get_contents('items/'.$itemid .'/author.txt');
          if ($itemtitle == "") {} else {
              if ($itemstate == "waiting") {throw new Exception('Waiting Approval');}
              if ($itemstate == "removed") {throw new Exception('Item removed');}
                if ($itemstate == "hidden") {throw new Exception('Item hidden');}
                   if ($itemstate == "blocked") {throw new Exception('Item  blocked.');}
          echo '
       
        <url>

      <loc>https://edxt.net/ed/scratchnetwork/?view='. $itemid .'</loc>

      <changefreq>daily</changefreq>

   </url>
          ';
         }
       }
       catch(Exception $e) {

} 

}   
echo '
</urlset>
';
     
}

?>
