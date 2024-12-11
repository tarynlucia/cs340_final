<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Meeting DB</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
	<style type="text/css">
        .wrapper{
            width: 70%;
            margin:0 auto;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
		 $('.selectpicker').selectpicker();
    </script>
</head>
<body>
    <?php
        // Include config file
        require_once "config.php";
//		include "header.php";
	?>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li><a class="navbar-brand" href="meetings.php">Meetings</a></li>
                <li><a href="big_little_groups.php">Big/Little</a></li> <!-- Replace with the URL for the second page -->
                <li><a href="index.php">Members</a></li> <!-- Replace with the URL for the third page -->
            </ul>
        </div>
    </nav>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
		    <div class="page-header clearfix">
		     <h2> SASE Website Project CS 340 </h2> 
                    <p> In this page you can:
                    <ol>
                        <li> CREATE new meeting </li> 	
                        <li> RETRIEVE attendees </li> 	
                        <li> UPDATE event information </li>
                        <li> DELETE meeting </li>
                        <li> RETRIEVE leads </li>
                    </ol>
		       <h2 class="pull-left">Meeting Details</h2>
                        <a href="createMeeting.php" class="btn btn-success pull-right">Create New Meeting</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    $sql = "SELECT * FROM Meetings";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th width=8%>Event Number</th>";
                                        echo "<th width=10%>Name</th>";
                                        echo "<th width=10%>Date</th>";
                                        echo "<th width=15%>Location </th>";
                                        echo "<th width=10%>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['Event_number'] . "</td>";
                                        echo "<td>" . $row['Event_name'] . "</td>";
                                        echo "<td>" . $row['Date'] . "</td>";
										echo "<td>" . $row['Location'] . "</td>";	
                                        echo "<td>";
                                            echo "<a href='viewAttendees.php?Event_number=". $row['Event_number'] ."' title='View Attendees' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='updateMeeting.php?Event_number=". $row['Event_number'] ."' title='Update Meeting' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='deleteMeeting.php?Event_number=". $row['Event_number'] ."' title='Delete Meeting' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
											echo "<a href='viewLeads.php?Event_number=". $row['Event_number'] ."' title='View Leads' data-toggle='tooltip'><span class='glyphicon glyphicon-user'></span></a>";
                                        echo "</td>";						
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. <br>" . mysqli_error($link);
                    }
					
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>

</body>
</html>
