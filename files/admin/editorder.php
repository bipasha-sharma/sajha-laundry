<?php
session_start();
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


  <link rel="stylesheet" type="text/css" href="admincss.css">
</head>

<body>
  <div class="header">
    <div>
      <h2> <img src="logo.png" class="logo"> <pre>  Sajha Laundry</pre></h2>
    </div>
    <!-- Navigation is mostly unorder list -->

    <ul>
      <li><a href="dashboard.php">Dashboard</a></li> 
      <li><a href="customerdetails.php">Customer Details</a></li>
      <li><a href="products.php">Products</a></li>
      <li><a href="orderdetails.php">Order Details</a></li>
      <li><a href="#">Payment Details</a></li>
      <li><a href="adminlogout.php">Log out</a></li>
    </ul>
  </div>
  <?php
  if ($_SESSION['admin_username']) {
  ?>
   <?php
   $id=$_GET['id'];
    include 'dbconn.php';
    $stmt = $conn->prepare("SELECT * FROM Orders where order_id= $id");
    $stmt->execute();
    $result = $stmt->get_result();
    if(isset($_POST['submit'])){
        $order_status=$_POST['order_status'];
        
        
        $sql="UPDATE orders set order_status='$order_status' where order_id='$id'";
        mysqli_query($conn,$sql);
        if(mysqli_affected_rows($conn)==1){
            header('location:orderdetails.php');
        }
        else{
            echo "data update failed".mysqli_error($conn);
        }
        }


    ?>

    <br><br><br><br>
    <div class="how-it-works">
      <div class="container">
        <h2>Order Details</h2>
        <br><br>
        

        <table class="content-table" id="table_data">
          <thead>
            <tr>
              <th>Order Id</th>

              <th>Order Date</th>

              <th>Pickup Date</th>

              <th>Pickup Time</th>

              <th>Drop off Time</th>

              <th>Order Status</th>

              <th>Service Type</th>

              <th>Customer Id</th>

              <th>Action</th>

            </tr>

          </thead>

          <?php
          while ($row = $result->fetch_assoc()) {
          ?>
          <form method="post">
            <tbody>
              <tr>
              <td><input type="text" disabled="disabled" name="order_id" value="<?= $row['order_id'];?>"></td>
              <td><input type="text" disabled="disabled" name="order_date" value="<?= $row['order_date'];?>"></td>
              <td><input type="text" disabled="disabled" name="pickup_date" value="<?= $row['pickup_date'];?>"></td>
              <td><input type="text" disabled="disabled" name="pickup_time" value="<?= $row['pickup_time'];?>"></td>
              <td><input type="text" disabled="disabled" name="dropoff_time" value="<?= $row['dropoff_time'];?>"></td>
              <td><select name="order_status" value="<?= $row['order_status'];?>">
			<option value="Pending">Pending</option>
			<option value="Processing">Processing</option>
			<option value="Complete">Complete</option>
		    </select></td>
              <td><input type="text" disabled="disabled" name="service_type" value="<?= $row['service_type'];?>"></td>
              <td><input type="text" disabled="disabled" name="customer_id" value="<?= $row['customer_id'];?>"></td>
              <td> <input type="submit" value="Update" name="submit" class="submit"></td>
              </tr>
            <?php } ?>
            </tbody>
          </form>
        </table>
      </div>
    </div>

  <?php
  } else echo "<h1> Please login first </h1> ";
  ?>

    <footer class="footer">
        <p>SAJHA LAUNDRY </p>
    </footer>
      
</body>
</html>