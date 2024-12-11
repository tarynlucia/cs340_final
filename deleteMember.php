<?php

// Names: Charissa Kau, Taryn Eng, Johnny Vo, Thien Tu

session_start();
require_once "config.php";

if (isset($_GET["OSU_ID"]) && !empty(trim($_GET["OSU_ID"]))) {
    $_SESSION["OSU_ID"] = trim($_GET["OSU_ID"]);
}

// Delete record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["OSU_ID"]) && !empty($_POST["OSU_ID"])) {
        $OSU_ID = $_POST["OSU_ID"];
        $sql = "DELETE FROM Members WHERE OSU_ID = ?";
        
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $OSU_ID);
            if (mysqli_stmt_execute($stmt)) {
                header("location: index.php");
                exit();
            } else {
                echo "Error deleting the member.";
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($link);
    }
} elseif (empty($_GET["OSU_ID"])) {
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Member</title>
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
                            <p>Are you sure you want to delete the record for <?php echo htmlspecialchars($_SESSION["OSU_ID"]); ?>?</p><br>
                            <input type="submit" value="Yes" class="btn btn-danger">
                            <a href="index.php" class="btn btn-default">No</a>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
