<!DOCTYPE html>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
</head>

<body>
    <div class="container">
        <h2>Employee Details</h2>
        <div class="row">
            <div class="col-md-10">
                <table width="100%" cellspacing="0" border="1">
                    <thead>
                        <tr>
                            <th> Item id</th>
                            <th> Item Name</th>
                            <th> laundry price</th>
                            <th> Dry cleaning price</th>
                        </tr>
                        <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'sixthsem');
                        if (isset($_GET['itemid'])) {
                            $item_id = mysqli_real_escape_string($conn, $_GET['itemid']);
                            $sql = "SELECT item_id, item_name, laundry, dry_cleaning
							FROM ITEM WHERE item_id = '$item_id'";
                            $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                            while ($rows = mysqli_fetch_assoc($resultset)) {
                        ?>
                                <tr>
                                    <td><?php echo $rows['item_id']; ?></td>
                                    <td><?php echo $rows['item_name']; ?></td>
                                    <td><?php echo $rows['laundry']; ?></td>
                                    <td><?php echo $rows['dry_cleaning']; ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>

</html>