<?php
	session_start();	
// Include config file
	require_once "config.php";
 
// Define variables and initialize with empty values
// Note: You can not update SSN 
$OSU_ID = "";
$OSU_ID_err = "" ;
// Form default values

if(isset($_GET["Group_number"]) && !empty(trim($_GET["Group_number"]))){
	$_SESSION["Group_number"] = $_GET["Group_number"];
    $Group_number = $_SESSION["Group_number"];
}

if(isset($_GET["OSU_ID"]) && !empty(trim($_GET["OSU_ID"]))){
	$_SESSION["OSU_ID"] = $_GET["OSU_ID"];
    $Group_number = $_SESSION["OSU_ID"];
}
 
// Post information about the employee when the form is submitted
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate form data this is similar to the create Employee file
    // Validate OSU_ID
    $OSU_ID = trim($_POST["OSU_ID"]);
    if(empty($OSU_ID)){
        $OSU_ID_err = "Please enter OSU_ID.";     
    }

    // Check input errors before inserting into database
    if(empty($OSU_ID_err)){
        // Prepare an update statement
        $sql = "UPDATE Members SET Group_number = NULL WHERE OSU_ID = ?";
    
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_OSU_ID);
            
            // Set parameters
            $param_OSU_ID = $OSU_ID;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: viewGroup.php?Group_number=<?php echo $Group_number ?>");
                exit();
            } else{
                echo "<center><h2>Error when deleting</center></h2>";
                echo "<center><h3>MySQL Error: " . mysqli_error($link) . "</h5></center>";
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
    <title>Delete Record</title>
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
                        <h1>Delete Little</h1>
                    </div>
                    <!-- <p>Please edit the input values and submit to update. -->
                    <!-- <form action="createLittle.php?Group_number=<?php echo $Group_number; ?>" method="post">
                        <div class="form-group <?php echo (!empty($OSU_ID_err)) ? 'has-error' : ''; ?>">
                            <label>OSU_ID</label>
                            <input type="number" name="OSU_ID" class="form-control" value="<?php echo $OSU_ID; ?>">
                            <span class="help-block"><?php echo $OSU_ID_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="viewGroup.php?Group_number=<?php echo $Group_number ?>" class="btn btn-default">Cancel</a>
                    </form> -->


                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="Group_number" value="<?php echo htmlspecialchars($_SESSION["Group_number"]); ?>"/>
                            <p>Are you sure you want to delete the record for <?php echo htmlspecialchars($_SESSION["OSU_ID"]); ?>?</p><br>
                            <input type="submit" value="Yes" class="btn btn-danger">
                            <a href="viewGroup.php?Group_number=<?php echo $Group_number ?>" class="btn btn-default">No</a>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>