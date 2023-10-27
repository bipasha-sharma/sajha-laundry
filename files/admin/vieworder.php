<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>user login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="admincss.css">
</head>

<body>

  <div class="header">
    <div>
      <h2> <img src="logo.png" class="logo">
        <pre>  Sajha Laundry</pre>
      </h2>
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
    $stmt = $conn->prepare("SELECT * FROM Orders AS O join item_orders AS IO on O.order_id= IO.order_id join item AS I on I.item_id= IO.item_id where O.order_id=$id");
    $stmt->execute();
    $result = $stmt->get_result();


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

              <th>Item Id</th>

              <th>Item Name</th>

              <th>Quantity ordered</th>



              <th>Action</th>

            </tr>

          </thead>

          <?php
          while ($row = $result->fetch_assoc()) {
          ?>
            <tbody>
              <tr>
                <td><?= $row['order_id']; ?></td>
                <td><?= $row['order_date']; ?></td>
                <td><?= $row['pickup_date']; ?></td>
                <td><?= $row['pickup_time']; ?></td>
                <td><?= $row['dropoff_time']; ?></td>
                <td><?= $row['order_status']; ?></td>
                <td><?= $row['service_type']; ?></td>
                <td><?= $row['customer_id']; ?></td>
                <td><?= $row['item_id']; ?></td>
                <td><?= $row['item_name']; ?></td>
                <td><?= $row['quantity_ordered']; ?></td>
                <td><a href="vieworder.php?id=<?php echo $row['order_id'] ?>"> Details</a> </td>
              </tr>
            <?php } ?>
            </tbody>
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