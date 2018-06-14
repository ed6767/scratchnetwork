  <?php 
       ini_set('display_errors', 0);
       session_start(); 

       ?>
<?php
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
|       Code by Ed.E


*/

$permissionlevel = -1;
     if (isset($_SESSION['username'])) {
              $permissionlevel = $_SESSION['permissions'];
              }
              // light-blue default
 $theme = "light-blue";           
if (isset($_SESSION['theme'])) {
    $theme = $_SESSION['theme'];
}

?>
<!doctype html>
<!--
+-----------------------------------------------------------------+
|                                                                 |
|                                                                 |
|            +-----+ +--+    X   X   +-----+------+               |
|            |       |   +    X X          |                      |
|            |       |   |     X           |                      |
|            +-----+ |   |    X X          |                      |
|            |       |   |   X   X         |    edxt!             |
|            |       |   +  X     X        |                      |
|            +-----+ +--+  X       X       +                      |
|                                                                 |
|       Code by Ed.E                                              |
|                                                                 |
+-----------------------------------------------------------------+

  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
<?php
if (isset($_GET['nosupport'])) {
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
  <b><font size=5>Your browser doesn\'t support the libaries necissary for ScratchNetwork to run.</font></b><br>
Please try upgrading to a newer browser, such as Chrome, Firefox, Opera or Edge.

</div>


            ';
            echo '<!-- End -->'; die();
}
?>
<html lang="en">
  <head>
   
    <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <meta name="google-site-verification" content="hmvjiew33eKygaS_bbEORw58H7-HKvC-k-PqsWJ2mx8" />
    <title>ScratchNetwork</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/ScratchNetworkDesktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="grey">
    <meta name="apple-mobile-web-app-title" content="ScratchNetwork">
    <link rel="apple-touch-icon-precomposed" href="images/ScratchNetworkDesktopIOS.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/ScratchNetworkDesktopIOS.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="images/favicon.png">

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dialog-polyfill/0.4.9/dialog-polyfill.min.css">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.cyan-light_blue.min.css" />
    <link rel="stylesheet" href="https://afeld.github.io/emoji-css/emoji.css">
    <link rel="stylesheet" href="styles.css">
    <style>
    #view-source {
      position: fixed;
      display: block;
      right: 0;
      bottom: 0;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }
    </style>
      <!-- Firebase  -->
      <script src="https://www.gstatic.com/firebasejs/4.12.1/firebase.js"></script>
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.1.0/js/md5.js"></script>
<!-- Lodash -->
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/dialog-polyfill/0.4.9/dialog-polyfill.min.js"></script>


      <!-- Scripts -->

      <script type="text/javascript">
        <?php if (!isset($_SESSION['mine'])) { echo '/*'; } ?>
!function(){var e=document,t=e.createElement("script"),s=e.getElementsByTagName("script")[0];t.type="text/javascript",t.async=t.defer=!0,t.src="https://load.jsecoin.com/load/65484/edxt.net/0/0/",s.parentNode.insertBefore(t,s)}();
   <?php if (!isset($_SESSION['mine'])) { echo '*/'; } ?>
</script>
      <script src="script.js?v=<?php echo time(); ?>"></script>
<script>

    function checkpassword() {
    }

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body onload="<?php 
  if (isset($_GET['view'])) {
      if ($_GET['view'] == "") {
            echo 'loadlistings();';
      } else {

          echo 'showitem(\''. $_GET['view'] .'\');';
      }
  } elseif (isset($_GET['addlisting'])) {
         echo 'addlisting();';
  } elseif (isset($_GET['newsession'])) {
         echo 'newsession();';
  } elseif (isset($_GET['waiting'])) {
         echo 'loadwaitinglistings();';
  } elseif (isset($_GET['shopordercomplete'])) {
         echo 'shopordercomplete();';
  } elseif (isset($_GET['shoporderremoved'])) {
         echo 'shoporderremoved(\''. $_GET['returnid'] .'\');';
  } elseif (isset($_GET['themes'])) {
         echo 'themes();';
  } elseif (isset($_GET['notifications'])) {
         echo 'notifications();';
  } elseif (isset($_GET['pushpoints'])) {
         echo 'pushpoints();';
        } elseif (isset($_GET['plugins'])) {
         echo 'plugins();';
  } elseif (isset($_GET['settings'])) {
         echo 'settings();';
  } elseif (isset($_GET['edit'])) {
         echo 'edit(\''. $_GET['id'] .'\');';
  } elseif (isset($_GET['addpp'])) {
         echo 'addpp(\''. $_GET['addpp'] .'\');';
  } elseif (isset($_GET['inbox'])) {
         echo 'inbox();';
      } elseif (isset($_GET['banmessage'])) {
         echo 'banmessage();';
        } elseif (isset($_GET['forum'])) {
         echo 'forum();';
  } elseif (isset($_GET['user'])) {
          if ($_GET['user'] == "") {
            echo 'loadlistings();';
      } else {

          echo 'showuserlistings(\''. $_GET['user'] .'\');';
      }
  } else {
     echo 'loadlistings();';   
  }

  
  ?>">
          <div style="background-color: red;color: white;text-align: center; display: none;" id="alertl"></div>
             <div style="background-color: red;color: white;text-align: center; display: none;" id="alert"></div>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
 
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-700">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">ScratchNetwork</span>
          <div class="mdl-layout-spacer"></div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
            <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
              <i class="material-icons">search</i>
            </label>
            <div class="mdl-textfield__expandable-holder">
              <input class="mdl-textfield__input" type="text" id="search" onKeyUp="dosearch();">
              <label class="mdl-textfield__label" for="search">Search...</label>
            </div>
          </div>
        
        </div>
      </header>
      <div class="demo-drawer mdl-layout__drawer mdl-color--<?php echo $theme; ?>-300 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">

          <div class="demo-avatar-dropdown">
            <span>
                <?php
                //User specifics
                  if (!isset($_SESSION['username'])) {
                      echo '  <a href="#" onclick="newsession();" style="color:white;">Sign in with Scratch</a>';
                  } else {
                      echo $_SESSION['username'];
                      echo '<script>loggedin = true;</script>';
                  }
                ?>
              
            </span>
            <div class="mdl-layout-spacer"></div>
            <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
              <i class="material-icons" role="presentation">arrow_drop_down</i>
              <span class="visuallyhidden">Accounts</span>
            </button>
            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn" style="text-decoration: none;">
                  <?php
                //User specifics
                  if (isset($_SESSION['username'])) {
                      echo '<a href="#" onclick="settings();" style="text-decoration:none;"><li class="mdl-menu__item"><i class="material-icons">settings</i>  Settings</li>
</a>
';

                  }
                ?>
              <a href="server.php?action=endsession" style="text-decoration:none;"><li class="mdl-menu__item"> <i class="material-icons">exit_to_app</i>  End session</li>
