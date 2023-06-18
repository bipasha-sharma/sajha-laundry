<?php 
session_start();
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

    <link rel="stylesheet" href="./files/css/style2.css" />
  </head>

  <body>
    <div class="header">
      <div>
        <h2> <img src="./files/logo.png" class="logo"> <pre>  Sajha Laundry</pre></h2>
      </div>
      <!-- Navigation is mostly unorder list -->

      <ul>
        <li><a href="#"><?php if($_SESSION['customer_username']){ echo $_SESSION['customer_username'];}?> </a></li>
        <li><a href="#">Book Now</a></li>
        <li><a href="#">History</a></li>
        <li><a href="logout.php">Log out</a></li>
      </ul>
    </div>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <div class="contact main-spacing">
     <div class="container">
        <div id="login" class="login-form-container">
        
        <h1>Booking</h1>
        <br>
        <fieldset style="border: solid">
            <div class="">
            <label> Select Service</label>
            <select name="service" required>
            <option value="laundry">Regular Laundry</option>
            <option value="dry_cleaning">Dry Cleaning</option>
            </select>
            </div>
            <span class="error"> <?php echo $errfullname;?> </span>
            <div class="column">
            <div class="input-wrapper">
                <label> Pants</label><input type="number" placeholder="Quantity" name=""/>
            </div>
            <span class="error"> <?php echo $erremail;?> </span>

            <div class="input-wrapper">
                <label> Shirt/t-shirt</label><input type="number" placeholder="Quantity" name="customer_username" />
            </div>
            <span class="error"> <?php echo $errusername;?> </span>
                
            <div class="input-wrapper">
                <label> Dress</label><input type="number" placeholder="Quantity" name="customer_password" /> 
            </div>
            <span class="error"> <?php echo $errpassword;?> </span>

            <div class="input-wrapper">
                <label> Blanket</label><input type="number" placeholder="Quantity" name="confirm_password" />   
            </div>
            <span class="error"> <?php echo $errconfirm_password;?> </span>

            <div class="input-wrapper">
                <label> Coat/blazer</label><input type="number" placeholder="Quantity" name="customer_address" /> 
            </div>
            <span class="error"> <?php echo $erraddress;?> </span>
                

            <div class="input-wrapper">
                <label> Jacket </label><input type="number" placeholder="Quantity" name="customer_contact" />
            </div>
            <span class="error"> <?php echo $errcontact;?> </span>

            <div class="input-wrapper">
                <label> Suit set (blazer+pants) </label><input type="number" placeholder="Quantity" name="customer_contact" />
            </div>
            <span class="error"> <?php echo $errcontact;?> </span>

            <div class="input-wrapper">
                <label> Tie </label><input type="number" placeholder="Quantity" name="customer_contact" />
            </div>
            <span class="error"> <?php echo $errcontact;?> </span>

            <div class="input-wrapper">
                <label> Socks </label><input type="number" placeholder="Quantity" name="customer_contact" />
            </div>
            <span class="error"> <?php echo $errcontact;?> </span>

            <div class="input-wrapper">
                <label> Saree </label><input type="number" placeholder="Quantity" name="customer_contact" />
            </div>
            <span class="error"> <?php echo $errcontact;?> </span>

            <div class="input-wrapper">
                <label> Towel </label><input type="number" placeholder="Quantity" name="customer_contact" />
            </div>
            <span class="error"> <?php echo $errcontact;?> </span>




        <input type="submit" value="SIGN IN" name="submit" class="submit" >
            </div>

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
