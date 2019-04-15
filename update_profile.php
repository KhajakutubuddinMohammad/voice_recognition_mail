<?php
   session_start();
   $_SESSION['color_flag']=0;
   $con=mysqli_connect("localhost","root","","projectkp1");
   $query="select * from user_register where user_id='$_SESSION[user_id]' ";
   $result=mysqli_query($con,$query);
   while($row=mysqli_fetch_array($result))
   {
   	     $_SESSION['username']=$row['username'];
   }
   $con->close();
?>
<!DOCTYPE html>
<html>
<head>
<title>Main page</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<style>

#compose {
top:5%;
left:75%;
outline: none;
overflow:hidden;
}

 ::-webkit-scrollbar {
    width: 10px;
}

::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(200,200,200,1);
    border-radius: 5px;
}

::-webkit-scrollbar-thumb {
    border-radius: 5px;
    background-color:#fff;
    -webkit-box-shadow: inset 0 0 6px rgba(90,90,90,0.7);
}

body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
/*
#wrapper.menu_display sidebar_menu{
	width:250px;
}
#wrapper.menu_display demo1{
	padding-left:250px;
}*/
#upload{
display:none;
}
#profile_pic
{
	display:none;
}
</style>
</head>
<body>

<!--================================================compose mail modal=========================================================-->
<div class="modal fade" id="compose1">
<div class="modal-dialog modal-dialog centered">
<div class="modal-content" style="width:700px;height:700px;background-color:#ffffff;">
<div class="modal-header bg-dark" style="color:#fff";>
 <h5 class="modal-title">New Message</h5>
 <button class="close" type="button" data-dismiss="modal">
 <span aria-hidden="true" style="color:#fff";>X</span>
 </button>
</div>

<div class="modal-body">
<form class="form-group" action="sidebar_test.php" method="post">  
<label><b>From:</b>
<input type="email" name="source_user" style="border:0px; width:550px;"  value="<?php echo $_SESSION['user_id'] ?>" readonly>
</label><hr>
<label><b>To: </b>   
<input type="text" name="dest_user"  style="border:0px;width:550px;font-family:<?php echo $_SESSION['font_family'] ?>;font-size:<?php echo $_SESSION['font_size']; ?>px;">
</label><hr>
<label><b>Subject:</b>
<input type="text" name="subject" style="border:0px;width:550px;font-family:<?php echo $_SESSION['font_family'] ?>;font-size:<?php echo $_SESSION['font_size']; ?>px;">
</label><hr>
<textarea id="demo"  name="message" rows="40" style="width:650px;height:300px;font-family: <?php echo $_SESSION['font_family'] ?>;font-size:<?php echo $_SESSION['font_size']; ?>px; "> </textarea>
 <input type="submit" class="btn btn-primary" name="submit_data" style="margin-top:10px;height:40px;width:100px;" value="Send">
<div class="btn btn-default" onclick="startconvert();"><i class="fas fa-microphone-alt" style="font-size:20px;"></i></div>
<input type="file" id="upload"><a href="" class="btn btn-default" id="upload_link"><i class="fas fa-link" style="font-size:20px;"></i></a>
<a href="" class="btn btn-default"><i class="fas fa-paperclip" style="font-size:20px;"></i></a>
<input type="file" accept="image/*" id="upload"><a href="" class="btn btn-default" id="upload_link"><i class="far fa-images" style="font-size:20px;"></i></a>
<a href="vr_drive.html" class="btn btn-default"><i class="fab fa-google-drive" style="font-size:20px;"></i></a>
<a href="" class="btn btn-default"><i class="far fa-smile-wink" style="font-size:20px;"></i></a> 
</form>
</div>

</div>
</div>
</div>

