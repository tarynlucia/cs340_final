<?php

// Names: Charissa Kau, Taryn Eng, Johnny Vo, Thien Tu

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$OSU_ID = $Fname = $Lname = $Year = $Major = $Group_number = "";
$OSU_ID_err = $Fname_err = $Lname_err = $Year_err = $Major_err = $Group_number_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate First name
    $Fname = trim($_POST["Fname"]);
    if(empty($Fname)){
        $Fname_err = "Please enter a Fname.";
    } elseif(!filter_var($Fname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $Fname_err = "Please enter a valid Fname.";
    } 
    // Validate Last name
    $Lname = trim($_POST["Lname"]);
    if(empty($Lname)){
        $Lname_err = "Please enter a Lname.";
    } elseif(!filter_var($Lname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $Lname_err = "Please enter a valid Lname.";
    } 
 
    // Validate OSU_ID
    $OSU_ID = trim($_POST["OSU_ID"]);
    if(empty($OSU_ID)){
        $OSU_ID_err = "Please enter an OSU_ID.";     
    } elseif(!ctype_digit($OSU_ID)){
        $OSU_ID_err = "Please enter a positive integer value of OSU_ID.";
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

    // Check input errors before inserting in database
    if(empty($OSU_ID_err) && empty($Fname_err) && empty($Lname_err) && empty($Year_err) && empty($Major_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO Members (OSU_ID, Fname, Lname, Year, Major, Group_number) 
		        VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "issisi", $param_OSU_ID, $param_Fname, $param_Lname, $param_Year, $param_Major, $param_Group_number);
            
            // Set parameters
			$param_OSU_ID = $OSU_ID;
            $param_Fname = $Fname;
            $param_Lname = $Lname;
			$param_Year = $Year;
			$param_Major = $Major;
			$param_Group_number = $Group_number;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
				    header("location: index.php");
					exit();
            } else{
                echo "<center><h4>Error while creating a new member</h4></center>";
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
    <title>Create Member</title>
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
                    <p>Please fill this form and submit to add a Member record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group <?php echo (!empty($OSU_ID_err)) ? 'has-error' : ''; ?>">
                            <label>OSU ID</label>
                            <input type="text" name="OSU_ID" class="form-control" value="<?php echo $OSU_ID; ?>">
                            <span class="help-block"><?php echo $OSU_ID_err;?></span>
                        </div>
                 
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
                            <input type="text" name="Group_number" class="form-control" value="<?php echo $Group_number; ?>">
                            <span class="help-block"><?php echo $Group_number_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>