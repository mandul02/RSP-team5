<?php
	require('connect.php');
    // If the values are posted, insert them into the database.
    if (isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
	$email = $_POST['email'];
        $password = $_POST['password'];
 
        $query = "INSERT INTO `hesla` (jmeno, heslo, email) VALUES ('$username', '$password', '$email')";
        $result = mysqli_query($connection, $query);
        if($result){
            $smsg = "User Created Successfully.";
        }else{
            $fmsg ="User Registration Failed";
        }
    }
    ?>
</html>
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
</head>
<style>
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
<body>
<div class="celekkopie">
  <div class="menu" style="font-family: MyriadCond;">
    <div class="casopisybutton"><a href="casopisy.html">časopisy</a> </div>
    <div class="registracebutton"><a style="color: #ED1C24;" href="registrace.php">registrace</a> </div>
    <div class="prihlasenibutton"><a href="prihlaseni.php">přihlášení</a> </div>
    <div class="akce"> 
      
      <!--
  jméno<br /><input type="text" style="height:50px; width:340px; font-size:38pt; font-family: MyriadCond; "><br /><br />
  e-mail<br /><input type="email" style="height:50px; width:340px; font-size:38pt; font-family: MyriadCond; "><br /><br />
  heslo<br /><input type="password" style="height:50px; width:340px; font-size:38pt; font-family: MyriadCond; "><br />
  <button onclick="naOndrovi()"><img src='img/odeslat.png' onmouseover="this.src = 'img/odeslathover.png';" onmouseout="this.src = 'img/odeslat.png';"></button>
  -->
      <div class="container">
        <form class="form-signin" method="POST">
          <?php if(isset($smsg)){ ?>
          <div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div>
          <?php } ?>
          <?php if(isset($fmsg)){ ?>
          <div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div>
          <?php } ?>
          <div class="input-group">
            <input type="text" name="username" class="form-control" placeholder="jmeno" required>
          </div>
          <label for="inputEmail" class="sr-only">email</label>
          <input type="email" name="email" id="inputEmail" class="form-control" placeholder="email" required autofocus>
          <label for="inputPassword" class="sr-only">heslo</label>
          <input type="password" name="password" id="inputPassword" class="form-control" placeholder="heslo" required>
          <div class="checkbox">
            <label style="font-size:16pt; font-family: MyriadCond;">
              <input type="checkbox" value="remember-me">
              zapamatovat </label>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">registrace</button>
          <a class="btn btn-lg btn-primary btn-block" href="prihlaseni.php">prihlaseni</a>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>
