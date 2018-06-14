<?php

$logindisabled = false;
     
     if ($_GET['action'] == "newsession") {
          if (isset($_SESSION['username'])) {
            echo '
       <script>loadlistings();</script>
    

    ';
    echo '<!-- End -->'; die();
    } 
if ($logindisabled and isset($_SESSION['downaccess']) == false) {

       echo '

    <b>Login disabled.</b>

    ';
    echo '<!-- End -->'; die();
  
}
    $_SESSION['code'] = newid();
    $_SESSION['confirmuser'] = 'hello-test'; // 'SNOfficial' "megacodeccclub". rand(5000, 11905); //5000, 11950
           echo '
<b>Login to ScratchNetwork</b><br>
            1. Double click on the code below and press CTRL+C to copy it<br>
            <small>'. $_SESSION['code'] .'</small><br>
            2. Post the code in as a comment on <a href="https://scratch.mit.edu/users/'.$_SESSION['confirmuser'].'/" target="_blank">this users</a> profile.<br>
            3. Click the button below to log in.



    ';
     }


     

       if ($_GET['action'] == "finishlogin") {
          if (isset($_SESSION['username'])) {
            echo 'You are already logged in.
    ';
    echo '<!-- End -->'; die();
    } 
    //Check sign in
           if (!isset($_SESSION['confirmuser'])) {
               echo 'Login expired. Please close this dialog and try again.';
               die();
           }
    $comments = curl_get_contents("https://scratch.mit.edu/site-api/comments/user/". $_SESSION['confirmuser']. "/");
    $username = "";
    $foundid = false;
foreach(preg_split("/((\r?\n)|(\r\n?))/", $comments) as $line){
if (strpos($line, 'data-comment-user') !== false) {
   $username = explode('"', $line)[5];
}
if (strpos($line, $_SESSION['code']) !== false) {
    $foundid = true;
   break;
}
} 
if ($username != "" and $foundid) {
    $userprofile = curl_get_contents("https://scratch.mit.edu/users/". $username ."/");
    //Check if new scratcher
    if (strpos($userprofile, 'New Scratcher') !== false) {
        echo '
         Sorry! You must be a Scratcher to use ScratchNetwork.
        ';
    } else {
        // Log in successfull
        $username = strtolower($username);
       $_SESSION['username'] = $username;
        if (!file_exists('users/'. $username)) {
            //New user
    mkdir('users/'. $username, 0777, true);
            //Write user as level 1 - normal user
    file_put_contents("users/". $username ."/permissionlevel.txt", "2");
            $_SESSION['permissions'] = "2";
              file_put_contents("users/". $username ."/pushpoints.txt", "100");
    } else {
            $_SESSION['permissions'] = file_get_contents("users/". $username ."/permissionlevel.txt");
            if (file_exists("users/". $username ."/theme.txt")) {
                $_SESSION['theme'] = file_get_contents("users/". $username ."/theme.txt");
            }
        }
        
        //Complete login with client
        echo '
    <meta http-equiv="refresh" content="0; url=index.php" />


        <script> </script>';
    }
} else {
       echo '
             Couldn\'t find your comment.
        ';
}
    

     }
    
  
    
if ($_GET['action'] == 'endsession') {

    // remove all session variables
session_unset(); 
// destroy the session 
session_destroy(); 
// Now we need to log out of Firebase
echo '
<script src="https://www.gstatic.com/firebasejs/4.12.1/firebase.js"></script>
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.1.0/js/md5.js"></script>
      <!-- Scripts -->
      <script src="script.js?v='. time() .'"></script>
      <script>
      firebase.auth().signOut().then(function() {
  // Sign-out successful.
  window.location.replace("index.php?los");
}, function(error) {
 console.log(error);
 window.location.replace("index.php?loe");

});
      </script>
Ending session...


';

}
    
    //Session check
        if ($_GET['action'] == "sessioncheck") {
              if (isset($_SESSION['username'])) {
                  file_put_contents("users/". $_SESSION['username'] . "/lastonline.txt", time());
                  echo $_SESSION['username'] .'#'. notificationcount($_SESSION['username']) . '#';
              } else {
                  echo '!nosession!';
              }
    echo '<!-- End -->'; die();
   } 

?>
