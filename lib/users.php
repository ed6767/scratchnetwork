<?php


                    


//main

        if (isset($_SESSION['username'])) {
        $permissionlevel = file_get_contents("users/". $_SESSION['username']  ."/permissionlevel.txt");

     $_SESSION['permissions'] = $permissionlevel;
           if (file_exists("users/". $_SESSION['username']  ."/theme.txt")) {
                $_SESSION['theme'] = file_get_contents("users/". $_SESSION['username']  ."/theme.txt"); 
           }
             if (file_exists("users/". $_SESSION['username']  ."/pushpoints.txt")) {
                $_SESSION['pushpoints'] = file_get_contents("users/". $_SESSION['username']  ."/pushpoints.txt"); 
           } else {
               file_put_contents("users/". $_SESSION['username']  ."/pushpoints.txt", "100"); 
                $_SESSION['pushpoints'] = 100; 
           }

        if ($permissionlevel == 0) {
             echo '
       <script>
       window.location.replace("index.php?u&banmessage");
       loggedin = false;
       </script>

    ';

                // remove all session variables
session_unset(); 
// destroy the session 
session_destroy(); 
    echo '<!-- End -->'; die();  
        }
    } else {
        $permissionlevel = -1;
    }


    //User stuff
if ($_GET['action'] == "getuser") {
    if (isset($_GET['username']) == false){
        echo 'Invalid username';
        echo '<!-- End -->'; die();
    }
    $_GET['username'] = strtolower($_GET['username']);
    if (file_exists("users/" . strtolower($_GET['username'])) == false) {
       //Unregistered account
         echo '
                    <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">'. formatusername($_GET['username']).'</h2> 
             <div class="mdl-color-text--grey-600">
            <b>This user isn\'t registered wth ScratchNetwork. Why not tell them about it?</b>
              </div><br>
              <div id="content-body-notice" style="display: none;">
       
                  </div>
                       <div class="mdl-card__actions mdl-card--border">
                  <a href="//scratch.mit.edu/users/'. $_GET['username'] .'" class="mdl-button mdl-js-button mdl-js-ripple-effect">Visit Scratch Profile</a>           

    
              </div>

          </div>
          ';  
       
       echo '<!-- End -->'; die();
       
    }
    // User modify form
    // /*
    if (isset($_GET['modify'])) {
        
        if ($permissionlevel < 4) {
            echo 'You can\'t modify users with this account.';
        }
        if (userpermissions($_GET['username']) >= $permissionlevel) {
          if ($_SESSION['username'] == $_GET['username']){
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
You can\'t modify your own account.

</div>


            ';
            echo '<!-- End -->'; die();  
          } elseif (false) {} else {
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
You can\'t modify this account.

</div>


            ';
            echo '<!-- End -->'; die(); 
          }
        }
    
     //   */
        //All checks ok 
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
  <b><font size=5>Change user '. $_GET['username'] .' permissions</font></b><br>
<form action="server.php?action=getuser&modifysubmit&username='. $_GET['username'] .'" method="post">
Set user to
     <select name="permission">
  <option value="2">curator</option>
  <option value="3">trusted curator</option>
';
            if ($permissionlevel >= 5) {
                  echo '  <option value="4">moderator</option>
                  <option value="1">revoke curator privilages</option>
                  <option value="0">ban</option>';
            }
  
echo '       </select><br>

Pressing submit will apply permission immedietlely.
  <input type="submit" value="Submit">

</form>

';
  if ($permissionlevel > 4) {
      echo '<br>
      As you are an admin, you can log in as this user. Please note that this will log you out and log you in as '. $_GET['username'] .'.<br>
      <a href="server.php?action=getuser&username='. $_GET['username'] .'&replacesession">Click here to log in as '. $_GET['username']. '</a>
      <br><br>
      Change this users access to features<br>
      <form>
PushPoints: <select><option value="on">Enable</option><option value="off">Disable</option></select>
      </form><br>

      <form>
Comments: <select><option value="on">Enable</option><option value="off">Disable</option></select>
      </form><br>
            <form>
Making posts: <select><option value="on">Enable</option><option value="off">Disable</option></select>
      </form><br>
      <b>WARNING: Disabling some modules may break the site for this user!</b>
      ';
  }

echo '

</div>
        ';   
        echo '<!-- End -->'; die();
    }
    
// Modify submit
//User

    // User modify form
    // /*
    if (isset($_GET['modifysubmit'])) {
        
        if ($permissionlevel < 4) {
            echo 'You can\'t modify users with this account.';
        }
        if (userpermissions($_GET['username']) >= $permissionlevel) {
          if ($_SESSION['username'] == $_GET['username']){
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
You can\'t modify your own account.

</div>


            ';
            echo '<!-- End -->'; die();  
          } elseif (false) {} else {
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
You can\'t modify an admin account.

</div>


            ';
            echo '<!-- End -->'; die(); 
          }
        }
    
     //   */
        //All checks ok
           sendnotification($_GET['username'], "Your account permission level have been changed from ". $permissions[file_get_contents("users/". $_GET['username'] . "/permissionlevel.txt")] . " to ". $permissions[$_POST['permission']] ." by ". formatusername($_SESSION['username']));
         file_put_contents("users/". $_GET['username'] . "/permissionlevel.txt", $_POST['permission']);
      
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

  <b><font size=5>Change user '. $_GET['username'] .' permissions</font></b><br>
Changed successfully.

</div>
        ';  
       
        
        echo '<!-- End -->'; die();
    }



// replace session
    if (isset($_GET['replacesession'])) {
        
        if ($permissionlevel < 5) {
            echo 'You can\'t embody users with this account.';
        }
        if (userpermissions($_GET['username']) >= $permissionlevel) {
          if ($_SESSION['username'] == $_GET['username']){
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
You can\'t modify your own account.

</div>


            ';
            echo '<!-- End -->'; die();  
          } elseif (false) {} else {
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
You can\'t modify an admin account.

</div>


            ';
            echo '<!-- End -->'; die(); 
          }
        }
    
     //   */
        //All checks ok 
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

  <b><font size=5>Log in as user '. $_GET['username'] .'</font></b><br>
Success. <a href="index.php">Click here</a> to return.

</div>
        ';  
   $_SESSION['username'] = $_GET['username'];
       if (file_exists("users/". $_SESSION['username']  ."/theme.txt")) {
                $_SESSION['theme'] = file_get_contents("users/". $_SESSION['username']  ."/theme.txt"); 
           }

        echo '<!-- End -->'; die();
    }
    
    

    
    
    
    //The actual output (last thing to run)
    $lastonline = "before April 8";
    $accountpp = userpp($_GET['username']);
    $onlinestatus = "<span style='color:red;'>Inactive</span>";
    if (file_exists("users/". $_GET['username']. "/lastonline.txt")) {//Two mins
        $lastonline = file_get_contents("users/". $_GET['username']. "/lastonline.txt");
        if ((time() - $lastonline) < 120){
             $onlinestatus = "<span style='color:green;'>Online</span>";
        } elseif ((time() - $lastonline) < 604800) {//One week
           $onlinestatus = "<span style='color:red;'>Offline</span> - Last online ". date("F d Y H:i.",$lastonline) ." UTC+1";
        } else {
            $onlinestatus = "<span style='color:red;'>Inactive</span> - Last online ". date("F d Y H:i.",$lastonline) ." UTC+1";
        }
        
    }
    try {
$testvari = $permissions[userpermissions($_GET['username'])];

    } catch (Exception $e) {
        if (userpermissions($_GET['username']) == -1) {
           echo '

                 <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">'. $_GET['username'] .'</h2>
             <div class="mdl-color-text--grey-600"><br>
             This user is a bot. It is used for automated services on ScratchNetwork.
              </div>

              </div>

          </div>


    ';
        } elseif (userpermissions($_GET['username']) == -2) {
            //DO groups
require 'lib/groups.php'; 
        } else {
             echo '
        <script> 
        loadlistings();
        shownoticeDialog("Sorry, this user is corrupt.");
        </script>
                 <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">User Corrupt</h2>
             <div class="mdl-color-text--grey-600"><br>

              </div>

              </div>

          </div>


    ';
    }
      echo '<!-- rip -->';  die();
    }
         echo '
                    <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">'. formatusername($_GET['username']).'</h2> 
             <div class="mdl-color-text--grey-600">
            <b>'. numberformat($accountpp) .'<small>pp - </small>ScratchNetwork '. $permissions[userpermissions($_GET['username'])] .'</b> - '. $onlinestatus .'
              </div><br>
              <div id="content-body-notice" style="display: none;">
       
                  </div>
                       <div class="mdl-card__actions mdl-card--border">
                  <a href="//scratch.mit.edu/users/'. $_GET['username'] .'" class="mdl-button mdl-js-button mdl-js-ripple-effect">Visit Scratch Profile</a>           
       ';
    
       if ($permissionlevel > 3) {
           echo '
             
                <a href="server.php?action=getuser&modify&username='. $_GET['username'] .'" class="mdl-button mdl-js-button mdl-js-ripple-effect">Edit permissions</a>
           ';
       }
    echo '  

    
              </div>
            
          </div>
          ';
          
             if (isset($_SESSION['username']) == false) {
         
           
               echo '
                 <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Log in to see more</h2>
             <div class="mdl-color-text--grey-600">
           There\'s much more to see about '. $_GET['username'] .'\'s ScratchNetwork profile.
           <a href="?u&newsession">Sign in</a> with your Scratch account now to see more.<br>
       
     
    
              </div>
            
          </div>
    
    
    ';
    echo '<!-- End -->'; die();
            
 
       }
       // PushPoints
       if ($permissionlevel > 1 and $_GET['username'] !== $_SESSION['username']) {
       echo '
       
            <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
              
             <h1 class="mdl-card__title-text" style="align-self: flex-start;">Send or Request PP</h1>
             <div class="mdl-color-text--grey-600">
       Send or request PushPoints to '. $_GET['username'] .'
              </div>
             <div class="mdl-card__actions mdl-card--border">
                <a href="#" onclick="sendpp(\''. $_GET['username'] .'\');" class="mdl-button mdl-js-button mdl-js-ripple-effect">Send</a> <a href="#" onclick="requestpp(\''. $_GET['username'] .'\');" class="mdl-button mdl-js-button mdl-js-ripple-effect">Request</a>
                </div>
              </div>

          </div>
       
       ';
       }
       //Actual listings
    $files = glob('items/*', GLOB_ONLYDIR);
usort($files, function($a, $b) {
    return filemtime($a) < filemtime($b);
});
foreach($files as $file){
//Return item
     $itemid = explode("/", $file)[1]; //Get rid of items/
// Everythign from try section go here
 //Set up vars
     try{ 
         $itemtitle = file_get_contents('items/'.$itemid .'/title.txt');
           $itemauthor = file_get_contents('items/'.$itemid .'/author.txt');
        $itemtype = file_get_contents('items/'.$itemid .'/type.txt');
        $itemstate = file_get_contents('items/'.$itemid .'/state.txt');
          $itemposter = file_get_contents('items/'.$itemid .'/poster.txt');

          if ($itemtitle == "") {} else {
              
              if (!((isset($_SESSION['username']) and $_GET['username'] == $_SESSION['username']) or $permissionlevel > 3)){
                   if ($itemstate == "waiting") {throw new Exception('Waiting Approval');}
              if ($itemstate == "removed") {throw new Exception('Item removed');}
                if ($itemstate == "hidden") {throw new Exception('Item hidden');}
                 if ($itemstate == "blocked") {throw new Exception('Item hidden');}
              } else {
              if ($itemstate == "waiting") {$itemtype="WAITING APPROVAL";}
              if ($itemstate == "removed") {$itemtype="REMOVED";}
                if ($itemstate == "hidden") {$itemtype="HIDDED";}
                if ($itemstate == "blocked") {$itemtype="BLOCKED";}
              }
                if ($itemposter == $_GET['username']){} else {throw new Exception('Item removed');}    
          echo '
                    <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col" IAMITEMLISTING="yes" data-itemid="'. $itemid .'">
                    <div class="mdl-color-text--grey-600">';
                    if ($itemtype == "project") {
                        echo 'PUBLIC - PROJECT';
                    } elseif ($itemtype == "studio") {
                          echo 'PUBLIC - STUDIO'; 
                    } elseif ($itemtype == "review") {
                          echo 'PUBLIC - REVIEW';
                    } elseif ($itemtype == "howto") {
                          echo 'PUBLIC - HOW-TO';
                    } elseif ($itemtype == "shop") {
                          echo 'PUBLIC - SHOP';
                    } elseif ($itemtype == "shoporder") {
                          echo 'PUBLIC - SHOP ORDER';
                    } elseif ($itemtype == "other") {
                          echo 'PUBLIC - OTHER POST';
                    } elseif ($itemtype == "post") {
                          echo 'ANNOUNCEMENT';
                    } else {
                        echo $itemtype; 
                    }
   echo '         </div>
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">'.$itemtitle.'</h2> 
             <div class="mdl-color-text--grey-600">
            by <a href="#" onclick="showuserlistings(\''.$itemauthor.'\');">'. formatusername($itemauthor).'</a>
              </div><br>
              <div id="content-body-'.$itemid.'" style="display: none;">

                  </div>

             <div class="mdl-card__actions mdl-card--border">
                <a href="#" onclick="showitem(\''. $itemid .'\');" class="mdl-button mdl-js-button mdl-js-ripple-effect">view</a>


              </div>

          </div>
          ';
         }
}
       catch(Exception $e) {
echo '<!-- Exception '. $e->getMessage() . ' line '. $e->getLine() .' -->';
}   
}



}

?>
