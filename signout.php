<?php

session_start();
$con=mysqli_connect("localhost","root","","projectkp1");

$query2="update user_log set signout_time=NOW() where user_id='$_SESSION[user_id]' ";
			$result=mysqli_query($con,$query2);
			if($result){
	                      echo "1";
			}
	else
	{
		 echo "0";
	}

?>