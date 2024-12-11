<?php

// Names: Charissa Kau, Taryn Eng, Johnny Vo, Thien Tu

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$Event_number = $Event_name = $Date = $Location = "";
$Event_number_err = $Event_name_err = $Date_err = $Location_err = "" ;
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate Event_number
    $Event_number = trim($_POST["Event_number"]);
    if(empty($Event_number)){
        $Event_number_err = "Please enter Event_number.";     
    } elseif(!ctype_digit($Event_number)){
        $Event_number_err = "Please enter a positive integer value of Event_number.";
    } 
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

    // Check input errors before inserting in database
    if(empty($Event_number_err) && empty($Event_name_err) && empty($Date_err) && empty($Location_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO Meetings (Event_number, Event_name, Date, Location) 
		        VALUES (?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "isss", $param_Event_number, $param_Event_name, $param_Date, 
				$param_Location);
            
            // Set parameters
			$param_Event_number = $Event_number;
            $param_Event_name = $Event_name;
			$param_Date = $Date;
			$param_Location = $Location;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
				    header("location: meetings.php");
					exit();
            } else{
                echo "<center><h4>Error while creating new meeting</h4></center>";
				$Event_number_err = "Enter a unique Event_number.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add a Meeting record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group <?php echo (!empty($Event_number_err)) ? 'has-error' : ''; ?>">
                            <label>Event_number</label>
                            <input type="text" name="Event_number" class="form-control" value="<?php echo $Event_number; ?>">
                            <span class="help-block"><?php echo $Event_number_err;?></span>
                        </div>
                 
						<div class="form-group <?php echo (!empty($Event_name_err)) ? 'has-error' : ''; ?>">
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
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="meetings.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>