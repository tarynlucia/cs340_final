<?php
	session_start();	
// Include config file
	require_once "config.php";
 
// Define variables and initialize with empty values
// Note: You can not update SSN 
$Group_name = $Big_ID = "";
$Group_name_err = $Big_ID_err = "" ;
// Form default values

if(isset($_GET["Group_number"]) && !empty(trim($_GET["Group_number"]))){
	$_SESSION["Group_number"] = $_GET["Group_number"];

    // Prepare a select statement
    $sql1 = "SELECT * FROM Big_Little_Group WHERE Group_number = ?";
  
    if($stmt1 = mysqli_prepare($link, $sql1)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt1, "i", $param_Group_number);      
        // Set parameters
       $param_Group_number = trim($_GET["Group_number"]);

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt1)){
            $result1 = mysqli_stmt_get_result($stmt1);
			if(mysqli_num_rows($result1) > 0){

				$row = mysqli_fetch_array($result1);

				$Group_name = $row['Group_name'];
				$Big_ID = $row['Big_ID'];
			}
		}
	}
}
 
// Post information about the employee when the form is submitted
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // the id is hidden and can not be changed
    $Group_number = $_SESSION["Group_number"];
    // Validate form data this is similar to the create Employee file
    // Validate name
    $Group_name = trim($_POST["Group_name"]);
    if(empty($Group_name)){
        $Group_name_err = "Please enter a group name.";
    } else if(!filter_var($Group_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $Group_name_err = "Please enter a valid group name.";
    }  

    // Validate Address
    $Big_ID = trim($_POST["Big_ID"]);
    if(empty($Big_ID)){
        $Big_ID_err = "Please enter big's ID.";     
    } else if(!ctype_digit($Big_ID)){
        $Big_ID_err = "Please enter a valid Big ID.";
    } 

    // Check input errors before inserting into database
    if(empty($Group_name_err) && empty($Big_ID_err)){
        // Prepare an update statement
        $sql = "UPDATE Big_Little_Group SET Group_name=?, Big_ID=? WHERE Group_number=?";
    
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sii", $param_Group_name, $param_Big_ID, $param_Group_number);
            
            // Set parameters
            $param_Group_name = $Group_name;
			$param_Big_ID = $Big_ID;
            $param_Group_number = $Group_number;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: big_little_groups.php");
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

    // Check existence of sID parameter before processing further
	// Form default values

	if(isset($_GET["Group_number"]) && !empty(trim($_GET["Group_number"]))){
		$_SESSION["Group_number"] = $_GET["Group_number"];

		// Prepare a select statement
		$sql1 = "SELECT * FROM Big_Little_Group WHERE Group_number = ?";
  
		if($stmt1 = mysqli_prepare($link, $sql1)){
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt1, "i", $param_Group_number);      
			// Set parameters
			$param_Group_number = trim($_GET["Group_number"]);

			// Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt1)){
				$result1 = mysqli_stmt_get_result($stmt1);
				if(mysqli_num_rows($result1) == 1){

					$row = mysqli_fetch_array($result1);

					$Group_name = $row['Group_name'];
					$Big_ID = $row['Big_ID'];
				} else{
					// URL doesn't contain valid id. Redirect to error page
					header("location: error.php");
					exit();
				}                
			} else{
				echo "Error in Group Number while updating";
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
    <title>SASE Big/Little Program</title>
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
                        <h3>Update Record for Group =  <?php echo $_GET["Group_number"]; ?> </H3>
                    </div>
                    <p>Please edit the input values and submit to update.
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
						<div class="form-group <?php echo (!empty($Group_name_err)) ? 'has-error' : ''; ?>">
                            <label>Group Name</label>
                            <input type="text" name="Group_name" class="form-control" value="<?php echo $Group_name; ?>">
                            <span class="help-block"><?php echo $Group_name_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($Big_ID_err)) ? 'has-error' : ''; ?>">
                            <label>Big ID</label>
                            <input type="text" name="Big_ID" class="form-control" value="<?php echo $Big_ID; ?>">
                            <span class="help-block"><?php echo $Big_ID_err;?></span>
                        </div>					
                        <input type="hidden" name="Group_number" value="<?php echo $Group_number; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="big_little_groups.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>