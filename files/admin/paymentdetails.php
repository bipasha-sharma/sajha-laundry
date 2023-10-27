<!-- customer details for admin -->
<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Sajha Laundry</title>

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
      <h2> <img src="logo.png" class="logo">
        <pre>  Sajha Laundry</pre>
      </h2>
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

  <!-- <div class="content-area"> -->

  <?php
  if ($_SESSION['admin_username']) {
  ?>


    <?php
    include 'dbconn.php';
    $stmt = $conn->prepare("SELECT * FROM payment");
    $stmt->execute();
    $result = $stmt->get_result();


    ?>

    <br><br><br><br>
    <div class="how-it-works">
      <div class="container">
        <h2>Customer Details</h2>
        <br><br>
        <input type="text" name="search" id="search_text" style="width: 550px; border: 1px solid #6cd3e3; border-radius: 20px; margin-bottom: 2em" placeholder="Search...">

        <table class="content-table" id="table_data">
          <thead>
            <tr>
              <th>Payment ID</th>

              <th>Amount</th>

              <th>Payment Date</th>

              <th>Payment Mode</th>

              <th>Order Id</th>

             
             

            </tr>

          </thead>

          <?php
          while ($row = $result->fetch_assoc()) {
          ?>
            <tbody>
              <tr>
                <td><?= $row['payment_id']; ?></td>
                <td><?= $row['amount']; ?></td>
                <td><?= $row['payment_date']; ?></td>
                <td><?= $row['payment_mode']; ?></td>
                <td><?= $row['order_id']; ?></td>
              </tr>
            <?php } ?>
            </tbody>
        </table>
      </div>
    </div>

  <?php
  } else echo "<h1> Please login first </h1> ";
  ?>
 
</body>

</html>