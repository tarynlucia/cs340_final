<?php
session_start();
require_once "config.php";

if (isset($_GET["Event_number"]) && !empty(trim($_GET["Event_number"]))) {
    $_SESSION["Event_number"] = trim($_GET["Event_number"]);
}

// Delete record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["Event_number"]) && !empty($_POST["Event_number"])) {
        $Event_number = $_POST["Event_number"];
        $sql = "DELETE FROM Meetings WHERE Event_number = ?";
        
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $Event_number);
            if (mysqli_stmt_execute($stmt)) {
                header("location: meetings.php");
                exit();
            } else {
                echo "Error deleting the meeting.";
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($link);
    }
} elseif (empty($_GET["Event_number"])) {
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
                            <input type="hidden" name="Event_number" value="<?php echo htmlspecialchars($_SESSION["Event_number"]); ?>"/>
                            <p>Are you sure you want to delete the record for Meeting #<?php echo htmlspecialchars($_SESSION["Event_number"]); ?>?</p><br>
                            <input type="submit" value="Yes" class="btn btn-danger">
                            <a href="meetings.php" class="btn btn-default">No</a>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
