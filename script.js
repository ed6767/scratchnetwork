var errorsinrow = 0;
  // Initialize Firebase full info found on dashboard
var _0x56e7=["\x41\x49\x7A\x61\x53\x79\x42\x35\x4D\x35\x49\x61\x33\x36\x4A\x41\x4B\x5A\x6A\x47\x54\x42\x31\x78\x6B\x4A\x54\x74\x38\x46\x66\x45\x31\x44\x78\x32\x75\x37\x6B","\x73\x63\x72\x61\x74\x63\x68\x2D\x6E\x65\x74\x77\x6F\x72\x6B\x2E\x66\x69\x72\x65\x62\x61\x73\x65\x61\x70\x70\x2E\x63\x6F\x6D","\x68\x74\x74\x70\x73\x3A\x2F\x2F\x73\x63\x72\x61\x74\x63\x68\x2D\x6E\x65\x74\x77\x6F\x72\x6B\x2E\x66\x69\x72\x65\x62\x61\x73\x65\x69\x6F\x2E\x63\x6F\x6D","\x73\x63\x72\x61\x74\x63\x68\x2D\x6E\x65\x74\x77\x6F\x72\x6B","\x73\x63\x72\x61\x74\x63\x68\x2D\x6E\x65\x74\x77\x6F\x72\x6B\x2E\x61\x70\x70\x73\x70\x6F\x74\x2E\x63\x6F\x6D","\x31\x30\x35\x34\x30\x39\x37\x39\x37\x30\x38\x34\x37"];var config={apiKey:_0x56e7[0],authDomain:_0x56e7[1],databaseURL:_0x56e7[2],projectId:_0x56e7[3],storageBucket:_0x56e7[4],messagingSenderId:_0x56e7[5]};
  firebase.initializeApp(config);
 config = null;
  console.log("Firebase init");
  
   var fadeDuration = 250;
    var loggedin = false;
    var t=setInterval(sessioncheck,15000);
function dosearch() {
  var searchValue = document.getElementById("search").value.toLowerCase();

$("[IAMITEMLISTING]").each(function(){
  if($(this).html().toLowerCase().indexOf(searchValue) > -1){
    $(this).fadeIn(50); 
  } else {
     $(this).fadeOut(50); 
  }
});   
}
$(document).ready(function(){
 var loadingTimeout;
$(document).ajaxStart(function() {

    loadingTimeout = setTimeout(function() {
      loadbanner("Loading...");
       loadingTimeout = setTimeout(function() {
      loadbanner("This is taking longer than usual...");
        loadingTimeout = setTimeout(function() {
      loadbanner("Okay, this is taking a really long time...");
    }, 35000);
    }, 10000);
    
    }, 5500);
});
$(document).ajaxStop(function() {
    clearTimeout(loadingTimeout);
    $("#alertl").fadeOut();
    componentHandler.upgradeDom();
});
  
//Check if account is password protected

});
function replacementions ( text ) {
    return text.replace(/@([a-z\d_]+)/ig, '<a href=index.php?user=$1>@$1</a>'); 
}
function phpvars(phpvars) {
        var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?u&' + phpvars ;
window.history.pushState({ path: newurl }, '', newurl);
checkpassword();
}

function filtertext(text) {
    var data1;
        $.get("https://www.purgomalum.com/service/plain?text=" + text +"&fill_text=amazing", function(data, status){
data1 = data;
});
return data1;
}

