<?php
  session_start();
  $_SESSION['flag1']=0;
  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Page Title</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/materialize/0.95.1/js/materialize.min.js"></script>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
</head>
<body style="background:url('vr_project_images/vr_mainimage.jpg') no-repeat;background-size:cover;">

<div class="modal fade" id="reg_login">
<div class="modal-dialog modal-dialog-centered" style="width:700px;">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" style="text-align:right;">&times</button>
</div>
<div class="modal-body">
<ul class="nav nav-tabs row" role="tablist">
<li class="nav-item col-md-6">
<a href="#register_tab" class="nav-link" data-toggle="tab">Register</a>
</li>
<li class="nav-item col-md-6">
<a href="#login_tab" class="nav-link" data-toggle="tab">Login</a>
</li>
</ul>
<div class="tab-content">
<div id="register_tab" class="container tab-pane active">
<form class="form-group" action="register_login.php" method="post">
<br>
<label>Username: </label><br>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fas fa-users"></i></span>
  </div>
  <input type="text" id='username' placeholder='enter username' class='form-control'>
</div>
</br>
<label>Email: </label><br>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fas fa-users"></i></span>
  </div>
  <input type="email" id='user_id' placeholder='enter your mail' class='form-control'>
</div>
<br>
<label>Password:</label><br>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
  </div>
  <input type="password" id='password' placeholder='enter your password' class='form-control'></br>
</div>
<br>
<button  type="button" id='register_button' class="btn btn-success" style="width:450px;height:50px;" onclick="javascript:registeruser();">Sign up</button>
</form>
</div>

<div id="login_tab" class="container tab-pane fade">
<form class="form-group" action="register_login.php" method="post">
<br>
<br>
<label>Email : </label><br>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fas fa-users"></i></span>
  </div>
  <input type="email" id='user_id2' placeholder='enter username' class='form-control'>
</div>
</br>
<label>Password:</label><br>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
  </div>
  <input type="password" id='password2' placeholder='enter your password' class='form-control'></br>
  <!--<a href="#forgot_password" data-toggle="modal">Forgot Password</a>-->
</div>
<br>
<button type="button" class="btn btn-success" style="width:450px;height:50px;" id="login_button" onclick="javascript:login_user();">Sign In</button>
</form>
</div>
</div>

</div>
</div>
</div>
</div>
</div>

<h1  style="color:#FFF;text-align:center;font-family:Times New Roman;font-size:70px;margin-top:220px;margin-left:350px;">Go Blind With Bmail</h1>
<p id="get_name"><?php error_reporting(0); echo $_SESSION['user']; ?> </p>
<p style="text-align:center;color:#FFF;font-size:25px;margin-left:350px;">yeah!!! we can just operate your emails through your voice without the use of keyboard.Thats pretty cool!!!</p>
<button class="btn btn-danger" style="height:50px;width:150px;margin-left:750px;margin-top:30px;font-size:20px;" data-toggle="modal" data-target="#reg_login">REGISTER</button>
<button class="btn btn-primary-outline" style="color:#000;height:50px;width:150px;font-size:20px;margin-left:30px;margin-top:30px;border:2px solid white;" data-target="#reg_login" data-toggle="modal">LOGIN</button>
<!--
<?php

$con=mysqli_connect("localhost","root","","projectkp1");

	$user_id=$_POST['user_id'];
	$password=$_POST['password'];
	$_SESSION['user_id']=$user_id;
	$_SESSION['password']=$password;
	echo "<script>alert(' '$user_id','$password' ')</script>";
	$query="select * from user_register where user_id='$user_id' and password='$password' ";
	$login_status=mysqli_query($con,$query);
	if(mysqli_num_rows($login_status) == 1)
	{
			$query2="update user_log set signin_time=NOW() where user_id='$user_id' ";
			$result=mysqli_query($con,$query2);
			echo "1";
			/*echo "<script>alert('Hey , lets do some crazy stuff with Bmail') </script>";
			echo "<script>window.open('sidebar_test.php','_self') </script>";*/
			
	}
	else
	{
	        echo "0";
		/* echo "<script>alert('Enter correct details') </script>";
		 echo "<script>window.open('register_login.php','_self') </script>";*/
	}


