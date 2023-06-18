<?php
session_start();
$message="";
if(isset($_POST['login'])){
	$con=mysqli_connect('localhost','root','','sixthsem') or die ("unable to connect");
	$customer_username=$_POST['customer_username'];
	$customer_password=$_POST['customer_password'];
	$sql = "SELECT * FROM customer WHERE customer_username='$customer_username' AND customer_password='$customer_password'";
	$result =mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result);
	if(is_array($row)){
		$_SESSION['customer_username']=$row['customer_username'];
		$_SESSION['customer_password']=$row['customer_password'];
    $customer_id = $row['customer_id'];

    $_SESSION['customer_id'] = $customer_id;

	}
	else{
		$message="invalid username or password ";
	}

	if(empty($customer_username) || empty($customer_password)){
            echo'<script> alert("Dont leave any field empty") </script>';
        }

}
 if(isset($_SESSION['customer_username'])){
	header("location:customer.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sajha Laundry</title>

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
      integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <link rel="stylesheet" href="./files/css/style.css" />
  </head>

  <body>
    <div class="header">
      <div>
        <h2> <img src="./files/logo.png" class="logo"> <pre>  Sajha Laundry</pre></h2>
      </div>
      <!-- Navigation is mostly unorder list -->

      <ul>
        <li><a href="#">About Us</a></li>
        <li><a href="#form">Login</a></li>
      </ul>
    </div>

    <!-- Sajha Section -->
    <div class="sajha">
      <div class="container">
        <div class="sajha-desc">
          <h1>Get your Laundry and dry cleaning done within 24hrs</h1>
          <p></p>
          <a href="#form">Start here</a>
        </div>
        <img src="./files/laundry.png" alt="" />
      </div>
    </div>

    <div class="how-it-works">
      <div class="container" >
        <h1> Available Services</h1>
        <p>Services provided by Sajha Laundry</p>
       
        <div class="row">
          <div class="card">
            <i class="fa-solid fa-jug-detergent"></i>
            <h1>Regular Laundry</h1>
            <p>
              Tell us about you, how you like your clothes and your dry cleaning
              needs
            </p>
          </div>
          <div class="card">
            <i class="fa-solid fa-jug-detergent"></i>
            <h1>Dry Cleaning</h1>
            <p>
              Tell us about you, how you like your clothes and your dry cleaning
              needs
            </p>
          </div>
         
        </div>
        <a href="#">Give a Price estimate</a>
      </div>
    </div>
    
    <div class="why main-spacing">
      <div class="container">
        <h1>Order process</h1>
        <p>
          The only laundry company that speeds us your last minutes deliveries
        </p>

        <div class="row-spacing">
          <div class="row">
            <div class="card">
              <i class="fa-sharp fa-solid fa-1" style="color: #ffffff;"></i>
              <h1>Get Registered</h1>
              <p>
                Tell us about you, how you like your clothes and your dry
                cleaning needs
              </p>
            </div>
            <div class="card">
              <i class="fa-sharp fa-solid fa-2" style="color: #ffffff;"></i>
              <h1>Log in</h1>
              <p>
                Tell us about you, how you like your clothes and your dry
                cleaning needs
              </p>
            </div>
          </div>
          <div class="row">
            <div class="card">
              <i class="fa-sharp fa-solid fa-3" style="color: #ffffff;"></i>
              <h1>Place your order and book a pick up</h1>
              <p>
                Tell us about you, how you like your clothes and your dry
                cleaning needs
              </p>
            </div>
            <div class="card">
              <i class="fa-sharp fa-solid fa-4" style="color: #ffffff;"></i>
              <h1>Make Payment</h1>
              <p>
                Tell us about you, how you like your clothes and your dry
                cleaning needs
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="contact main-spacing">
      <div class="container">
        <a id="form">
        <h1>Contact us today</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
          <div id="login" class="login-form-container">
              <fieldset>
                <div class="input-wrapper">
                  <img src="user.png" class="user"><label> Username</label><input type="text" placeholder="your@email.com" name="customer_username"/>
                  
                </div>
                <div class="input-wrapper">
                  <img src="pass.png" class="pass"><label> Password</label><input type="password" placeholder="password" name="customer_password"/>
                  
                </div>
                
                <input type="submit" value="LOGIN" name="login" class="submit" >
                <div class="message"><?php if($message!="") {echo $message; } ?></div>
                <p style="text-align: center;">Don't have an account? <a href="reg.php"> Sign in </a> </p>
                
              </fieldset>
            </div>
          </form>
        </a>
      </div>
    </div>
    <footer class="footer">
      <p>SAJHA LAUNDRY </p>
    </footer>
  </body>
</html>
