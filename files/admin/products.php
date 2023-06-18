<!-- customer details for admin -->
<?php
session_start(); 
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
      <h2> <img src="logo.png" class="logo"> <pre>  Sajha Laundry</pre></h2>
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

   

<?php 
$conn=mysqli_connect('localhost','root','','sixthsem');
$sql="INSERT INTO ITEM";
$res = mysqli_query($conn, $sql);
$data = [];
if (mysqli_num_rows($res)> 0){
while ($row = mysqli_fetch_assoc($res)){
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
<br><br><br><br><br><br><br>

<h2>Customer Details</h2>
<br><br>
	<table class="content-table" >
		<thead>
			<tr>
			<th>Customer ID</th>
            
            <th>Full name</th>
          
            <th>Username</th>
        
            <th>Email</th>
        
            <th>Address</th>
      
            <th>Contact</th>

            <!-- <th>Action</th> -->
            
            </tr>
            
		</thead>
        
		<?php 
		foreach($data as $d) {
			?>
			<tbody>
				<tr>
					<td><?php echo $d['customer_id']; ?></td>
					<td><?php echo $d['customer_fullname']; ?></td>
                    <td><?php echo $d['customer_username']; ?></td>
					<td><?php echo $d['customer_email']; ?></td>
                    <td><?php echo $d['customer_address']; ?></td>
                    <td><?php echo $d['customer_contact']; ?></td>
                    
				
				
					<!-- <td>
						 <a href="cd_edit.php?id=<?php echo $d['customer_id'] ?>">Edit</a>
						<a href="cd_edit.php?id=<?php echo $d['customer_id']?>"onclick="return confirm('are you sure to delete??')">delete</a>
                        </td> -->

				
				</tr>
			</tbody>
		
        

		 <?php } ?>
	</table>

</body>
</html>
	</div>

      </div>
    </div>
  <!-- </div> -->


</body>
</html>