<?php

require('includes/opendb.php');

if(isset($_POST['node_id']) && isset($_POST['node_key']) && isset($_POST['detection']) === true)
{
    $node_id = $_POST['node_id'];
    $node_key = $_POST['node_key'];
    $detection = $_POST['detection'];
    
    //verify node identity
    $nodeCheck = $conn->prepare("SELECT * FROM nodes WHERE node_id = ? AND node_key = ?");
    $nodeCheck->bind_param("ss", $node_id, $node_key);
    $nodeCheck->execute();
    $nodeCheck->store_result();
    $nodeCount = $nodeCheck->num_rows;
    $nodeCheck->close();

    //end if no matching found
    if($nodeCount != 1)
    {
        echo("Invalid node!");
        exit();
    }
    
    //if node identity good

    $time = time();

    //get location
    $getLocation = $conn->prepare("SELECT * FROM nodes WHERE node_id = ? LIMIT 1");
    $getLocation->bind_param("s", $node_id);
    $getLocation->execute();
    $result = $getLocation->get_result()->fetch_assoc();
    $getLocation->close();

    $location = $result['location'];

    //insert into database
    $send = $conn->prepare("INSERT INTO detections (node_id, detection, location, time) VALUES (?, ?, ?, ?)");
    $send->bind_param("sisi", $node_id, $detection, $location, $time);
    $send->execute();
    $send->close();

    //make notification
}
?>