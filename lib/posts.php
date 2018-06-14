<?php

    if ($_GET['action'] == "getlistings") {
         echo '
                    <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">ScratchNetwork is closing on June 16th</h2> 
             <div class="mdl-color-text--grey-600">
            <b>After this date, you will not longer be able to use ScratchNetwork</b> - but the site will still be accessable for historical purpouses.
              </div>
              <p>
             <b>'. count( glob("users/*", GLOB_ONLYDIR) ) .'</b> members - <b>'. count( glob("items/*", GLOB_ONLYDIR) ) .'</b> Posts
             </p>
             <br>
             <h2>Official Closing Statement from myeducate and hellounicorn2</h2>
             <p>
             On June 8th, Scratch Team announced their disapproval to ScratchNetwork in an email response to my ban appeal.<br>
<i>

Scratch Team said:

The service you are attempting to run also appears to be a self moderated service which violates our policies. This is effectively the same as allowing a Scratcher to create a public chatroom and link others to it, but claim it is okay because the Scratcher themselves will moderate it. This is again very much not okay.
</i>
<br>
             Because of this decision by Scratch Team, I have made the hard decision to close ScratchNetwork and move it way from Scratch.<br>
ScratchNetwork will close on the 14th of June. We will then rebrand it to YEN. You can see progress on the new site at our temporary forum below!<br><br>

Thanks for your continued support across an awesome 3 months,<br>
Ed.E<br>
             </p>
             <p>
              Since the ST has banned linking to us please remove ANY occurrences in which you linked to us in order to prevent receiving alerts. Now, ScratchNetwork no longer must follow the Scratch community guidlines. As such, if you can please join https://discord.gg/HFzrKK7 if you are allowed to use discord. If you are not please await the new website at theyen.site . Soon this domain will become a redirect to that website. On behalf of the whole team we would like to apologise to anyone who put effort into being promoted, moved their shops here and did basically anything on here. We hope you see oppurtunity in the new website, named "Young Entrepreneurial Network". Even better, it will be possible to earn money on it. Pushpoints will probably remain. Also, I will be helping with the coding on yen (yay) and I am being taught php. There may still be pp on yen and you will keep your ranks here there I assume. We thank everyone for understanding and hope you do well on yen!
             </p>



             <div class="mdl-card__actions mdl-card--border">
                             <a href="https://discord.gg/HFzrKK7" class="mdl-button mdl-js-button mdl-js-ripple-effect">JOIN THE YEN DISCORD!</a>
                               <a href="https://yen.freeflarum.com" class="mdl-button mdl-js-button mdl-js-ripple-effect">Go to the Yen Forums</a>
                <a href="#" onclick="rickroll();" class="mdl-button mdl-js-button mdl-js-ripple-effect">One last rickroll?</a>


              </div>

          </div>

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
                    <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col" IAMITEMLISTING="yes" data-itemid="'. $itemid .'">
                    <div class="mdl-color-text--grey-600">';
                    if ($itemtype == "project") {
                        echo 'PROJECT';
                    } elseif ($itemtype == "studio") {
                          echo 'STUDIO'; 
                    } elseif ($itemtype == "review") {
                          echo 'REVIEW';
                    } elseif ($itemtype == "howto") {
                          echo 'HOW-TO';
                    } elseif ($itemtype == "shop") {
                          echo 'SHOP';
                    } elseif ($itemtype == "shoporder") {
                          echo 'SHOP ORDER';
                    } elseif ($itemtype == "other") {
                          echo 'OTHER POST';
                    } elseif ($itemtype == "post") {
                          echo 'ANNOUNCEMENT';
                    } else {
                        echo 'OTHER'; 
                    }
     echo ' - '. itempp($itemid) .' PP
   </div>
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

} 

}

}
    


