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

if(isset($_GET["Group_number"]) && !empty(trim($_GET["Group_number"]))){
	$_SESSION["Group_number"] = $_GET["Group_number"];
    $Group_number = $_SESSION["Group_number"];
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate OSU_ID
    $OSU_ID = trim($_POST["OSU_ID"]);
    if (empty($OSU_ID)) {
        $OSU_ID_err = "Please enter OSU_ID.";
    } else {
        // Check if the OSU_ID is a member
        $member_check_sql = "SELECT 1 FROM Members WHERE OSU_ID = ?";
        if ($member_check_stmt = mysqli_prepare($link, $member_check_sql)) {
            mysqli_stmt_bind_param($member_check_stmt, "i", $param_OSU_ID);
            $param_OSU_ID = $OSU_ID;

            // Execute the query
            if (mysqli_stmt_execute($member_check_stmt)) {
                mysqli_stmt_store_result($member_check_stmt);
                if (mysqli_stmt_num_rows($member_check_stmt) == 0) {
                    $OSU_ID_err = "This OSU_ID is not a member.";
                }
            } else {
                echo "Error checking membership.";
            }
            mysqli_stmt_close($member_check_stmt);
        }

        // Check if the OSU_ID already exists in the group
        if (empty($OSU_ID_err)) { // Only proceed if no prior error
            $group_check_sql = "SELECT 1 FROM Members WHERE OSU_ID = ? AND Group_number = ?";
            if ($group_check_stmt = mysqli_prepare($link, $group_check_sql)) {
                mysqli_stmt_bind_param($group_check_stmt, "ii", $param_OSU_ID, $param_Group_number);
                $param_Group_number = $Group_number;

                // Execute the query
                if (mysqli_stmt_execute($group_check_stmt)) {
                    mysqli_stmt_store_result($group_check_stmt);
                    if (mysqli_stmt_num_rows($group_check_stmt) > 0) {
                        $OSU_ID_err = "This OSU_ID is already in the group.";
                    }
                } else {
                    echo "Error checking group membership.";
                }
                mysqli_stmt_close($group_check_stmt);
            }
        }
    }

    // Check input errors before inserting into database
    if(empty($OSU_ID_err)){
        // Prepare an update statement
        $sql = "UPDATE Members SET Group_number = $Group_number WHERE OSU_ID = ?";
    
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_OSU_ID);
            
            // Set parameters
            $param_OSU_ID = $OSU_ID;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: viewGroup.php?Group_number=$Group_number");
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
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Littles</title>
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
                        <h3>Add Littles to Group <?php echo $_GET["Group_number"]; ?> </H3>
                    </div>
                    <p>Please edit the input values and submit to update.
                    <form action="createLittle.php?Group_number=<?php echo $Group_number; ?>" method="post">
                        <div class="form-group <?php echo (!empty($OSU_ID_err)) ? 'has-error' : ''; ?>">
                            <label>OSU_ID</label>
                            <input type="number" name="OSU_ID" class="form-control" value="<?php echo $OSU_ID; ?>">
                            <span class="help-block"><?php echo $OSU_ID_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="viewGroup.php?Group_number=<?php echo $Group_number ?>" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>      
        </div>
    </div>
</body>
</html>