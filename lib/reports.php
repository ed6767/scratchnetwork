<?php

//Reporting
if ($_GET['action'] == "confirmreport") {
    // Check ID
    if ($_GET['id'] == "") {
            echo '
                 <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">The client did not provide all the information needed in the request.</h2>
             <div class="mdl-color-text--grey-600">
            Missing attribute: Post ID<br>
            Try refreshing the page later
              </div>
    
              </div>
            
          </div>
    

    ';
    echo '<!-- End -->'; die();
    }
 
    //Check if signed in
        if (!isset($_SESSION['username'])) {
            echo '
                 <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Please log in with your Scratch account.</h2>
             <div class="mdl-color-text--grey-600">
            Click "Sign in with Scratch" on the draw to sign in.
            
              </div>
                    <div class="mdl-card__actions mdl-card--border">
                <a href="#" onclick="loadlistings();" class="mdl-button mdl-js-button mdl-js-ripple-effect">Return</a>
                </div>
    
              </div>
            
          </div>
    
    
    ';
    echo '<!-- End -->'; die();
    }
        
        //Set up vars
        $itemid = $_GET['id'];
         $itemtitle = file_get_contents('items/'.$itemid .'/title.txt');
       //  $itembody = file_get_contents('items/'.$itemid .'/body.html');
        //  $itemlink = file_get_contents('items/'.$itemid .'/link.txt');
          $itemauthor = file_get_contents('items/'.$itemid .'/author.txt');
          if ($itemtitle == "") {} else {
          echo '
                    <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col" IAMITEMLISTING="yes" data-itemid="'. $itemid .'">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">'.$itemtitle.'</h2>
             <div class="mdl-color-text--grey-600">
            by <a href="#" onclick="showuserlistings(\''.$itemauthor.'\');">'.$itemauthor.'</a>
              </div><br>
              <div id="content-body-'.$itemid.'">
             <span style="color:red;">You are about to report this listing. You should only do this if it breaks Scratch\'s community guidelines. If information in this post is outdated or incorrect, you should contact a curator.</span>
                     
                  </div>
       
             <div class="mdl-card__actions mdl-card--border">
                <a href="#" onclick="showitem(\''. $itemid .'\');" class="mdl-button mdl-js-button mdl-js-ripple-effect">Do not report and return</a>
        
   <a href="#" onclick="submitreport(\''. $itemid .'\');" class="mdl-button mdl-js-button mdl-js-ripple-effect">Submit Report</a>
    
              </div>
            
          </div>
          ';
         }
     }

        /*+---------------------------------------+
          |                                       |
          |       REPORTING                       |
          |                                       |
          +---------------------------------------+*/



    
 //Submit report   
if ($_GET['action'] == "submitreport") {
    // Check ID
    if ($_GET['id'] == "") {
            echo '
                 <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">The client did not provide all the information needed in the request.</h2>
             <div class="mdl-color-text--grey-600">
            Missing attribute: Post ID<br>
            Try refreshing the page later
              </div>
    
              </div>
            
          </div>
    
    
    ';
    echo '<!-- End -->'; die();
    }
 
    //Check if signed in
        if (!isset($_SESSION['username'])) {
            echo '
                 <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Please log in with your Scratch account.</h2>
             <div class="mdl-color-text--grey-600">
            Click "Sign in with Scratch" on the draw to sign in.
            
              </div>
                    <div class="mdl-card__actions mdl-card--border">
                <a href="#" onclick="loadlistings();" class="mdl-button mdl-js-button mdl-js-ripple-effect">Return</a>
                </div>
    
              </div>
            
          </div>
    
    
    ';
    echo '<!-- End -->'; die();
    }
        
        //Set up vars
        $itemid = $_GET['id'];
         $itemtitle = file_get_contents('items/'.$itemid .'/title.txt');
       //  $itembody = file_get_contents('items/'.$itemid .'/body.html');
        //  $itemlink = file_get_contents('items/'.$itemid .'/link.txt');
          $itemauthor = file_get_contents('items/'.$itemid .'/author.txt');
    file_put_contents("items/". $_GET['id']. "/" . $_SESSION['username'] . '.report', "reported!");
          if ($itemtitle == "") {} else {
          echo '
                    <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col" IAMITEMLISTING="yes" data-itemid="'. $itemid .'">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">'.$itemtitle.'</h2>
             <div class="mdl-color-text--grey-600">
            by <a href="#" onclick="showuserlistings(\''.$itemauthor.'\');">'.$itemauthor.'</a>
              </div><br>
              <div id="content-body-'.$itemid.'">
             Your report has been submitted. A moderator will review it shortly within 48 hours and remove it if it breaks the Scratch Community Guidelines.<br>

                     
                  </div>
       
          <div class="mdl-card__actions mdl-card--border">
                <a href="#" onclick="loadlistings();" class="mdl-button mdl-js-button mdl-js-ripple-effect">Return</a>
                </div>
            
          </div>
          ';
         }
     }
     
     
     // Priority Reporting
       if ($_GET['action'] == "priorityreport") {
        if (isset($_SESSION["permissions"])){
        if ($_SESSION["permissions"] < 3) {
            echo '
            
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<style type="text/css">
div.error
{
width: 90%;
padding: 1%;
border: 2px solid red;
border-radius: 15px;
-moz-border-radius: 15px;
font-family: \'Roboto\', sans-serif;
}
</style>
<div class="error">
  <b><font size=5>Not authorised</font></b><br>
You need to log in as a Trusted Curator or higher to file a priority report.

</div>


            ';
            echo '<!-- End -->'; die();
        }
//Everything OKAY - lets report
        $msg = '
       Post ID: '. $_GET['postid'] .' 
       Thanks - autoguy!
        ';

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("myemail","SCRATCHNETWORK - New prority report from ". $_SESSION['username'],$msg);
            
                              echo '
            
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<style type="text/css">
div.error
{
width: 90%;
padding: 1%;
border: 2px solid red;
border-radius: 15px;
-moz-border-radius: 15px;
font-family: \'Roboto\', sans-serif;
}
</style>
<div class="error">
  <b><font size=5>Prority report sent</font></b><br>
Email sent to @myed. It will be reviewed an you will be notified of our progress on your profile page.

</div>


            ';
            echo '<!-- End -->'; die();
            
            
            
        } else {
                  echo '
            
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<style type="text/css">
div.error
{
width: 90%;
padding: 1%;
border: 2px solid red;
border-radius: 15px;
-moz-border-radius: 15px;
font-family: \'Roboto\', sans-serif;
}
</style>
<div class="error">
  <b><font size=5>Not authorised</font></b><br>
You need to log in as a Trusted Curator or higher to file a priority report.

</div>


            ';
            echo '<!-- End -->'; die();
        }
        
    }


?>
