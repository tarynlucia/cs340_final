<?php

// Names: Charissa Kau, Taryn Eng, Johnny Vo, Thien Tu

	session_start();
    // Include config file
    require_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Meetings Attended</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
	   <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">View Meetings Attended</h2>
                    </div>
<?php

// Check existence of id parameter before processing further
if(isset($_GET["OSU_ID"]) && !empty(trim($_GET["OSU_ID"]))){
	$_SESSION["OSU_ID"] = $_GET["OSU_ID"];
    $OSU_ID = $_SESSION["OSU_ID"];
    echo "<a href='addAttendedMeeting.php?OSU_ID=" . $OSU_ID . "' class='btn btn-success pull-right'>Add Attended Meeting</a>";
}

if(isset($_SESSION["OSU_ID"]) ){
	
	
    // Prepare a select statement
    $sql = "SELECT *
            FROM Meetings
            JOIN Attends ON Meetings.Event_number = Attends.Event_number
            WHERE Attends.OSU_ID = ?
            ";

  
    if($stmt = mysqli_prepare($link, $sql)){  
        // Set parameters
       $param_OSU_ID = $_SESSION["OSU_ID"];

       // Bind variables to the prepared statement as parameters
       mysqli_stmt_bind_param($stmt, "i", $param_OSU_ID);    

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
			echo"<h4> Meetings Attended for OSU_ID = ".$param_OSU_ID."</h4><p>";
            echo "<br>";
			if(mysqli_num_rows($result) > 0){
				echo "<table class='table table-bordered table-striped'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>Event Number</th>";
                            echo "<th>Event Name</th>";
							echo "<th>Date</th>";
							echo "<th>Location</th>";
                            echo "<th>Actions</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";							
				// output data of each row
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                        echo "<td>" . $row['Event_number'] . "</td>";
                        echo "<td>" . $row['Event_name'] . "</td>";
						echo "<td>" . $row['Date']."</td>";
                        echo "<td>" . $row['Location'] . "</td>";
                        echo "<td>";
                            echo "<a href='deleteAttendedMeeting.php?OSU_ID=$OSU_ID&Event_number=". $row['Event_number'] ."' title='Delete Attended Meeting' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                        echo "</td>";
						echo "</tr>";
                    }
                    echo "</tbody>";                            
                echo "</table>";				
				mysqli_free_result($result);
			} else {
				echo "No Meetings Attended. ";
			}
//				mysqli_free_result($result);
        } else{
			// URL doesn't contain valid id parameter. Redirect to error page
            header("location: error.php");
            exit();
        }
    }     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>					                 					
	<p><a href="index.php" class="btn btn-primary">Back</a></p>
    </div>
   </div>        
  </div>
</div>
</body>
</html>