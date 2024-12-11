<?php
	session_start();	
// Include config file
	require_once "config.php";
 
// Define variables and initialize with empty values
$Fname = $Lname = $Year = $Major = $Group_number = "";
$Fname_err = $Lname_err = $Year_err = $Major_err = $Group_number_err = "";
// Form default values

if(isset($_GET["OSU_ID"]) && !empty(trim($_GET["OSU_ID"]))){
	$_SESSION["OSU_ID"] = $_GET["OSU_ID"];

    // Prepare a select statement
    $sql1 = "SELECT * FROM Members WHERE OSU_ID = ?";
  
    if($stmt1 = mysqli_prepare($link, $sql1)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt1, "i", $param_OSU_ID);      
        // Set parameters
       $param_OSU_ID = trim($_GET["OSU_ID"]);

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt1)){
            $result1 = mysqli_stmt_get_result($stmt1);
			if(mysqli_num_rows($result1) > 0){

				$row = mysqli_fetch_array($result1);

                $Fname = $row['Fname'];
				$Lname = $row['Lname'];
				$Year = $row['Year'];
				$Major = $row['Major'];
				$Group_number = $row['Group_number'];
			}
		}
	}
}
 
// Post information about the employee when the form is submitted
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // the id is hidden and can not be changed
    $OSU_ID = $_SESSION["OSU_ID"];
    // Validate name
    $Fname = trim($_POST["Fname"]);

    if(empty($Fname)){
        $Fname_err = "Please enter a first name.";
    } elseif(!filter_var($Fname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $Fname_err = "Please enter a valid first name.";
    } 
    $Lname = trim($_POST["Lname"]);
    if(empty($Lname)){
        $Lname_err = "Please enter a last name.";
    } elseif(!filter_var($Lname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $Lname_err = "Please enter a valid last name.";
    }  
    // Validate Year
    $Year = trim($_POST["Year"]);
    if(empty($Year)){
        $Year_err = "Please enter a Year.";     
    }
	
	// Validate Major
    $Major = trim($_POST["Major"]);
    if(empty($Major)){
        $Major_err = "Please enter a Major.";    	
	}
	
    $Group_number = trim($_POST["Group_number"]);
    if(empty($Group_number)){
        $Group_number = null;
    }

    // Check input errors before inserting into database
    if(empty($Fname_err) && empty($Lname_err) && empty($Year_err) && empty($Major_err)){
        // Prepare an update statement
        $sql = "UPDATE Members SET Fname=?, Lname=?, Year=?, Major = ?, Group_number = ? WHERE OSU_ID=?";
    
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssisii", $param_Fname, $param_Lname, $param_Year, $param_Major, $param_Group_number, $param_OSU_ID);
            
            // Set parameters
            $param_Fname = $Fname;
			$param_Lname = $Lname;            
			$param_Year = $Year;
            $param_Major = $Major;
            $param_Group_number = $Group_number;
            $param_OSU_ID = $OSU_ID;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
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

	if(isset($_GET["OSU_ID"]) && !empty(trim($_GET["OSU_ID"]))){
		$_SESSION["OSU_ID"] = $_GET["OSU_ID"];

		// Prepare a select statement
		$sql1 = "SELECT * FROM Members WHERE OSU_ID = ?";
  
		if($stmt1 = mysqli_prepare($link, $sql1)){
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt1, "i", $param_OSU_ID);      
			// Set parameters
			$param_OSU_ID = trim($_GET["OSU_ID"]);

			// Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt1)){
				$result1 = mysqli_stmt_get_result($stmt1);
				if(mysqli_num_rows($result1) == 1){

					$row = mysqli_fetch_array($result1);

                    $Fname = $row['Fname'];
					$Lname = $row['Lname'];
					$Year = $row['Year'];
					$Major = $row['Major'];
					$Group_number = $row['Group_number'];
				} else{
					// URL doesn't contain valid id. Redirect to error page
					header("location: error.php");
					exit();
				}                
			} else{
				echo "Error in SSN while updating";
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
    <title>Update Member</title>
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
                        <h3>Update Record for OSU_ID =  <?php echo $_GET["OSU_ID"]; ?> </H3>
                    </div>
                    <p>Please edit the input values and submit to update.
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
						<div class="form-group <?php echo (!empty($Fname_err)) ? 'has-error' : ''; ?>">
                            <label>First Name</label>
                            <input type="text" name="Fname" class="form-control" value="<?php echo $Fname; ?>">
                            <span class="help-block"><?php echo $Fname_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($Lname_err)) ? 'has-error' : ''; ?>">
                            <label>Last Name</label>
                            <input type="text" name="Lname" class="form-control" value="<?php echo $Lname; ?>">
                            <span class="help-block"><?php echo $Lname_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($Year_err)) ? 'has-error' : ''; ?>">
                            <label>Year</label>
                            <input type="text" name="Year" class="form-control" value="<?php echo $Year; ?>">
                            <span class="help-block"><?php echo $Year_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($Major_err)) ? 'has-error' : ''; ?>">
                            <label>Major</label>
                            <input type="text" name="Major" class="form-control" value="<?php echo $Major; ?>">
                            <span class="help-block"><?php echo $Major_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($Group_number_err)) ? 'has-error' : ''; ?>">
                            <label>Group Number</label>
                            <input type="number" min="1" max="20" name="Group_number" class="form-control" value="<?php echo $Group_number; ?>">
                            <span class="help-block"><?php echo $Group_number_err;?></span>
                        </div>						
                        <input type="hidden" name="OSU_ID" value="<?php echo $OSU_ID; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>