/*if(isset($_POST['register_user']))
	{
//Load Composer's autoloader
require 'vendor/autoload.php';
$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
	$email_id=$_POST['email_id'];
	$username=$_POST['username'];
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.'.substr(strstr($email_id ,'@'), 1);;  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'hospitalssksh@gmail.com';                 // SMTP username
    $mail->Password = 'sksh@123';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = '587';   
   
    $mail->setFrom('skshhospitals@gmail.com', 'sksh hospitals');
    $mail->addAddress($_POST['email_id'], $_POST['username']);
	
	$mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Welcome to SKSH HOSPITALS';
    $mail->Body    = "hii $username.</br>we are glad to serve you and provide a healthy life.Thank you for joining us";
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
     if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
     } else {
        echo "Message has been sent";
     }
	   
	   
	   
	     $username=$_POST['username'];
		 $user_id=$_POST['user_id'];
		 $password=$_POST['password'];
		 $background_image="vr_project_images/scenary1.jpg";
		 $background_color="#000000";
		 //$profile_pic= echo "<img src='vr_project_images/default_profile_pic.png' id='$user_id'> ";
		 $query="insert into user_register(username,user_id,password,background_color,background_image) values('$username','$user_id','$password','$background_color','$background_image')";
		 $result=mysqli_query($con,$query);
		 if($result)
		 {
		       echo "1";
			   $query2="insert into user_log(user_id) values('$user_id')";
			   $result2=mysqli_query($con,$query2);
		       echo "<script>window.open('register_login.php','_self') </script>";    
			   $_SESSION['user']=$username;
			   return speechtext();
		 }
		 else
		 {
		        echo "0";
			    echo "failed to connect".mysqli_connect_error();
		       echo "<script>alert('sorry,your details are not registered')</script>";
		    	echo "<script>window.open('sidebar_test.html','_self')</script>";
		 }
		 
	}
	catch(Exception $e)
	{
		echo "error occurred:"
	}
	}*/
   $con->close();
