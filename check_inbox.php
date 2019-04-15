<?php

        session_start();
        $con=mysqli_connect("localhost","root","","projectkp1");
        $_SESSION['flag1']=1;
	   error_reporting(0);
	   $count=0;
	   //echo "<script>alert('$_SESSION[user_id]')</script>";
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

?>