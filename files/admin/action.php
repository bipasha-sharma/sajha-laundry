<?php 
    include 'dbconn.php';
    $output='';

    if(isset($_POST['query'])){
        $search= $_POST['query']; //the input from the search is stored in search variable
        $stmt= $conn ->prepare("SELECT * from CUSTOMER WHERE customer_username like concat('%',?,'%') OR customer_fullname like concat('%',?,'%') OR customer_id like concat('%',?,'%')");
        $stmt-> bind_param("ssi",$search,$search,$search);
    }
    else{
        $stmt=$conn->prepare("SELECT * FROM CUSTOMER");
    }
    $stmt->execute();
    $result = $stmt->get_result();

    if($result -> num_rows>0){
        $output = "<thead>
        <tr>
        <th>Customer ID</th>
        
        <th>Full name</th>
      
        <th>Username</th>
    
        <th>Email</th>
    
        <th>Address</th>
  
        <th>Contact</th>

        
        
        </tr>
        
    </thead>
    <tbody>";
    while($row=$result->fetch_assoc()){
       $output.= "
       <tr>
			<td>".$row['customer_id']."</td>
			<td>".$row['customer_fullname']." </td>
            <td>".$row['customer_username']."</td>
			<td>".$row['customer_email']." </td>
            <td>".$row['customer_address']."</td>
            <td>".$row['customer_contact']."</td>
				
		</tr>"; 
    }
        $output.="</tbody>";
        echo $output;
    }
    else{
        echo "<h3> No Match Found </h3>";
    }
?>