?>-->
<script>
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
		            if(res=="register")
					{
					
					//alert('voice recognized:register');
						var username=$('#username').val();
		var user_id=$('#user_id').val();
		var password=$('#password').val();
		
		//alert(username+user_id+password);
       
		$.post('register.php',{username:username,user_id:user_id,password:password},
		function(data,status){
			if(data=="1")
			   {
					 alert('Hello ,your registration was successful') ;
					 window.open('register_login.php','_self');    
			   }
			   else 
			   {
		                  alert('sorry,your details are not registered');
		    	           window.open('register_login.php','_self');
			   }
			  // alert(status+"    "+data);
		});
					}
					else if(res=="login")
					{
						//alert('voice recognized:login');
						 var user_id=$('#user_id2').val();
	   var password=$('#password2').val();
	   
	   //alert(user_id+"    "+password);
	   $.post("login.php",{user_id:user_id,password:password},
	   function(data,status)
	   {
	             if(data=="1")
				 {
				 	    //alert("Hey welcome to Bmail,you can do a lot of stuff here");
						window.open('sidebar_test.php','_self');
				 }
				 else
				 {
				 	  alert("we cant able to log you in.Try again");
					  window.open('register_login.php','_self');
				 }
				 //alert(status+"   "+data);
	   });
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
/*
function registeruser()
{
	    var username=$('#username').val();
		var user_id=$('#user_id').val();
		var password=$('#password').val();
		
		alert(username+user_id+password);
       
		$.post('register.php',{username:username,user_id:user_id,password:password},
		function(data,status){
			if(data=="1")
			   {
					 alert('Hello $user_,your registration was successful') ;
					 window.open('register_login.php','_self');    
			   }
			   else 
			   {
		                  alert('sorry,your details are not registered');
		    	           window.open('register_login.php','_self');
			   }
			   alert(status+"    "+data);
		});
}
function login_user()
{
	   var user_id=$('#user_id2').val();
	   var password=$('#password2').val();
	   
	   //alert(user_id+"    "+password);
	   $.post("login.php",{user_id:user_id,password:password},
	   function(data,status)
	   {
	             if(data=="1")
				 {
				 	    alert("Hey welcome to Bmail,you can do a lot of stuff here");
						window.open('sidebar_test.php','_self');
				 }
				 else
				 {
				 	  alert("we cant able to log you in.Try again");
					  window.open('register_login.php','_self');
				 }
				 //alert(status+"   "+data);
	   });
}*/
</script>
<!--------------------------------------------------------------------------------------------------------forgot_password modal----------------------------------------------------------------------------------------------------->
<div class="modal fade" id="forgot_password">
<div class="modal-dialog modal-dialog centered">
<div class="modal-content" style="width:600px;height:650px;background-color:#ffffff;">
<div class="modal-header bg-dark" style="color:#fff";>
 <h5 class="modal-title">Forgot Password</h5>
 <button class="close" type="button" data-dismiss="modal">
 <span aria-hidden="true" style="color:#fff";>X</span>
 </button>
</div>

<div class="modal-body">
<form class="form-group" action="register_login.php" method="post">  
<label><b>Bmail Id:</b></label>
<input type="email" name="user_id" style="width:550px;" class="form-control"></br>
</label>
<label><b>Question:</b></label>
<select name="pass_ques" class="form-control" style="width:550px;">
<option value="Your nick name ?">Your nick name ?</option>
<option value="Your favourite game ?">Your favourite game ?</option>
<option value="Your favourite place to visit ?">Your favourite place to visit ?</option>
<option value="Your lover's name ?">Your lover's name ?</option>
<option value="Your father's favourite food ?">Your father's favourite food ?</option>
<option value="Yours mother's favourite hero/heroin ?">Yours mother's favourite hero/heroin ?</option>
</select></br>
<label><b>Answer:</b>
<input type="text" name="pass_ans" style="width:550px;" class="form-control"></br>
</br>
<input type="submit" value="submit" name="confirm_password" class="btn btn-primary">
</form>
</div>

</div>
</div>
</div>

<!--=======================================================change_password modal=============================================================-->
<div class="modal fade" id="change_password">
<div class="modal-dialog modal-dialog centered">
<div class="modal-content" style="width:600px;height:650px;background-color:#ffffff;">
<div class="modal-header bg-dark" style="color:#fff";>
 <h5 class="modal-title">Change Password</h5>
 <button class="close" type="button" data-dismiss="modal">
 <span aria-hidden="true" style="color:#fff";>X</span>
 </button>
</div>

<div class="modal-body">
<form class="form-group" action="register_login.php" method="post">  
<label><b>Enter new Password:</b></label>
<input type="password" name="new_pass" style="width:550px;" class="form-control"></br>
</label>
<input type="submit" name="change_password" value="change password">
</form>
</div>

</div>
</div>
</div>


<?php

$con=mysqli_connect("localhost","root","","projectkp1");

if(isset($_POST['confirm_password']))
{
	    $user_id=$_POST['user_id'];
		$_SESSION['password_changer']=$user_id;
		$pass_ques=$_POST['pass_ques'];
		$pass_ans=$_POST['pass_ans'];

		      $query="select * from user_register where user_id='$user_id' and pass_ques='$pass_ques' and pass_ans='$pass_ans' ";
			  $result=mysqli_query($con,$query);
			  if($result)
			  {
			            echo "<script>alert('entered')</script>";
			  	        echo '<script type="text/javascript">
                                  $(function(){
                              	  $("#change_password").modal("show");
							    	});
									</script>';
									
			  }
			  else
			  {
			  	    echo "<script>alert('password is not set.Try again')</script>";
			        echo "<script>window.open('register_login.php','_self')</script>";
			  }
	    
		
}
if(isset($_POST['change_password']))
{
	   $new_pass=$_POST['new_pass'];
	   $query="update user_register set password='$new_pass' where user_id='$_SESSION[password_changer]' ";
	   $result=mysqli_query($con,$query);
	   if($result)
	   {
	   	      echo "<script>alert('password set successfully')</script>";
			  echo "<script>window.open('register_login.php','_self')</script>";
	   }
	   else
	   {
	   	       echo "<script>alert('password not set.Try again')</script>";
			  echo "<script>window.open('register_login.php','_self')</script>";
	   }
}

?>

</body>
</html>
