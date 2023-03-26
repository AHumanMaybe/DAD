<!DOCTYPE html>
<html>
  <head>
    <title>DAD</title>
    <link width="16" height="25" href="Favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <style>
      body {
       
        font-family: "Raleway", sans-serif;
        font-size: 2vw;
        
 
      }
      tbody {
        margin-top: 250px;
        
        
       
      }
      td {
        font-family: "Raleway", sans-serif;
        font-size: 2vw;
        color: black;
        
        text-align: center; padding-left: 50px; padding-right: 50px;
        
        
      }

      body, html {height: 100%}
      .bgimg {
        background-image: url('background2.png');
        min-height: 100%;
        background-position: center;
        background-size: contain;
      }
      .bgimg {
        background-image: url('background2.png');
        min-height: 100%;
        background-position: center;
        background-size: cover;
      }
    </style>
  </head>
  <body>
    
    <div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
    <div class="w3-display-topleft w3-padding-large w3-xlarge"> <img src="Logo.png" width="80" height="45"> </div>
      
       
    <div>
        
        <table>    
    <tbody class="w3-display-middle">
    <div style="font-size: 5vw; " class="w3-display-middle">Gunshot Detections</div>
    <tr>
      <td>Node</td>
      <td>Location</td>
      <td>Time</td>
    </tr>
     <!--put whatever time-->

    <!--php below-->
    <?php

      //database list all detection events
      require('includes/opendb.php');
    
      //get all detection events 
      $detectState = 1;
      $detectionArr = $conn->prepare("SELECT * FROM detections WHERE detection = ?");
      $detectionArr->bind_param("s", $detectState);
      $detectionArr->execute();
      $result = $detectionArr->get_result();
      $detectionArr->close();
          
      //loop through all recorded events and print
      foreach($result->fetch_all() as $dbReq)
      {
         $node_id = $dbReq[0];
         $location = $dbReq[2];
         $time = $dbReq[3];
      ?>
         <tr>
            <td><?php echo($node_id); ?></td>
            <td><?php echo($location); ?></td>
            <td><?php echo(date("Y-m-d h:i:sa",$time)); ?></td>
          </tr>
      <?php
      } 
      require('includes/closedb.php');
      ?>
          
    <!--php above-->
    </tbody>

		  </table>

      </div>
    </div>
  </body>
</html>