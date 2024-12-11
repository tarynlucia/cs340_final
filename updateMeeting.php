<?php
	session_start();	
// Include config file
	require_once "config.php";
 
// Define variables and initialize with empty values
$Event_name = $Date = $Location = "";
$Event_name_err = $Date_err = $Location_err = "" ;
// Form default values

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
			if(mysqli_num_rows($result1) > 0){

				$row = mysqli_fetch_array($result1);

				$Event_name = $row['Event_name'];
				$Date = $row['Date'];
				$Location = $row['Location'];
			}
		}
	}
}
 
// Post information about the employee when the form is submitted
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // the id is hidden and can not be changed
    $Event_number = $_SESSION["Event_number"];
    // Validate Event_name
    $Event_name = trim($_POST["Event_name"]);
    if(empty($Event_name)){
        $Event_name_err = "Please enter an Event_name.";     
    }
    // Validate Date
    $Date = trim($_POST["Date"]);
    if(empty($Date)){
        $Date_err = "Please enter a Date.";     
    }	
    // Validate Location
    $Location = trim($_POST["Location"]);
    if(empty($Location)){
        $Location_err = "Please enter a Location.";     
    }

    // Check input errors before inserting into database
    if(empty($Event_name_err) && empty($Date_err) && empty($Location_err)){
        // Prepare an update statement
        $sql = "UPDATE Meetings SET Event_name=?, Date=?, Location=? WHERE Event_number=?";
    
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_Event_name, $param_Date,$param_Location, $param_Event_number);
            
            // Set parameters
            $param_Event_name = $Event_name;
			$param_Date = $Date;            
			$param_Location = $Location;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: meetings.php");
                exit();
            } else{
                echo "<center><h2>Error when updating</center></h2>";
            }
        }        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else {
	// Form default values

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

					$Event_name = $row['Event_name'];
					$Date = $row['Date'];
					$Location = $row['Location'];
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
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
						<div class="form-group <?php echo (!empty($FEvent_name_err)) ? 'has-error' : ''; ?>">
                            <label>Event_name</label>
                            <input type="text" name="Event_name" class="form-control" value="<?php echo $Event_name; ?>">
                            <span class="help-block"><?php echo $Event_name_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($Date_err)) ? 'has-error' : ''; ?>">
                            <label>Date</label>
                            <input type="date" name="Date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                            <span class="help-block"><?php echo $Date_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($Location_err)) ? 'has-error' : ''; ?>">
                            <label>Location</label>
                            <input type="text" name="Location" class="form-control" value="<?php echo $Location; ?>">
                            <span class="help-block"><?php echo $Location_err;?></span>
                        </div>
                        <input type="hidden" name="Event_number" value="<?php echo $Event_number; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="meetings.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>