<?php
session_start();
require_once "config.php";

// Ensure we have the OSU_ID and Event_number in the session or GET
if (isset($_GET["OSU_ID"]) && !empty(trim($_GET["OSU_ID"]))) {
    $_SESSION["OSU_ID"] = trim($_GET["OSU_ID"]);
}

if (isset($_GET["Event_number"]) && !empty(trim($_GET["Event_number"]))) {
    $_SESSION["Event_number"] = trim($_GET["Event_number"]);
}

// Delete record when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["OSU_ID"]) && !empty($_POST["OSU_ID"])) {
        $OSU_ID = $_POST["OSU_ID"];
        $Event_number = $_POST["Event_number"];
        
        // SQL query to delete the record
        $sql = "DELETE FROM Attends WHERE OSU_ID = ? AND Event_number = ?";
        
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ii", $OSU_ID, $Event_number);
            
            // Execute query
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to viewLeads.php after successful deletion
                header("location: viewAttendees.php?Event_number=" . $Event_number);
                exit();  // Always call exit() after header to stop script execution
            } else {
                echo "Error deleting the record.";
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($link);
    }
} elseif (empty($_GET["OSU_ID"])) {
    // If OSU_ID is missing, redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style>
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
                        <h1>Delete Record</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="OSU_ID" value="<?php echo htmlspecialchars($_SESSION["OSU_ID"]); ?>"/>
                            <input type="hidden" name="Event_number" value="<?php echo htmlspecialchars($_SESSION["Event_number"]); ?>"/>
                            <p>Are you sure you want to delete OSU_ID#<?php echo htmlspecialchars($_SESSION["OSU_ID"]); ?>?</p><br>
                            <input type="submit" value="Yes" class="btn btn-danger">
                            <a href="viewAttendees.php?Event_number=<?php echo $_SESSION['Event_number']; ?>" class="btn btn-default">No</a>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
