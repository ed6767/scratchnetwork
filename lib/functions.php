<?php
//Accepted in GET
 $acceptedactions = [// Item listings
                     'getlistings', 
                     'getitem',
                     'sitemap',
                     'addlisting',
                     'getwaitinglistings',
                     'getuser',
                     //Sessions
                    'newsession',
                    'endsession',
                    'finishlogin',
                    'plusaccount',
                    //Reports
                    'confirmreport',
                    'submitreport',
                    'priorityreport',
                    //Groups
                    'groupwizzard',
                    //Internal tools
                    'id',
                    'loadingmessage',
                    'sessioncheck',
                    'isbad',
                    'testnew',
                    'api',
                    //Other stuff
                    'theme',
                    'notifications',
                    'pushpoints',
                    'settings',
                    'comments',
                    'inbox',
                    'plugins',
                    'download',
                    'forum'
 ];
function is_decimal( $val )
{
    return is_numeric( $val ) && floor( $val ) != $val;
}
  function numberformat($number,$decimal = '.')
      {
      $broken_number = explode($decimal,$number);
if (is_decimal($number)) {
   return number_format($broken_number[0]).$decimal.$broken_number[1];
} else {
  return number_format($number);
}

      }

function curl_get_contents($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}
function XSSclean($data) {
// Fix &entity\n;
$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

// Remove any attribute starting with "on" or xmlns
$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

// Remove javascript: and vbscript: protocols
$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);


// Remove namespaced elements (we do not need them)
$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

do
{
    // Remove really unwanted tags
    $old_data = $data;
    $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
}
while ($old_data !== $data);

// we are done...
return $data;
}




function newid() {
    $lines = file("words.txt") ; 
    $line = $lines[array_rand($lines)]; 
    $line .= $lines[array_rand($lines)]; 
      $line .= rand(1000,9999);
     $line = str_replace(' ', '', $line);
      $line = str_replace('\n', '', $line);
      $line = preg_replace('/\s+/','',$line);
        return $line;
}

function isbadtext($text){
    return false;
    /*
    $text = strtolower($text);
$blacklist = explode("\n", file_get_contents('blacklist.txt'));
foreach ($blacklist as &$value) {
if (strpos($text, $value) !== false) {
    //Bad words found!!
 return true;   
}
}
return false;
*/
}
function sendnotification($user, $body) {
    if (file_exists("users/". $user)) {
        file_put_contents("users/". $user ."/". newid() . ".notification", $body);
    }
}
function notificationcount($user) {
        if (file_exists("users/". $user)) {

  $count = 0;
 $files = glob('users/'. $_SESSION['username'] .'/*.notification');
usort($files, function($a, $b) {
    return filemtime($a) < filemtime($b);
});
foreach($files as $file){
$count = $count + 1;
}
return $count;
}
}


//Main

function functions_StartCheck() {
    $downmode = false; // Change to true to disable site
$logindisabled = false;
     $date_now = date("Y-m-d"); // this format is string comparable

$downmode = $date_now >= '2018-06-16';
if (!$downmode and $_GET['action'] != "sessioncheck") {
    $rem = strtotime('2018-06-16 00:00:00') - time();
$day = floor($rem / 86400);
$hr  = floor(($rem % 86400) / 3600);
$min = floor(($rem % 3600) / 60);
$sec = ($rem % 60);

echo '
    <div class="demo-graphs mdl-shadow--2dp mdl-color--red mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">ScratchNetwork is automaticly closing in ';
    if($day) echo "$day Day, ";
if($hr) echo "$hr Hours,";
if($min) echo "$min Minutes and ";
if($sec) echo "$sec Seconds";
    echo'</h2>
              </div>

          </div>
';
}
    if (isset($_SESSION['downaccess'])) {
        $downmode = false;
    } elseif ($_GET['action'] == "downaccess") {
      $_SESSION['downaccess'] = true;  
      echo '
      You have been granted access to ScratchNetwork. It has been disabled by myed for a reason. Tread very carefully.
      ';
    }
  if ($downmode) { 
       echo '
             <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">ScratchNetwork closed at midnight on June 16th 2018, BST.</h2> 
             <div class="mdl-color-text--grey-600">
        You can no longer use ScratchNetwork.
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
<I>A copy of the SN achives is stored on the CaidM Discord.</I>


             <div class="mdl-card__actions mdl-card--border">
                             <a href="https://discord.gg/HFzrKK7" class="mdl-button mdl-js-button mdl-js-ripple-effect">JOIN THE YEN DISCORD!</a>
                               <a href="https://yen.freeflarum.com" class="mdl-button mdl-js-button mdl-js-ripple-effect">Go to the Yen Forums</a>
                <a href="#" onclick="rickroll();" class="mdl-button mdl-js-button mdl-js-ripple-effect">One last rickroll?</a>


              </div>

          </div>



    ';
      die();
  }
}

function functions_VerifyActions() {
global $acceptedactions; //SCREW you globals!!
if (!in_array($_GET['action'], $acceptedactions)) {
    echo '
                 <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
             <h2 class="mdl-card__title-text" style="align-self: flex-start;">The client made a malformed or incorrect request.</h2>
             <div class="mdl-color-text--grey-600">
            Sorry about that. Try reloading the page. 
              </div>
    
              </div>
            
          </div>
    
    
    ';
    echo '<!-- End -->'; die();
}

}



                    $permissions = [
                        'Disabled Account',
                        'User',
                        'Curator',
                        'Trusted Curator',
                        'Moderator',
                        'Admin',
                        'Overlord'
                                        ];