//Banner
function banner(alerttext){
     $("#alert").html(alerttext);
                $("#alert").fadeIn(fadeDuration);
}
function loadbanner(alerttext){
     $("#alertl").html(alerttext);
                $("#alertl").fadeIn(fadeDuration);
}
    
    function loadlistings(){
        $("#sitelistings").fadeOut(fadeDuration, function() {
     $.get("server.php?action=getlistings", function(data, status){
    $("#sitelistings").html(data);
                $("#sitelistings").fadeIn(fadeDuration);
                    phpvars("main");
    });
});
     
        
    }
       function loadwaitinglistings(){
        $("#sitelistings").fadeOut(fadeDuration, function() {
     $.get("server.php?action=getwaitinglistings", function(data, status){
    $("#sitelistings").html(data);
                $("#sitelistings").fadeIn(fadeDuration);
                phpvars("waiting");
    });
});
     
        
    }
           function showuserlistings(username){
                phpvars("user="+ username);
        $("#sitelistings").fadeOut(fadeDuration, function() {
     $.get("server.php?action=getuser&username="+ username, function(data, status){
    $("#sitelistings").html(data);
                $("#sitelistings").fadeIn(fadeDuration);

    });
});
     

    }
               function requestpp(username){
                phpvars("requestpp="+ username);
        $("#sitelistings").fadeOut(fadeDuration, function() {
     $.get("server.php?action=pushpoints&request&username="+ username, function(data, status){
    $("#sitelistings").html(data);
                $("#sitelistings").fadeIn(fadeDuration);
               
    });
});
     
        
    }
                   function inbox(){
                phpvars("inbox");
        $("#sitelistings").fadeOut(fadeDuration, function() {
     $.get("server.php?action=inbox", function(data, status){
    $("#sitelistings").html(data);
                $("#sitelistings").fadeIn(fadeDuration);
               
    });
});
     
        
    }
    
    
       function showitem(postid){
              $("#sitelistings").fadeOut(fadeDuration, function() {
     $.get("server.php?action=getitem&id="+ postid, function(data, status){
    $("#sitelistings").html(data);
                $("#sitelistings").fadeIn(fadeDuration);
            phpvars("view=" + postid);
    });
    });
        
    }
           function approvepost(postid){
              $("#sitelistings").fadeOut(fadeDuration, function() {
     $.get("server.php?action=addlisting&approve&id="+ postid, function(data, status){
    $("#sitelistings").html(data);
                $("#sitelistings").fadeIn(fadeDuration);
    });
    });
        
        
    }
               function removepost(postid){
                   if (window.confirm("Are you sure you want to remove this post?")) {
              $("#sitelistings").fadeOut(fadeDuration, function() {
     $.get("server.php?action=addlisting&remove&id="+ postid, function(data, status){
    $("#sitelistings").html(data);
                $("#sitelistings").fadeIn(fadeDuration);
    });
    });
                   }   
    }

    
       function confirmreport(postid){
              $("#sitelistings").fadeOut(fadeDuration, function() {
     $.get("server.php?action=confirmreport&id="+ postid, function(data, status){
    $("#sitelistings").html(data);
                $("#sitelistings").fadeIn(fadeDuration);
    });
    });
        
    }
         function newsession(){
   showloginDialog();
        
    }
         function finishlogin(){
           document.getElementById("logindialogerror").innerHTML = "Please wait...";
     $.get("server.php?action=finishlogin", function(data, status){
    document.getElementById("logindialogerror").innerHTML = data;
    });
        
    }
       function submitreport(postid){
              $("#sitelistings").fadeOut(fadeDuration, function() {
     $.get("server.php?action=submitreport&id="+ postid, function(data, status){
    $("#sitelistings").html(data);
                $("#sitelistings").fadeIn(fadeDuration);
    });
    });
        
    }
            function addlisting(){
              $("#sitelistings").fadeOut(fadeDuration, function() {
     $.get("server.php?action=addlisting", function(data, status){
    $("#sitelistings").html(data);
                $("#sitelistings").fadeIn(fadeDuration);
                phpvars("addlisting");
    });
    });
        
    }
    
                function sessioncheck(){
                    errorsinrow = 0;
 $.get("server.php?action=sessioncheck", function(data, status){
     if (data.includes("!nosession!")) {
       if (loggedin) {
loggedin = false;
shownoticeDialog("<b>Your session has expired.</b><br>You are no longer logged in to ScratchNetwork. Save all work and <b>do not</b> attempt to submit anything. When you are done, reload ScratchNetwork.");
banner("Your session has expired and you've been logged out. Please SAVE ALL WORK and do not attempt to submit anything. When you're done, refresh the page.");
 
       }
     } else {
         let notificationcount = data.split("#")[1];
        document.getElementById("noti").setAttribute("data-badge", notificationcount);
        if (notificationcount == 0) {
              document.getElementById("noti").setAttribute("class", "material-icons");
        } else {
              document.getElementById("noti").setAttribute("class", "material-icons notifi mdl-badge mdl-badge--overlap");   
        } 
     }
 });   
    }
           function shopordercomplete(){
        $("#sitelistings").fadeOut(fadeDuration, function() {
     $.get("server.php?action=addlisting&shopordercomplete", function(data, status){
    $("#sitelistings").html(data);
                $("#sitelistings").fadeIn(fadeDuration);
                phpvars("shopordercomplete");
    });
});
     
        
    }
 
  function shoporderremoved(returnid){
        $("#sitelistings").fadeOut(fadeDuration, function() {
     $.get("server.php?action=addlisting&shoporderremoved&returnid="+ returnid, function(data, status){
    $("#sitelistings").html(data);
                $("#sitelistings").fadeIn(fadeDuration);
                phpvars("shoporderremoved&returnid="+ returnid);
    });
});
     
        
    }
      function themes(){
        $("#sitelistings").fadeOut(fadeDuration, function() {
     $.get("server.php?action=theme", function(data, status){
    $("#sitelistings").html(data);
                $("#sitelistings").fadeIn(fadeDuration);
                phpvars("themes");
    });
});
     
        
    }
        function notifications(){
        $("#sitelistings").fadeOut(fadeDuration, function() {
     $.get("server.php?action=notifications", function(data, status){
    $("#sitelistings").html(data);
                $("#sitelistings").fadeIn(fadeDuration);
                phpvars("notifications");
    });
});

     
        
    }
    
        function pushpoints(){
        $("#sitelistings").fadeOut(fadeDuration, function() {
     $.get("server.php?action=pushpoints", function(data, status){
    $("#sitelistings").html(data);
                $("#sitelistings").fadeIn(fadeDuration);
                    phpvars("pushpoints");
    });
});
        } 
        
      function edit(id){
        $("#sitelistings").fadeOut(fadeDuration, function() {
     $.get("server.php?action=addlisting&edit&id="+ id, function(data, status){
    $("#sitelistings").html(data);
                $("#sitelistings").fadeIn(fadeDuration);
                phpvars("edit&id="+ id);
    });
});
}

       function addpp(postid){
              $("#sitelistings").fadeOut(fadeDuration, function() {
     $.get("server.php?action=pushpoints&WARNING-THIS-URL-WILL-EFFECT-YOUR-PUSHPOINTS-DO-NOT-CLICK-THIS-LINK-PLEASE-UNLESS-YOU-WANT-TO-LOSE-YOUR-PUSHPOINTS&addpp&id="+ postid, function(data, status){
    $("#sitelistings").html(data);
                $("#sitelistings").fadeIn(fadeDuration);
            phpvars("addpp=" + postid);
    });
    });
        
    }
         function sendpp(username){
              $("#sitelistings").fadeOut(fadeDuration, function() {
     $.get("server.php?action=pushpoints&send&username="+ username, function(data, status){
    $("#sitelistings").html(data);
                $("#sitelistings").fadeIn(fadeDuration);
            phpvars("addpp=" + postid);
    });
    });
        
    }
    function rickroll() {
       
                   
        var audio = new Audio('https://ia800605.us.archive.org/8/items/NeverGonnaGiveYouUp/jocofullinterview41.mp3');
audio.play();
    document.getElementById("sitelistings").style.backgroundColor = "#f3f3f3";
    document.getElementById("sitelistings").style.backgroundImage = "url('https://media.giphy.com/media/olAik8MhYOB9K/giphy.gif')";
        
}

