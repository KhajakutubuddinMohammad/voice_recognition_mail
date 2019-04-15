<!--<?php session_start();
//	$_SESSION['username'] = "user1";
?>-->

<?php
	if(isset($_POST['submit'])){
		move_uploaded_file($_FILES['file']['tmp_name'],"pics/".$_FILES['file']['name']);
		$con = mysqli_connect("localhost","root","","ost");

		  $username = mysqli_real_escape_string($con, $_POST['username']);
		//$q = mysqli_query($con,"UPDATE register SET image = '".$_FILES['file']['name']."' WHERE username = '".$_SESSION['username']."'");
			$q = mysqli_query($con,"UPDATE register SET image = '".$_FILES['file']['name']."' WHERE username ='$username'");

	}
	
	
?>

<!DOCTYPE html>
<html>
	<head>
	
	</head>
	<body>
		<form action="profile_pic.php"  method="post" enctype="multipart/form-data">
			<label>Username</label>
  	  <input type="text" align="center" name="username"></label><br><br>
			<input type="file"  align="center" name="file"><br><br>
			<input type="submit" align="center" name="submit">
		
		<br>
		<br>
		<br>
		<?php
			$con = mysqli_connect("localhost","root","","ost");
			$q = mysqli_query($con,"SELECT * FROM register WHERE username='$username'");
		while($row = mysqli_fetch_assoc($q)){
				echo $row['username'];
				if($row['image'] == ""){
					echo "<img width='150' height='150' src='vr_project_images/default_profile_pic.png' alt='Default Profile Pic'>";
				} else {
					echo "<img width='150' height='150' src='vr_project_images/".$row['image']."' alt='Profile Pic'>";
				}
				echo "<br>";
			}
		?>
	</form>
	</body>
</html>