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

   <!-- Latest compiled and minified CSS  -->
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> -->

  <!-- jQuery library -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script> -->

  <!-- Popper JS -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" type="text/css" href="admincss.css">
</head>

<body>
  <div class="header">
    <div>
      <h2> <img src="logo.png" class="logo"> <pre>  Sajha Laundry</pre></h2>
    </div>
    <!-- Navigation is mostly unorder list -->

    <ul>
      
      <li><a href="customerdetails.php">Customer Details</a></li>
      <li><a href="products.php">Products</a></li>
      <li><a href="orderdetails.php">Order Details</a></li>
      <li><a href="paymentdetails.php">Payment Details</a></li>
      <li><a href="adminlogout.php">Log out</a></li>
    </ul>
  </div>
  <?php
  if ($_SESSION['admin_username']) {
  ?>
   <?php
    include 'dbconn.php';
    $stmt = $conn->prepare("SELECT * FROM Orders");
    $stmt->execute();
    $result = $stmt->get_result();


    ?>

    <br><br><br><br>
    <div class="how-it-works">
      <div class="container">
        <h2>Order Details</h2>
        <br><br>
        <input type="text" name="search" id="search_text" style="width: 550px; border: 1px solid #6cd3e3; border-radius: 20px; margin-bottom: 2em" placeholder="Search...">

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
                <td><a href="vieworder.php?id=<?php echo $row['order_id'] ?>">Details</a> <a href="editorder.php?id=<?php echo $row['order_id'] ?>">Edit</a></td>
              </tr>
            <?php } ?>
            </tbody>
        </table>
      </div>
    </div>

  <?php
  } else echo "<h1> Please login first </h1> ";
  ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    var jq = $.noConflict();
    jq(document).ready(function() {
      jq("#search_text").keyup(function() {
        var search = jq(this).val();
        jq.ajax({
          url: "actionorder.php",
          method: "POST",
          data: {
            query: search
          },
          success: function(response) {
            jq("#table_data").html(response);
          }
        });
      });
    });
  </script>
 
   
    <footer class="footer">
        <p>SAJHA LAUNDRY </p>
    </footer>
      
</body>
</html>