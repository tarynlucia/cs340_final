<?php

// Names: Charissa Kau, Taryn Eng, Johnny Vo, Thien Tu

session_start();
require_once "config.php";

if (isset($_GET["OSU_ID"]) && !empty(trim($_GET["OSU_ID"]))) {
    $_SESSION["OSU_ID"] = trim($_GET["OSU_ID"]);
}

if (isset($_GET["Event_number"]) && !empty(trim($_GET["Event_number"]))) {
    $_SESSION["Event_number"] = trim($_GET["Event_number"]);
}

// Delete record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["OSU_ID"]) && !empty($_POST["OSU_ID"]) && isset($_POST["Event_number"]) && !empty($_POST["Event_number"])) {
        $OSU_ID = $_POST["OSU_ID"];
        $Event_number = $_POST["Event_number"];
        $sql = "DELETE FROM Attends WHERE OSU_ID = ? AND Event_number = ?";
        
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ii", $OSU_ID, $Event_number);
            if (mysqli_stmt_execute($stmt)) {
                header("location: viewMeetingsAttended.php?OSU_ID=$OSU_ID");
                exit();
            } else {
                echo "Error deleting the attended meeting.";
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($link);
    }
} elseif (empty($_GET["OSU_ID"]) || empty($_GET["Event_number"])) {
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Attended Meeting</title>
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
                        <h1>Delete Attended Meeting</h1>
                    </div>
                    <form action="deleteAttendedMeeting.php?OSU_ID=<?php echo $OSU_ID; ?>&Event_number=<?php echo $Event_number; ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="OSU_ID" value="<?php echo htmlspecialchars($_SESSION["OSU_ID"]); ?>"/>
                            <input type="hidden" name="Event_number" value="<?php echo htmlspecialchars($_SESSION["Event_number"]); ?>"/>
                            <p>Are you sure you want to delete the attended meeting <?php echo htmlspecialchars($_SESSION["Event_number"]); ?> for <?php echo htmlspecialchars($_SESSION["OSU_ID"]); ?>?</p><br>
                            <input type="submit" value="Yes" class="btn btn-danger">
                            <a href="viewMeetingsAttended.php?OSU_ID=<?php echo $_SESSION["OSU_ID"]; ?>" class="btn btn-default">No</a>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
