<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!--změna textového formátu kvůli interpunkcím -->

<title>Redakční systém</title>
<link rel="icon" type="=image/pgn" href="img/favicon.png">
<link href="css/css.css" rel="stylesheet" type="text/css" />
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="styles.css" >

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
body
{font-family: MyriadCond;}
a:link, a:visited {
	color: #000;
	text-decoration: none;
}
a:hover { 
    color: #ED1C24;
}
.form-signin {
	max-width: 330px;
	/*padding: 15px;*/
	/*margin: 0 auto;*/
}
.form-signin .form-signin-heading, .form-signin .checkbox {
	margin-bottom: 10px;
}
.form-signin .checkbox {
	font-weight: normal;
}
.form-signin .form-control {
	position: relative;
	height: auto;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	padding: 10px;
	font-size: 16px;
}
.form-signin .form-control:focus {
	z-index: 2;
}
.form-signin input[type="email"] {
	margin-bottom: -1px;
	border-bottom-right-radius: 0;
	border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
	margin-bottom: 10px;
	border-top-left-radius: 0;
	border-top-right-radius: 0;
}
</style>
</head>

<body>
<div class="celekkopie">
<div class="menu">
  <div class="casopisybutton"><a href="casopisy.html">časopisy</a> </div>
  <div class="registracebutton"><a href="registrace.php">registrace</a> </div>
  <div class="prihlasenibutton"><a style="color: #ED1C24;" href="prihlaseni.php">přihlášení</a> </div>
  <div class="akce"> 
    
    <!--
  jméno<br /><input type="text" style="height:50px; width:340px; font-size:38pt; font-family: MyriadCond; "><br /><br />
  heslo<br /><input type="password" style="height:50px; width:340px; font-size:38pt; font-family: MyriadCond; "><br />
  <button onclick="naOndrovi()"><img src='img/odeslat.png' onmouseover="this.src = 'img/odeslathover.png';" onmouseout="this.src = 'img/odeslat.png';"></button>
  -->
    <form class="form-signin" method="POST">
      <div class="input-group"> <!--<span class="input-group-addon" id="basic-addon1"></span>-->
        <input type="text" name="username" class="form-control" placeholder="jmeno" required>
      </div>
      <label for="inputPassword" class="sr-only">heslo</label>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="heslo" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">prihlaseni</button>
      <a class="btn btn-lg btn-primary btn-block" href="registrace.php">registrace</a>
    </form>
  </div>
</div>

</body>
</html>
<?php  //Start the Session
session_start();
 require('connect.php');
//3. If the form is submitted or not.
//3.1 If the form is submitted
if (isset($_POST['username']) and isset($_POST['password'])){
//3.1.1 Assigning posted values to variables.
$username = $_POST['username'];
$password = $_POST['password'];
//3.1.2 Checking the values are existing in the database or not
$query = "SELECT * FROM `hesla` WHERE jmeno='$username' and heslo='$password'";
 
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$count = mysqli_num_rows($result);
//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
if ($count == 1){
$_SESSION['username'] = $username;
}else{
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
$fmsg = "Invalid Login Credentials.";
}
}
//3.1.4 if the user is logged in Greets the user with message
if (isset($_SESSION['username'])){
$username = $_SESSION['username'];
echo "Hai " . $username . "
";
header("Location: admin.html");
echo "<a href='logout.php'>Logout</a>";
 
}else
 //echo "nespravne udaje";
//3.2 When the user visits the page first time, simple login form will be displayed.
?>