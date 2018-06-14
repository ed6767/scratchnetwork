<?php
//Group Setup
if ($_GET['action'] == "groupwizzard") {
    if (!isset($_SESSION['username'])) {
        echo 'Please login to use this wizzard.';
        die();
    }
echo '<!DOCTYPE html>
<html lang="en">
<head> 
  <title>ScratchNetwork Group Creation Wizzard</title>
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
  <h1>ScratchNetwork Group Creation Wizzard</h1>
  <p>'. $_SESSION['username'] .'</p> 
  <a href="index.php?u&main" class="btn btn-primary">Return to home page</a>
</div>

<div class="container">
  <h4>'. formatusername($_SESSION['username']) .',  welcome to the group creation wizzard.</h4>
        <p class="lead">
        Let\'s get started!
        <hr>
         <h5>Group Details</h5>
         <div class="form-group">
  <label for="name">Name:</label>
  <input type="text" class="form-control" id="name" pattern="[a-zA-Z0-9 ]+">
</div>
      <div class="form-group">
  <label for="id">ID</label>
  group/<input type="text" class="form-control" id="id" required pattern="[a-z0-9]+">
</div>
<hr><br>
  <h5>Make your Plan</h5>
        <small>
        Groups are not free. They cost a monthly payment of PushPoints calculated here.<br>
        The first payment is taken from your account, the following payments are taken from the groups bank.<br>
        <span style="color:red;">If your groups bank goes over your selected overdraft, or stays in overdraft for more than a month will go bankrupt and your group will close.</span>
        </small>
<div class="form-group">
  <label for="c1">Maximum Members:</label>
  <select class="form-control" id="c1" onchange="document.getElementsByTagName(\'cost\')[0].innerHTML = document.getElementById(\'c1\').value;">
    <option value=15>3</option>
    <option value=25>5</option>
    <option value=50>10</option>
    <option value=75>15</option>
     <option value=100>20</option>
    <option value=125>25</option>
     <option value=250>50</option>
      <option value=500>100</option>
       <option value=750>150</option>
       <option value=1250>250</option>
  </select>
</div>
Cost: <cost>15</cost>pp monthly<br><br>
<div class="form-group">
  <label for="c2">Maximum Posts:</label>
  <select class="form-control" id="c2" onchange="document.getElementsByTagName(\'cost\')[1].innerHTML = document.getElementById(\'c2\').value;">
    <option value=10>20</option>
    <option value=20>40</option>
    <option value=40>80</option>
    <option value=80>160</option>
  </select>
</div>
Cost: <cost>10</cost>pp monthly<br><br>
<div class="form-group">
  <label for="c3">Overdraft:</label>
  <select class="form-control" id="c3" onchange="document.getElementsByTagName(\'cost\')[2].innerHTML = document.getElementById(\'c3\').value;">
    <option value=10>100pp</option>
    <option value=25>250pp</option>
    <option value=50>500pp</option>
    <option value=100>1000pp</option>
      <option value=500>5000pp</option>
       <option value=1000>10000pp</option>
  </select>
</div>
Cost: <cost>10</cost>pp monthly<br><br>

<span href="#" onclick="document.getElementsByTagName(\'cost\')[3].innerHTML = parseInt(document.getElementById(\'c3\').value) + parseInt(document.getElementById(\'c2\').value) + parseInt(document.getElementById(\'c1\').value);">Click to Refresh total cost</span>
<h5>Final cost: <cost>35</cost>pp per month.</h5>
        </p>
</div>

</body>
</html>

';
    die();
}


// MAIN
$groupdir = "users/". $_GET['username'];
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/ 
function ggup($username) {
    global $groupdir;
if (file_exists($groupdir ."/". $username. ".member")) {
return file_get_contents($groupdir ."/". $username. ".member");
} else {
    return 0;
}
}
$gup = [
//Level 0
    'Non-member',
    //1
    'Ex-member',
    //2
    'Member',
    //3 
    'Curator',
    //4
    'Manager',
    //5
    'Owner'

];
$readgup = [
    'a Non-Member',
    'an Ex-Member',
    'a member',
    'a curator',
    'a manager',
    'the owner'
];

