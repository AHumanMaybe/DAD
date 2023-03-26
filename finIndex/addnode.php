<?php

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $node_id = $_POST['node_id'];
    $node_key = $_POST['node_key'];
    $node_location = $_POST['location'];
    
    require_once('includes/functions.php');
    if(!isset($_POST['node_id']))
    {
        $error = 'Please enter an ID for the node!';
    }
    elseif(!isset($_POST['node_key']))
    {
        $error = 'Please enter a key for the node!';
    }
    elseif(!isset($_POST['location']))
    {
        $error = 'Please specify the node\'s location!';
    }
    else //no errors
    {
        require('includes/opendb.php');

        $create = $conn->prepare("INSERT INTO nodes (node_id, node_key, location) VALUES (?, ?, ?)");
        $create->bind_param("sss", $node_id, $node_key, $node_location);
        $create->execute();
        $create->close();

        require('includes/closedb.php');
    }
}

echo($newCode);

?>
