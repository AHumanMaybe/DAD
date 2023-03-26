<!DOCTYPE html>
<html>
  <head>
    <title>DAD</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <style>
      body,
      h1 {
        font-family: "Raleway", sans-serif;
        color: black;
        text-shadow: 10px, 10px, black;
      }

      body,
      html {
        height: 100%
      }

      .bgimg {
        background-image: url('thumbo6.jpg');
        min-height: 100%;
        background-position: center;
        background-size: cover;
      }
    </style>
  </head>
  <body>
    <div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
      <div class="w3-display-topleft w3-padding-large w3-xlarge"> Logo </div>
      <div class="w3-display-middle">
        <h1 class="w3-jumbo w3-animate-top" id="detection"></h1>

        <table width="100%" border="0">    
  <tbody>
    <tr>
      <td>Node ID</td>
      <td>Node Key</td>
	  <td>Location</td>
      <td>Detections</td>
    </tr>
    <?php 
    //database list all detection events
    require('includes/opendb.php');

    //get all detection events 
    $detectionArr = $conn->prepare("SELECT * FROM nodes");
    $detectionArr->execute();
    $result = $detectionArr->get_result();
    $detectionArr->close();
    
    foreach($result->fetch_all() as $dbReq)
    {
        
        $detCount = $conn->prepare("SELECT * FROM nodes WHERE node_id = ?");
        $detCount->bind_param("s", $refCode);
        $detCount->execute();
        $detCount->store_result();
        $rowCount = $detCount->num_rows;
        $detCount->close();
        
        $node_id = $dbReq[0];
        $node_key = $dbReq[1];
        $location = $dbReq[2];
    ?>
        <tr>
          <td><?php echo($node_id); ?></td>
          <td><?php echo($node_key); ?></td>
	      <td><?php echo($location); ?></td>
          <td> <?php echo($rowCount); ?> </td>
        </tr>
    <?php
    } 
    require('includes/closedb.php');
    ?>
  </tbody>

		  </table>

      </div>
    </div>
  </body>
</html>