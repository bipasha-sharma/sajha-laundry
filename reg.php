<!---->
<?php
$conn=mysqli_connect('localhost','root','','sixthsem') or die ("unable to connect");

$errfullname=$erremail=$errusername=$errpassword=$errconfirm_password=$erraddress=$errcontact='';

if(isset($_POST['submit']))
{
    $customer_fullname=$_POST['customer_fullname'];
    $customer_email=$_POST['customer_email'];
    $customer_username=$_POST['customer_username'];
    $customer_password=$_POST['customer_password'];
    $confirm_password=$_POST['confirm_password'];
    $customer_address=$_POST['customer_address'];
    $customer_contact=$_POST['customer_contact'];

 
    
    
  if (empty($_POST["customer_fullname"])) {
      $errfullname = "Name is required";
  } 
  else {
      $customer_fullname = ($_POST["customer_fullname"]);
      $sanitized_fullname = htmlspecialchars($customer_fullname, ENT_QUOTES, 'UTF-8');
      // Check if name contains only letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/", $sanitized_fullname)) {
          $errfullname = "Only letters and white space allowed";
      }
  }
 
  // Validate email
  if (empty($_POST["customer_email"])) {
      $erremail = "Email is required";
  } else {
      $customer_email = filter_var($_POST["customer_email"], FILTER_SANITIZE_EMAIL);
      // Check if email address is valid
      if (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
          $erremail = "Invalid email format";
      }
  }
 // Check if the username is empty
 if (empty($customer_username)) {
  $errusername = "Username is required";
  } else {
  if (strpos($customer_username, ' ') !== false) {
    $errusername = "Input contains whitespace";
  } else {
      $query = "SELECT * FROM customer WHERE customer_username = '$customer_username'";
      $result = $conn->query($query);
    
      if ($result->num_rows > 0) {
          $errusername = "Username already exists";
      } 
    } 
  }
  // Validate password
  if (empty($_POST["customer_password"])) {
      $errpassword = "Password is required";
   } 

  // Validate confirm password
  if (empty($_POST["confirm_password"])) {
      $errconfirm_password = "Please confirm password";
  } else {
      $confirm_password =($_POST["confirm_password"]);
      // Check if confirm password matches password
      if ($confirm_password !== $customer_password) {
          $errconfirm_password= "Passwords do not match";
      }
  }
  if (empty($_POST["customer_address"])) {
      $erraddress = "address is required";
  } 

  if (empty($_POST["customer_contact"])) {
    $errcontact = "contact no. is required";
  }
  else{
    if (strlen($customer_contact) !== 10) {
      $errcontact = "Contact number should contain 10 digits";
    }
  }





  // If all validations pass, proceed with registration or further processing
   if (empty($errfullname)&& empty($erremail) && empty($errusername)&& empty($errpassword) && empty($errconfirm_password)&& empty($erraddress)&& empty($errcontact)) {
    	$stmt=$conn->prepare("INSERT INTO customer (customer_fullname,customer_email,customer_username,customer_password,customer_address,customer_contact, admin_id) VALUES(?,?,?,?,?,?,1)");
    	$stmt->bind_param("sssssi",$customer_fullname,$customer_email,$customer_username,$customer_password,$customer_address,$customer_contact);
    	$stmt->execute();
    	echo'<script> alert("Registration Successful !") </script>';
    	$stmt->close();
    	$conn->close();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
      <li><a href="index.php">Available Services</a></li>
      <li><a href="#">About Us</a></li>
      <li><a href="index.php">Contact Us</a></li>
    </ul>
  </div>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <div class="contact main-spacing">
     <div class="container">
        <div id="login" class="login-form-container">
        
        <h1>SIGN UP</h1>
        <fieldset style="border: solid">
            <div class="input-wrapper">
                <label> Name</label><input type="text" placeholder="Enter your full name please" name="customer_fullname" /> 
            </div>
            <span class="error"> <?php echo $errfullname;?> </span>

            <div class="input-wrapper">
                <label> Email</label><input type="text" placeholder="your@email.com" name="customer_email"/>
            </div>
            <span class="error"> <?php echo $erremail;?> </span>

            <div class="input-wrapper">
                <label> Username</label><input type="text" placeholder="Enter your username please" name="customer_username" />
            </div>
            <span class="error"> <?php echo $errusername;?> </span>
                
            <div class="input-wrapper">
                <label> Password</label><input type="password" placeholder="Password" name="customer_password" /> 
            </div>
            <span class="error"> <?php echo $errpassword;?> </span>

            <div class="input-wrapper">
                <label> Confirm Password</label><input type="password" placeholder="Confirm password" name="confirm_password" />   
            </div>
            <span class="error"> <?php echo $errconfirm_password;?> </span>

            <div class="input-wrapper">
                <label> Address</label><input type="text" placeholder="Enter your address please" name="customer_address" /> 
            </div>
            <span class="error"> <?php echo $erraddress;?> </span>
                

            <div class="input-wrapper">
                <label> Contact Number </label><input type="number" placeholder="Enter your contact number please" name="customer_contact" />
            </div>
            <span class="error"> <?php echo $errcontact;?> </span>



        <input type="submit" value="SIGN IN" name="submit" class="submit" >

        </fieldset>
        </div>
      </div>
      </div>
    </form>
    <footer class="footer">
        <p>SAJHA LAUNDRY </p>
    </footer>
      
</body>
</html>