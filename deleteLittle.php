<?php
session_start();
// Include config file
require_once "config.php";

$OSU_ID = "";
$OSU_ID_err = "";

if (isset($_GET["Group_number"]) && !empty(trim($_GET["Group_number"]))) {
    $_SESSION["Group_number"] = $_GET["Group_number"];
}

if (isset($_GET["OSU_ID"]) && !empty(trim($_GET["OSU_ID"]))) {
    $_SESSION["OSU_ID"] = $_GET["OSU_ID"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate OSU_ID
    $OSU_ID = trim($_POST["OSU_ID"]);
    if (empty($OSU_ID)) {
        $OSU_ID_err = "Please enter OSU_ID.";
    }

    if (empty($OSU_ID_err)) {
        // Prepare the deletion query
        $sql = "UPDATE Members SET Group_number = NULL WHERE OSU_ID = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $param_OSU_ID);
            $param_OSU_ID = $OSU_ID;

            if (mysqli_stmt_execute($stmt)) {
                // Redirect to viewGroup.php
                header("location: viewGroup.php?Group_number=" . urlencode($_SESSION["Group_number"]));
                exit();
            } else {
                echo "<center><h3>Error when deleting</h3></center>";
                echo "<center><h3>MySQL Error: " . mysqli_error($link) . "</h3></center>";
            }
        }
        mysqli_stmt_close($stmt);
    }
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
        .wrapper { 
            width: 500px; 
            margin: 0 
            auto; 
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
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="Group_number" value="<?php echo htmlspecialchars($_SESSION["Group_number"]); ?>"/>
                            <input type="hidden" name="OSU_ID" value="<?php echo htmlspecialchars($_SESSION["OSU_ID"]); ?>"/>
                            <p>Are you sure you want to delete the record for <?php echo htmlspecialchars($_SESSION["OSU_ID"]); ?>?</p><br>
                            <input type="submit" value="Yes" class="btn btn-danger">
                            <a href="viewGroup.php?Group_number=<?php echo htmlspecialchars($_SESSION["Group_number"]); ?>" class="btn btn-default">No</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>