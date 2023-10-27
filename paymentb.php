<?php
session_start(); // Start the PHP session
error_log("Payment Failure page accessed", 0);
// Rest of your PHP code goes here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Payment Details</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Payment Details</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <td><?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : ''; ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?></td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td><?php echo isset($_GET['phone']) ? htmlspecialchars($_GET['phone']) : ''; ?></td>
                            </tr>
                            <tr>
                                <th>Event</th>
                                <td><?php echo isset($_GET['event']) ? htmlspecialchars($_GET['event']) : ''; ?></td>
                            </tr>
                            <tr>
                                <th>Amount</th>
                                <td><?php echo isset($_GET['amount']) ? htmlspecialchars($_GET['amount']) : ''; ?></td>
                            </tr>
                        </table>

                        <?php
                            // Generate a unique ID for the payment
                            $payment_id = uniqid();

                            // Store the generated pid in a session variable for later use
                            // $_SESSION['payment_pid'] = $pid;
                        ?>

                        <form action="https://uat.esewa.com.np/epay/main" method="POST">
                            <input value="<?php echo $_GET['amount']; ?>" name="tAmt" type="hidden">
                            <input value="<?php echo $_GET['amount']; ?>" name="amt" type="hidden">
                            <input value="0" name="txAmt" type="hidden">
                            <input value="0" name="psc" type="hidden">
                            <input value="0" name="pdc" type="hidden">
                            <input value="EPAYTEST" name="scd" type="hidden">
                            <input value="<?php echo $payment_id; ?>" name="pid" type="hidden">
                            <input value="http://localhost:3000/sixthsemproject/sajhalaundry/paymentsuccess.php" type="hidden" name="su">
                            <input value="http://localhost/sixthsemproject/sajhalaundry/payment_failure.php" type="hidden" name="fu">
                            <input value="Submit" type="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>