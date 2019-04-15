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
<body>
<div class="modal fade" id="forgot_password">
<div class="modal-dialog modal-dialog centered">
<div class="modal-content" style="width:600px;height:650px;background-color:#ffffff;">
<div class="modal-header bg-dark" style="color:#fff";>
 <h5 class="modal-title">Change Password</h5>
 <button class="close" type="button" data-dismiss="modal">
 <span aria-hidden="true" style="color:#fff";>X</span>
 </button>
</div>

<div class="modal-body">
<form class="form-group" action="forgot_password.php" method="post">  
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
<label><b>Enter New Password:</b></label>
<input type="password" name="new_pass1" style="width:550px;" class="form-control"></br>
<label><b>Confirm Password:</b></label>
<input type="password" name="new_pass2" style="width:550px;" class="form-control"></br></br>
<input type="submit" name="confirm_password" value="Submit" class="btn btn-primary">
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
		$pass_ques=$_POST['pass_ques'];
		$pass_ans=$_POST['pass_ans'];
		$new_pass1=$_POST['new_pass1'];
		$new_pass2=$_POST['new_pass2'];
		
		if($new_pass1 == $new_pass2)
		{
		      $query="update user_register set pass_ques='$pass_ques',pass_ans='$pass_ans',password='$new_pass2' where user_id='$user_id' ";
			  $result=mysqli_query($con,$query);
			  if($result)
			  {
			  	        echo "<script>alert('password changed successfully')</script>";
					    echo "<script>window.open('register_login.php','_self')</script>";
			  }
	    }
		else 
		{
			   echo "<script>alert('Two passwords doesn't match')</script>";
			   echo "<script>window.open('forgot_password.php','_self')</script>";
		}
}

?>

</body>
</html>