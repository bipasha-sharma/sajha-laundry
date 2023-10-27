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

        $a = $_SESSION["customer_username"];
        $b= $_SESSION["customer_id"];
        $id=$_GET['id'];
        $conn=mysqli_connect('localhost','root','','sixthsem');
        $stmt = $conn->prepare("SELECT * FROM Orders AS O join item_orders AS IO on O.order_id= IO.order_id join item AS I on I.item_id= IO.item_id where O.customer_id=$b and O.order_id=$id");
        $stmt->execute();
        $result = $stmt->get_result();

        ?>


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



              <!-- <th>Action</th> -->

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
                <!-- <td><a href="vieworder.php?id=<?php echo $row['order_id'] ?>"> Details</a> </td> -->
              </tr>
            <?php } ?>
            </tbody>
        </table>
      </div>
    </div>
    <footer class="footer">
      <p>SAJHA LAUNDRY </p>
    </footer>
  </body>
</html>
