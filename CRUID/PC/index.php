<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PC Dashboard</title>
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
                        <h2 class="pull-left">PC Details</h2>
                        <a href="create.php" class="btn btn-success pull-right">Add New PC</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                   //t1=PC
				   //t2=cpu
				   //t3=ram
				    $sql = "SELECT t1.pcid, t2.cpuname, t2.cpumodel, t2.cpuman, t3.gpuman, t3.gpuname, t4.ramman FROM PC AS t1 INNER JOIN CPU AS t2 on t1.pccpuid=t2.cpuid INNER JOIN GPU AS t3 on t1.pcgpuid=t3.gpuid INNER JOIN RAM AS t4 on t1.pcramid=t4.ramid";
					//SELECT e.first_name, e.last_name, u.user_type, u.username FROM `employee` AS e INNER JOIN `user` AS u ON e.id = u.employee_id;
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>CPU</th>";
										echo "<th>MB</th>";
										echo "<th>RAM</th>";
                                        echo "<th>GPU</th>";
										echo "<th>OS</th>";
										echo "<th>SSD</th>";
										echo "<th>HDD</th>";
										echo "<th>PSU</th>";
                                     	echo "<th>Last changes</th>";
										echo "<th>Options</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['pcid'] . "</td>";
                                        echo "<td>" . $row['cpuman'] ." ".$row['cpuname']." ".$row['cpumodel']."</td>";
                                        echo "<td>" . $row['motherid'] . "</td>";
										echo "<td>" . $row['ramman'] . "</td>";
										echo "<td>" . $row['gpuman'] ." ".$row['gpuname']."</td>";
										echo "<td>" . $row['name'] . "</td>";
										echo "<td>" . $row['ssd'] . "</td>";
										echo "<td>" . $row['hdd'] . "</td>";
										echo "<td>" . $row['psu'] . "</td>";
                             			echo "<td>" . $row['reg_date'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
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
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
