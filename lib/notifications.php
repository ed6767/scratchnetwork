<?php

    //Notifications
if ($_GET['action'] == "notifications") {
    if ($permissionlevel < 1) {
               echo '
     
                 <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Login</h2>
             <div class="mdl-color-text--grey-600">
       You need to log in to see your notifications.
              </div>
    
              </div>
            
          </div>
  
    ';
    die(); 
    }
        echo '
     
                 <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">Notifications</h2>
    
              </div>
            
          </div>
  
    ';
    
    //Sort chromnalogically - show read
    $files = glob('users/'. $_SESSION['username'] .'/*.notification');
usort($files, function($a, $b) {
    return filemtime($a) < filemtime($b);
});
foreach($files as $file){
  echo '
        <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <div class="mdl-color-text--grey-600">
        NEW - '. strtoupper(date('F d Y, H:i', filemtime($file))) .'
              </div>
              <p>
    '. file_get_contents($file) .'
    </p>
              </div>
            
          </div>
  ';
  //Rename to read!
 // rename($file, "users/". $_SESSION['username']. "/". newid() . ".readnotification");
}
//List read notifications
 $files2 = glob('users/'. $_SESSION['username'] .'/*.readnotification');
usort($files2, function($a, $b) {
    return filemtime($a) < filemtime($b);
});
foreach($files2 as $file){
  echo '
        <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col" style=\'opacity:0.69\'>
             <div class="mdl-color-text--grey-600">
        '. strtoupper(date('F d Y, H:i', filemtime($file))) .'
              </div>
              <p>
    '. file_get_contents($file) .'
             </p>
              </div>
            
          </div>
  ';

}

//Mark notifications as read
    //Sort chromnalogically - show read
    $files = glob('users/'. $_SESSION['username'] .'/*.notification');
usort($files, function($a, $b) {
    return filemtime($a) < filemtime($b);
});
foreach($files as $file){

  //Rename to read!
 rename($file, "users/". $_SESSION['username']. "/". newid() . ".readnotification");
}
    die();
}

?>
