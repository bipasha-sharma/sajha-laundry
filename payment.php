<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'sixthsem') or die("unable to connect");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="./files/css/style2.css" />
</head>

<body>
  <div class="header">
    <div>
      <h2> <img src="./files/logo.png" class="logo">
        <pre>  Sajha Laundry</pre>
      </h2>
    </div>


    <ul>
      <li><a href="customer.php"><?php if ($_SESSION['customer_username']) {
                        echo $_SESSION['customer_username'];
                      } ?> </a></li>
      <li><a href="book.php">Book Now</a></li>
      <li><a href="payment.php">Payment</a></li>
      <li><a href="logout.php">Log out</a></li>
    </ul>
  </div>
  <div class="how-it-works">
      <div class="container">
        <h1>Payment Details</h1>
        
        <br>
        <!-- client details DISPLAY FORM -->

<?php 
$order_id=$_GET['id'];
$a = $_SESSION["customer_username"];
$b= $_SESSION["customer_id"];

$sqla = "SELECT service_type FROM orders WHERE order_id = $order_id";
$resulta = $conn->query($sqla);
if ($resulta->num_rows > 0) {
    while ($row1 = $resulta->fetch_assoc()) {
        $service_type = $row1['service_type'];
    



$sql = "SELECT item_id, quantity_ordered FROM item_orders WHERE order_id = $order_id";
$result = $conn->query($sql);

$amount = 0; // Initialize the total amount

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $item_id = $row['item_id'];
        $quantity_ordered = $row['quantity_ordered'];

        // Fetch item price from the 'item' table
        $item_sql = "SELECT laundry, dry_cleaning FROM item WHERE item_id = $item_id";
        $item_result = $conn->query($item_sql);

        if ($item_result->num_rows == 1) {
            $item_row = $item_result->fetch_assoc();
           
            if($service_type=="laundry"){
            $price = $item_row['laundry'];
            }
            else{
                $price = $item_row['dry_cleaning'];
            }

            // Calculate the total amount for this item in the order
            $item_total = $price * $quantity_ordered;
            $amount += $item_total;
        }
    }

    // Insert payment information into the 'payment' table
    $payment_sql = "INSERT INTO payment (order_id, amount) VALUES ($order_id, $amount)";

    if ($conn->query($payment_sql) === TRUE) {

        $conn=mysqli_connect('localhost','root','','sixthsem');
        $stmt1 = $conn->prepare("SELECT * FROM Orders AS O join item_orders AS IO on O.order_id= IO.order_id join item AS I on I.item_id= IO.item_id join payment AS P on P.order_id= O.order_id where O.customer_id=$b and O.order_id=$order_id ");
        $stmt1->execute();
        $result = $stmt1->get_result();

    ?>
    
    <table class="content-table" id="table_data" border="1px solid" >
          <thead>
            <tr>
              <th>Order Id</th>

              <th>Order Date</th>

              <th>Item Id</th>

              <th>Item Name</th>

              <th>Quantity ordered</th>


             
            </tr>
          </thead>
          <?php
          while ($row = $result->fetch_assoc()) {
          ?>
            <tbody>
              <tr>
                <td><?= $row['order_id']; ?></td>
                <td><?= $row['order_date']; ?></td>
                <td><?= $row['item_id']; ?></td>
                <td><?= $row['item_name']; ?></td>
                <td><?= $row['quantity_ordered']; ?></td>
                
                
              </tr>
             
            <?php } ?>
            </tbody>
    </table>
    <br>
    <br>
    <?php echo "Total Amount =".$amount; ?>
    <?php
                            // Generate a unique ID for the payment
                            $payment_id = uniqid();

                            // Store the generated pid in a session variable for later use
                            // $_SESSION['payment_pid'] = $pid;
                        ?>

                        <form action="https://uat.esewa.com.np/epay/main" method="POST">
                            <input value="<?php echo $amount; ?>" name="tAmt" type="hidden">
                            <input value="<?php echo $amount; ?>" name="amt" type="hidden">
                            <input value="0" name="txAmt" type="hidden">
                            <input value="0" name="psc" type="hidden">
                            <input value="0" name="pdc" type="hidden">
                            <input value="EPAYTEST" name="scd" type="hidden">
                            <input value="<?php echo $payment_id; ?>" name="pid" type="hidden">
                            <input value="http://sixthsemproject/sajhalaundry/paymentsuccess.php" type="hidden" name="su">
                            <input value="http://sixthsemproject/sajhalaundry/payment_failure.php" type="hidden" name="fu">
                            <input value="Submit" type="submit">
                        </form>

                    
    <?php
       
        
    } else {
        echo "Error: " . $payment_sql . "<br>" . $conn->error;
    }
} else {
    echo "No items found in the order.";
}
    }
}

// Close the database connection
$conn->close();

?>
</body>
  


</html>