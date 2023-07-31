<!-- customer details for admin -->
<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'sixthsem') or die("unable to connect");


if (isset($_POST['submit'])) {
    $item_name = $_POST['item_name'];
    $laundry = $_POST['laundry'];
    $dry_cleaning = $_POST['dry_cleaning'];
    $stmt = $conn->prepare("INSERT INTO item (item_name,laundry,dry_cleaning,admin_id) VALUES(?,?,?,1)");
    $stmt->bind_param("sdd", $item_name, $laundry, $dry_cleaning);
    $stmt->execute();
    echo '<script> alert("Product added !") </script>';
    $stmt->close();
    $conn->close();
    header("Location: products.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>user login</title>
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
            <li><a href="#">Order Details</a></li>
            <li><a href="#">Payment Details</a></li>
            <li><a href="adminlogout.php">Log out</a></li>
        </ul>
    </div>


    <h2>Add Products</h2>
    <br><br>
    <table class="content-table">
        <thead>
            <tr>

                <th>Item Name</th>

                <th>Regular Laundry Rate</th>

                <th>Dry Cleaning Rate</th>

                <!-- <th>Action</th> -->

            </tr>

        </thead>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">

            <tbody>
                <tr>
                    <td><input type="text" placeholder="Enter item name" name="item_name" /></td>
                    <td><input type="number" placeholder="Enter laundry rate" name="laundry" /></td>
                    <td><input type="number" placeholder="Enter dry cleaning rate" name="dry_cleaning" /></td>
                </tr>
            </tbody>




    </table>
    <input class="submit" type="submit" value="submit" name="submit">
</body>
</html>