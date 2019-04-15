<!DOCTYPE html>
<html>
<head>
<title>Main page</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/materialize/0.95.1/js/materialize.min.js"></script>
<script type="text/javascript" src="jquery.js"></script>
</head>
<body>
<div class="form-group" action="" method="post">  
<div class="card" style="width:900px;height:750px;margin-left:30px;">
<div class="card-title" style="font-size:30px;">New Message</div>
<div class="card-body">
<label>From:<input type="email" id="from_mail" style="border:0px; width:700px;">
</label><hr>
<label>To:    
<input type="email" id="to_email"  style="border:0px;width:700px;">
</label><hr>
<label>Subject:
<input type="text" id="subject" style="border:0px;width:700px;">
</label><hr>
<textarea id="demo"  id="message" rows="20" style="height:400px;width:850px;">    </textarea>
  <input type="submit" class="btn btn-primary" name="submit_data" style="margin-top:10px;height:40px;width:100px;" value="Send"> 
<div class="btn btn-default" onclick="startconvert();"><i class="fas fa-microphone-alt" style="font-size:20px;"></i></div>
<a href="" class="btn btn-default"><i class="fas fa-link" style="font-size:20px;"></i></a>
<a href="" class="btn btn-default"><i class="fas fa-paperclip" style="font-size:20px;"></i></a>
<a href="" class="btn btn-default"><i class="far fa-images" style="font-size:20px;"></i></a>
<a href="" class="btn btn-default"><i class="fab fa-google-drive" style="font-size:20px;"></i></a>
<a href="" class="btn btn-default"><i class="far fa-smile-wink" style="font-size:20px;"></i></a>
</div>
</div>
</div>
<button id="demo" onclick="startconvert();"></button>          
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
      msg.rate=1;
      msg.pitch=1;
      msg.lang='en-us';
      msg.text ='you can do a lot of stuff here'; 

      msg.onend = function(e) {
        console.log('Finished in ' + event.elapsedTime + ' seconds.');
      };

      speechSynthesis.speak(msg);
    })
  } else {
    alert("hello world");
  }
});

function startconvert(){
 if('webkitSpeechRecognition' in window){
    var speechrec=new webkitSpeechRecognition();
	speechrec.interimResults=true;
	speechrec.continuous=true;
	speechrec.lang='en-IN';
	speechrec.start();

   flagset=0;
	var finalTranscripts=' ',interimTranscripts=' ';
	speechrec.onresult= function(event){
		
		  interimTranscripts="";
          for(var i=event.resultIndex;i<event.results.length;i++){
		  	        var res=event.results[i][0].transcript;
					//res.splice(1,res.length);
					
					if(event.results[i].isFinal) {
					       finalTranscripts+=res;
						   if(res=="ok mail") { var flagset=1;break;}
						   }
				   else
				          interimTranscripts+=res;
		  }
		  var msg=new SpeechSynthesisUtterance(finalTranscripts);
		  document.getElementById("demo").innerHTML=finalTranscripts+interimTranscripts;
		  if(flagset==1) alert('working');
		  var res=event.results[event.resultIndex][0].transcript;
		  if(res=="send an email")
		  {
		  	        var from_mail=$('#from_mail');
					var to_email=$('#to_email');
					var subject=$('#subject');
					var message=$('#message');
					
					function post(data)
					{
						     $.post("validate_send.php",{from_mail:from_mail,to_email:to_email,subject:subject,message:message},
							 function(data)
							 {
							 	      if(data=="1")
									  {
									  	     alert("mail sent successfully");
									  }
									  else 
									  {
									  	   alert('sorry something went wrong');
									  }
							 });
					}
		  }
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
?>
</body>
</html>