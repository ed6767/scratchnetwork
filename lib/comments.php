<?php

    if ($_GET['action'] == "comments") {
    if (isset($_GET['remove'])) {
        if ($permissionlevel < 4) {echo 'Sorry, only Mods can do that.';die();}
     $database = $firebase->getDatabase();
     $db = $database;
      $db->getReference($_GET['path'])
   ->set([
       'message' => 'comment was removed by moderator',
      ]);
  echo 'Comment removed.';
      die();
    }
    
    
    $postid = $_POST['id'];
     $database = $firebase->getDatabase();
     $db = $database;
      $db->getReference('comments/'. $postid .'/'. time() . $_SESSION['username'] . newid())
   ->set([
       'name' => $_SESSION['username'],
       'message' => $_POST['message'],
      ]);

$commentposter = $_SESSION['username'];
$commentmessage = $_POST['message'];
$itemposter = file_get_contents("items/". $postid . "/poster.txt");
preg_match_all('/(^|\s)(@\w+)/', $commentmessage, $result);
//Send notification to poster
sendnotification($itemposter, '<div class="mdl-color-text--grey-600"><a href="#" onclick="getuserlistings(\''. $commentposter .'\');">'.$commentposter.'</a> left a comment on your <a href="#" onclick="showitem(\''. $postid .'\');">post</a>:</div><p> '.$commentmessage.'</p>');
foreach ($result[2] as &$value) {
    $mentionedusername = explode("@", $value)[1];
    //Send notification to mentioned user
       sendnotification($mentionedusername, '<div class="mdl-color-text--grey-600"><a href="#" onclick="getuserlistings(\''. $commentposter .'\');">'.$commentposter.'</a> mentioned you in a <a href="#" onclick="showitem(\''. $postid .'\')">comment</a>:</div><p> '.$commentmessage.'</p>');
}
echo 'Comment posting...  <meta http-equiv="refresh" content="0; url=index.php?u&view='.$postid.'" />';
}

?>
