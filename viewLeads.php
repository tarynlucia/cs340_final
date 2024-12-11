<?php
	session_start();
    // Include config file
    require_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Leads</title>
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
                        <h2 class="pull-left">View Leads</h2>
                    </div>
<?php

// Check existence of id parameter before processing further
if(isset($_GET["Event_number"]) && !empty(trim($_GET["Event_number"]))){
	$_SESSION["Event_number"] = $_GET["Event_number"];
    $Event_number = $_SESSION["Event_number"];
    echo "<a href='updateLeads.php?Event_number=$Event_number' class='btn btn-success pull-right'>Update Leads</a>";
}

if(isset($_SESSION["Event_number"]) ){
	
	
    // Prepare a select statement
    $sql = "SELECT M.Fname, M.Lname, L.OSU_ID FROM Leads L JOIN Members M ON L.OSU_ID = M.OSU_ID WHERE Event_number = ?";

  
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_Event_number);      
        // Set parameters
       $param_Event_number = $_SESSION["Event_number"];

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
			echo"<h4> Leads for Meeting #".$param_Event_number."</h4><p>";
            echo "<br>";
			if(mysqli_num_rows($result) > 0){
				echo "<table class='table table-bordered table-striped'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>OSU_ID </th>";
                            echo "<th>First Name</th>";
                            echo "<th>Last Name</th>";
                            echo "<th>Actions</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";							
				// output data of each row
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                        echo "<td>" . $row['OSU_ID'] . "</td>";
                        echo "<td>" . $row['Fname'] . "</td>";
						echo "<td>" . $row['Lname']."</td>";
                        echo "<td>";
                            echo "<a href='deleteLeads.php?OSU_ID=". $row['OSU_ID'] ."&Event_number=". $_SESSION["Event_number"] ."' title='Delete Leads' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                        echo "</td>";	
						echo "</tr>";
                    }
                    echo "</tbody>";                            
                echo "</table>";				
				mysqli_free_result($result);
			} else {
				echo "No Leads. ";
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
	<p><a href="meetings.php" class="btn btn-primary">Back</a></p>
    </div>
   </div>        
  </div>
</div>
</body>
</html>