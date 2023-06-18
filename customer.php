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
        $conn=mysqli_connect('localhost','root','','sixthsem');
        $sql="SELECT * FROM customer where customer_username = '$a'";
        $res = mysqli_query($conn, $sql);
        $data = [];
        if (mysqli_num_rows($res)> 0){
        while ($row = mysqli_fetch_assoc($res)){
          array_unshift($data, $row);
        }
        }
        ?>


          <table border="1" class="content-table">
            <?php 
            foreach($data as $d) {
              ?>
            <thead>
              <tr>
                    <th>Customer id</th>
                    <td><?php echo $d['customer_id']; ?></td>
                    </tr>
                    <tr>
                    <th>Full name</th>
                    <td><?php echo $d['customer_fullname']; ?></td>
                    </tr>
                    <tr>
                    <th>Username</th>
                    <td><?php echo $d['customer_username']; ?></td>
                    </tr>
                    <tr>
                    <th>Email</th>
                    <td><?php echo $d['customer_email']; ?></td>
                    </tr>
                    <tr>
                    <th>Address</th>
                    <td><?php echo $d['customer_address']; ?></td>
                    </tr>
                    <th>Contact</th>
                    <td><?php echo $d['customer_contact']; ?></td>
                    </tr>
                    
            </thead>
                <?php } ?>
          </table>

      </div>
    </div>
    
    <footer class="footer">
      <p>SAJHA LAUNDRY </p>
    </footer>
  </body>
</html>