<script> 
function startconvert(){
 if('webkitSpeechRecognition' in window){
    var speechrec=new webkitSpeechRecognition();
	speechrec.interimResults=true;
	speechrec.continuous=true;
	speechrec.lang='en-IN';
	speechrec.start();
	
	var finalTranscripts=' ',interimTranscripts=' ';
	speechrec.onresult= function(event){
		
		  interimTranscripts="";
          for(var i=event.resultIndex;i<event.results.length;i++){
		  	        var res=event.results[i][0].transcript;
					//res.splice(1,res.length);
					if(event.results[i].isFinal) 
					       finalTranscripts+=res;
				   else
				          interimTranscripts+=res;
		  }
		  var msg=new SpeechSynthesisUtterance(finalTranscripts);
		  document.getElementById("demo").innerHTML=finalTranscripts+interimTranscripts;
		  msg.lang="en-IN";
		  msg.rate=1;
		  msg.pitch=10;
		  //window.speechSynthesis.speak(msg);
	}
	speechrec.onerror=function(event){
		 document.write("your browser doesnt this functionality<br>");
	}
	}
	else {
		document.write("your browser doesnt support this functionality");
	}
}
$(function(){
    $("#upload_link").on('click', function(e){
        e.preventDefault();
        $("#upload:hidden").trigger('click');
    });
});
</script>

<?php

$con=mysqli_connect("localhost","root","","projectkp1");
if(isset($_POST['submit_data']))
{        
         $source_user=$_POST['source_user']; 
		 $dest_user=$_POST['dest_user'];
		 $recepients=explode(";",$dest_user);
		 $message=$_POST['message'];
		 $subject=$_POST['subject'];
		 if(getimagesize($_FILES['image']['tmp_name'])==TRUE)
	     {
		         $image=addslashes($_FILES['image']['tmp_name']);
			 $name=addslashes($_FILES['image']['name']);
			 $image=base64_encode($image);
			 $image=file_get_contents($image);
			 echo "<script>alert('hello')</script>";
		         $query="insert into sent_mails(from_user,to_user,message,subject,time_of_sending,images) values('$source_user','$dest_user','$message','$subject',NOW(),$name)";
				 $result=mysqli_query($con,$query);
		 }
		 else{
		            $count=count($recepients);
					echo "<script>alert('hii')</script>";
					echo "<script>alert('$count')</script>";
					$i=0;
					while($i<$count)
					{
					       $query="insert into sent_mails(from_user,to_user,message,subject,time_of_sending) values('$source_user','$recepients[$i]','$message','$subject',NOW())";	
						   $result=mysqli_query($con,$query);
						   echo "<script>alert('$recepients[$i]')</script>";
						   $i++;
					}
		       }
			  // $result=mysqli_query($con,$query);
		       // echo "<script>alert('done khaja')</script>";
		 if($result)
		 {
		       //echo "<script>alert('$username,Bmail sent successfully') </script>";
		       echo "<script>window.open('sidebar_test.php','_self') </script>";    
		 }
		 else
		 {
			    echo "failed to connect".mysqli_connect_error();
		       echo "<script>alert('sorry,your details are not registered')</script>";
		    	echo "<script>window.open('sidebar_test.php','_self')</script>";
		 }
}
if(isset($_POST['files']))
{
	   if(getimagesize($_FILES['image']['tmp_name'])==FALSE)
	   {
	   	     echo "<script>alert('please select an image')</script>";
	   }
	   else 
	   {
	   	     $image=addslashes($_FILES['image']['tmp_name']);
			 $name=addslashes($_FILES['image']['name']);
			 $image=base64_encode($image);
			 $image=file_get_contents($image);
			 save_image($image,$name);
	   }
}
	   function save_image($image,$name)
	   {
	           $source_user=$_POST['source_user']; 
		       $dest_user=$_POST['dest_user'];
		       $message=$_POST['message'];
		       $subject=$_POST['subject'];
	   	       $query_image="insert into sent_mails(from_user,to_user,message,subject,time_of_sending,images) values('$source_user','$dest_user','$message','$subject',NOW(),$name)";
			   $result_image=mysqli_query($con,$query_image);
			  if($result_image)
		      {
		              //echo "<script>alert('$username,Bmail sent successfully') </script>";
		              echo "<script>window.open('sidebar_test.php','_self') </script>";    
		      }
		      else
		      {
		       	    echo "failed to connect".mysqli_connect_error();
		            echo "<script>alert('sorry,your details are not registered')</script>";
		         	echo "<script>window.open('sidebar_test.php','_self')</script>";
	    	 }
	    }
