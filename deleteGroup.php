<?php
session_start();
require_once "config.php";

if (isset($_GET["Group_number"]) && !empty(trim($_GET["Group_number"]))) {
    $_SESSION["Group_number"] = trim($_GET["Group_number"]);
}

// Delete record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["Group_number"]) && !empty($_POST["Group_number"])) {
        $Group_number = $_POST["Group_number"];
        $sql = "DELETE FROM Big_Little_Group WHERE Group_number = ?";
        
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $Group_number);
            if (mysqli_stmt_execute($stmt)) {
                header("location: big_little_groups.php");
                exit();
            } else {
                echo "Error deleting the group.";
                // Capture and print the error message from the SQL execution
                echo "<center><h4>Error while adding a new attended meeting: " . mysqli_stmt_error($stmt) . "</h4></center>";
                echo "<center><h5>MySQL Error: " . mysqli_error($link) . "</h5></center>";
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($link);
    }
} elseif (empty($_GET["Group_number"])) {
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
                            <input type="hidden" name="Group_number" value="<?php echo htmlspecialchars($_SESSION["Group_number"]); ?>"/>
                            <p>Are you sure you want to delete the record for <?php echo htmlspecialchars($_SESSION["Group_number"]); ?>?</p><br>
                            <input type="submit" value="Yes" class="btn btn-danger">
                            <a href="big_little_groups.php" class="btn btn-default">No</a>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