// Detect of inline include from post module
if(isset($GroupModuleIncluded)) {
    echo 'called';
if ($GroupModuleIncluded == "groupSig") {
echo file_get_contents($groupdir . "/sig.htm");
}
    if ($GroupModuleIncluded == "groupButtons") {
echo '<a href="#" onclick="showuserlistings(\''. $_GET['username'] .'\');" class="mdl-button mdl-js-button mdl-js-ripple-effect">View Group</a>';
}

    goto end; // Stop excecution

}

// Verify Group
if (userpermissions($_GET['username']) == -2) {
if (isset($_GET['groupeditor'])) {
    if (!isset($_SESSION['username'])) {
        echo 'Please log in to edit this group.';
        die();
    }
    if (ggup($_SESSION['username']) < 4) {
echo 'You do not have permission to modify this group.';
        die();
    }
    if (isset($_GET['raw'])) {
        if ($_GET['raw'] == "banner") {
          echo file_get_contents($groupdir ."/banner.htm");
        }
         if ($_GET['raw'] == "news") {
          echo file_get_contents($groupdir ."/news.htm");
        }
         if ($_GET['raw'] == "sig") {
          echo file_get_contents($groupdir ."/sig.htm");
        }
        die();
    }
       if (isset($_GET['edit'])) {
        if ($_GET['edit'] == "banner") {
         file_put_contents($groupdir ."/banner.htm", $_POST['content']);
          echo '<meta http-equiv="refresh" content="0; url=server.php?action=getuser&username='. $_GET['username'] .'&groupeditor" />Saving...';
        }
         if ($_GET['edit'] == "news") {
          file_put_contents($groupdir ."/news.htm", $_POST['content']);
          echo '<meta http-equiv="refresh" content="0; url=server.php?action=getuser&username='. $_GET['username'] .'&groupeditor" />Saving...';

        }
           if ($_GET['edit'] == "sig") {
          file_put_contents($groupdir ."/sig.htm", $_POST['content']);
          echo '<meta http-equiv="refresh" content="0; url=server.php?action=getuser&username='. $_GET['username'] .'&groupeditor" />Saving...';

        }
        die();
    }
echo '

<!DOCTYPE html>
<html lang="en">
<head> 
  <title>ScratchNetwork Group Edit '. $_GET['username'] .'</title>
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
          $.get("server.php?action=getuser&username='. $_GET['username'] .'&groupeditor&raw=banner", function(data, status){
$(\'#summernote\').summernote(\'code\', data);
});


  $(\'#summernote2\').summernote();
          $.get("server.php?action=getuser&username='. $_GET['username'] .'&groupeditor&raw=news", function(data, status){
$(\'#summernote2\').summernote(\'code\', data);
});



  $(\'#summernote3\').summernote();
          $.get("server.php?action=getuser&username='. $_GET['username'] .'&groupeditor&raw=sig", function(data, status){
$(\'#summernote3\').summernote(\'code\', data);
});

//end
});
</script>
</head>
<body>

<div class="jumbotron text-center">
  <h1>ScratchNetwork Group Editor</h1>
  <p>'. $_GET['username'] .'</p> 
  <a href="index.php?user='. $_GET['username'] .'" class="btn btn-primary">Return to group page</a>
</div>

<div class="container">
  <h4>'. formatusername($_SESSION['username']) .', you are a '. $gup[ggup($_SESSION['username'])] .' of the '. file_get_contents($groupdir . "/name.txt") .' group.</h4>
        <p class="lead">
        ';
    if (ggup($_SESSION['username']) < 3) {
echo 'You do not have permission to modify this group.';
    } else {
        echo '
        Modify group
        <hr>
        <h5>Edit Banner</h5>
        <small>The header is the first thing people see on your group page.</small>
        <form id="banner" method="post" action="server.php?action=getuser&username='. $_GET['username'] .'&groupeditor&edit=banner">
<textarea id="summernote" name="me" cols="75" id="summernote"></textarea>
<button class="btn btn-primary"type="submit" form="banner" value="Save and apply.">Save and apply</button>
        </form>
        <br><hr>
  <h5>Edit News</h5>
        <small>The news section is for, well, news.</small> 
        <form id="news" method="post" action="server.php?action=getuser&username='. $_GET['username'] .'&groupeditor&edit=news">
<textarea id="summernote2" name="content" cols="75"></textarea>
<button class="btn btn-primary"type="submit" form="news" value="Save and apply.">Save and apply</button>
        </form>
      <br><hr>
      <h5>Edit Post Signiture</h5>
        <small>This shows at the bottom of every group post.</small> 
        <form id="sig" method="post" action="server.php?action=getuser&username='. $_GET['username'] .'&groupeditor&edit=sig">
<textarea id="summernote3" name="content" cols="75"></textarea>
<button class="btn btn-primary"type="submit" form="sig" value="Save and apply.">Save and apply</button>
        </form>
      <br><hr>
  <h5>Invite Members</h5>
        <small>To invite or change users change this document in this format: <pre>username,permissions,next</pre></small>
        <form id="users" method="post" action="server.php?action=getuser&username='. $_GET['username'] .'&groupeditor&edit=members">

<button class="btn btn-primary"type="submit" form="users" value="Save and apply.">Save and apply</button>
        </form>

        ';
    }
    echo '

        </p>
</div>

</body>
</html>

';
    die();
}
if (isset($_GET['newpost'])) {
if (ggup($_SESSION['username']) < 3) {
    echo 'You don\'t have permission for that.';
    die();
}
if (isset($_GET['submit'])) {
    $itemid = newid();
mkdir("items/". $itemid ."/");
file_put_contents("items/". $itemid ."/title.txt", xssclean($_POST['title']));
//author to be replaced with session user once I ADD logins
file_put_contents("items/". $itemid ."/author.txt", $_GET['username']);
file_put_contents("items/". $itemid ."/body.html", xssclean($_POST['message']));
file_put_contents("items/". $itemid ."/link.txt", $_POST['link']);
file_put_contents("items/". $itemid ."/type.txt", $_POST['type']);
file_put_contents("items/". $itemid ."/poster.txt", $_GET['username']); 
   file_put_contents("users/". $_SESSION['username'] . "/lastpost.txt", time());
    file_put_contents("items/". $itemid ."/grouppost.txt", $_GET['username']);
//Final permission thing
//Detect if bad.
if (isbadtext($_POST['message']) or isbadtext($_POST['title']) or isbadtext($_POST['link'])) {
  file_put_contents("items/". $itemid ."/state.txt", "blocked"); 
   echo 'Your post has been blocked by the server because it may be against Scratch\'s community guidelines. Please get a moderator to check it and make it public..'. $itemid;  

  echo '<!-- End -->'; die();
}
if (isset($_POST['hidden']) and $_POST['hidden'] == "yes") {
  file_put_contents("items/". $itemid ."/state.txt", "hidden");
    echo 'Your hidden post has been submitted successfully. You can access it by this link: edxt.net/ed/scratchnetwork/?view='. $itemid;  
  echo '<!-- End -->'; die();
} 

    file_put_contents("items/". $itemid ."/state.txt", "public");
    file_put_contents("items/". $itemid ."/approver.txt", $_SESSION['username']); 
      echo 'Your post has been submitted publicly. You can also access it by this link: edxt.net/ed/scratchnetwork/?view='. $itemid;  
  echo '<!-- End -->'; die();

}
echo '
    <html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.cyan-light_blue.min.css">

<title>Add</title>
<!-- include libraries(jQuery, bootstrap) -->
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 

<!-- include summernote css/js -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script>
$(document).ready(function() {
  $(\'#summernote\').summernote();
});
</script>
</head>
<body>';
if (isset($_GET['msg'])){
    echo'<span style="color:red">'. $_GET['msg'] .'</span>';}
if (file_exists("users/". $_SESSION['username'] . "/lastpost.txt")) {
    if (time() - file_get_contents("users/". $_SESSION['username'] . "/lastpost.txt") < 120) {
        echo 'Woah there speedy-cat! To reduce spam, please wait at least 120 seconds between posts.';
        die();
    }
}
echo '
<center>
<br><br>
<h2>Make a group post</h2>
  <form action="server.php?action=getuser&username='. $_GET['username'] .'&newpost&submit" method="post" id="email">

      This is a...
     <select name="type">
  <option value="project">project</option>
  <option value="studio">studio</option>
  <option value="review">review</option>
  <option value="howto">how-to</option>
    <option value="shop">shop</option>
    <option value="shoporder">shop order</option>
     <option value="other">other post</option>
';
            if ($permissionlevel >= 5) {
                  echo '  <option value="post">announcement</option>';
            }

echo '       </select>
<br>
 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="text" id="title" name="title" maxlength=60 required>
    <label class="mdl-textfield__label" for="title" required>Title</label>
  </div>
  <br>
    <input class="mdl-textfield__input" type="hidden" id="author" name="author" maxlength=30 value="'. $_SESSION['username'] .'">


    <input class="mdl-textfield__input" type="hidden" id="link" name="link" value="">
Description - please add images, banners, links, ext..:<br>
</center>
    <textarea name="message" id="summernote" cols="75"></textarea><br>
<center>
    <label for="checkbox-2">
  <input type="checkbox" id="checkbox-2" value="yes">
  <span class="mdl-checkbox__label">Post as hidden</span>
</label><br>
<i>A hidden post is not Public. The post is only viewable by a link.</i>
<br>
    </form>
<button type="submit" form="email" value="Submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Add to network</button>
</center>
<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</body>
</html>
';
    die();
}

    // GROUP OUTPUT
echo '
     <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
       <div class="mdl-color-text--grey-600">
            GROUP
              </div>
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">'. file_get_contents($groupdir ."/name.txt") .'</h2>
             <div class="content-banner"><br>
'. file_get_contents($groupdir ."/banner.htm") .'
              </div>

              </div>

          </div>

       <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
       <div class="mdl-color-text--grey-600">
            NEWS
              </div>
             <div class="content-news"><br>
'. file_get_contents($groupdir ."/news.htm") .'
              </div>

              </div>

          </div>

';

  $files = glob($groupdir.'/*.member');
usort($files, function($a, $b) {
    return file_get_contents($a) < file_get_contents($b);
});
foreach($files as $file){
    $ThePermissiveUsername = explode(".",explode("/", $file)[3])[0];
  echo '
        <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <div class="mdl-color-text--grey-600">
        Member since '. strtoupper(date('F d Y', filemtime($file))) .'
              </div>

    <h4>'. formatusername($ThePermissiveUsername) .'</h4>
    <p>
   '.$ThePermissiveUsername.' is a ScratchNetwork '. $permissions[userpermissions($ThePermissiveUsername)] .' and '. $readgup[ggup($ThePermissiveUsername)] .' of the '. file_get_contents($groupdir ."/name.txt") .' group.
    </p>
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

              if (!isset($_SESSION['username']) or ggup($_SESSION['username']) < 4){
                   if ($itemstate == "waiting") {throw new Exception('Waiting Approval');}
              if ($itemstate == "removed") {throw new Exception('Item removed');}
                if ($itemstate == "hidden") {throw new Exception('Item hidden');}
                 if ($itemstate == "blocked") {throw new Exception('Item hidden');}
              } else {
              if ($itemstate == "waiting") {$itemtype="WAITING APPROVAL";}
              if ($itemstate == "removed") {$itemtype="REMOVED";}
                if ($itemstate == "hidden") {$itemtype="HIDDEN";}
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

} else {
    echo 'This user is not a group. The use of the group module is not required.';
}

//end
die();

end:
?>