?>


<!--====================================================compose mail modal end======================================================-->
<!--====================================================navbar start========================================================-->

<div id="mySidenav" class="sidenav" style="background-color:#D8D8D8;">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="far fa-hand-point-left"></i></a> 
<table class="table table-hover borderless">
<form class="form-group" action="sidebar_test.php" method="post">
  <thead>
    <tr>
      <th scope="col">Settings</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:5px;font-size:15px;" name="manage_accounts">Manage accounts</button></td>
    </tr>
    <tr>
      <td><a class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:5px;font-size:15px;"  href="#personalize" data-toggle="modal">Personalization</a></td>
    </tr>
	 <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:5px;font-size:15px;" name="manage_accounts">Automatic replies</button></td>
    </tr>
	 <tr>
      <td><a class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:5px;font-size:15px;" name="update_profile" data-toggle="modal" href="#compose2">Update Profile</a></td>
    </tr>
	 <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="message_list">Message List</button></td>
    </tr>
	 <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="reading_pane">Reading pane</button></td>
    </tr>
	 <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="manage_accounts">Signature</button></td>
    </tr>
	 <tr>
      <td><a class="list-group-item" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="default_font" data-toggle="modal" href="#compose2">Default font</a></td>
    </tr>
	 <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="notifications">Notifications</button></td>
    </tr>
	 <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="email_security">Email Security</button></td>
    </tr>
	 <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="whats_new>What's new</button></td>
    </tr>
	 <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="outlook_account">Outlook for Android and iOS</button></td>
    </tr>
	 <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="help_fun">Help</button></td>
    </tr>
	 <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="manage_accounts">Trust Center</button></td>
    </tr>
	 <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="manage_accounts">Feedback</button></td>
    </tr>
	 <tr>
      <td><button class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="manage_accounts"  onclick="openNav2()">About</button></td>
    </tr>
  </tbody>
  </form>
</table>
</div>

 <script>
function openNav() {
  //document.getElementById("mySidenav").style.marginRight= "0px";
  document.getElementById("mySidenav").style.width= "300px";
 document.getElementById("demo1").style.marginLeft ="300px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width= "0px";
  document.getElementById("demo1").style.marginLeft = "0px";
}
function openNav2() {
  //document.getElementById("mySidenav").style.marginRight= "0px";
  document.getElementById("mySidenav2").style.width= "300px";
 document.getElementById("demo1").style.marginLeft ="300px";
}
function closeNav2() {
  document.getElementById("mySidenav2").style.width= "0px";
  document.getElementById("demo1").style.marginLeft = "0px";
}
 </script>
 
 <div id="mySidenav2" class="sidenav" style="background-color:#D8D8D8;">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav2()"><i class="far fa-hand-point-left"></i></a> 
<table class="table table-hover borderless">
<form class="form-group" action="sidebar_test.php" method="post">
  <thead>
    <tr>
      <th scope="col">Settings</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:5px;font-size:15px;" name="manage_accounts">Manage accounts</button></td>
    </tr>
    <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:5px;font-size:15px;" name="personalize">Personalization</button></td>
    </tr>
	 <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:5px;font-size:15px;" name="manage_accounts">Automatic replies</button></td>
    </tr>
	 <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:5px;font-size:15px;" name="focussed_inbox">Focussed inbox</button></td>
    </tr>
	 <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="message_list">Message List</button></td>
    </tr>
	 <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="reading_pane">Reading pane</button></td>
    </tr>
	 <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="manage_accounts">Signature</button></td>
    </tr>
	 <tr>
      <td><a class="list-group-item" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="default_font" data-toggle="modal" href="#compose2">Default font</button></td>
    </tr>
	 <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="notifications">Notifications</button></td>
    </tr>
	 <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="email_security">Email Security</button></td>
    </tr>
	 <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="whats_new>What's new</button></td>
    </tr>
	 <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="outlook_account">Outlook for Android and iOS</button></td>
    </tr>
	 <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="help_fun">Help</button></td>
    </tr>
	 <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="manage_accounts">Trust Center</button></td>
    </tr>
	 <tr>
      <td><button type="submit" class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="manage_accounts">Feedback</button></td>
    </tr>
	 <tr>
      <td><button class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="manage_accounts"  onclick="openNav2()">About</button></td>
    </tr>
  </tbody>
  </form>