function formatusername($username) {
    $username = strtolower($username);
     // Custom Flags
      if ($username == "hellounicorns2") { 
         return 'Carrots <i class="em em-carrot"></i></i>';
      }
         if ($username == "python_megapixel") { 
         return 'PythonMegapixel <i class="em em-train2"></i>';
      }
       if ($username == "grahamsh") { 
         return 'GrahamSH <i class="em em-us"></i>';
      }
     if ($username == "asqwde") { 
         return 'asqwde <i class="em em-cat"></i>';
      }
     if ($username == "rose-maylie") { 
         return 'rose-maylie <i class="em em-dog"></i>';
      }

   if (file_exists("users/". $username)) {
             $permissionlevel = file_get_contents("users/". $username  ."/permissionlevel.txt");
         if ($permissionlevel == -2) {
                 return $username . '<i class="material-icons" style="display: inline-flex;vertical-align: middle;text-decoration: none;">group</i>';

             }
             if ($permissionlevel == 0) {
                 return 'disabled account';

             }
               if ($permissionlevel == 1) {
                 return $username;
                
             }
             if ($permissionlevel == 2) {
                 return $username . ' <i class="em em-book" title="Curator"></i>';

             }
               if ($permissionlevel == 3) {
                 return $username . ' <i class="em em-heavy_check_mark" title="Trusted Curator"></i>';

             }
                 if ($permissionlevel == 4) {
                 return $username . ' <i class="em em-waving_black_flag" title="Moderator"></i>';

             }
                   if ($permissionlevel == 5) {
                 return $username . ' <i class="em em-crown" title="Admin Crown"></i>';

             }
                      if ($permissionlevel == 6) {
                 return $username . ' <i class="em em-crown" title="Overlord"></i>';

             }
             
} else {
    return $username; 
}
}
function userpermissions($username) {
    return file_get_contents("users/". $username  ."/permissionlevel.txt");
}

function userpp($username) {
    if (file_exists("users/". $username  ."/pushpoints.txt")) {
         return file_get_contents("users/". $username  ."/pushpoints.txt");
    } else {
        return '0';
    }
}

function itempp($id) {
    if (file_exists("items/". $id  ."/pushpoints.txt")) {
         return file_get_contents("items/". $id  ."/pushpoints.txt");
    } else {
        file_put_contents("items/". $id  ."/pushpoints.txt", "1");
        return '1';
    }
}
function minitempp($id) {
    $re = round((itempp($id) / 10) * 3, 0, PHP_ROUND_HALF_DOWN);
    if($re<1){$re=1;} //Fix >0 (always true)
return $re;
}

function additempp($id, $amount) {
 if (userpp($_SESSION['username']) < $amount) {
     sendnotification($_SESSION['username'], "Your attempt to add ". $amount ."<small>pp</small> to the post '". file_get_contents("items/". $id   ."/title.txt")  ."' would've take your account into negitive balance. Please try again with a lower amount.");
    return false;  
 } else {
     if (minitempp($id) <= $amount) {
  //Start add


        file_put_contents("items/". $id  ."/pushpoints.txt", file_get_contents("items/". $id  ."/pushpoints.txt") + $amount);
            file_put_contents("users/". $_SESSION['username']  ."/pushpoints.txt", file_get_contents("users/". $_SESSION['username']   ."/pushpoints.txt") - $amount);
        sendnotification($_SESSION['username'], "You have added ". $amount ."<small>pp</small> to the post '". file_get_contents("items/". $id   ."/title.txt")  ."' and the balance has been deducted from your account.");
     } else {
         sendnotification($_SESSION['username'], "Your attempt to add ". $amount ."<small>pp</small> to the post '". file_get_contents("items/". $id   ."/title.txt")  ."' is below the post's PP limit. Please try again with a higer amount.");
       return false;  
     }
 }
}

function transferpp($username, $amount) {
 if (userpp($_SESSION['username']) < $amount) {
      sendnotification($_SESSION['username'], "Your request to send ". $amount ."<small>pp</small> to '". $username ." would've taken your account into negative balance so it has been canceled.");
    return false;  
 } else {
     
  //Start add
  if ($amount < 1) {
           sendnotification($_SESSION['username'], "Your recent PushPoint request was invalid");
           return false;
  }
        file_put_contents("users/". $username  ."/pushpoints.txt", file_get_contents("users/". $username ."/pushpoints.txt") + $amount);
            file_put_contents("users/". $_SESSION['username']  ."/pushpoints.txt", file_get_contents("users/". $_SESSION['username']   ."/pushpoints.txt") - $amount);
        sendnotification($_SESSION['username'], "You have sent ". $amount ."<small>pp</small> to '". $username ." and the balance has been deducted from your account.");
           sendnotification($username, $_SESSION['username'] . " has sent you ". $amount ."<small>pp</small> and the balance has been added to your account.");
           return true;
 }
}

?>
