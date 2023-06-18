<!DOCTYPE html>
<html>
<head>
    <title>Place Order</title>
    <style>
        .error {
            color: red;
        }
        .form-columns {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .form-column {
            width: calc(50% - 10px);
        }
        .form-column label {
            display: block;
            margin-bottom: 5px;
        }
        .form-column input,
        .form-column select {
            width: 100%;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Place Order</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-columns">
            <div class="form-column">
                <label for="customer_name">Customer Name:</label>
                <input type="text" name="customer_name" required>
            </div>
            <div class="form-column">
                <label for="phone_number">Phone Number:</label>
                <input type="text" name="phone_number" required>
            </div>
            <div class="form-column">
                <label for="pickup_date">Pickup Date:</label>
                <input type="date" name="pickup_date" required>
            </div>
            <div class="form-column">
                <label for="delivery_date">Delivery Date:</label>
                <input type="date" name="delivery_date" required>
            </div>
            <div class="form-column">
                <label for="service_type">Service Type:</label>
                <select name="service_type" required>
                    <option value="standard">Standard</option>
                    <option value="express">Express</option>
                    <option value="premium">Premium</option>
                </select>
            </div>
            <div class="form-column">
                <label for="additional_notes">Additional Notes:</label>
                <textarea name="additional_notes" rows="4" cols="50"></textarea>
            </div>
        </div>
        <input type="submit" value="Place Order">
    </form>
</body>
</html>