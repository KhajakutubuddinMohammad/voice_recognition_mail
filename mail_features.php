<!DOCTYPE html>
<html>
<head>
<title>Main page</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>
<div class="container">
<form class="form-group" method="post" action="sidebar_test.php">
<li style="list-style-type:none;margin-top:20px;float:right;">
<button type="submit" name='make_spam' style="border:none;background:none;cursor:pointer;"><i class="fas fa-exclamation-triangle" style="font-size:20px;color:#D8D8D8;"></i></button>
<input  type="submit" name='make_trash' style="border:none;background:none;cursor:pointer;"><i class="fas fa-trash" style="font-size:20px;margin-left:15px;color:#D8D8D8;"></i>
<!--<button type="submit" name='make_important' style="border:none;background:none;cursor:pointer;"" ><i class="fas fa-star" style="font-size:20px;margin-left:15px;color:#D8D8D8;"></i></button>
<button type="submit" name='make_' style="border:none;background:none;cursor:pointer;""><i class="fas fa-exclamation-triangle" style="font-size:20px;margin-left:15px;color:#D8D8D8;"></i></button>-->
</li>
</form>
</div>
<?php
session_start();

$msg_id=$_GET['msg_id'];
$_SESSION['msg_id']=$_GET['msg_id'];
$user_id=$_SESSION['user_id'];
$con=mysqli_connect("localhost","root","","projectkp1");
echo "<script>alert('$msg_id')</script>";
$con=mysqli_connect("localhost","root","","projectkp1");
$query4="select * from sent_mails where msg_id='$msg_id' ";
$result4=mysqli_query($con,$query4);
$num4=mysqli_num_rows($result4);
if($result4)
{
     echo "<br><br>";
     while($field=mysqli_fetch_array($result4))
	 {
           $subject_dis=$field['subject'];
           $message_dis=$field['message'];
		   $from_user=$field['from_user'];
		   $to_user=$field['to_user'];
           echo "<h3>$subject_dis</h3><br>
		      <p>From:$from_user</p><br>
			  <p>To:$to_user</p><hr>
              <p>$message_dis</p>";
     }
}
else
{
	 echo "<script>alert('something went wrong')</script>";
}

if(isset($_POST['make_spam']))
{
      $count=1;
	  $user_id=$_SESSION['user_id'];
	  $query1="update sent_mails set spam='$count' where to_user='$user_id' and msg_id='$msg_id' ";
	  $result1=mysqli_query($con,$query1);
	  if($result1)
	  {
	  	     echo "<script>alert('this message is marked as important')</script>";
	  }
	  else
	  {
	  	    echo "<script>alert('this message is not marked as important')</script>";
	  }
}

if(isset($_POST['make_trash']))
{
      $user_id=$_SESSION['user_id'];
	  $msg_id=$_SESSION['msg_id'];
      echo "<script>alert('entered trash')</script>";
	  echo "<script>alert('$msg_id')</script>";
      $count=1;
	  $query2="delete from sent_mails where msg_id='$msg_id' ";
	  $result2=mysqli_query($con,$query2);
	  if($result2)
	  {
	  	     echo "<script>alert('this message is deleted')</script>";
	  }
	  else
	  {
	  	    echo "<script>alert('this message is not deleted')</script>";
	  }
}

if(isset($_POST['make_important']))
{
      $count=1;
	  $query2="update sent_mails set important='$count' where to_user='$user_id' and msg_id='$msg_id' ";
	  $result3=mysqli_query($con,$query3);
	  if($result3)
	  {
	  	     echo "<script>alert('this message is marked as important')</script>";
	  }
	  else
	  {
	  	    echo "<script>alert('this message is not marked as important')</script>";
	  }
}

?>
</body>
</html>