<?php

// Names: Charissa Kau, Taryn Eng, Johnny Vo, Thien Tu

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$Group_number = $Group_name = $Big_ID = "";
$Group_number_err = $Group_name_err = $Big_ID_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // // Validate group name
    // $Group_number = trim($_POST["Group_number"]);
    // if(empty($Group_number)){
    //     $Group_number_err = "Please enter a Group Number.";
    // } else if(!ctype_digit($Group_number)){
    //     $Group_number_err = "Please enter a valid Group Number. Group Number may not already exist.";
    // }

    // // Validate group number
    // $Group_name = trim($_POST["Group_name"]);
    // if(empty($Group_name)){
    //     $Group_name_err = "Please enter a Group Name.";
    // }

    // // Validate big's ID
    // $Big_ID = trim($_POST["Big_ID"]);
    // if(empty($Big_ID)){
    //     $Big_ID_err = "Please enter the Big's ID.";     
    // } else if(!ctype_digit($Big_ID)){
    //     $Big_ID_err = "Please enter numerical value for the Big ID.";
    // }
	
    // Check input errors before inserting in database
    if(empty($Group_number_err) && empty($Group_name_err) && empty($Big_ID_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO Big_Little_Group (Group_number, Group_name, Big_ID) 
		        VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "isi", $param_Group_number, $param_Group_name, $param_Big_ID);
            
            // Set parameters
			$param_Group_number = $Group_number;
            $param_Group_name = $Group_name;
			$param_Big_ID = $Big_ID;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
				    header("location: big_little_groups.php");
					exit();
            } 
            else {
				// Validate group name
                $Group_number = trim($_POST["Group_number"]);
                if(empty($Group_number)){
                    $Group_number_err = "Please enter a Group Number.";
                } else if(!ctype_digit($Group_number)){
                    $Group_number_err = "Please enter numerical value for the Group Number.";
                } else if(empty($Group_number_err)) {
                    $group_check_sql = "SELECT 1 FROM Big_Little_Group WHERE Group_number = ?";
                    if ($group_check_stmt = mysqli_prepare($link, $group_check_sql)) {
                        mysqli_stmt_bind_param($group_check_stmt, "i", $param_Group_number);
                        $param_Group_number = $Group_number;

                        // Execute the query
                        if (mysqli_stmt_execute($group_check_stmt)) {
                            mysqli_stmt_store_result($group_check_stmt);
                            if (mysqli_stmt_num_rows($group_check_stmt) > 0) {
                                $Group_number_err = "Group Number already exists. Please enter a unique number.";
                            }
                        } else {
                            echo "Error checking groups.";
                        }
                        mysqli_stmt_close($group_check_stmt);
                    }
                }
            
                // Validate group number
                $Group_name = trim($_POST["Group_name"]);
                if(empty($Group_name)){
                    $Group_name_err = "Please enter a Group Name.";
                }
            
                // Validate big's ID
                $Big_ID = trim($_POST["Big_ID"]);
                if(empty($Big_ID)){
                    $Big_ID_err = "Please enter the Big's ID.";     
                } else if(!ctype_digit($Big_ID)){
                    $Big_ID_err = "Please enter numerical value for the Big ID.";
                } else if(empty($Big_ID_err)) {
                    $group_check_sql = "SELECT 1 FROM Officers WHERE OSU_ID = ?";
                    if ($group_check_stmt = mysqli_prepare($link, $group_check_sql)) {
                        mysqli_stmt_bind_param($group_check_stmt, "i", $param_OSU_ID);
                        $param_OSU_ID = $OSU_ID;

                        // Execute the query
                        if (mysqli_stmt_execute($group_check_stmt)) {
                            mysqli_stmt_store_result($group_check_stmt);
                            if (mysqli_stmt_num_rows($group_check_stmt) <= 0) {
                                $Big_ID_err = "Big ID must belong to a club officer.";
                            }
                        } else {
                            echo "Error checking Big ID.";
                        }
                        mysqli_stmt_close($group_check_stmt);
                    }
                }
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
                        <h2>Create Big/Little Group</h2>
                    </div>
                    <p>Please fill this form and submit to add a new Big/Little Group to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group <?php echo (!empty($Group_number_err)) ? 'has-error' : ''; ?>">
                            <label>Group Number</label>
                            <input type="text" name="Group_number" class="form-control" value="<?php echo $Group_number; ?>">
                            <span class="help-block"><?php echo $Group_number_err;?></span>
                        </div>
                 
						<div class="form-group <?php echo (!empty($Group_name_err)) ? 'has-error' : ''; ?>">
                            <label>Group Name</label>
                            <input type="text" name="Group_name" class="form-control" value="<?php echo $Group_name; ?>">
                            <span class="help-block"><?php echo $Group_name_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($Big_ID_err)) ? 'has-error' : ''; ?>">
                            <label>Big's ID</label>
                            <input type="text" name="Big_ID" class="form-control" value="<?php echo $Big_ID; ?>">
                            <span class="help-block"><?php echo $Big_ID_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="big_little_groups.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>