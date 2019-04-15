<?php

      $con=mysqli_connect("localhost","root","","projectkp1");
      $from_user=$_POST['source_user'];
      $to_user=$_POST['dest_user'];
      $subject=$_POST['subject'];
      $message=$_POST['message'];
	  
	  //echo "<script>alert('$from_user,$to_user,$subject,$message')</script>";
	  $query="insert into sent_mails(from_user,to_user,subject,message,time_of_sending) values('$from_user','$to_user','$subject','$message',NOW())";
      $result=mysqli_query($con,$query);
	  if($result){
	        echo "1";
      }
	  else{ 
	       echo "0";
	 }
?>