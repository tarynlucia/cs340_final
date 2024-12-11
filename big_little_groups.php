<?php
	session_start();
	//$currentpage="View Employees"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SASE Big Little Program</title>
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
                <li><a class="navbar-brand" href="big_little_groups.php">Big/Little</a></li> <!-- Replace with the URL for the third page -->
                <li><a href="index.php">Members</a></li>
                <li><a href="meetings.php">Meetings</a></li> <!-- Replace with the URL for the second page -->
            </ul>
        </div>
    </nav>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2> SASE Website Project CS340 </h2> 
                            <p> In this page you can:
                            <ol> 	
                                <li> CREATE big/little group </li>
                                <li> CREATE little from big/little group </li>
                                <li> RETRIEVE group member information </li>
                                <li> UPDATE group details </li>
                                <li> DELETE little from big/little group </li>
                                <li> DELETE big/little group </li>
                            </ol>
                        <h2 class="pull-left">Big Little Group Details</h2>
                        <a href="createGroup.php" class="btn btn-success pull-right">Add New Big/Little Group</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select all employee query execution
					// *****
					// Insert your function for Salary Level
					/*
						$sql = "SELECT Ssn,Fname,Lname,Salary, Address, Bdate, PayLevel(Ssn) as Level, Super_ssn, Dno
							FROM EMPLOYEE";
					*/
                    $sql = "SELECT *
							FROM Big_Little_Group";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th width=8%>Group Number</th>";
                                        echo "<th width=10%>Group Name</th>";
                                        echo "<th width=10%>Big_ID</th>";
                                        echo "<th width=15%>Action </th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row['Group_number'] . "</td>";
                                    echo "<td>" . $row['Group_name'] . "</td>";
                                    echo "<td>" . $row['Big_ID'] . "</td>";
                                    echo "<td>";
                                        echo "<a href='viewGroup.php?Group_number=" . $row['Group_number'] . "&Group_name=" . $row['Group_name'] . "' title='View Group' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                        echo "<a href='updateGroup.php?Group_number=" . $row['Group_number'] . "' title='Update Group' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                        echo "<a href='deleteGroup.php?Group_number=" . $row['Group_number'] . "' title='Delete Group' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
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
