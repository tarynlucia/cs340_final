<?php

// Names: Charissa Kau, Taryn Eng, Johnny Vo, Thien Tu

	session_start();	
// Include config file
	require_once "config.php";
 
// Define variables and initialize with empty values
// Note: You can not update SSN 
$OSU_ID = "";
$OSU_ID_err = "" ;
// Form default values

if(isset($_GET["Event_number"]) && !empty(trim($_GET["Event_number"]))){
	$_SESSION["Event_number"] = $_GET["Event_number"];
    $Event_number = $_SESSION["Event_number"];

    // Prepare a select statement
    $sql1 = "SELECT * FROM Attends WHERE Event_number = ?";
  
    if($stmt1 = mysqli_prepare($link, $sql1)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt1, "i", $param_Event_number);      
        // Set parameters
       $param_Event_number = trim($_GET["Event_number"]);

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt1)){
            $result1 = mysqli_stmt_get_result($stmt1);
			if(mysqli_num_rows($result1) > 0){

				$row = mysqli_fetch_array($result1);

				$OSU_ID = $row['OSU_ID'];
			}
		}
	}
}
 
// Post information about the employee when the form is submitted
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // the id is hidden and can not be changed
    $Event_number = $_SESSION["Event_number"];
    // Validate form data this is similar to the create Employee file
    // Validate OSU_ID
    $OSU_ID = trim($_POST["OSU_ID"]);
    if(empty($OSU_ID)){
        $OSU_ID_err = "Please enter OSU_ID.";     
    }

    // Check input errors before inserting into database
    if(empty($OSU_ID_err)){
        // Prepare an update statement
        $sql = "INSERT INTO Attends (Event_number, OSU_ID)
                VALUES ($Event_number, ?)";
    
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_OSU_ID);
            
            // Set parameters
            $param_OSU_ID = $OSU_ID;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: viewAttendees.php?Event_number=$Event_number");
                exit();
            } else{
                echo "<center><h2>Error when updating</center></h2>";
                echo "<center><h3>MySQL Error: " . mysqli_error($link) . "</h5></center>";
            }
        }        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else {

	if(isset($_GET["Event_number"]) && !empty(trim($_GET["Event_number"]))){
		$_SESSION["Event_number"] = $_GET["Event_number"];

		// Prepare a select statement
		$sql1 = "SELECT * FROM Meetings WHERE Event_number = ?";
  
		if($stmt1 = mysqli_prepare($link, $sql1)){
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt1, "i", $param_Event_number);      
			// Set parameters
			$param_Event_number = trim($_GET["Event_number"]);

			// Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt1)){
				$result1 = mysqli_stmt_get_result($stmt1);
				if(mysqli_num_rows($result1) == 1){

					$row = mysqli_fetch_array($result1);

					$OSU_ID = $row['OSU_ID'];
				} else{
					// URL doesn't contain valid id. Redirect to error page
					header("location: error.php");
					exit();
				}                
			} else{
				echo "Error in Event_number while updating";
			}		
		}
			// Close statement
			mysqli_stmt_close($stmt1);
        
			// Close connection
			mysqli_close($link);
	}  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
	}	
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Meeting</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h3>Update Record for Event #<?php echo $_GET["Event_number"]; ?> </H3>
                    </div>
                    <p>Please edit the input values and submit to update.
                    <form action="updateAttendees.php?Event_number=<?php echo $Event_number; ?>" method="post">
                        <div class="form-group <?php echo (!empty($OSU_ID_err)) ? 'has-error' : ''; ?>">
                            <label>OSU_ID</label>
                            <input type="number" name="OSU_ID" class="form-control" value="<?php echo $OSU_ID; ?>">
                            <span class="help-block"><?php echo $OSU_ID_err;?></span>
                        </div>
                        <input type="hidden" name="Event_number" value="<?php echo $Event_number; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="viewAttendees.php?Event_number=<?php echo $Event_number ?>" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>