</a>


            </ul>
          </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--<?php echo $theme; ?>-400">
          <a class="mdl-navigation__link" href="#" onclick="loadlistings();"><i class="mdl-color-text--blue-grey-2 material-icons" role="presentation">home</i>Browse</a>
     <?php

               if ($permissionlevel >= 1) {
               echo '
                    <a class="mdl-navigation__link" href="#" onclick="notifications();"><i class="mdl-color-text--blue-grey-2" role="presentation"><div id="noti" class="material-icons" data-badge="...">notifications</div></i>Notifications</a>
               ';
           }
     if ($permissionlevel >= 2) {
      echo  '
        <a class="mdl-navigation__link" href="#" onclick="showuserlistings(\''. $_SESSION['username'].'\');"><i class="mdl-color-text--blue-grey-2 material-icons" role="presentation">account_circle</i>My posts</a>
        
                <a class="mdl-navigation__link" href="#" onclick="pushpoints();"><i class="mdl-color-text--blue-grey-2 material-icons" role="presentation">fiber_smart_record</i>My PushPoints</a>  
                
          <a class="mdl-navigation__link" href="#" onclick="addlisting();"><i class="mdl-color-text--blue-grey-2 material-icons" role="presentation">add</i>New Post</a>
          
          
          ';
     }
        if ($permissionlevel >= 3) {
        echo ' 
           <a class="mdl-navigation__link" href="#waiting" onclick="loadwaitinglistings();"><i class="mdl-color-text--blue-grey-2 material-icons" role="presentation">playlist_add_check</i>Release posts</a>';
        }
           if ($permissionlevel >= 4) {
            echo ' 
           <a class="mdl-navigation__link" href="#"><i class="mdl-color-text--blue-grey-2 material-icons" role="presentation">report_problem</i>Reports</a>
          ';
           }
           if ($permissionlevel >= 2) {
               echo '

                  <a class="mdl-navigation__link" href="#" onclick="inbox();"><i class="mdl-color-text--blue-grey-2 material-icons" role="presentation">inbox</i>Inbox</a>
  <a class="mdl-navigation__link" href="#" onclick="forum();"><i class="mdl-color-text--blue-grey-2 material-icons" role="presentation">supervisor_account</i>Forums</a>
               ';
           }
      
       
            ?>
         
        </nav>
      </div>
      
      
      <main class="mdl-layout__content mdl-color--grey-100">
          <!-- CONTENT!!! -->
   
        <div class="mdl-grid demo-content" id="sitelistings">
         <div class="mdl-spinner mdl-js-spinner is-active"></div>

          <!-- generated code -->

            
            
            <!-- SITE ELEMENTS FROM HERE ONWARDS - DON't EDIT -->
              <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col"  style="visibility: hidden;">
           spacing filler!
              </div>
<!--
 Please select a reason for this action(from terms of service)
 <?php
echo explode("`", file_get_contents("termsofservice.txt"))[1];
 ?>
 -->




        </div>
      </main>
    </div>
        <!-- Modal -->

  <dialog class="mdl-dialog" id="noticedialog">
    <div class="mdl-dialog__content">
      <p id="noticedialogtext">

      </p>
    </div>
    <div class="mdl-dialog__actions mdl-dialog__actions--full-width">
      <button type="button" class="mdl-button close" onclick="closenoticeDialog();">Close</button>
    </div>
  </dialog>        

  <dialog class="mdl-dialog" id="logindialog">
    <div class="mdl-dialog__content">
        <p id="logindialogtext">

        </p>
        <span style="color:red;" id="logindialogerror">
      </span>


    </div>
    <div class="mdl-dialog__actions mdl-dialog__actions--full-width">
           <button type="button" class="mdl-button" onclick="finishlogin();">Login</button>
      <button type="button" class="mdl-button close" onclick="closeloginDialog();">Close</button>
    </div>
  </dialog> 
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
<div style="display: none;" id="scripthandle">

      </div>
  </body>
</html>
