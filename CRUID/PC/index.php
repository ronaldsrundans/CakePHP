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
				   //t3=gpu
				   //t4=ram
				   //t5=os
				   //t6=motherboard
				   //t7=hdd
				   //t8=ssd
				    $sql = "SELECT t1.pcid, t1.pcpsu, t1.pcdate, t2.cpuname, t2.cpumodel, t2.cpuman, t3.gpuman, t3.gpuname, t4.ramman, t5.osname, t6.motherman, t6.mothername, t7.hddman, t7.hddmodel, t7.hddmem, t8.ssdman, t8.ssdmodel, t8.ssdmem FROM PC AS t1 INNER JOIN CPU AS t2 on t1.pccpuid=t2.cpuid INNER JOIN GPU AS t3 on t1.pcgpuid=t3.gpuid INNER JOIN RAM AS t4 on t1.pcramid=t4.ramid INNER JOIN OS AS t5 on t1.pcosid=t5.osid INNER JOIN MOTHER AS t6 on t1.pcmotherid=t6.motherid INNER JOIN HDD AS t7 on t1.pchddid=t7.hddid INNER JOIN SSD AS t8 on t1.pcssdid=t8.ssdid";
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
                                        echo "<td>" . $row['mothername'] . "</td>";
										echo "<td>" . $row['ramman'] . "</td>";
										echo "<td>" . $row['gpuman'] ." ".$row['gpuname']."</td>";
										echo "<td>" . $row['osname'] . "</td>";
										echo "<td>" . $row['ssdman'] ." ".$row['ssdmodel']." ".$row['ssdmem']. "</td>";
										echo "<td>" . $row['hddman'] ." ".$row['hddmodel']." ".$row['hddmem']. "</td>";
										echo "<td>" . $row['pcpsu'] . "</td>";
                             			echo "<td>" . $row['pcdate'] . "</td>";
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
