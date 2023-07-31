<?php
$conn = mysqli_connect('localhost', 'root', '', 'sixthsem');

// Check if 'query' parameter is set in the POST request
if (isset($_POST['query'])) {
    $query = $_POST['query'];

    // Use a prepared statement to prevent SQL injection
    $sql = "SELECT item_id, item_name as itemname, laundry, dry_cleaning 
            FROM ITEM
            WHERE item_name LIKE CONCAT('%', ?, '%') LIMIT 20";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $query);
    mysqli_stmt_execute($stmt);

    $resultset = mysqli_stmt_get_result($stmt);

    $array = array();
    while ($rows = mysqli_fetch_assoc($resultset)) {
        $array[] = array("itemname" => $rows['itemname'], "href" => "profile.php?itemid=" . $rows['item_id']);
    }

    echo json_encode($array);
} else {
    // Handle the case when 'query' parameter is not set
    echo json_encode(array('error' => 'No query parameter provided.'));
}
?>