function testdb() {
    var database = firebase.database();
var location = database.ref('release/polling/items/test/info');
var data = {
  title: 'Cheese or Crackers?',
  names: ['Cheese!', 'Crackers!', 'I do not care!']
};
location.push(data);
location = database.ref('release/polling/items/test/data');
data = {
  vote: 0
};
location.push(data);
}
function testlogin() {
    firebase.auth().createUserWithEmailAndPassword("", "test1234576").catch(function(error) {
  // Handle Errors here.
  var errorCode = error.code;
  var errorMessage = error.message;
  console.log(error.message);
  // ...
});
}


function plusaccount() {
  $("#sitelistings").fadeOut(fadeDuration, function() {
     $.get("server.php?action=plusaccount", function(data, status){
    $("#sitelistings").html(data);
                $("#sitelistings").fadeIn(fadeDuration);
                phpvars("pluslogin");
    });
});   
}
           function settings(){ 
        $("#sitelistings").fadeOut(fadeDuration, function() {
     $.get("server.php?action=settings", function(data, status){
    $("#sitelistings").html(data);
                $("#sitelistings").fadeIn(fadeDuration);
                phpvars("settings");
    });
});


    }

       function plugins(){
                phpvars("plugins");
        $("#sitelistings").fadeOut(fadeDuration, function() {
     $.get("server.php?action=plugins", function(data, status){
    $("#sitelistings").html(data);
                $("#sitelistings").fadeIn(fadeDuration);

    });
});


    }
 function forum(){
        $("#sitelistings").fadeOut(fadeDuration, function() {
     $.get("server.php?action=forum", function(data, status){
    $("#sitelistings").html(data);
                $("#sitelistings").fadeIn(fadeDuration);
                    phpvars("forum");
    });
});
     
        
    }
 function newforumuser(){
        $("#sitelistings").fadeOut(fadeDuration, function() {
     $.get("server.php?action=forum&register", function(data, status){
    $("#sitelistings").html(data);
                $("#sitelistings").fadeIn(fadeDuration);

    });
});
     
        
    }

function shownoticeDialog(message) {
    var dialog = document.querySelector('#noticedialog');
    if (! dialog.showModal) {
      dialogPolyfill.registerDialog(dialog);
    }
   document.getElementById("noticedialogtext").innerHTML = message;
    dialog.showModal();
}

function closenoticeDialog() {
    var dialog = document.querySelector('#noticedialog');
    if (! dialog.showModal) {
      dialogPolyfill.registerDialog(dialog);
    }
    dialog.close();
}

function showloginDialog() {
    var dialog = document.querySelector('#logindialog');
    if (! dialog.showModal) {
      dialogPolyfill.registerDialog(dialog);
    }
   document.getElementById("logindialogtext").innerHTML = "Loading login...";
    dialog.showModal();
    $.get("server.php?action=newsession", function(data, status){
    document.getElementById("logindialogtext").innerHTML = data;              
    });
}
function closeloginDialog() {
    var dialog = document.querySelector('#logindialog');
    if (! dialog.showModal) {
      dialogPolyfill.registerDialog(dialog);
    }
    dialog.close();
}


function banmessage() {

    loadlistings();
     shownoticeDialog("<b>You can't use this account with ScratchNetwork.</b><br><p>This account has been disabled by yourself or an admin for Terms of Service violations. To re-enable this account please leave a comment on @myeducate's scratch profile.</p>");
}
