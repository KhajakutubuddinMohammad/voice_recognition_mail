<?php

       session_start();
	   $con=mysqli_connect("localhost","root","","projectkp1");
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

?>