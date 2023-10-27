<!-- customer details for admin -->
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
    // $conn = mysqli_connect('localhost', 'root', '', 'sixthsem');
    include 'dbconn.php';
    $sql = "SELECT * FROM ITEM";
    $res = mysqli_query($conn, $sql);
    $data = [];
    if (mysqli_num_rows($res) > 0) {
      while ($row = mysqli_fetch_assoc($res)) {
        array_unshift($data, $row);
      }
    }

    ?>
    <!DOCTYPE html>
    <html>

    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style.css">
    </head>

    <body>
      <br><br>
      
      <div class="btnadd">
        <input type="submit" value="Add Products" class="submit" onClick="redirectToPage()">

        <script>
          function redirectToPage() {
            // Redirect to the desired page
            window.location.href = 'addproduct.php';
          }
        </script>
      </div>


      <div class="how-it-works">
      <div class= "container">
        <h2>Product Details</h2>
        <br><br>
        <table class="content-table">
          <thead>
            <tr>
              <th>Item ID</th>

              <th>Item Name</th>

              <th>Laundry Price</th>

              <th>Dry Cleaning Price</th>

              <th>Action</th>

            </tr>

          </thead>

          <?php
          foreach ($data as $d) {
          ?>
            <tbody>
              <tr>
                <td><?php echo $d['item_id']; ?></td>
                <td><?php echo $d['item_name']; ?></td>
                <td><?php echo $d['laundry']; ?></td>
                <td><?php echo $d['dry_cleaning']; ?></td>



                <td>
                  <a href="product_edit.php?id=<?php echo $d['item_id'] ?>">Edit</a>
                  <a href="product_delete.php?id=<?php echo $d['item_id'] ?>" onclick="return confirm('are you sure to delete??')">delete</a>
                </td>


              </tr>
            </tbody>



          <?php } ?>
        </table>
        <div>
        </div>

    </body>

    </html>

  <?php
  } else echo "<h1> Please login first </h1> ";
  ?>


</body>

</html>