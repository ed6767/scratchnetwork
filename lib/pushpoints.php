<?php
//pushpoints



    if ($_GET['action'] == "pushpoints"){
    if ($permissionlevel < 2) {
               echo '
     
                 <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Log in</h2>
             <div class="mdl-color-text--grey-600">
       You need to log in as a curator or higher to use PushPoints.
              </div>
    
              </div>
            
          </div>
  
    ';
    die(); 
    }  
    //Main send/recive things
    if (isset($_GET['WARNING-THIS-URL-WILL-EFFECT-YOUR-PUSHPOINTS-DO-NOT-CLICK-THIS-LINK-PLEASE-UNLESS-YOU-WANT-TO-LOSE-YOUR-PUSHPOINTS'])) {
        if (isset($_GET['addpp'])) {
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
 

        
        //Set up vars
        $itemid = $_GET['id'];
         $itemtitle = file_get_contents('items/'.$itemid .'/title.txt');
       //  $itembody = file_get_contents('items/'.$itemid .'/body.html');
        //  $itemlink = file_get_contents('items/'.$itemid .'/link.txt');
          $itemauthor = file_get_contents('items/'.$itemid .'/author.txt');
          //Form submit
          if (isset($_GET['formsubmit'])) {
              additempp($itemid, $_POST['amount']);
              echo '
              Your transaction is being proccessed... Once complete you will be returned to the item page. Full details can be found in your notifications.
              <meta http-equiv="refresh" content="3; url=index.php?u&view='. $itemid .'" />
              ';
              die();
          }
          
          //Display
          if ($itemtitle == "") {} else {
          echo '
                    <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col" data-itemid="'. $itemid .'">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">'.$itemtitle.'</h2>
             <div class="mdl-color-text--grey-600">
            by <a href="#" onclick="showuserlistings(\''.$itemauthor.'\');">'.$itemauthor.'</a>
              </div><br>
              <div id="content-body-'.$itemid.'">
              <br>
             <span style="color:red;">Please note that the minimum push points you can add to this post is <b>'. minitempp($itemid) .'</b></span><br>
             You have <b>'. userpp($_SESSION['username']) .'</b><small>pp</small> in your account.<br>
             <form action="server.php?action=pushpoints&WARNING-THIS-URL-WILL-EFFECT-YOUR-PUSHPOINTS-DO-NOT-CLICK-THIS-LINK-PLEASE-UNLESS-YOU-WANT-TO-LOSE-YOUR-PUSHPOINTS&addpp&formsubmit&id='. $itemid .'" method="post" id="email">
             Number of PushPoints to add
              <input class="mdl-textfield__input" type="number" id="amount" name="amount" value="'. minitempp($itemid) .'" min="'. minitempp($itemid) .'" max="'. userpp($_SESSION['username']) .'" required style="width: 100%;border: 2px solid black;border-radius: 4px;">
<small>Press enter to submit and start transaction.</small>
             </form>
                     
                  </div>
       
             <div class="mdl-card__actions mdl-card--border">
                <a href="#" onclick="showitem(\''. $itemid .'\');" class="mdl-button mdl-js-button mdl-js-ripple-effect">Cancel Transaction</a>
        
   <a href="#" onclick="document.getElementById(\'email\').submit();
" class="mdl-button mdl-js-button mdl-js-ripple-effect">Add PushPoints</a>
    
              </div>
            
          </div>
          ';
         }
     }
    die(); 
    }
   if (isset($_GET['request'])) {
       
       if (isset($_GET['submit'])) {
           sendnotification($_GET['username'], $_SESSION['username'] . " has requested ". $_POST['amount'] . "pp from you. Please visit their profile and transfer this amount.");
           echo 'Requesting....   <meta http-equiv="refresh" content="0; url=index.php?u&user='. $_GET['username'] .'" />';
       }
       
    echo '
    
        <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Request PushPoints</h2>
             <div class="mdl-color-text--grey-600">
            from <a href="#" onclick="showuserlistings(\''.$_GET['username'].'\');">'.$_GET['username'].'</a>
              </div><br>
              <div id="content-body">
              <br>
             <span style="color:red;">Please note that the user is not required to complete your request. If a user refuses to pay for a shop order or otherwise owes you PushPoints, this is called a PPD which can be enforced by Admins.</span><br>
             This user has <b>'. userpp($_GET['username']) .'</b><small>pp</small> in your account.<br>
             <form action="server.php?action=pushpoints&request&submit&username='. $_GET['username'] .'" method="post" id="email">
             Number of PushPoints to request
              <input class="mdl-textfield__input" type="number" id="amount" name="amount" value="10" min="1" required style="width: 100%;border: 2px solid black;border-radius: 4px;">
             </form>
                     
                  </div>
       
             <div class="mdl-card__actions mdl-card--border">
                <a href="#" onclick="showuserlistings(\''. $_GET['username'] .'\');" class="mdl-button mdl-js-button mdl-js-ripple-effect">Cancel Transaction</a>
        
   <a href="#" onclick="document.getElementById(\'email\').submit();
" class="mdl-button mdl-js-button mdl-js-ripple-effect">Request PushPoints</a>
    
              </div>
            
          </div>
          ';
    die();
   } 
      if (isset($_GET['send'])) {
       
       if (isset($_GET['submit'])) {
           transferpp($_GET['username'], $_POST['amount']);
           echo 'Sending....   <meta http-equiv="refresh" content="0; url=index.php?u&user='. $_GET['username'] .'" />';
       }
       
    echo '
    
        <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Send PushPoints</h2>
             <div class="mdl-color-text--grey-600">
            to <a href="#" onclick="showuserlistings(\''.$_GET['username'].'\');">'.$_GET['username'].'</a>
              </div><br>
              <div id="content-body">
          <br>
             You have <b>'. userpp($_SESSION['username']) .'</b><small>pp</small> in your account.<br>
             <form action="server.php?action=pushpoints&send&submit&username='. $_GET['username'] .'" method="post" id="email">
             Number of PushPoints to send
              <input class="mdl-textfield__input" type="number" id="amount" name="amount" value="10" min="1" max="'. userpp($_SESSION['username']) .'" required style="width: 100%;border: 2px solid black;border-radius: 4px;">
             </form>

                  </div>
       
             <div class="mdl-card__actions mdl-card--border">
                <a href="#" onclick="showuserlistings(\''. $_GET['username'] .'\');" class="mdl-button mdl-js-button mdl-js-ripple-effect">Cancel Transaction</a>
        
   <a href="#" onclick="document.getElementById(\'email\').submit();
" class="mdl-button mdl-js-button mdl-js-ripple-effect">Send PushPoints</a>
    
              </div>
            
          </div>
          ';
    die();
   } 
    


    //Display thing
           echo '
             <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
               <div class="mdl-color-text--grey-600">
               YOUR PUSHPOINT BALANCE
               </div>
             <h1 class="mdl-card__title-text" style="align-self: flex-start;">'. numberformat(userpp($_SESSION['username'])) .'<small>pp</small></h1>

            
              </div>
            
          </div>
                 <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">What are PushPoints?</h2>
             <div class="mdl-color-text--grey-600">
       PushPoints(or <small>PP</small> for short) are like a currency for ScratchNetwork. You can use them to push posts on the front page(hence the name "PushPoints"), order items from shops, trade them between your friends and get special perks for your profile.
              </div>
    
              </div>
            
          </div>
          
  
    ';
    die();
}


?>
