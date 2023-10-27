<?php 
    include 'dbconn.php';
    $output='';

    if(isset($_POST['query'])){
        $search= $_POST['query']; //the input from the search is stored in search variable
        $stmt= $conn ->prepare("SELECT * from Orders WHERE order_id like concat('%',?,'%') OR customer_id like concat('%',?,'%')");
        $stmt-> bind_param("ii",$search,$search);
    }
    else{
        $stmt=$conn->prepare("SELECT * FROM Orders");
    }
    $stmt->execute();
    $result = $stmt->get_result();

    if($result -> num_rows>0){
        $output = "<thead>
        <tr>
            <th>Order Id</th>

            <th>Order Date</th>

            <th>Pickup Date</th>

            <th>Pickup Time</th>

            <th>Drop off Time</th>

            <th>Order Status</th>

            <th>Service Type</th>

            <th>Customer Id</th>

            <th>Action</th>
        </tr>
        
    </thead>
    <tbody>";
    while($row=$result->fetch_assoc()){
       $output.= "
       <tr>
			<td>".$row['order_id']."</td>
			<td>".$row['order_date']." </td>
            <td>".$row['pickup_date']."</td>
			<td>".$row['pickup_time']." </td>
            <td>".$row['dropoff_time']."</td>
            <td>".$row['order_status']."</td>
            <td>".$row['service_type']."</td>
            <td>".$row['customer_id']."</td>
            <td><a href=viewcus.php?id=<?php echo ".$row['customer_id']." ?>View Details</a></td>	
		</tr>"; 
    }
        $output.="</tbody>";
        echo $output;
    }
    else{
        echo "<h3> No Match Found </h3>";
    }
?>