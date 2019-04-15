<?php
session_start();
 $con=mysqli_connect("localhost","root","","projectkp1");
if(isset($_POST['username'])){
        
         $username=$_POST['username'];
		 $user_id=$_POST['user_id'];
		 $password=$_POST['password'];
		 $background_image="vr_project_images/scenary4.jpg";
		 $background_color="#000000";
		 //$profile_pic= echo "<img src='vr_project_images/default_profile_pic.png' id='$user_id'> ";
	     //echo "<script>alert(' '$username','$user_id','$password' ')</script>";
		 $query="insert into user_register(username,user_id,password,background_color,background_image) values('$username','$user_id','$password','$background_color','$background_image')";
		 $result=mysqli_query($con,$query);
		 if($result)
		 {       
			   $query2="insert into user_log(user_id) values('$user_id')";
			   $result2=mysqli_query($con,$query2);
			   $_SESSION['user']=$username;
			   echo "1";
		 }
		 else
		 {
		        echo "0";
			   /* echo "failed to connect".mysqli_connect_error();
		       echo "<script>alert('sorry,your details are not registered')</script>";
		    	echo "<script>window.open('sidebar_test.html','_self')</script>";*/
		 }
}	
	/*}
	catch(Exception $e)
	{
		echo "error occurred:"
	}*/

/*if(isset($_POST['user_id']))
{
    $user_id=$_POST['user_id'];
	$password=$_POST['password'];
	$_SESSION['user_id']=$user_id;
	$_SESSION['password']=$password;
	//echo "<script>alert(' '$user_id','$password' ')</script>";
	$query="select * from user_register where user_id='$user_id' and password='$password' ";
	$login_status=mysqli_query($con,$query);
	if(mysqli_num_rows($login_status) == 1)
	{
			$query2="update user_log set signin_time=NOW() where user_id='$user_id' ";
			$result=mysqli_query($con,$query2);
			echo "1";
			echo "<script>alert('Hey , lets do some crazy stuff with Bmail') </script>";
			echo "<script>window.open('sidebar_test.php','_self') </script>";
			
	}
	else
	{
	        echo "0";
		 echo "<script>alert('Enter correct details') </script>";
		 echo "<script>window.open('register_login.php','_self') </script>";
	}
}*/
$con->close();

?>