if ($_GET['action'] == "getitem") {
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
        
        //Set up vars
        $itemid = $_GET['id'];
         $itemtitle = file_get_contents('items/'.$itemid .'/title.txt');
         $itembody = file_get_contents('items/'.$itemid .'/body.html');
        // was used:  $itemlink = file_get_contents('items/'.$itemid .'/link.txt');
      $itemauthor = file_get_contents('items/'.$itemid .'/author.txt');
                 $itemtype = file_get_contents('items/'.$itemid .'/type.txt');
        $itemstate = file_get_contents('items/'.$itemid .'/state.txt');
        $itemapprover = "unknown";
        $itemposter = "unknown";
        
    //Buttons for moderators
    $itembuttons = '
    <!-- BACK -->
      <a href="#" onclick="loadlistings();" class="mdl-button mdl-js-button mdl-js-ripple-effect">Back</a>
  
    ';
    if (file_exists('items/'.$itemid .'/poster.txt') and $permissionlevel > 0) {
               $itemposter = file_get_contents('items/'.$itemid .'/poster.txt');
               if ($_SESSION['username'] == $itemposter) {
                  $itembuttons .= '  <a href="#" onclick="edit(\''. $itemid .'\');" class="mdl-button mdl-js-button mdl-js-ripple-effect">Edit</a>';
               }
    }
        if (file_exists('items/'.$itemid .'/approver.txt')) {
     $itemapprover = file_get_contents('items/'.$itemid .'/approver.txt');
        }
   
    if (isset($_SESSION['permissions'])) {
    $permissionlevel = $_SESSION['permissions'];
    if ($itemstate == "public") {
        


        if ($permissionlevel >= 1) {
               $itembuttons = $itembuttons . '
            <!-- REPORT -->
   <a href="#" onclick="confirmreport(\''. $itemid .'\');" class="mdl-button mdl-js-button mdl-js-ripple-effect">Report</a>
        ';  
        }
        // Trusted curator
            if ($permissionlevel >= 3) {
               $itembuttons = $itembuttons . '
            <!-- REPORT Priority -->
   <a href="#" onclick="if(window.confirm(\'Are you sure about dat???? False prority reports are annoying and will get you demoted.... \')){ window.location.href = \'server.php?action=priorityreport&postid='. $itemid .'\'; }" class="mdl-button mdl-js-button mdl-js-ripple-effect">Prority Report</a>
        ';  
        }
                  if ($permissionlevel >= 4) {
               $itembuttons = $itembuttons . '
            <!-- Edit -->
  <a href="#" onclick="edit(\''. $itemid .'\');" class="mdl-button mdl-js-button mdl-js-ripple-effect">Edit</a><a href="#" onclick="removepost(\''. $itemid .'\');" class="mdl-button mdl-js-button mdl-js-ripple-effect">Remove</a>
    
    
        ';  
        }
                // ROBLOX ADMINS!!! 
                  if ($permissionlevel >= 5) {
               $itembuttons = $itembuttons . '
   
        ';  
        }
    } elseif ($itemstate == "waiting") {
             if ($permissionlevel >= 3) {
               $itembuttons = $itembuttons . '
                  <a href="#" onclick="approvepost(\''. $itemid .'\');" class="mdl-button mdl-js-button mdl-js-ripple-effect">make public</a>
            <!-- REPORT Priority -->
   <a href="#" onclick="if(window.confirm(\'Are you sure? False prority reports are annoying and will get you demoted.... \')){ window.location.href = \'server.php?action=priorityreport&postid='. $itemid .'\'; }" class="mdl-button mdl-js-button mdl-js-ripple-effect">Prority Report</a>
        ';  
        }
          // Moderator
                  if ($permissionlevel >= 4) {
               $itembuttons = $itembuttons . '
            <!-- Edit -->
   <a href="#" onclick="edit(\''. $itemid .'\');" class="mdl-button mdl-js-button mdl-js-ripple-effect">Edit</a>
    <a href="#" onclick="removepost(\''. $itemid .'\');" class="mdl-button mdl-js-button mdl-js-ripple-effect">Remove</a>
    
        ';  
        }
             if ($permissionlevel >= 5) { 
      }
        
    } else {
        //Removed or hidden
                     if ($permissionlevel >= 3) {
               $itembuttons = $itembuttons . '
                  <a href="#" onclick="approvepost(\''. $itemid .'\');" class="mdl-button mdl-js-button mdl-js-ripple-effect">make public</a>
            <!-- REPORT Priority -->
   <a href="#" onclick="if(window.confirm(\'Are you sure about dat???? False prority reports are annoying and will get you demoted.... \')){ window.location.href = \'server.php?action=priorityreport&postid='. $itemid .'\'; }" class="mdl-button mdl-js-button mdl-js-ripple-effect">Prority Report</a>
        ';  
        }
          // Moderator
                  if ($permissionlevel >= 4) {
               $itembuttons = $itembuttons . '
            <!-- Edit -->
  <a href="#" onclick="edit(\''. $itemid .'\');" class="mdl-button mdl-js-button mdl-js-ripple-effect">Edit</a>';
                      
                  }
      if ($permissionlevel >= 5) { 
          //Admin
           $itembuttons = $itembuttons . '<a href="#" onclick="if(window.confirm(\'Are you sure? This post will be deleted from the view of you and the creator. It will not be able to be reshared but can be recovered if you ask myed. \')){ window.location.href = \'server.php?action=addlisting&delete&id='. $itemid .'\'; }"  class="mdl-button mdl-js-button mdl-js-ripple-effect">Delete Post</a>

        ';  }
        }
    }

    



          if ($itemtitle == "") {} else {
          echo '
                    <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col" IAMITEMLISTING="yes" data-itemid="'. $itemid .'">
                                <div class="mdl-color-text--grey-600">';
                    if ($itemtype == "project") {
                        echo 'PROJECT';
                    } elseif ($itemtype == "studio") {
                          echo 'STUDIO'; 
                    } elseif ($itemtype == "review") {
                          echo 'REVIEW';
                    } elseif ($itemtype == "howto") {
                          echo 'HOW-TO';
                    } elseif ($itemtype == "shop") {
                          echo 'SHOP';
                    } elseif ($itemtype == "shoporder") {
                          echo 'SHOP ORDER';
                    } elseif ($itemtype == "other") {
                          echo 'OTHER POST';
                    } elseif ($itemtype == "post") {
                          echo 'ANNOUNCEMENT';
                    } else {
                        echo 'OTHER'; 
                    }
   echo '   -  '. itempp($itemid) .'<small>pp</small>      </div>
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">'.$itemtitle.'</h2>
             <div class="mdl-color-text--grey-600">
            by <a href="#" onclick="showuserlistings(\''.$itemauthor.'\');">'.formatusername($itemauthor).'</a>
              </div><br>
              <div id="content-body-'.$itemid.'">
              <!-- USER GENERATED -->
                '.$itembody.'
                     <!-- END USER GENERATED --> 
                     '; 
              //Add group sig
              if (file_exists("items/". $itemid. "/grouppost.txt")) {
$GroupModuleIncluded = "groupSig";
                  $_GET['username'] = $itemposter;
                  require "lib/groups.php";
              }
              echo'
                     <br><br>';
                     if ($itemstate == "removed") {
                            echo '  <small><i>Link to post: <a href="//edxt.net/ed/scratchnetwork/?view='.$itemid.'">edxt.net/ed/scratchnetwork/?view='.$itemid.'</a></small><br></i>
                     <i>This post was approved by</i> '. formatusername($itemapprover) .' <i>and posted by</i> '. formatusername($itemposter). ' <i> but was later removed by '. formatusername(file_get_contents("items/". $itemid ."/remover.txt")) .'</i>';
                     } elseif ($itemstate == "hidden") {
                            echo '  <small><i>Link to post: <a href="//edxt.net/ed/scratchnetwork/?view='.$itemid.'">edxt.net/ed/scratchnetwork/?view='.$itemid.'</a></small><br></i>
                     <i>This post is hidden. It was posted by </i> '. formatusername($itemposter);

                     } else {
                          echo '  <small><i>Link to post: <a href="//edxt.net/ed/scratchnetwork/?view='.$itemid.'">edxt.net/ed/scratchnetwork/?view='.$itemid.'</a></small></i>
                                      <br><small><a href="#" onclick="addpp(\''. $itemid .'\');">Add PushPoints</a> - The minimum PushPoints to add to this post is '. minitempp($itemid) .'</small><br>
                     <i>This post was approved by</i> '. formatusername($itemapprover) .' <i>and posted by</i> '. formatusername($itemposter);
                     }
                     
                   echo '

                  </div>
       
             <div class="mdl-card__actions mdl-card--border">
              '. $itembuttons;  
                if (file_exists("items/". $itemid. "/grouppost.txt")) {
$GroupModuleIncluded = "groupButtons";
                  $_GET['username'] = $itemposter;
                  require "lib/groups.php";
              }
              echo'

              </div>

          </div>
          ';
          //Comments
                  //CHECK IF BANNED
    if (userpermissions($itemposter) == 0) {
echo '
<script>
loadlistings();
shownoticeDialog("Sorry, this post is unavailible.");
</script>
';
        die();
    }
          if ($permissionlevel > 1) {
              echo '
               <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Comments</h2>
             <span style="color:red;"><i>These comments are public to ScratchNetwork curators. Everything you read, write and post can be seen by everyone.</i></span>
          <form id="comment" action="server.php?action=comments" method="post">
<input type="hidden" name="id" value="'. $itemid .'" />
  <p id="postc"><b>'. $_SESSION['username'] .'</b>  <input type="text" id="message" name="message" minlength=2 maxlength=512 style="width:60%"></p>

  <input type="hidden" id="name" value="'.$_SESSION['username'].'">
<hr>
<div class="comments"></div>
</form>
    
              </div>
            
          </div>

<!-- Script -->
        <script>
        var nextisnew = false;    
$(function() {
  let database = firebase.database();
    let postRef = database.ref("comments/" + slugify("'. $itemid .'"));

    postRef.on("child_added", function(snapshot) {
      var newPost = snapshot.val();
      if (nextisnew) {
          window.location.replace("server.php?action=comments&id='. $itemid .'&commentid=" + snapshot.key);
      } else {
      var chee;

      chee = escapeHtml(newPost.message);
       chee = replacementions(chee);

             $(".comments").prepend(\'\' +
        \'<b>\' + escapeHtml(newPost.name) + \'</b> \' + chee  + \'<small><a href="#" onclick="document.getElementById(\\\'message\\\').value=\"@\'+ newPost.name +\'\";" style="float: right;">reply</a><a href="server.php?action=reportcomment&path=scratch-network/comments/\'+ slugify("'. $itemid .'") + \'/\' + snapshot.key +\'" style="float: right;">report</a></small>';
        if ($permissionlevel > 3) {
            echo '<small><a style="color:red;float: right;" href="server.php?action=comments&remove&path=comments/\'+ slugify("'. $itemid .'") + \'/\' + snapshot.key +\'" style="float: right;">REMOVE</a></small> ';
        }
        echo '<hr>\');  
      }
 
 
    });

 /*   $("#comment").submit(function(e) {
    nextisnew = true;
    banner("Please wait...");
    e.preventDefault();
        $.get("https://www.purgomalum.com/service/plain?text=" + $("#message").val() +"&fill_text=unicorn", function(data, status){
      
           var a = postRef.push();
     banner("Your comment is being posted...");
a.set({
        name: $("#name").val(),
        message: _.escape(data)
      });

      $("input[type=text], textarea").val("");
     
  
});

      
    }); */
   
});

function slugify(text) {
  return text.toString().toLowerCase().trim()
    .replace(/&/g, \'-and-\')
    .replace(/[\s\W-]+/g, \'-\')
    .replace(/[^a-zA-Z0-9-_]+/g,\'\');
}


function escapeHtml(str) {
    var div = document.createElement(\'div\');
    div.appendChild(document.createTextNode(str));
    return div.innerHTML;
}
        </script>
              
              ';
          }
          // Shop specifics
         if ($itemtype !== "shop") { echo '<!-- End -->'; die(); }
         if (isset($_SESSION['username'])) {} else { 
                  echo '
                          <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Order from shop</h2>
             <div class="mdl-color-text--grey-600">
           To order from this shop, you need to sign in with your Scratch account. Click "sign in with Scratch" and follow the basic instructions.
              </div>
    
              </div>
            
          </div>

         
         ';    
             
             echo '<!-- End -->'; die(); 
             
         }
         echo '
                          <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Order from shop</h2>
             <div class="mdl-color-text--grey-600">
           Place an order here. Make sure you use one of our order forms!
       <form id="order" action="server.php?action=addlisting&shoporder&id='. $itemid .'" method="post">
       <textarea name="body" cols="75" rows="8" required>
       </textarea>
       </form>
       <button type="submit" form="order" value="Submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Place order</button>
              </div>
    
              </div>
            
          </div>

         
         ';
         if ($itemposter == $_SESSION['username'] or $permissionlevel > 3) {}else{echo '<!-- End -->'; die();}
         //List orders only mods and OP
  echo '
            <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Shop orders</h2>
             <div class="mdl-color-text--grey-600">
            View the orders below. When you are done, click "Remove" on the order.
            
              </div>
    
              </div>
            
          </div>
  ';         
if ($handle = opendir('items/'. $_GET['id'])) {
    while (false !== ($file = readdir($handle)))
    {
        if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'shoporder')
        {
          if (file_get_contents("items/". $_GET['id'] ."/". $file) == "") {} else {
              echo '
            <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Order placed on '. date("F d Y", filemtime("items/". $_GET['id'] ."/". $file)) .'</h2>
             <div class="mdl-color-text--grey-600">
           '. file_get_contents("items/". $_GET['id'] ."/". $file) .'
              </div>
              <br>
              <small>Link to order: <a href="//edxt.net/ed/scratchnetwork/items/'. $itemid .'/'.$file.'">edxt.net/ed/scratchnetwork/items/'. $itemid .'/'.$file.'</a></small>
                    <div class="mdl-card__actions mdl-card--border">
                <a href="server.php?action=addlisting&shoporderremove&id='. $_GET['id'] .'&file='. $file .'" class="mdl-button mdl-js-button mdl-js-ripple-effect">Remove</a>
                </div>
    
              </div>
            
          </div>
  ';
          }
        }
    }
    closedir($handle);
}

//End
         }
}
     
     
     //Waiting
     if ($_GET['action'] == "getwaitinglistings") {
          if ($permissionlevel > 2) { } else {
              echo 'You don\'t have permsission to view waiting items.';
          }
          $dir = new DirectoryIterator('items');
foreach ($dir as $fileinfo) {
    if ($fileinfo->isDir() && !$fileinfo->isDot()) {
       try { 
        //Set up vars
        $itemid = $fileinfo->getFilename();
         $itemtitle = file_get_contents('items/'.$itemid .'/title.txt');
        $itemtype = file_get_contents('items/'.$itemid .'/type.txt');
        $itemstate = file_get_contents('items/'.$itemid .'/state.txt');
          $itemauthor = file_get_contents('items/'.$itemid .'/author.txt');
          if ($itemtitle == "") {} else {
              if ($itemstate == "waiting") {
       
            
          echo '
                    <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col" IAMITEMLISTING="yes" data-itemid="'. $itemid .'">
                                <div class="mdl-color-text--grey-600">';
                    if ($itemtype == "project") {
                        echo 'WATING - PROJECT';
                    } elseif ($itemtype == "studio") {
                          echo 'WATING - STUDIO'; 
                    } elseif ($itemtype == "review") {
                          echo 'WATING - REVIEW';
                    } elseif ($itemtype == "howto") {
                          echo 'WATING - HOW-TO';
                    } elseif ($itemtype == "shop") {
                          echo 'WAITING - SHOP';
                    } elseif ($itemtype == "shoporder") {
                          echo 'WAITING - SHOP ORDER';
                    } elseif ($itemtype == "other") {
                          echo 'WAITING - OTHER POST';
                    } elseif ($itemtype == "post") {
                          echo 'ANNOUNCEMENT';
                    } else {
                        echo 'WAITING - OTHER'; 
                    }
   echo '         </div>
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">'.$itemtitle.'</h2> 
             <div class="mdl-color-text--grey-600">
            by <a href="#" onclick="showuserlistings(\''.$itemauthor.'\');">'.formatusername($itemauthor).'</a>
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
       }
       catch(Exception $e) {
echo '<!-- Exception '. $e->getMessage() . ' -->';
}   
    }
}
    
}

if ($_GET['action'] == "addlisting") {
  
  //Only allow Curators or higher past here.
 if ($permissionlevel < 2) {
echo '
           <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Log in</h2>
             <div class="mdl-color-text--grey-600">
            You must be logged in as a curator or higher to add or modify listings.
            
              </div>
                    <div class="mdl-card__actions mdl-card--border">
                <a href="#" onclick="loadlistings();" class="mdl-button mdl-js-button mdl-js-ripple-effect">Return</a>
                </div>
    
              </div>

          </div>
          ';
echo '<!-- End -->'; die();
}
//Return the page if asked
if (isset($_GET['returnpage'])) {
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
echo '<br><br>
  <form action="server.php?action=addlisting&posted" method="post" id="email">
      
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
    <textarea name="message" id="summernote" cols="75"></textarea><br>
    <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-2">
  <input type="checkbox" id="checkbox-2" class="mdl-checkbox__input" name="hidden" value="yes">
  <span class="mdl-checkbox__label">Post as hidden</span>
</label>
<i>A hidden post does not require confirmation but is not public. The post is only viewable by a link.</i>
    </form>
<button type="submit" form="email" value="Submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Add to network</button>

<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</body>
</html>
    
    
    ';
    echo '<!-- End -->'; die();
}


// Create the listing
if (isset($_GET['posted'])) {
    if ($_POST['type'] == "post") { 
        if ($permissionlevel < 5) {
        echo 'You do not have permssion to post an announcment.';
        echo '<!-- End -->'; die();
        }
        
    }
$itemid = newid();
mkdir("items/". $itemid ."/");
file_put_contents("items/". $itemid ."/title.txt", xssclean($_POST['title']));
//author to be replaced with session user once I ADD logins
file_put_contents("items/". $itemid ."/author.txt", $_POST['author']);
file_put_contents("items/". $itemid ."/body.html", xssclean($_POST['message']));
file_put_contents("items/". $itemid ."/link.txt", $_POST['link']);
file_put_contents("items/". $itemid ."/type.txt", $_POST['type']);
file_put_contents("items/". $itemid ."/poster.txt", $_SESSION['username']); 
   file_put_contents("users/". $_SESSION['username'] . "/lastpost.txt", time());
//Final permission thing
//Detect if bad.
if (isbadtext($_POST['message']) or isbadtext($_POST['title']) or isbadtext($_POST['link'])) {
  file_put_contents("items/". $itemid ."/state.txt", "blocked"); 
   echo 'Your post has been blocked by the server because it may be against Scratch\'s community guidelines. Please check your notifications for more info.'. $itemid;  
             sendnotification($_SESSION['username'], "Your post '". $_POST['title']."' was blocked by the filterbot. <a href='//edxt.net/ed/scratchnetwork/?view=snowingplay1843'>Please see this FAQ</a> for more infomation.");
  echo '<!-- End -->'; die();
} 
if (isset($_POST['hidden']) and $_POST['hidden'] == "yes") {
  file_put_contents("items/". $itemid ."/state.txt", "hidden");
    echo 'Your hidden post has been submitted successfully. You can find it in your "My Posts" section. You can also access it by this link: edxt.net/ed/scratchnetwork/?view='. $itemid;  
  echo '<!-- End -->'; die();
} 

if ($permissionlevel < 3) {
  file_put_contents("items/". $itemid ."/state.txt", "waiting"); 
   echo 'Your post has been submitted for review. You can find the status of the review in your "My Posts" section. You can also access it by this link: edxt.net/ed/scratchnetwork/?view='. $itemid;  
             sendnotification($_SESSION['username'], "Your post '". file_get_contents('items/'.$itemid .'/title.txt') ."' has been submitted for review.");
  echo '<!-- End -->'; die();
} else {
    file_put_contents("items/". $itemid ."/state.txt", "public");
    file_put_contents("items/". $itemid ."/approver.txt", $_SESSION['username']); 
      echo 'Your post has been submitted publicly. You can find it wit the review in your "My Posts" section. You can also access it by this link: edxt.net/ed/scratchnetwork/?view='. $itemid;  
  echo '<!-- End -->'; die();
}


  echo 'Your post has been submitted successfully. If everything is OK it will show on the site within 7 days. If you are a trusted curator or higher it is now public.';  
  echo '<!-- End -->'; die();

}

//APPROVE
      if (isset($_GET['approve'])) {
          if ($permissionlevel < 3) { echo 'You do not have permission to approve this post.'; }
           //Approve Listing   
                file_put_contents("items/". $_GET['id'] ."/state.txt", "public");
               file_put_contents("items/". $_GET['id'] ."/approver.txt", $_SESSION['username']); 
                         sendnotification(file_get_contents("items/". $_GET['id'] ."/poster.txt"), "Your post '". file_get_contents('items/'.$_GET['id'].'/title.txt') ."' was approved by ". formatusername($_SESSION['username']) . " and is now availible on the network.");
           echo '
                       <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Item released.</h2>
             <div class="mdl-color-text--grey-600">
            Now availible on network
            
              </div>
                    <div class="mdl-card__actions mdl-card--border">
                <a href="#" onclick="loadwaitinglistings();" class="mdl-button mdl-js-button mdl-js-ripple-effect">Return</a>
                </div>
    
              </div>
             
          </div>
           ';    
           echo '<!-- End -->'; die();
          }
     
     //REMOVE POST     
  if (isset($_GET['remove'])) {
              if ($permissionlevel < 4) { echo 'You do not have permission to remove this post.'; }
              $itemid = $_GET['id'];
        if (file_exists('items/'.$itemid .'/approver.txt')) {
     $itemapprover = file_get_contents('items/'.$itemid .'/approver.txt');
      if (userpermissions($itemapprover) >= $permissionlevel) {
          if ($_SESSION['username'] == $itemapprover){} elseif (false) {} else {
                    echo '
                       <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Item can\'t be removed.</h2>
             <div class="mdl-color-text--grey-600">
            Sorry, You can\'t remove a post that was approved by an admin or another moderator.
            
              </div>
                    <div class="mdl-card__actions mdl-card--border">
                <a href="#" onclick="loadlistings();" class="mdl-button mdl-js-button mdl-js-ripple-effect">Return</a>
                </div>
    
              </div>
             
          </div>
           ';    
           echo '<!-- End -->'; die(); 
          }
              }
              
        }
        
        
             
           //Remove Listing   
                file_put_contents("items/". $_GET['id'] ."/state.txt", "removed");
               file_put_contents("items/". $_GET['id'] ."/remover.txt", $_SESSION['username']); 
                         sendnotification(file_get_contents("items/". $_GET['id'] ."/poster.txt"), "Your post '". file_get_contents('items/'.$_GET['id'] .'/title.txt') ."' was removed from ScratchNetwork by ". formatusername($_SESSION['username']));
           echo '
                       <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Item removed.</h2>
             <div class="mdl-color-text--grey-600">
            No longer availible on network.
            
              </div>
                    <div class="mdl-card__actions mdl-card--border">
                <a href="#" onclick="loadlistings();" class="mdl-button mdl-js-button mdl-js-ripple-effect">Return</a>
                </div>
    
              </div>
             
          </div>
           ';    
           echo '<!-- End -->'; die();
  }
  if (isset($_GET['delete'])) {
           if ($permissionlevel >= 5) { 
          $itemid = $_GET['id'];
                  if (file_exists('items/'.$itemid .'/poster.txt')) {
     $itemapprover = file_get_contents('items/'.$itemid .'/poster.txt');
      if (userpermissions($itemapprover) >= $permissionlevel) {
          if ($_SESSION['username'] == $itemapprover){} elseif (false) {} else {
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
You can\'t delete another admins posts.

</div>


            ';
            echo '<!-- End -->'; die(); 
          }
              }
              
        }
         
          sendnotification($itemapprover, "Your post '". file_get_contents('items/'.$itemid .'/title.txt') ."' was deleted permanatly from ScratchNetwork by ". formatusername($_SESSION['username']));
           unlink("items/". $itemid ."/title.txt");
    echo'      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
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
  <b><font size=5>Deleted</font></b><br>
Item was deleted.

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
You need to log in as an admin to delete posts.

</div>


            ';
            echo '<!-- End -->'; die();
           }
  }
          
          //Shop order
  if (isset($_GET['shoporder'])) {
    file_put_contents("items/". $_GET['id'] ."/". newid() .".shoporder", "Ordered by:". $_SESSION['username'] ."<br>" .xssclean($_POST['body']));
    sendnotification($_SESSION['username'], "Your order for '". file_get_contents("items/". $_GET['id'] ."/title.txt"). "' has been placed successfully.");
      sendnotification(file_get_contents("items/". $_GET['id'] ."/poster.txt"), "You have a new order on '<a href='index.php?view=". $_GET['id'] ."'>". file_get_contents("items/". $_GET['id'] ."/title.txt"). "'</a>");
    echo 'Your order is being placed...
    <meta http-equiv="refresh" content="0; url=index.php?u&shopordercomplete" />

    ';
    echo '<!-- End -->'; die();
    }
    
          if (isset($_GET['shopordercomplete'])) {
  echo '
            <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Order placed</h2>
             <div class="mdl-color-text--grey-600">
            Your order has been placed successfully. You will be notified on your profile when the order is complete.
            
              </div>
                    <div class="mdl-card__actions mdl-card--border">
                <a href="#" onclick="loadlistings();" class="mdl-button mdl-js-button mdl-js-ripple-effect">Return</a>
                </div>
    
              </div>
            
          </div>
  ';
  echo '<!-- End -->'; die();
    }
    
      if (isset($_GET['shoporderremove'])) {
    file_put_contents("items/". $_GET['id'] ."/". $_GET['file'], "");
    echo 'This order is being removed...
    <meta http-equiv="refresh" content="0; url=index.php?u&shoporderremoved&returnid='. $_GET['id'] .'" />

    ';
    echo '<!-- End -->'; die();
    }
          if (isset($_GET['shoporderremoved'])) {
  echo '
            <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Order removed</h2>
             <div class="mdl-color-text--grey-600">
            This order was removed successfully.
            
              </div>
                    <div class="mdl-card__actions mdl-card--border">
                <a href="#" onclick="showitem(\''. $_GET['returnid'] .'\');" class="mdl-button mdl-js-button mdl-js-ripple-effect">Return</a>
                </div>
    
              </div>
            
          </div>
  ';
  echo '<!-- End -->'; die();
    }
    
    //Editing
    if (isset($_GET['edit']) and isset($_GET['id']) ) {
          //Only allow OP or mods post here
          $itemid = $_GET['id'];
         $itemtitle = file_get_contents('items/'.$itemid .'/title.txt');
        $itembody = file_get_contents('items/'.$itemid .'/body.html');
          $itemlink = file_get_contents('items/'.$itemid .'/link.txt');
          $itemauthor = file_get_contents('items/'.$itemid .'/author.txt');
           $itemposter = file_get_contents('items/'.$itemid .'/poster.txt');
           if (isset($_GET['raw'])) {
               echo $itembody;
               die();
           }
if ($permissionlevel <= userpermissions($itemposter) and $itemposter !== $_SESSION['username']) {
  echo '
           <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Not authorised</h2>
             <div class="mdl-color-text--grey-600">
            You can\'t modify an admins post.
            
              </div>
                    <div class="mdl-card__actions mdl-card--border">
                <a href="#" onclick="showlisting(\''. $itemid .'\');" class="mdl-button mdl-js-button mdl-js-ripple-effect">Return</a>
                </div>
    
              </div>
            
          </div>
          ';
echo '<!-- End -->'; die();  
}
 if ($permissionlevel < 4 and $itemposter !== $_SESSION['username']) {
     
echo '
           <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Log in</h2>
             <div class="mdl-color-text--grey-600">
            You must be logged in as a moderator or the original poster to edit this post.
            
              </div>
                    <div class="mdl-card__actions mdl-card--border">
                <a href="#" onclick="loadlistings();" class="mdl-button mdl-js-button mdl-js-ripple-effect">Return</a>
                </div>
    
              </div>
            
          </div>
          ';
echo '<!-- End -->'; die();
}
if (isset($_GET['do'])) {
    file_put_contents("items/". $itemid ."/title.txt",xssclean($_POST['title']));
//author to be replaced with session user once I ADD logins
file_put_contents("items/". $itemid ."/body.html", xssclean($_POST['message']));
file_put_contents("items/". $itemid ."/link.txt", $_POST['link']);
if ($_POST['type'] !== "nochange") {
 file_put_contents("items/". $itemid ."/type.txt", $_POST['type']);   
}

  sendnotification($itemposter, "Your post '". $_POST['title']."' has been edited by ". formatusername($_SESSION['username']));
    echo 'Your edit has been submitted.';
die();
}
if (isset($_GET['form'])) {
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
          $.get("server.php?action=addlisting&edit&raw&id='. $itemid .'", function(data, status){
$(\'#summernote\').summernote(\'code\', data);
});
  

});
</script>
  

</head>
<body>';
if (isset($_GET['msg'])){
    echo'<span style="color:red">'. $_GET['msg'] .'</span>';}

echo '<br><br>
  <form action="server.php?action=addlisting&edit&do&id='. $itemid .'" method="post" id="email">
      
      Item type: 
     <select name="type">
      <option value="nochange">Do not change</option>
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
    <input class="mdl-textfield__input" type="text" id="title" name="title" maxlength=60 required value="'. $itemtitle .'" required>
    <label class="mdl-textfield__label" for="title" required>Title</label>
  </div>
  <br>
 <input class="mdl-textfield__input" type="hidden" id="author" name="author" maxlength=30 value="'. $_SESSION['username'] .'">
  

    <input class="mdl-textfield__input" type="hidden" id="link" name="link" value="">
    <br>
Description - please add images, banners, links, ext..:<br>
    <textarea id="summernote" name="message" cols="75" id="summernote"></textarea><br>

    </form>
<button type="submit" form="email" value="Submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Submit Edit</button>

<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</body>
</html>
    
    
    ';
    echo '<!-- End -->'; die();

}

//Display edit
echo '
           <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Edit listing</h2>
             <div class="mdl-color-text--red-400">
      
            <iframe src="server.php?action=addlisting&edit&form&id='. $itemid .'" height=600></iframe>
              </div>
 
                    <div class="mdl-card__actions mdl-card--border">
                <a href="#" onclick="if(window.confirm(\'Are you sure? You will lose ALL unsaved work. If you want to save, copy the lisitng into a Rich Text Editor like WordPad, OpenOffice or Google Docs. \')){ loadlistings(); }" class="mdl-button mdl-js-button mdl-js-ripple-effect">Discard</a>
                </div>

              </div>
            
          </div>
          ';
          die();
    }

          
//The actual display thing
echo '
           <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">New Post</h2>
             <div class="mdl-color-text--red-400">

            <iframe src="server.php?action=addlisting&returnpage" height=600></iframe>
              </div>
 
                    <div class="mdl-card__actions mdl-card--border">
                <a href="#" onclick="if(window.confirm(\'Are you sure? You will lose ALL unsaved work. If you want to save, copy the lisitng into a Rich Text Editor like WordPad, OpenOffice or Google Docs. \')){ loadlistings(); }" class="mdl-button mdl-js-button mdl-js-ripple-effect">Discard</a>
                </div>
    
              </div>

          </div>
          ';
    

}


?>
