<?php
	session_start();
    // Include config file
    require_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Big Little Group</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
	   <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">View Group</h2>
                    </div>

                    <?php
                    if(isset($_GET["Group_number"]) && !empty(trim($_GET["Group_number"]))){
                        $_SESSION["Group_number"] = $_GET["Group_number"];
                        $Group_number = $_SESSION["Group_number"];
                        echo "<a href='createLittle.php?Group_number=$Group_number' class='btn btn-success pull-right'>Add Little</a>";
                    }

                    if(isset($_SESSION["Group_number"]) ){
                    
                    
                    // Prepare a select statement
                    $sql = "SELECT OSU_ID, Fname, Lname, Year, Major 
                            FROM Members
                            WHERE Group_number = ?
                            ";

                
                    if($stmt = mysqli_prepare($link, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "i", $param_Group_number);      
                        // Set parameters
                        $param_Group_number = $_SESSION["Group_number"];

                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            $result = mysqli_stmt_get_result($stmt);
                    
                            echo"<h4> Littles: </h4><p>";
                            echo"<br>";
                            if(mysqli_num_rows($result) > 0){
                                echo "<table class='table table-bordered table-striped'>";
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>OSU_ID</th>";
                                            echo "<th>First Name</th>";
                                            echo "<th>Last Name </th>";
                                            echo "<th>Year</th>";
                                            echo "<th>Major</th>";
                                            echo "<th>Action</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";							
                                // output data of each row
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                        echo "<td>" . $row['OSU_ID'] . "</td>";
                                        echo "<td>" . $row['Fname'] . "</td>";
                                        echo "<td>" . $row['Lname']."</td>";
                                        echo "<td>" . $row['Year'] . "</td>";
                                        echo "<td>" . $row['Major'] . "</td>";
                                        // echo "<td>" . $row['Group_number'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='deleteLittle.php?Group_number=". $_SESSION["Group_number"] . "?OSU_ID=" . $row['OSU_ID'] ."' title='Delete Little' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";                            
                                echo "</table>";				
                                mysqli_free_result($result);
                            } else {
                                echo "No Littles. ";
                            }
                //				mysqli_free_result($result);
                        } else{
                            // URL doesn't contain valid id parameter. Redirect to error page
                            header("location: error.php");
                            exit();
                        }
                    }     
                    // Close statement
                    mysqli_stmt_close($stmt);
                    
                    // Close connection
                    mysqli_close($link);
                } else{
                    // URL doesn't contain id parameter. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                ?>					                 					
                    <p><a href="big_little_groups.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>