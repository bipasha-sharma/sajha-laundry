<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'sixthsem') or die("unable to connect");
$error = '';
$order_status = 'pending';

if (isset($_POST['submit'])) {
    
    $service_type=$_POST['service_type'];
    $pickup_time=$_POST['pickup_time'];
    $pickup_date=$_POST['pickup_date'];
    $dropoff_time=$_POST['dropoff_time'];

    $dt = date('Y-m-d H:i:s');
    $customer_id = $_SESSION['customer_id'];
   
  

    $stmt = $conn->prepare("INSERT INTO orders (order_date,pickup_date,pickup_time,dropoff_time,order_status,service_type,customer_id) VALUES(?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssi", $dt, $pickup_date, $pickup_time,$dropoff_time,$order_status,$service_type,$customer_id);
    $stmt->execute();
    $order_id = mysqli_insert_id($conn);
    echo '<script> alert("order successful !") </script>';
    $stmt->close();


  
   

  $select = "SELECT * from item";
  $result_query = mysqli_query($conn, $select);
  while ($row = mysqli_fetch_assoc($result_query)) {
    $item_id = $row['item_id'];
    $item_name = $row['item_name'];
    $quantity=$_POST[$item_name];
    if (empty($quantity)) {
      $quantity=0;
    }
 
  else {
    if($quantity<0){
    echo'<script> alert("Invalid Input") </script>';
    break;
  }
}
if ($quantity >= 0) {
  $stmt2 = $conn->prepare("INSERT INTO item_orders (item_id, order_id, quantity_ordered) VALUES (?, ?, ?)");
  $stmt2->bind_param("iii", $item_id, $order_id, $quantity);
  $stmt2->execute();
  $stmt2->close();
}

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
      <li><a href="#">Book Now</a></li>
      <li><a href="#">Payment</a></li>
      <li><a href="logout.php">Log out</a></li>
    </ul>
  </div>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <div class="container">
      <div class="booking-form-container">
        <h1>Booking</h1>
        <br>
        <fieldset style="border: solid">

          <div class="column">
          

            <div class="input-wrapper-0">
              <label> Select Service</label>
              <select name="service_type">
                <option value="laundry">Regular Laundry</option>
                <option value="dry_cleaning">Dry Cleaning</option>
              </select>
            </div>
            <div class="input-wrapper-0">
              <label> Pick-up timing</label>
              <select name="pickup_time">
                <option value="8AM-11AM">8AM-11AM</option>
                <option value="11AM-3PM">11AM-3PM</option>
                <option value="3PM-6PM">3PM-6PM</option>
              </select>
            </div>

            <div class="input-wrapper-0">
              <label>Select pick-up date:</label>
              <select name="pickup_date">
                <?php
                // Get tomorrow's date
                $tomorrow = new DateTime('tomorrow');

                // Loop to generate the next 5 days' dates
                for ($i = 0; $i < 5; $i++) {
                  // Create a new date object for each day
                  $date = clone $tomorrow;
                  $date->modify("+$i day");

                  // Format the date as "YYYY-MM-DD"
                  $formattedDate = $date->format("Y-m-d");

                  // Create an option element for the select box
                  echo "<option value='$formattedDate'>$formattedDate</option>";
                }
                ?>
              </select>
            </div>

            <div class="input-wrapper-0">
              <label> Drop off timing</label>
              <select name="dropoff_time">
                <option value="8AM-11AM">8AM-11AM</option>
                <option value="11AM-3PM">11AM-3PM</option>
                <option value="3PM-6PM">3PM-6PM</option>
              </select>
            </div>

            <?php
            $select = "SELECT * from item";
            $result_query = mysqli_query($conn, $select);
            while ($row = mysqli_fetch_assoc($result_query)) {
              $item_id = $row['item_id'];
              $item_name = $row['item_name'];
              $laundry = $row['laundry'];
              $dry_cleaning = $row['dry_cleaning'];
              echo "<div class='input-wrapper'>
                <label>$item_name</label><input type='number' placeholder='Quantity' name='$item_name'/>
                Laundry $laundry per piece, Dry cleaning $dry_cleaning per piece.
                </div>";
            }
            ?>
            
    

            <input type="submit" value="book" name="submit" class="submit">
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