</table>
</div>
  
<nav class="navbar navbar-expand-lg navbar-light" style="height:70px;background-color:#0000b3";>
<!--<button class="toggle_button"><i class="fas fa-bars"></i></button>
<span style="font-size:30px;cursor:pointer;color:#ffffff;" onclick="openNav()">&#9776;</span> -->
  <a class="navbar-brand" href="#"><img class="img-responsive rounded-circle" src="vr_project_images/Bmail_logo2.png" style="width:40px;height:40px;margin-left:10px;"><b style="margin-left:10px;color:#fff;">Bmail</b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
    <form class="form-inline my-2 my-lg-0 mx-auto" method="post" action="sidebar_test.php">
	<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fas fa-search"></i></span>
  </div>
      <input class="form-control" type="text" placeholder="hello <?php echo $_SESSION['username'] ?>, how can i help you? " aria-label="Search" style="width:650px;" name="search_mail">
   </div>
    </form>
  </div>
    <div class="btn btn-default" onclick="readcontent();"><i class="fas fa-microphone-alt" style="font-size:30px;margin-right:50px;" id="speak"></i></div>
    <a href="#compose" data-toggle="modal" class="navbar-brand"><img class="img-responsive rounded-circle" src="vr_project_images/default_profile_pic.png" style="width:40px;height:40px;"></a>
</nav>
<script type="text/javascript">
window.onload(){
  if ('speechSynthesis' in window) {
  
    $('#speak').click(function(){
      //var text = $('#message').val();
      var msg = new SpeechSynthesisUtterance();
      //var voices = window.speechSynthesis.getVoices();
      //msg.voice = voices[$('#voices').val()];
      //msg.rate = $('#rate').val() / 10;
      //msg.pitch = $('#pitch').val();
      msg.rate=0.8;
      msg.pitch=9;
      msg.lang='en-us';
      msg.text ='Please enter a valid mail address and username and also give a genuine feedback'; 
     
      msg.onend = function(e) {
        console.log('Finished in ' + event.elapsedTime + ' seconds.');
      };

      speechSynthesis.speak(msg);
    })
  } else {
    alert("hello world");
  }
};
</script>
<!--==========================================================navbar end=================================================-->

<!--==========================================================row=========================================================-->
<?php

$con=mysqli_connect("localhost","root","","projectkp1");
$query="select * from user_register where user_id='$_SESSION[user_id]' ";
$result=mysqli_query($con,$query);
if($result)
{
     while($row=mysqli_fetch_array($result)){
	  $_SESSION['bg_color']=$row['background_color'];
	  $_SESSION['bg_image']=$row['background_image'];
	  }
}
else
{
	echo "<script>alert('no bg color found')</script>";
}
?>
<div class="container-fluid" id="rowstart" style="background:url('<?php echo $_SESSION['bg_image'] ?>'); no-repeat;background-size:cover;">
<div class="row" style="height:950px;">
<div class="col-md-2"  style="height:800px;background-color:<?php echo $_SESSION['bg_color'] ?>;" id="mailbox">
<a href="#compose1" class="btn btn-default" style="width:320px;font-size:20px;text-align:left;" data-toggle="modal">

<i class="fa fa-plus" aria-hidden="true"></i>New Mail
</a>

