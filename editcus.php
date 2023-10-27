<?php 
session_start();
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
        <li><a href="#"><?php if($_SESSION['customer_username']){ echo $_SESSION['customer_username'];}?> </a></li>
        <li><a href="book.php">Book Now</a></li>
        <li><a href="history.php">History</a></li>
        <li><a href="#">Payment</a></li>
        <li><a href="logout.php">Log out</a></li>
      </ul>
    </div>


    <div class="how-it-works">
      <div class="container">
        <h1>Profile Details</h1>
        <br>
        <!-- client details DISPLAY FORM -->

<?php 
$id=$_GET['id'];

$conn=mysqli_connect('localhost','root','','sixthsem');

$sql1="select * from customer where customer_id=$id";
$res=mysqli_query($conn,$sql1);
$data=mysqli_fetch_assoc($res);
if(isset($_POST['submit'])){
$customer_fullname=$_POST['customer_fullname'];
$customer_username=$_POST['customer_username'];
$customer_email=$_POST['customer_email'];
$customer_address=$_POST['customer_address'];
$customer_contact=$_POST['customer_contact'];

$sql="UPDATE customer set customer_fullname='$customer_fullname',customer_username='$customer_username',customer_email='$customer_email',customer_address='$customer_address',customer_contact='$customer_contact' where customer_id='$id'";
mysqli_query($conn,$sql);
if(mysqli_affected_rows($conn)==1){
	header('location:customer.php');
}
else{
	echo "data update failed".mysqli_error($conn);
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>edit form from database 10</title>
</head>
<body>
	<form method="post">

    <table border="1" class="content-table">
            <thead>
                    <tr>
                    <th>Full name</th>
                    <td><input type="text" name="customer_fullname" value="<?php echo $data['customer_fullname'];?>"></td>
                    </tr>
                    <tr>
                    <th>Username</th>
                    <td><input type="text" name="customer_username" value="<?php echo $data['customer_username'];?>"></td>
                    </tr>
                    <tr>
                    <th>Email</th>
                    <td><input type="text" name="customer_email" value="<?php echo $data['customer_email'];?>"></td>
                    </tr>
                    <tr>
                    <th>Address</th>
                    <td><input type="text" name="customer_address" value="<?php echo $data['customer_address'];?>"></td>
                    </tr>
                    <tr>
                    <th>Contact</th>
                    <td><input type="number" name="customer_contact" value="<?php echo $data['customer_contact'];?>"></td>
                    </tr>
                    
            </thead>
                
          </table>
          <input type="submit" value="Update" name="submit" class="submit">
                    
		
	</form>
</body>
</html>

</div>
    </div>
    
    <footer class="footer">
      <p>SAJHA LAUNDRY </p>
    </footer>
  </body>
</html>