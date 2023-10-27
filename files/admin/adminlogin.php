<!-- admin login -->

<?php
session_start();
$message="";
if(isset($_POST['login'])){
	$con=mysqli_connect('localhost','root','','sixthsem') or die ("unable to connect");
	$admin_username=$_POST['admin_username'];
	$admin_password=$_POST['admin_password'];
	$sql = "SELECT * FROM admin WHERE admin_username='$admin_username' AND admin_password='$admin_password'";
	$result =mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result);
	if(is_array($row)){
		$_SESSION['admin_username']=$row['admin_username'];
		$_SESSION['admin_password']=$row['admin_password'];

	}
	else{
		$message="invalid username or password ";
	}

	if(empty($admin_username) || empty($admin_password)){
            echo'<script> alert("Dont leave any field empty") </script>';
        }

}
if(isset($_SESSION['admin_username'])){
	header("location:customerdetails.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>form</title>
	<link rel="stylesheet" type="text/css" href="admincss.css">
</head>
<body>
      <div class="contact main-spacing">
      <div class="container">
        <a id="form">
        <h1>ADMIN LOG IN</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
          <div id="login" class="login-form-container">
              <fieldset>
                <div class="input-wrapper">
                  <img src="user.png" class="user"><label> Username</label><input type="text" placeholder="Enter your username" name="admin_username"/>
                  
                </div>
                <div class="input-wrapper">
                  <img src="pass.png" class="pass"><label> Password</label><input type="password" placeholder="Enter your password" name="admin_password"/>
                  
                </div>
                
                <input type="submit" value="LOGIN" name="login" class="submit" >
                <div class="message"><?php if($message!="") {echo $message; } ?></div>
                
                
              </fieldset>
            </div>
          </form>
        </a>
      </div>
    </div>
    
</body>
</html>