<div>
<a href="" class="btn btn-default" style="margin-top:20px;width:320px;font-size:20px;text-align:left;"><i class="fa fa-user-circle" aria-hidden="true" style="width:50px;"></i>Accounts</a>
</div>
<div class="list-group" style="margin-top:20px;margin-left:15px;">
<form class="form-group" action="sidebar_test.php" method="post">
<button type="submit" class="list-group-item" style="background-color:transparent;border:none;color:#2895ED;text-align:left;" name="check_inbox"><i class="fas fa-envelope" style="color:#2895ED;margin-right:15px;"></i>Inbox<span class="badge">1320</span></button>
<button type="submit" class="list-group-item" style="background-color:transparent;border:none;color:#2895ED;text-align:left;" name="display_important"><i class="fas fa-star" style="color:#2895ED;margin-right:15px;"></i>Starred</button>
<button type="submit" class="list-group-item" style="background-color:transparent;border:none;color:#2895ED;text-align:left;" name="display_drafts"><i class="far fa-save" style="color:#2895ED;margin-right:15px;"></i>Drafts</button>
<button type="submit" class="list-group-item" style="background-color:transparent;border:none;color:#2895ED;text-align:left;" name="display_important"><i class="far fa-star" style="color:#2895ED;margin-right:15px;"></i>Important</button>
<button type="submit" class="list-group-item" style="background-color:transparent;border:none;color:#2895ED;text-align:left;" name="display_spam"><i class="fas fa-exclamation-triangle" style="#2895ED;margin-right:15px;"></i>Spam</button>
<button type="submit" class="list-group-item" style="background-color:transparent;border:none;color:#2895ED;text-align:left;" name="display_trash"><i class="fas fa-trash-alt" style="color:#2895ED;margin-right:15px;"></i>Trash</button>
</form>
</div>
</div>

 <div class="col-md-10">
 <div class="card" style="height:900px;width:1280px;margin-left:-20px;">
 <div class="card-header" style="background-color:#D8D8D8;">
 <h4>Update Profile</h4>
 </div>
 <div class="card-body">
 <form class="form group" method="post" action="update_profile.php">
 <div class="row" style="margin-top:30px;">
 <div class="col-md-4">
 <img src="vr_project_images/default_profile_pic.png" style="width:220px;height:220px;margin-left:20px;" class="img-responsive rounded-circle">
 </div>
 <div class="col-md-8">
 <div class="row" style="margin-top:40px;">
 <div class="col-md-6">
 <label>UserName:</label><br>
 <input type="text" name="username" style="width:280px;height:40px;">
 </div>
 <div class="col-md-6">
 <label>Bmail Id:</label><br>
 <input type="email" name="mail_id" style="width:280px;height:40px;">
 </div>
 </div>
 
 <div class="row" style="margin-top:30px;">
 <div class="col-md-6">
 <label>Age:</label><br>
 <input type="text" name="age" style="width:280px;height:40px;">
 </div>
 <div class="col-md-6">
 <label>Contact details:</label><br>
 <input type="text"  name="con_det" style="width:280px;height:40px;"> 
 </div>
 </div>
 
 </div>
 </div>
 <br>
 <button type="submit" name="update_profile" class="btn btn-primary" style="margin-left:900px;text-align:center;width:200px;">Update Profile</button>
 </form>
 </div>
 </div>

 <?php
 
 $con=mysqli_connect("localhost","root","","projectkp1");
