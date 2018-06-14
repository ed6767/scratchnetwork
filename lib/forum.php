<?php
if ($_GET['action'] == "forum") {
    require 'forumtoken.php';
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    //Sign up 
    if (isset($_GET['register'])) {
        if(file_exists("users/". $_SESSION['username']. "/forum.txt")) {die();}

        enableforumsignup();
        $api_url = "https://edxt.net/ed/scratchnetwork/forum/api/users";
$token = getforumtoken();
$new_username = $_SESSION['username'];
$new_password = newid();
$new_email = $_SESSION['username'] . "@scratchnetwork.xyz";
$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
 'Content-Type: application/json',
  'Authorization: Token ' . $token
]); 
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
  'data' => [
    'attributes' => [
      "username" => $new_username,
      "password" => $new_password,
      "email"    => $new_email
    ]
  ]    
]));
$result = curl_exec($ch);
$new_user = json_decode($result);
        file_put_contents("users/". $_SESSION['username']. "/forum.txt", "has account");
disableforumsignup();
echo '
     <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Forum account created</h2>
             <div class="mdl-color-text--grey-600">
        You can now log in with your Scratch username with the password <pre>'. $new_password .'</pre><br>
        The email assosiated with your account is <b>'. $new_email .'</b><br><br>
        <b>PLEASE WRITE YOU PASSWORD IN A SAFE PLACE. You won\'t be able to get it again!</b><br>
        You can change it in your forum account settings using the email above. All forum emails are sent to your
        ScratchNetwork Inbox.<br><br>
        <a href="forum">Click here to continue to the forums</a>
              </div>
              </div>

          </div>
          <!--
          Account info
'. $result .'
          -->
';
        die();
}
    
    // And now, we do the tag marketplace!
    if (isset($_GET['tagmarketplace'])) {
        if (!isset($_SESSION['username'])) {
            echo 'Log in to ScratchNetwork to continue.';
            die();
        }
        echo '
        <!DOCTYPE html>
<html lang="en">
<head> 
  <title>ScratchNetwork Forums Tag Maker</title>
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script>
$(document).ready(function() {

  $(\'#summernote\').summernote();



  $(\'#summernote2\').summernote();


});
</script>
</head>
<body>

<div class="jumbotron text-center">
  <h1>ScratchNetwork Forums - Tag Maker</h1>
  <p>'. $_SESSION['username'] .'</p> 
  <a href="index.php?u&main" class="btn btn-primary">Return to home page</a>
</div>

<div class="container">
  <h4>'. formatusername($_SESSION['username']) .',  welcome to the ScratchNetwork Forum Tag maker.</h4>
        <p class="lead">';
        if ($permissionlevel < 3) {
            echo 'Sorry, you must be a trusted curator or higher to make your own tag.';
            } elseif (userpp($_SESSION['username']) < 250) {
echo 'Sorry, you do not have the 250 PushPoints required to make a tag. Come back soon!';
} elseif (isset($_POST['tagname'])) {
            //Create tag!
            //Charge 250pp from user
            transferpp("scratchnetwork", 250);
            $tagslug = strtolower($_POST['tagname']) .'-'.$_SESSION['username'];
            $jsontosendoff = '{"data":{"type":"tags","attributes":{"name":"'. $_POST['tagname'] .'","slug":"'. $tagslug .'","description":"'. $_POST['tagdescription'] .' - This is a custom tag made by '. $_SESSION['username'] .' through the ScratchNetwork tag maker.","color":"#4286f4","isHidden":false}}}';

   $api_url = "https://edxt.net/ed/scratchnetwork/forum/api/tags";
$token = getforumtoken();
$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
 'Content-Type: application/json',
  'Authorization: Token ' . $token
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([

   'data' => [
       "type" => "tags",
    'attributes' => [
      "name" => $_POST['tagname'],
      "slug" => $tagslug,
      "description" => $_POST['tagdescription']. ' - by '.$_SESSION['username'],
        "color" => "#4286f4",
        "isHidden" => false
    ]
  ] 

]));
$result = curl_exec($ch);

            echo 'Tag created! Redirecting...
<script>window.location = "https://edxt.net/ed/scratchnetwork/forum/t/'. $tagslug .'";</script>';
        } else {
        echo '
        Please remember that these tags can be used by anyone, unless you are a group. In this case, you should use the group tag editor.
        <hr>
         <h5>Make your tag now!</h5>
      <div class="form-group">
  <label for="tagname">Tag Name</label>
  <form method="post" action="server.php?action=forum&tagmarketplace">
 <input type="text" class="form-control" id="tagname" required pattern="[a-zA-Z0-9]+" minlength=4 maxlength=12 name="tagname"><br>
  <label for="tagndescription">Breifly Describe your tag</label>
 <input type="text" class="form-control" id="tagdescription" required minlength=10 maxlength=90 name="tagdescription">
  <small>Tag name must be alphabetic. No spaces or special characters allowed with a minimum of 4 characters and a max of 12. You can\'t customise colours or slugs using this tool. Tags cost 250pp each. You have '.userpp($_SESSION['username']).'pp in your account. You <b>will not</b> be refunded if your tag is deleted. Clicking continue will charge you account and create your tag immedietly.</small>
<br><input type="submit" value="Make my tag now and charge me 250pp.">
</form>
</div>

';/*endif*/} echo'
        </p>
</div>

</body>
</html>

        
        ';
        die();
    }
    echo '
     <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">ScratchNetwork Forums</h2>
             <div class="mdl-color-text--grey-600">
             Discuss about anything - Computers, Scratch, code or games - as long as it\'s age apropriate. Just follow the ScratchNetwork Terms of Service!';
   if (file_exists("users/". $_SESSION['username']. "/forum.txt")) {
    echo '
    <br>
<a href="forum">Go to the forums</a>
<br>
<hr>
<br>
<font size=5>Forum Options</font><br><br>
<a href="server.php?action=forum&tagmarketplace">Buy tags with PushPoints</a>
        '; 
   } else {
echo '
<a href="#" onclick="newforumuser();">Create my account now</a>
';
   }

    echo'
    <br>
              </div>
              </div>

          </div>
';
}
?>
