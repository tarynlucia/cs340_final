<?php

// Names: Charissa Kau, Taryn Eng, Johnny Vo, Thien Tu

session_start();

if (isset($_GET["OSU_ID"]) && !empty(trim($_GET["OSU_ID"]))){
	$_SESSION["OSU_ID"] = $_GET["OSU_ID"];
} else {
    echo "OSU_ID not set in session!";
    exit();
}

$OSU_ID = $_SESSION["OSU_ID"];

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$Event_number = "";
$Event_number_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Event_number
    $Event_number = trim($_POST["Event_number"]);
    if (empty($Event_number)) {
        $Event_number_err = "Please enter an Event Number.";
    } elseif (!is_numeric($Event_number)) {
        $Event_number_err = "Event Number must be a number.";
    }

    // Check input errors before inserting in database
    if (empty($Event_number_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO Attends (Event_number, OSU_ID) VALUES (?, ?)";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ii", $param_Event_number, $param_OSU_ID);

            $param_OSU_ID = $OSU_ID;
            $param_Event_number = $Event_number;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to previous page
                header("location: viewMeetingsAttended.php?OSU_ID=$OSU_ID");
                exit();
            } else {
                // Capture and print the error message from the SQL execution
                echo "<center><h4>Error while adding a new attended meeting: " . mysqli_stmt_error($stmt) . "</h4></center>";
                echo "<center><h5>MySQL Error: " . mysqli_error($link) . "</h5></center>";
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
    <title>Add Attended Meeting</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
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
                    <h2>Add Attended Meeting</h2>
                    <h3> For member with OSU_ID = <?php echo $OSU_ID; ?> </h3>
                </div>

                <form action="addAttendedMeeting.php?OSU_ID=<?php echo $OSU_ID; ?>" method="post">
                    <div class="form-group <?php echo (!empty($Event_number_err)) ? 'has-error' : ''; ?>">
                        <label>Event Number</label>
                        <input type="text" name="Event_number" class="form-control" value="<?php echo htmlspecialchars($Event_number); ?>">
                        <span class="help-block"><?php echo $Event_number_err; ?></span>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="viewMeetingsAttended.php?OSU_ID=<?php echo $OSU_ID; ?>" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
