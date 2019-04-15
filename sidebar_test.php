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
		 document.write("your browser doesnt this functionality<br>"+event.error);
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
					//echo "<script>alert('hii')</script>";
					//echo "<script>alert('$count')</script>";
					$i=0;
					while($i<$count)
					{
					       $query="insert into sent_mails(from_user,to_user,message,subject,time_of_sending) values('$source_user','$recepients[$i]','$message','$subject',NOW())";	
						   $result=mysqli_query($con,$query);
						   //echo "<script>alert('$recepients[$i]')</script>";
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
      <td><a class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:5px;font-size:15px;" name="update_profile" href="update_profile.php">Update Profile</a></td>
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
      <td><a class="list-group-item btn btn-primary" style="background:transparent;border:none;color:#000000;text-align:left;width:100%;height:10px;font-size:15px;" name="manage_accounts" href="feedback.php">Feedback</button></td>
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

$(function(){
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
      msg.text ='hey welcome to bmail  you can do a lot of stuff here in bmail you can send a mail through voice and can personalize bmail as you want'; 

      msg.onend = function(e) {
        console.log('Finished in ' + event.elapsedTime + ' seconds.');
      };

      speechSynthesis.speak(msg);
    })
  } else {
    alert("hello world");
  }
}); 

window.onload=function(){
  
  if('webkitSpeechRecognition' in window){
    var speechrec=new webkitSpeechRecognition();
	speechrec.interimResults=true;
	speechrec.continuous=true;
	speechrec.lang='en-IN';
	speechrec.start();
	
	  
	var finalTranscripts=' ',interimTranscripts=' ';
	speechrec.onresult= function(event){
		
		  interimTranscripts="";
		  var index=event.results.length-1;
		  var res=event.results[index][0].transcript;
					//res.splice(1,res.length);
					if(event.results[index].isFinal){
					
					      if(res=="compose a new mail")
						  {
						         //alert('voice recognized:compose new mail');
						  	     window.open('send_message.php','_self');
						  }
						  else if(res=="update my profile")
						  {
						  	     /*alert('voice recognized:update my profile');
								 var msg=new SpeechSynthesisUtterance();
								 msg.text="voice recognized update my profile";
								 msg.lang="en-IN";
		                         msg.rate=1;
		                         msg.pitch=10;
		                         window.speechSynthesis.speak(msg);*/
						  	     window.open('update_profile.php','_self');
						  }
						  else if(res=="change my background theme")
						  {
						  	     alert('voice recognized:change my background theme');
								 $('#personalize').modal('show');
						  }
						 /* else if(res="set my default font")
						  {
						  	      alert('voice recognized:set my default font');
								 $('#compose2').modal('show');
						  }*/
						  else if(res==" feedback")
						  {
						  	    alert('voice recognized:give feedback');
						  	     window.open('feedback.php','_self');
						  }
						    else if(res=="check my mails")
						  {
						         alert("voice recognized:check my mails");
						  	     $('#all_mails').load("check_inbox.php");
						  }
						  else if(res=="check trash mails")
						  {
						  	      alert("voice recognized:check trash mails");
						  	      $('#all_mails').load("check_trash.php");
						  }
						  else if(res=="check important mails")
						  {
						  	     alert("voice recognized:check important mails");
						  	      $('#all_mails').load("check_imp_mails.php");
						  }
						  else if(res=="check spam mails")
						  {
						  	      alert("voice recognized:check spam mails");
						  	      $('#all_mails').load("check_spam_mails.php");
						  }
					      
		            }
					
				 
		  }
	speechrec.onerror=function(event){
		 document.write("your browser doesnt this functionality<br>"+event.error);
	}
	}
	else {
		document.write("your browser doesnt support this functionality");
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
<div class="container-fluid" id="rowstart" style="background:url('<?php echo $_SESSION['bg_image'] ?>'); no-repeat;background-size:cover;height:800px;">
<div class="row">
<div class="col-md-2"  style="background-color:<?php echo $_SESSION['bg_color'] ?>;" id="mailbox">
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

<div class="col-md-3"  style="height:800px;background-color:#FFFFFF;overflow-y:scroll;opacity:0.7;" id="all_mails">
<form class="form-group" method="post" action="sidebar_test.php" >
<button class="btn btn-primary-outline" name="check_inbox" style="width:100%;background-color:transparent;"><h5 style="float:left;margin-top:15px;">Inbox</h5></button>
</form>

<?php

$con=mysqli_connect("localhost","root","","projectkp1");
if(isset($_POST['check_inbox'])) 
{
       $_SESSION['flag1']=1;
	   error_reporting(0);
	   $count=0;
       $query3="select * from sent_mails where to_user='$_SESSION[user_id]' and spam='$count' and trash='$count' ";
	   $result3=mysqli_query($con,$query3);
		   $rows3=mysqli_num_rows($result3);
		   if($rows3== 0){
		          echo "<script>alert('Sorry, No mails for you')</script>";
				  echo "<script>window.open('sidebar_test.php','_self')</script>";
   		 }
		  else{
 		  while($field=mysqli_fetch_array($result3))
		  {
		         $dis_subject=$field['subject'];
		  	     $dis_message=$field['message'];
			     $dis_msg_id=$field['msg_id'];
			    echo "<div class='container'><a role='button' href='sidebar_test.php?msg_id=$dis_msg_id '><hr><h5 style='color:#000000;'>$dis_subject</h5>
			                  <p style='width:300px;height:20px;overflow:hidden;'>$dis_message</p> </a></div>";
			 /*  echo "<div class='container'><form class="class-gro"<a role='button' href='sidebar_test.php?msg_id=$dis_msg_id '><hr><h5 style='color:#000000;'>$dis_subject</h5>
			                  <p style='width:300px;height:20px;overflow:hidden;'>$dis_message</p> </button></div>";		*/
	      }
		  }
}

if(isset($_POST['display_important'])) 
{
	   error_reporting(0);
	   $count=1;
	   $user_id=$_SESSION['user_id'];
	   $_SESSION['flag1']=1;
       $query6="select * from sent_mails where to_user='$user_id' and important='$count' ";
	   $result6=mysqli_query($con,$query6);
		   $rows3=mysqli_num_rows($result6);
		   if($rows3== 0){
		          echo "<script>alert('Sorry, No important mails for you')</script>";
				  echo "<script>window.open('sidebar_test.php','_self')</script>";
   		 }
		  else{
 		  while($field=mysqli_fetch_array($result6))
		  {
		         $dis_subject=$field['subject'];
		  	     $dis_message=$field['message'];
			     $dis_msg_id=$field['msg_id'];
			     echo "<div class='container'><a role='button' href='sidebar_test.php?msg_id=$dis_msg_id '><hr><h5 style='color:#000000;'>$dis_subject</h5>
			                  <p style='width:300px;height:20px;overflow:hidden;'>$dis_message</p> </a></div>";
	      }
		  }
}

if(isset($_POST['display_trash'])) 
{
	   error_reporting(0);
	   $user_id=$_SESSION['user_id'];
	   $_SESSION['flag1']=1;
       $query7="select * from trash_mails where to_user='$user_id' ";
	   $result7=mysqli_query($con,$query7);
		   $rows3=mysqli_num_rows($result7);
		   if($rows3== 0){
		          echo "<script>alert('Sorry, No trash mails found')</script>";
				  echo "<script>window.open('sidebar_test.php','_self')</script>";
   		 }
		  else{
 		  while($field=mysqli_fetch_array($result7))
		  {
		         $dis_subject=$field['subject'];
		  	     $dis_message=$field['message'];
			     $dis_msg_id=$field['msg_id'];
			     echo "<div class='container'><a role='button' href='sidebar_test.php?msg_id=$dis_msg_id '><hr><h5 style='color:#000000;'>$dis_subject</h5>
			                  <p style='width:300px;height:20px;overflow:hidden;'>$dis_message</p> </a></div>";
	      }
		  }
}

if(isset($_POST['display_spam'])) 
{
	   error_reporting(0);
	   $count=1;
	   $user_id=$_SESSION['user_id'];
	   $_SESSION['flag1']=1;
       $query6="select * from sent_mails where to_user='$user_id' and spam='$count' ";
	   $result6=mysqli_query($con,$query6);
		   $rows3=mysqli_num_rows($result6);
		   if($rows3== 0){
		          echo "<script>alert('Sorry, No spam mails for you')</script>";
				  echo "<script>window.open('sidebar_test.php','_self')</script>";
   		 }
		  else{
 		  while($field=mysqli_fetch_array($result6))
		  {
		         $dis_subject=$field['subject'];
		  	     $dis_message=$field['message'];
			     $dis_msg_id=$field['msg_id'];
			     echo "<div class='container'><a role='button' href='sidebar_test.php?msg_id=$dis_msg_id '><hr><h5 style='color:#000000;'>$dis_subject</h5>
			                  <p style='width:300px;height:20px;overflow:hidden;'>$dis_message</p> </a></div>";
	      }
		  }
}

if(isset($_POST['search_mail'])) 
{
       $_SESSION['flag1']=1;
	   $search_content=$_POST['search_mail'];
	   error_reporting(0);
	   $count=0;
       $query3="select * from sent_mails where to_user='$_SESSION[user_id]' and subject='$search_content' ";
	   $result3=mysqli_query($con,$query3);
		   $rows3=mysqli_num_rows($result3);
		   if($rows3== 0){
		          echo "<script>alert('Sorry, No mails for you')</script>";
				  echo "<script>window.open('sidebar_test.php','_self')</script>";
   		 }
		  else{
 		  while($field=mysqli_fetch_array($result3))
		  {
		         $dis_subject=$field['subject'];
		  	     $dis_message=$field['message'];
			     $dis_msg_id=$field['msg_id'];
			     echo "<div class='container'><a role='button' href='sidebar_test.php?msg_id=$dis_msg_id '><hr><h5 style='color:#000000;'>$dis_subject</h5>
			                  <p style='width:300px;height:20px;overflow:hidden;'>$dis_message</p> </a></div>";
	      }
		  }
}
?>

<!--
<div class="row">
<div class="col-md-3">
<img class="img-responsive" src="vr_project_images/vr_boy.jpg" style="height:40px;width:70px;">
</div>
<div class="col-md-6">
<a href="compose_vr.html">
<h4>khaja</h4>
<p>Roll no:95</p><hr>
</a>
</div>
</div>-->
</div>

<div class="container col-md-6">
<form class="form-group" method="post" action="sidebar_test.php ">
<li style="list-style-type:none;margin-top:20px;float:right;">
<button type="submit" name='make_spam' style="border:none;background:none;cursor:pointer;"><i class="fas fa-exclamation-triangle" style="font-size:20px;color:#000000;"></i></button>
<button type="submit" name='make_trash' style="border:none;background:none;cursor:pointer;"><i class="fas fa-trash" style="font-size:20px;margin-left:15px;color:#000000;"></i>
<button type="submit" name='make_important' style="border:none;background:none;cursor:pointer;"" ><i class="far fa-star" style="font-size:20px;margin-left:15px;color:#000000;"></i></button>
<button type="submit" name='make_drafts' style="border:none;background:none;cursor:pointer;""><i class="far fa-save" style="font-size:20px;margin-left:15px;color:#000000;"></i></button>
</li>
</form>

<?php

error_reporting(0);
/*
if($_SESSION['flag1']==2)
 {
 	$_SESSION['flag']=0;
	$_SESSION['flag1']=3;
	//echo $_SESSION['flag1'];
 }*/
 if($_SESSION['flag1']==1)
 {
 	$_SESSION['flag']=0;
	$_SESSION['flag1']=2;
	//echo $_SESSION['flag1'];
 }
 if($_SESSION['flag1']==0)
 {
 	$_SESSION['flag']=1;
	$_SESSION['flag1']=1;
	//echo $_SESSION['flag1'];
 }
 
 
if($_SESSION['flag']==0)
{
	$msg_id=$_GET['msg_id'];
$_SESSION['msg_id']=$_GET['msg_id'];
$_SESSION['flag']=1;
}
//echo "<script>alert('$msg_id')</script>";
$con=mysqli_connect("localhost","root","","projectkp1");
$query4="select * from sent_mails where msg_id='$msg_id' ";
$result4=mysqli_query($con,$query4);
$num4=mysqli_num_rows($result4);
if($result4)
{
     echo "<br><br>";
     while($field=mysqli_fetch_array($result4))
	 {
           $subject_dis=$field['subject'];
           $message_dis=$field['message'];
		   $from_user=$field['from_user'];
		   $to_user=$field['to_user'];
           echo "<h3>$subject_dis</h3><br>
		      <p>From:$from_user</p><br>
			  <p>To:$to_user</p><hr>
              <p>$message_dis</p>";
     }
}
else
{
	 echo "<script>alert('something went wrong')</script>";
}

if(isset($_POST['make_spam']))
{
      $count=1;
	  $user_id=$_SESSION['user_id'];
	  $msg_id=$_SESSION['msg_id'];
	  $query1="update sent_mails set spam='$count' where msg_id='$msg_id' ";
	  $result1=mysqli_query($con,$query1);
	  if($result1)
	  {
	  	     echo "<script>alert('this message is marked as spam')</script>";
	  }
	  else
	  {
	  	    echo "<script>alert('this message is unmarked as spam')</script>";
	  }
}

if(isset($_POST['make_trash']))
{
      $user_id=$_SESSION['user_id'];
	  $msg_id=$_SESSION['msg_id'];
      //echo "<script>alert('entered trash')</script>";
	  //echo "<script>alert('$msg_id')</script>";
      $count=1;
	  $query2="update sent_mails set trash='$count' where msg_id='$msg_id' ";
	  $result2=mysqli_query($con,$query2);
	  if($result2)
	  {
	  	     echo "<script>alert('this message is deleted')</script>";
	  }
	  else
	  {
	  	    echo "<script>alert('this message is not deleted')</script>";
	  }
}

if(isset($_POST['make_important']))
{
      $msg_id=$_SESSION['msg_id'];
      $count=1;
	  $query3="update sent_mails set important='$count' where msg_id='$msg_id' ";
	  $result3=mysqli_query($con,$query3);
	  if($result3)
	  {
	  	     echo "<script>alert('this message is marked as important')</script>";
	  }
	  else
	  {
	  	    echo "<script>alert('this message is not marked as important')</script>";
	  }
}

?>

 
 </div>
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

 ?>
 
<!--===================================================signout modal========================================================-->
<div class="modal fade" id="compose">
<div class="modal-dialog modal-dialog">
<div class="modal-content" style="width:350px;height:300px;background-color:#ffffff;">
<div class="modal-body">
<div class="row">
<div class="col-md-6">
<img src="vr_project_images/default_profile_pic.png" class="img responsive rounded-circle" style="height:150px;width:150px;">
<!--<form action="sidebar_test.php"  method="post" enctype="multipart/form-data">
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
			 
</form> -->

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
<!--=======================================================signout modal end==============================================================-->

<!--=====================================================default_font======================================================-->

<div class="modal fade" id="compose2">
<div class="modal-dialog modal-dialog centered">
<div class="modal-content" style="width:550px;height:450px;background-color:#ffffff;">
<div class="modal-header" style="color:#000;height:70px;">
 <h5 class="modal-title">Default Font</h5>
 <button class="close" type="button" data-dismiss="modal">
 <span aria-hidden="true" style="color:#000";>X</span>
 </button>
</div>

<div class="modal-body">

 <p>select your customized default font</p>
<div class="container" style="border:1px solid #000;height:250px;">
<!--<form class="form-group" method="post" action="default_font.php"> -->
<div class="row" style="background-color:#D8D8D8;height:40px;width:100%;text-align:left;">
<div class="col-md-5">
<select name="font_family" style="height:100%;" form="font_change">
<option value="Arial" style="font-family:Arial">Arial</option>
<option value="Arial Black" style="font-family:Arial Black">Arial Black</option>
<option value="Bahnschrift" style="font-family:Bahnschrift">Bahnschrift</option>
<option value="Bahnschrift Condensed" style="font-family:Bahnschrift Condensed">Bahnschrift Condensed</option>
<option value="Calibri" style="font-family:Calibri">Calibri</option>
<option value="Calibri Light" style="font-family:Calibri Light">Calibri Light</option>
<option value="Cambria" style="font-family:Cambria">Cambria</option>
<option value="Comic Sans MS" style="font-family:Comic Sans MS">Comic Sans MS</option>
<option value="Courier New" style="font-family:Courier New">Courier New</option>
<option value="Gabriola" style="font-family:Gabriola">Gabriola</option>
<option value="Lucida Console" style="font-family:Lucida Console">Lucida Console</option>
<option value="Microsoft Himalaya" style="font-family:Microsoft Himalaya">Microsoft Himalaya</option>
<option value="MS UI Gothic" style="font-family:MS UI Gothic">MS UI Gothic</option>
<option value="MV Boli" style="font-family:MV Boli">MV Boli</option>
<option value="Segoe Print" style="font-family:Segoe Print">Segoe Print</option>
<option value="Times New Roman" style="font-family:TimesNewRoman">Times New Roman</option>
<option value="Verdana" style="font-family:Verdana">Verdana</option>
<option value="Webdings" style="font-family:Webdings">Webdings</option>
</select>
</div>
<div class="col-md-1">
<select name="font_size" style="height:100%;" form="font_change">
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="14">14</option>
<option value="16">16</option>
<option value="18">18</option>
<option value="20">20</option>
<option value="22">22</option>
<option value="24">24</option>
<option value="26">26</option>
<option value="28">28</option>
<option value="36">36</option>
<option value="48">48</option>
<option value="72">72</option>
</select>
</div>
<form action="sidebar_test.php" id="font_change" method="post">
<div class="col-md-3">
<button type="submit" name="make_preview" class="btn btn-default">Preview</button>
</div>
</form>
<!--</form> -->
<div class="col-md-1">
<button class="btn btn-default" onclick="make_bold();" style="border:none;"><i class="fas fa-bold"></i></button>
</div>
<div class="col-md-1">
<button class="btn btn-default" onclick="make_italic()" style="border:none;"><i class="fas fa-italic"></i></button>
</div>
<div class="col-md-1">
<button class="btn btn-default" onclick="make_underline()" style="border:none;"><i class="fas fa-underline"></i></button>
</div>
</div>
<p id="test_paragraph" style="margin-top:20px;" readonly>Messages you write will look like this by default. You can also change the format of your message in a new message window.</p>
</div>
</div>
<form class="form-group" method="post" action="sidebar_test.php">
<div class="modal-footer justify-content-between">
<button  type="submit" class="btn btn-default" name="make_preview" style="width:300px;margin-left:10px;">Save</button>
<button class="btn btn-default" name="make_cancel" style="width:300px;margin-left:10px;" data-dismiss="modal">Cancel</button>
</div>
</form>

</div>
</div>
</div>
<script>
$turn_bold=0;
$turn_italic=0;
$turn_under=0;
function make_preview()
{
    window.alert(sel_font_family);
    var e=document.getElementById("font_family");
    var sel_font_family=e.options[e.selectedIndex].text;
    document.getElementById("test_paragraph").style.fontFamily=sel_font_family;	 
}
function make_bold()
{
   if($turn_bold%2==0){
        	document.getElementById("test_paragraph").style.fontWeight=700;
			sessionStorage.setItem("bold",1);
	}
	else{
		document.getElementById("test_paragraph").style.fontWeight=400;
		sessionStorage.setItem("bold",0);
	} 
	$turn_bold++;
	//document.getElementById("test_paragraph").style.fontWeight=700;
}
function make_italic()
{
   if($turn_italic%2==0){
        	document.getElementById("test_paragraph").style.fontStyle="italic";
	}
	else{
	      if($turn_bold%2!=0){
	         	document.getElementById("test_paragraph").style.fontWeight=700;
	         	document.getElementById("test_paragraph").style.fontStyle="normal";
       	} 
	else
	{
		document.getElementById("test_paragraph").style.fontStyle="normal";
		document.getElementById("test_paragraph").style.fontWeight="normal";
	}
	}
	$turn_italic++;
	//document.getElementById("test_paragraph").style.fontWeight=700;
}

function make_underline()
{
   if($turn_under%2==0){
        	document.getElementById("test_paragraph").style.textDecoration="underline overline";
	}
	else{
		document.getElementById("test_paragraph").style.textDecoration="none";
	} 
	$turn_under++;
	//document.getElementById("test_paragraph").style.fontWeight=700;
}
</script>
<?php
$con=mysqli_connect("localhost","root","","projectkp1");
//echo "<script>alert('$_SESSION[bold]')</script>";
if(isset($_POST['make_preview']))
{
	 $font_family=$_POST['font_family'];
	 $font_size=$_POST['font_size'];
	 //echo "<script>alert('$font_family')</script>";
	 //echo "<script>alert('$font_size')</script>";
	 $_SESSION['font_family']=$font_family;
	 $_SESSION['font_size']=$font_size;
	 echo "<script>window.open('sidebar_test.php','_self')</script>";
}

?>

<!--==========================================================default font modal end=======================================-->

<!--==========================================================personalization modal ===========================================-->

<div class="modal fade" id="personalize">
<div class="modal-dialog modal-dialog centered">
<div class="modal-content" style="width:650px;height:650px;background-color:#ffffff;overflow-y:scroll;">
<div class="modal-header" style="color:#000;height:70px;">
 <h4 class="modal-title">Personalization</h4>
 <button class="close" type="button" data-dismiss="modal">
 <span aria-hidden="true" style="color:#000";>X</span>
 </button>
</div>
<div class="modal-body">
<b>Colours</b><br>
<div class="row" style="margin-top:20px;margin-bottom:30px;">
<form class="form-inline" method="post" action="sidebar_test.php"> 
<div class="col-md-1">
<button id="lightblue" style="width:40px;height:40px;background-color:#699088;" type="submit" name="lightblue"></button>
</div>
<div class="col-md-1">
<button id="pink" style="width:40px;height:40px;background-color:#ED2899;" type="submit" name="pink"></button>
</div>
<div class="col-md-1">
<button id="lightred" style="width:40px;height:40px;background-color:#974646;" name="lightred" type="submit"></button>
</div>
<div class="col-md-1">
<button id="lightorange" style="width:40px;height:40px;background-color:#ED6428;" type="submit" name="lightorange"></button>
</div>
<div class="col-md-1">
<button id="brinjal" style="width:40px;height:40px;background-color:#AC28ED;" type="submit" name="brinjal"></button>
</div>
<div class="col-md-1">
<button id="lightgreen" style="width:40px;height:40px;background-color:#41ED28" type="submit" name="lightgreen"></button>
</div>
<div class="col-md-1">
<button id="lightskyblue" style="width:40px;height:40px;background-color:#28E3ED" type="submit" name="lightskyblue"></button>
</div>
<div class="col-md-1">
<button id="red" style="width:40px;height:40px;background-color:#ED3A28;" type="submit" name="red"></button>
</div>
<div class="col-md-1">
<button id="blue" style="width:40px;height:40px;background-color:#2839ED" type="submit" name="blue"></button>
</div>
<div class="col-md-1">
<button id="brick" style="width:40px;height:40px;background-color:#ED283D;" type="submit" name="brick"></button>
</div>
<div class="col-md-1">
<button id="skyblue" style="width:40px;height:40px;background-color:#28D1ED;" type="submit" name="skyblue"></button>
</div>
<div class="col-md-1">
<button id="yellow" style="width:40px;height:40px;background-color:#E5ED28;" type="submit" name="yellow"></button>
</div>
<hr/>
<b style="margin-top:20px;">Default colour</b><br/>
<button id="black" style="width:40px;height:40px;background-color:#000000;margin-top:20px;" type="submit" name="black"></button>
</form>
</div>
<b style="margin-top:30px;">Background</b><br>
<form class="form group" action="sidebar_test.php" method="post">
<div class="row" style="margin-top:20px;">
<div class="col-md-3">
<button id="scenary1" type="submit" name="scenary1"><img src="vr_project_images/scenary1.jpg" style="width:100px;height:100px;"></button>
</div>
<div class="col-md-3">
<button id="scenary13" type="submit" name="scenary14"><img src="vr_project_images/scenary13.jpg" style="width:100px;height:100px;"></button>
</div>
<div class="col-md-3">
<button id="scenary3" type="submit" name="scenary3"><img src="vr_project_images/scenary3.jpg" style="width:100px;height:100px;"></button>
</div>
<div class="col-md-3">
<button id="scenary4" type="submit" name="scenary4"><img src="vr_project_images/scenary4.jpg" style="width:100px;height:100px;"></button>
</div>
</div>

<div class="row" style="margin-top:20px;">
<div class="col-md-3">
<button id="scenary14" type="submit" name="scenary14"><img src="vr_project_images/scenary14.jpg" style="width:100px;height:100px;"></button>
</div>
<div class="col-md-3">
<button id="scenary6" type="submit" name="scenary6"><img src="vr_project_images/scenary6.jpg" style="width:100px;height:100px;"></button>
</div>
<div class="col-md-3">
<button id="scenary15" type="submit" name="scenary15"><img src="vr_project_images/scenary15.jpg" style="width:100px;height:100px;"></button>
</div>
<div class="col-md-3">
<button id="scenary8" type="submit" name="scenary8"><img src="vr_project_images/scenary8.jpg" style="width:100px;height:100px;"></button>
</div>
</div>

<div class="row" style="margin-top:20px;">
<div class="col-md-3">
<button id="scenary9" type="submit" name="scenary9"><img src="vr_project_images/scenary9.jpg" style="width:100px;height:100px;"></button>
</div>
<div class="col-md-3">
<button id="scenary10" type="submit" name="scenary10"><img src="vr_project_images/scenary10.jpg" style="width:100px;height:100px;"></button>
</div>
<div class="col-md-3">
<button id="scenary11" type="submit" name="scenary11"><img src="vr_project_images/scenary11.jpg" style="width:100px;height:100px;"></button>
</div>
<div class="col-md-3">
<button id="scenary12" type="submit" name="scenary12"><img src="vr_project_images/scenary12.jpg" style="width:100px;height:100px;"></button>
</div>
</div>
</form>
</div>

</div>
</div>
</div>

<?php

$con=mysqli_connect("localhost","root","","projectkp1");
if(isset($_POST['lightblue']))
{
          	$_SESSION['bg_color']="#699088";
			$query="update user_register set background_color='$_SESSION[bg_color]' where user_id='$_SESSION[user_id]' ";
			$result=mysqli_query($con,$query);
			echo("<meta http-equiv='refresh' content='0'>");
			//echo "<script>alert('$_SESSION[color]')</script>";
			//header("Refresh:0,url=sidebar_test.php");
}
if(isset($_POST['pink']))
{
          	$_SESSION['bg_color']="#ED2899";
			$query="update user_register set background_color='$_SESSION[bg_color]' where user_id='$_SESSION[user_id]' ";
			$result=mysqli_query($con,$query);
			echo("<meta http-equiv='refresh' content='0'>");
			//echo "<script>alert('$_SESSION[color]')</script>";
			//echo("<meta http-equiv='refresh' content='0'>");
}
if(isset($_POST['lightred']))
{
          	$_SESSION['bg_color']="#974646";
			$query="update user_register set background_color='$_SESSION[bg_color]' where user_id='$_SESSION[user_id]' ";
			$result=mysqli_query($con,$query);
			echo("<meta http-equiv='refresh' content='0'>");
			//echo "<script>alert('$_SESSION[color]')</script>";
			//echo("<meta http-equiv='refresh' content='0'>");
}
if(isset($_POST['lightorange']))
{
          	$_SESSION['bg_color']="#ED6428;";
			$query="update user_register set background_color='$_SESSION[bg_color]' where user_id='$_SESSION[user_id]' ";
			$result=mysqli_query($con,$query);
			echo("<meta http-equiv='refresh' content='0'>");
			//echo "<script>alert('$_SESSION[color]')</script>";
			//echo("<meta http-equiv='refresh' content='0'>");
}
if(isset($_POST['brinjal']))
{
          	$_SESSION['bg_color']="#AC28ED";
			$query="update user_register set background_color='$_SESSION[bg_color]' where user_id='$_SESSION[user_id]' ";
			$result=mysqli_query($con,$query);
			echo("<meta http-equiv='refresh' content='0'>");
			//echo "<script>alert('$_SESSION[color]')</script>";
			//echo("<meta http-equiv='refresh' content='0'>");
}
if(isset($_POST['lightgreen']))
{
          	$_SESSION['bg_color']="#41ED28";
			$query="update user_register set background_color='$_SESSION[bg_color]' where user_id='$_SESSION[user_id]' ";
			$result=mysqli_query($con,$query);
			echo("<meta http-equiv='refresh' content='0'>");
			//echo "<script>alert('$_SESSION[color]')</script>";
			//echo("<meta http-equiv='refresh' content='0'>");
}
if(isset($_POST['lightskyblue']))
{
          	$_SESSION['bg_color']="#28E3ED";
			echo("<meta http-equiv='refresh' content='0'>");
			$query="update user_register set background_color='$_SESSION[bg_color]' where user_id='$_SESSION[user_id]' ";
			$result=mysqli_query($con,$query);
			//echo "<script>alert('$_SESSION[color]')</script>";
			//echo("<meta http-equiv='refresh' content='0'>");
}
if(isset($_POST['pink']))
{
          	$_SESSION['bg_color']="#ED2899";
			$query="update user_register set background_color='$_SESSION[bg_color]' where user_id='$_SESSION[user_id]' ";
			$result=mysqli_query($con,$query);
			echo("<meta http-equiv='refresh' content='0'>");
			//echo "<script>alert('$_SESSION[color]')</script>";
			//echo("<meta http-equiv='refresh' content='0'>");
}
if(isset($_POST['red']))
{
          	$_SESSION['bg_color']="#ED3A28";
			$query="update user_register set background_color='$_SESSION[bg_color]' where user_id='$_SESSION[user_id]' ";
			$result=mysqli_query($con,$query);
			echo("<meta http-equiv='refresh' content='0'>");
			//echo "<script>alert('$_SESSION[color]')</script>";
			//echo("<meta http-equiv='refresh' content='0'>");
}
if(isset($_POST['blue']))
{
          	$_SESSION['bg_olor']="#2839ED";
			$query="update user_register set background_color='$_SESSION[bg_olor]' where user_id='$_SESSION[user_id]' ";
			$result=mysqli_query($con,$query);
			echo("<meta http-equiv='refresh' content='0'>");
			//echo "<script>alert('$_SESSION[color]')</script>";
			//echo("<meta http-equiv='refresh' content='0'>");
}
if(isset($_POST['brick']))
{
          	$_SESSION['bg_color']="#ED283D";
			$query="update user_register set background_color='$_SESSION[bg_color]' where user_id='$_SESSION[user_id]' ";
			$result=mysqli_query($con,$query);
			echo("<meta http-equiv='refresh' content='0'>");
			//echo "<script>alert('$_SESSION[color]')</script>";
			//echo("<meta http-equiv='refresh' content='0'>");
}
if(isset($_POST['skyblue']))
{
          	$_SESSION['bg_color']="#28D1ED";
			$query="update user_register set background_color='$_SESSION[bg_color]' where user_id='$_SESSION[user_id]' ";
			$result=mysqli_query($con,$query);
			echo("<meta http-equiv='refresh' content='0'>");
			//echo "<script>alert('$_SESSION[color]')</script>";
			//echo("<meta http-equiv='refresh' content='0'>");
}
if(isset($_POST['yellow']))
{
          	$_SESSION['bg_color']="#E5ED28";
			$query="update user_register set background_color='$_SESSION[bg_color]' where user_id='$_SESSION[user_id]' ";
			$result=mysqli_query($con,$query);
			echo("<meta http-equiv='refresh' content='0'>");
			//echo "<script>alert('$_SESSION[color]')</script>";
			//echo("<meta http-equiv='refresh' content='0'>");
}
if(isset($_POST['black']))
{
          	$_SESSION['bg_color']="#000000";
			$query="update user_register set background_color='$_SESSION[bg_color]' where user_id='$_SESSION[user_id]' ";
			$result=mysqli_query($con,$query);
			echo("<meta http-equiv='refresh' content='0'>");
			//echo "<script>alert('$_SESSION[color]')</script>";
			//echo("<meta http-equiv='refresh' content='0'>");
}

if(isset($_POST['scenary1']))
{
	  $_SESSION['bg_image']="vr_project_images/scenary1.jpg";
	  $query="update user_register set background_image='$_SESSION[bg_image]' where user_id='$_SESSION[user_id]' ";
	  $result=mysqli_query($con,$query);
	  echo("<meta http-equiv='refresh' content='0'>");
}
if(isset($_POST['scenary13']))
{
	  $_SESSION['bg_image']="vr_project_images/scenary13.jpg";
	  $query="update user_register set background_image='$_SESSION[bg_image]' where user_id='$_SESSION[user_id]' ";
	  $result=mysqli_query($con,$query);
	  echo("<meta http-equiv='refresh' content='0'>");
}
if(isset($_POST['scenary3']))
{
	  $_SESSION['bg_image']="vr_project_images/scenary3.jpg";
	  $query="update user_register set background_image='$_SESSION[bg_image]' where user_id='$_SESSION[user_id]' ";
	  $result=mysqli_query($con,$query);
	  echo("<meta http-equiv='refresh' content='0'>");
}
if(isset($_POST['scenary4']))
{
	  $_SESSION['bg_image']="vr_project_images/scenary4.jpg";
	  $query="update user_register set background_image='$_SESSION[bg_image]' where user_id='$_SESSION[user_id]' ";
	  $result=mysqli_query($con,$query);
	  echo("<meta http-equiv='refresh' content='0'>");
}
if(isset($_POST['scenary14']))
{
	  $_SESSION['bg_image']="vr_project_images/scenary14.jpg";
	  $query="update user_register set background_image='$_SESSION[bg_image]' where user_id='$_SESSION[user_id]' ";
	  $result=mysqli_query($con,$query);
	  echo("<meta http-equiv='refresh' content='0'>");
}

if(isset($_POST['scenary6']))
{
	  $_SESSION['bg_image']="vr_project_images/scenary6.jpg";
	  $query="update user_register set background_image='$_SESSION[bg_image]' where user_id='$_SESSION[user_id]' ";
	  $result=mysqli_query($con,$query);
	  echo("<meta http-equiv='refresh' content='0'>");
}
if(isset($_POST['scenary15']))
{
	  $_SESSION['bg_image']="vr_project_images/scenary15.jpg";
	  $query="update user_register set background_image='$_SESSION[bg_image]' where user_id='$_SESSION[user_id]' ";
	  $result=mysqli_query($con,$query);
	  echo("<meta http-equiv='refresh' content='0'>");
}
if(isset($_POST['scenary8']))
{
	  $_SESSION['bg_image']="vr_project_images/scenary8.jpg";
	  $query="update user_register set background_image='$_SESSION[bg_image]' where user_id='$_SESSION[user_id]' ";
	  $result=mysqli_query($con,$query);
	  echo("<meta http-equiv='refresh' content='0'>");
}
if(isset($_POST['scenary9']))
{
	  $_SESSION['bg_image']="vr_project_images/scenary9.jpg";
	  $query="update user_register set background_image='$_SESSION[bg_image]' where user_id='$_SESSION[user_id]' ";
	  $result=mysqli_query($con,$query);
	  echo("<meta http-equiv='refresh' content='0'>");
}
if(isset($_POST['scenary10']))
{
	  $_SESSION['bg_image']="vr_project_images/scenary10.jpg";
	  $query="update user_register set background_image='$_SESSION[bg_image]' where user_id='$_SESSION[user_id]' ";
	  $result=mysqli_query($con,$query);
	  echo("<meta http-equiv='refresh' content='0'>");
}
if(isset($_POST['scenary11']))
{
	  $_SESSION['bg_image']="vr_project_images/scenary11.jpg";
	  $query="update user_register set background_image='$_SESSION[bg_image]' where user_id='$_SESSION[user_id]' ";
	  $result=mysqli_query($con,$query);
	  echo("<meta http-equiv='refresh' content='0'>");
}
if(isset($_POST['scenary12']))
{
	  $_SESSION['bg_image']="vr_project_images/scenary12.jpg";
	  $query="update user_register set background_image='$_SESSION[bg_image]' where user_id='$_SESSION[user_id]' ";
	  $result=mysqli_query($con,$query);
	  echo("<meta http-equiv='refresh' content='0'>");
}
?>
<!--=========================================================personalization modal end========================================-->
</body>
</html>
