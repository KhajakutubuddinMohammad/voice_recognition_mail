<?php
session_start();
    $con=mysqli_connect("localhost","root","","projectkp1");
    $user_id=$_POST['user_id'];
	$password=$_POST['password'];
	$_SESSION['user_id']=$user_id;
	$_SESSION['password']=$password;
	//echo "<script>alert(' '$user_id','$password' ')</script>";
	$query="select * from user_register where user_id='$user_id' and password='$password' ";
	$login_status=mysqli_query($con,$query);
	if($login_status)
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

?>