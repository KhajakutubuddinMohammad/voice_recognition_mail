<!DOCTYPE html>
<html>
<head>
<title>Main page</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<style>
.test_paragraph{
	font-family: <?php echo $_SESSION['font_family']; ?>;
	font-size: <?php echo $_SESSION['font_size']; ?>;
	
}
</style>
<body>
<button class="btn btn-primary" data-toggle="modal" data-target="#compose1">Default font</button>
<div class="modal fade" id="compose1">
<div class="modal-dialog modal-dialog centered">
<div class="modal-content" style="width:550px;height:450px;background-color:#ffffff;">
<div class="modal-header" style="color:#000;height:70px;">
 <h5 class="modal-title">Default Font</h5>
 <button class="close" type="button" data-dismiss="modal">
 <span aria-hidden="true" style="color:#000";>X</span>
 </button>
</div>

<div class="modal-body">

 <p>select your customized default font</p>
<div class="container" style="border:1px solid #000;height:250px;">
<!--<form class="form-group" method="post" action="default_font.php"> -->
<div class="row" style="background-color:#D8D8D8;height:40px;width:100%;text-align:left;">
<div class="col-md-5">
<select name="font_family" style="height:100%;" form="font_change">
<option value="Arial" style="font-family:Arial">Arial</option>
<option value="Arial Black" style="font-family:Arial Black">Arial Black</option>
<option value="Bahnschrift" style="font-family:Bahnschrift">Bahnschrift</option>
<option value="Bahnschrift Condensed" style="font-family:Bahnschrift Condensed">Bahnschrift Condensed</option>
<option value="Calibri" style="font-family:Calibri">Calibri</option>
<option value="Calibri Light" style="font-family:Calibri Light">Calibri Light</option>
<option value="Cambria" style="font-family:Cambria">Cambria</option>
<option value="Comic Sans MS" style="font-family:Comic Sans MS">Comic Sans MS</option>
<option value="Courier New" style="font-family:Courier New">Courier New</option>
<option value="Gabriola" style="font-family:Gabriola">Gabriola</option>
<option value="Lucida Console" style="font-family:Lucida Console">Lucida Console</option>
<option value="Microsoft Himalaya" style="font-family:Microsoft Himalaya">Microsoft Himalaya</option>
<option value="MS UI Gothic" style="font-family:MS UI Gothic">MS UI Gothic</option>
<option value="MV Boli" style="font-family:MV Boli">MV Boli</option>
<option value="Segoe Print" style="font-family:Segoe Print">Segoe Print</option>
<option value="Times New Roman" style="font-family:TimesNewRoman">Times New Roman</option>
<option value="Verdana" style="font-family:Verdana">Verdana</option>
<option value="Webdings" style="font-family:Webdings">Webdings</option>
</select>
</div>
<div class="col-md-1">
<select name="font_size" style="height:100%;" form="font_change">
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="14">14</option>
<option value="16">16</option>
<option value="18">18</option>
<option value="20">20</option>
<option value="22">22</option>
<option value="24">24</option>
<option value="26">26</option>
<option value="28">28</option>
<option value="36">36</option>
<option value="48">48</option>
<option value="72">72</option>
</select>
</div>
<form action="default_font.php" id="font_change" method="post">
<div class="col-md-3">
<button type="submit" name="make_preview" class="btn btn-default">Preview</button>
</div>
</form>
<!--</form> -->
<div class="col-md-1">
<button class="btn btn-default" onclick="make_bold();" style="border:none;"><i class="fas fa-bold"></i></button>
</div>
<div class="col-md-1">
<button class="btn btn-default" onclick="make_italic()" style="border:none;"><i class="fas fa-italic"></i></button>
</div>
<div class="col-md-1">
<button class="btn btn-default" onclick="make_underline()" style="border:none;"><i class="fas fa-underline"></i></button>
</div>
</div>
<p id="test_paragraph" style="margin-top:20px;" readonly>Messages you write will look like this by default. You can also change the format of your message in a new message window.</p>
</div>
</div>
<form class="form-group" method="post" action="default_font.php">
<div class="modal-footer justify-content-between">
<button class="btn btn-default" name="make_save" style="width:300px;margin-left:10px;">Save</button>
<button class="btn btn-default" name="make_cancel" style="width:300px;margin-left:10px;">Cancel</button>
</div>
</form>

</div>
</div>
</div>
<script>
$turn_bold=0;
$turn_italic=0;
$turn_under=0;
function make_preview()
{
    window.alert(sel_font_family);
    var e=document.getElementById("font_family");
    var sel_font_family=e.options[e.selectedIndex].text;
    document.getElementById("test_paragraph").style.fontFamily=sel_font_family;	 
}
function make_bold()
{
   if($turn_bold%2==0){
        	document.getElementById("test_paragraph").style.fontWeight=700;
	}
	else{
		document.getElementById("test_paragraph").style.fontWeight=400;
	} 
	$turn_bold++;
	//document.getElementById("test_paragraph").style.fontWeight=700;
}
function make_italic()
{
   if($turn_italic%2==0){
        	document.getElementById("test_paragraph").style.fontStyle="italic";
	}
	else{
	      if($turn_bold%2!=0){
	         	document.getElementById("test_paragraph").style.fontWeight=700;
	         	document.getElementById("test_paragraph").style.fontStyle="normal";
       	} 
	else
	{
		document.getElementById("test_paragraph").style.fontStyle="normal";
		document.getElementById("test_paragraph").style.fontWeight="normal";
	}
	}
	$turn_italic++;
	//document.getElementById("test_paragraph").style.fontWeight=700;
}

function make_underline()
{
   if($turn_under%2==0){
        	document.getElementById("test_paragraph").style.textDecoration="underline overline";
	}
	else{
		document.getElementById("test_paragraph").style.textDecoration="none";
	} 
	$turn_under++;
	//document.getElementById("test_paragraph").style.fontWeight=700;
}
</script>
<?php
$con=mysqli_connect("localhost","root","","projectkp1");
if(isset($_POST['make_preview']))
{
	 $font_family=$_POST['font_family'];
	 $font_size=$_POST['font_size'];
	 echo "<script>alert('$font_family')</script>";
	 echo "<script>alert('$font_size')</script>";
	 $_SESSION['font_family']=$font_family;
	 $_SESSION['font_size']=$font_size;
}
?>

<!--================================================default_font===========================================================-->

</body>
</html>