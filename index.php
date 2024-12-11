<?php

// Names: Charissa Kau, Taryn Eng, Johnny Vo, Thien Tu

	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SASE Website</title>
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
                <li><a class="navbar-brand" href="index.php">Members</a></li>
                <li><a href="meetings.php">Meetings</a></li> <!-- Replace with the URL for the second page -->
                <li><a href="big_little_groups.php">Big/Little</a></li> <!-- Replace with the URL for the third page -->
            </ul>
        </div>
    </nav>


    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
		    <div class="page-header clearfix">
		     <h2> SASE Website Project CS 340 </h2> 
                       <p> On this webpage you can:
				<ol> 	<li> CREATE new Members </li>
					<li> RETRIEVE all Meetings attended by a member</li>
                                        <li> CREATE new Meetings attended by a member</li>
					<li> DELETE member records </li>
				</ol>
		       <h2 class="pull-left">Member Details</h2>
                        <a href="createMember.php" class="btn btn-success pull-right">Add New Member</a>
                        <a href="viewMajorCount.php" class="btn btn-success pull-right" style="margin-right: 10px;">View Major Breakdown</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    

                    $sql = "SELECT *
							FROM Members";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th width=10%>OSU ID</th>";
                                        echo "<th width=10%>First Name</th>";
                                        echo "<th width=10%>Last Name</th>";
                                        echo "<th width=10%>Year</th>";
										echo "<th width=10%>Major</th>";
										echo "<th width=10%>Group Number</th>";
                                        echo "<th width=10%>Actions</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['OSU_ID'] . "</td>";
                                        echo "<td>" . $row['Fname'] . "</td>";
                                        echo "<td>" . $row['Lname'] . "</td>";
										echo "<td>" . $row['Year'] . "</td>";									
										echo "<td>" . $row['Major'] . "</td>";
                                        echo "<td>" . $row['Group_number'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='updateMember.php?OSU_ID=". $row['OSU_ID'] ."' title='Update Member' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='deleteMember.php?OSU_ID=". $row['OSU_ID'] ."' title='Delete Member' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
											echo "<a href='viewMeetingsAttended.php?OSU_ID=". $row['OSU_ID'] ."' title='View Meetings Attended' data-toggle='tooltip'><span class='glyphicon glyphicon-user'></span></a>";
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