if(isset($_POST['signout']))
{
            $name=$_SESSION['user_id'];
			//$name="khaja";
			$query2="update user_log set signout_time=NOW() where user_id='$_SESSION[user_id]' ";
			$result=mysqli_query($con,$query2);
			if($result){
			echo "<script>alert('please wait while you are successfully logging out') </script>";
			echo "<script>window.open('register_login.php','_self') </script>";
			}
	else
	{
		 echo "<script>alert('Something went wrong.Please try again later') </script>";
		 echo "<script>window.open('register_login.php','_self') </script>";
	}

}
if(isset($_POST['update_profile']))
{
	 $username=$_POST['username'];
	 $user_id=$_POST['mail_id'];
	 $age=$_POST['age'];
	 $con_det=$_POST['con_det'];
	 
	 echo "<script>alert('$_SESSION[user_id]')</script>";
	 $query="update user_register set age='$age',contact_no='$con_det',username='$username' where user_id='$_SESSION[user_id]' ";
	 $result=mysqli_query($con,$query);
	 if($result)
	 {
	 	   echo "<script>alert('details updated successfully')</script>";
		   echo "<script>window.open('sidebar_test.php','_self')</script>";
	 }
	 else
	 {
	 	   echo "<script>alert('details are not updated,something went wrong')</script>";
		   echo "<script>window.open('sidebar_test.php','_self')</script>";
	 }
}
 ?>
 
 <!--===================================================signout modal========================================================-->
<div class="modal fade" id="compose">
<div class="modal-dialog modal-dialog">
<div class="modal-content" style="width:350px;height:300px;background-color:#ffffff;">
<div class="modal-body">
<div class="row">
<div class="col-md-6">
<form action="sidebar_test.php"  method="post" enctype="multipart/form-data">
            <input type="file"  id="file" name="file" required></label>
			<?php
// Database configuration
error_reporting(0);
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "projectkp1";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
 
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Include the database configuration file
$statusMsg = '';

// File upload path
$targetDir = "vr_project_images/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $insert = $db->query("INSERT into images (file_name, uploaded_on) VALUES ('".$fileName."', NOW())");
            if($insert){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            }else{
                $statusMsg = "File upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

?>


			<img src=" <?php echo $targetFilePath ?>  class="img-responsive rounded-circle" style="width:150px;height:150px;">
			<br><br>
			<input type="submit" name="submit" value="change profile pic">
			 
</form>

 <!--
// Display status message
echo $statusMsg;
?>
<?php
// Include the database configuration file
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "projectkp1";

// Get images from the database
$rows=$query->num_rows;
$query = $db->query("SELECT * FROM images where id='$rows' ");

if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $imageURL = 'vr_project_images/'.$row["file_name"];
?>
    <img src="<?php echo $imageURL; ?>" alt="" style="width:100px;height:100px;"/>
<?php }
}else{ ?>
    <p>No image(s) found...</p>
<?php } ?>-->
</div>
<div class="col-md-6">
<h4>Bmail Account</h4>
<p><?php echo "$_SESSION[user_id]"; ?></p>
</div>
</div>
</div>
<div class="modal-footer justify-content-between">
<button onclick="openNav()" class="btn btn-default" data-dismiss="modal">Account Settings</button>
<form class="form-group" action="sidebar_test.php" method="post">
<button type="submit" class="btn btn-default" name="signout">Sign out</button>
<!--
<?php
			$con = mysqli_connect("localhost","root","","project");
			$q = mysqli_query($con,"SELECT * FROM register WHERE username='$username'");
		while($row = mysqli_fetch_assoc($q)){
				echo $row['username'];
				if($row['image'] == ""){
					echo "<img width='150' height='150' src='vr_project_images/default_profile_pic.png' alt='Default Profile Pic'>";
				} else {
					echo "<img width='150' height='150' src='vr_project_images/".$row['image']."' alt='Profile Pic'>";
				}
				echo "<br>";
			}
?>-->
</form>
</div>

</div>
</div>
</div>

<?php

$con=mysqli_connect("localhost","root","","projectkp1");
if(isset($_POST['change_profile']))
{
        echo "<script>alert('$_SESSION[user_id]')</script>";
		$profile_name=$_FILES['file']['name'];
        $user_id=$_SESSION['user_id'];
	    //move_uploaded_file($_FILES['file']['tmp_name'],"$profile_name");
		$q = mysqli_query($con,"UPDATE user_register SET profile_pic = '".$_FILES['file']['name']."' WHERE user_id ='$user_id' ");

}
?>
