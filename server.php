<?php ini_set('display_errors', 0); session_start(); if ($_GET['action'] == "sitemap") {header('Content-type: application/xml'); echo '<?xml version="1.0" encoding="UTF-8"?>';}?>
          <?php   
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
/*


+-----------------------------------------------------------------+
|                                                                 |
|                                                                 |
|            +-----+ +--+    X   X   +-----+------+               |
|            |       |   +    X X          |                      |
|            |       |   |     X           |                      |
| +------->  +-----+ |   |    X X          |         <---------+  |
|            |       |   |   X   X         |                      |
|            |       |   +  X     X        |                      |
|            +-----+ +--+  X       X       +                      |
|                                                                 |
|       Code by Ed.E - Intellectual property
|                                                                 |
|                                                                 |
|                                                                 |
+-----------------------------------------------------------------+

*/
$permissionlevel = -1;
// Require Composer
require 'vendor/autoload.php';
/*
Initiate Firebase PHP
yay!!
*/
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$serviceAccount = ServiceAccount::fromJsonFile('key');
$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->withDatabaseUri('https://scratch-network.firebaseio.com/')
    ->create();



try {

    // Some internal stuff to get error handling - scroll down
    set_error_handler(function($errno, $errstr, $errfile, $errline, array $errcontext) {
    // error was suppressed with the @-operator
    if (0 === error_reporting()) {
        return false;
    }

    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

require 'lib/functions.php'; //done
   //Start checks
functions_StartCheck();
//Verify action param
functions_VerifyActions();
    //Load and update user stuff

require 'lib/users.php'; //done
//notifications check
require 'lib/notifications.php'; //done
//Pushpoint check
require 'lib/pushpoints.php'; //done
    require 'lib/sessions.php'; //done



// LETS GO!!!
require 'lib/posts.php'; //done
require 'lib/reports.php'; //done
require 'lib/tools.php'; //done

require 'lib/comments.php'; //done
require 'lib/plugins.php'; //done

// require 'lib/groups.php'; IS NOT REQUIRED! Include when needed(user module, below).
if ($_GET['action'] == "groupwizzard") {
require 'lib/groups.php';
    die();
}
    if ($_GET['action'] == "download") {
require 'lib/download.php';
    die();
}
        if ($_GET['action'] == "forum") {
require 'lib/forum.php';
    die();
}



  




//Thats all!
//End try DO NOT REMOVE!   (i mean it!)  
}
catch(Exception $e) {
        /*+---------------------------------------+
          |                                       |
          |       ERROR MESSAGE                   |
          |                                       |
          +---------------------------------------+*/
    $errorcode = base64_encode($e->getMessage());
    // Not found message
  if( strpos( $e->getMessage(), "No such file or directory" ) !== false ) {
         echo '
                 <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Not found</h2>
             <div class="mdl-color-text--grey-600">
           The item you requested does not exist. It could\'ve been deleted.<br>
           <a href="#" onclick="loadlistings();">Click here</a> to return to the main page. 
           <!-- <font size=1>'. $errorcode  .' line '. $e->getLine() .'</font> -->
              </div>
    
              </div>
            
          </div>
    
    
    ';
    echo '<!-- End -->'; die();
}
    //Release error message
    /*
       echo '
                 <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Unhandled Server Error</h2>
             <div class="mdl-color-text--grey-600"><br>
             Sorry, we couldn\'t proccess your request because there was an internal server error.<br>
             It may be a problem with your session. Open the draw to the left of the page and click the down arrow next to your username and click "End Session".<br>
            Please contact <a href="//scratch.mit.edu/users/myed">@myed</a> on Scratch immedietly if this error still occurs after refreshing.
            <font size=1>'. $errorcode  .' line '. $e->getLine() .'</font>
              </div>
    
              </div>

          </div>
    

    ';
    */
        echo '
        <script>
        loadlistings();
        shownoticeDialog("Sorry, there was an error proccessing your request. It was in module '. explode("/", $e->getFile())[7] .' at line '. $e->getLine() .'. The error code is: '. $errorcode .'... Please send this message to @myed as text. Screenshots are scary.");
        </script>
                 <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Error Proccessing Request</h2>
             <div class="mdl-color-text--grey-600"><br>
             Please tell @myed - it is likely that this bug is being worked on right now so only do it if it lasts for more than an hour.
            <font size=1>'. $errorcode  .' line '. $e->getLine() .' module '.  explode("/", $e->getFile())[7] .'</font>
              </div>

              </div>

          </div>
    

    ';
    echo '<!-- End -->'; die();
}

//That's all, folks!         

?>
