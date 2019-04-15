
<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Compose Mail</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<script type="text/javascript" src="jquery.js"></script>
</head>
<style>
#upload
{
	display:none;
}
</style>

<!--<button class="btn btn-primary" data-target="#compose" data-toggle="modal">Compose Mail</button> -->
<div class="modal fade" id="compose" role="dialog">
<div class="modal-dialog modal-dialog centered">
<div class="modal-content" style="width:700px;height:700px;background-color:#ffffff;">
<div class="modal-header bg-dark" style="color:#fff";>
 <h5 class="modal-title">New Message</h5>
 <button class="close" type="button" data-dismiss="modal">
 <span aria-hidden="true" style="color:#fff";>X</span>
 </button>
</div>

<div class="modal-body">
<form class="form-group"  method="post">  
<label><b>From:</b>
<input type="email" id="source_user" style="border:0px; width:550px;" value=" <?php echo $_SESSION['user_id']  ?>  " readonly>
</label><hr>
<label><b>To: </b>   
<input type="email" id="dest_user"  style="border:0px;width:550px;font-family:<?php echo $_SESSION['font_family'] ?>;font-size:<?php echo $_SESSION['font_size']; ?>px;">
</label><hr>
<label><b>Subject:</b>
<input type="text" id="subject" style="border:0px;width:550px;font-family:<?php echo $_SESSION['font_family'] ?>;font-size:<?php echo $_SESSION['font_size']; ?>px;">
</label><hr>
<textarea  id="message" rows="40" style="width:650px;height:300px;font-family:<?php echo $_SESSION['font_family'] ?>;font-size:<?php echo $_SESSION['font_size']; ?>px;"> </textarea>
 <input type="submit" class="btn btn-primary" name="submit_data" style="margin-top:10px;height:40px;width:100px;" onclick="senddata();" value="send">
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
 window.onload=function(){        
   $('#compose').modal('show');
    }; 
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
					if(event.results[i].isFinal) {
					if(res=="send this mail"){
						alert("voice recognized:send this mail");
						
					}
					finalTranscripts+=res;
					}
				   else
				          interimTranscripts+=res;
		  }
		  var msg=new SpeechSynthesisUtterance(finalTranscripts);
		 document.getElementById("message").innerHTML=finalTranscripts+interimTranscripts;
		  msg.lang="en-IN";
		  msg.rate=1;
		  msg.pitch=10;
		  
		  speechrec.onstop()
		  {
		  	  window.speechSynthesis.speak(msg);
		  }
		  //window.speechSynthesis.speak(msg);
	}
	speechrec.onerror=function(event){
		 document.write("some error occurred.please try again later.<br>");
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
/*if(isset($_POST['submit_data']))
{
         
         $source_user=$_POST['source_user']; 
		 $dest_user=$_POST['dest_user'];
		 $message=$_POST['message'];
		 $subject=$_POST['subject'];
		 if(getimagesize($_FILES['image']['tmp_name'])==TRUE)
	     {
		         $image=addslashes($_FILES['image']['tmp_name']);
			 $name=addslashes($_FILES['image']['name']);
			 $image=base64_encode($image);
			 $image=file_get_contents($image);
		         $query="insert into sent_mails(from_user,to_user,message,subject,time_of_sending,images) values('$source_user','$dest_user','$message','$subject',NOW(),$name)";
		 }
		 else{
		            $query="insert into sent_mails(from_user,to_user,message,subject,time_of_sending) values('$source_user','$dest_user','$message','$subject',NOW())";
		       }
			   $result=mysqli_query($con,$query);
		       echo "<script>alert('done khaja')</script>";
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
}*/
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
<script>

function senddata()
{
      var source_user=$('#source_user').val();
		var dest_user=$('#dest_user').val();
		var subject=$('#subject').val();
		var message=$('#message').val();
		$.post('validate_send.php',{source_user:source_user,dest_user:dest_user,subject:subject,message:message},
		function(data){
			if(data=="1")
			  {
			  	  alert('mail sent unsuccessfully');
				  window.open('sidebar_test.php','_self');
			  }
			  else
			  {
			  	alert('mail cant be sent try again later');
			  }
		});
}
</script>
</body>
</html>