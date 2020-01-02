<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
                     //t1=PC
				   //t2=cpu
				   //t3=gpu
				   //t4=ram
				   //t5=os
				   //t6=motherboard
				   //t7=hdd
				   //t8=ssd  
    // Prepare a select statement
	 $sql="SELECT * FROM PC AS t1 INNER JOIN RPCXCPU AS t2 ON t1.pcid=t2.rpcxcpupcid INNER JOIN CPU AS t3 ON t2.rpcxcpucpuid=t3.cpuid INNER JOIN RPCXGPU AS t4 ON t1.pcid=t4.rpcxgpupcid INNER JOIN GPU AS t5 ON t4.rpcxgpugpuid=t5.gpuid INNER JOIN RPCXRAM AS t6 ON t1.pcid=t6.rpcxrampcid INNER JOIN RAM AS t7 ON t6.rpcxramramid=t7.ramid INNER JOIN RPCXMOTHER AS t8 ON t1.pcid=t8.rpcxmotherpcid INNER JOIN MOTHER AS t9 ON t8.rpcxmothermotherid=t9.motherid INNER JOIN RPCXOS AS t10 ON t1.pcid=t10.rpcxospcid INNER JOIN OS AS t11 ON t10.rpcxososid=t11.osid INNER JOIN RPCXSSD AS t12 ON t1.pcid=t12.rpcxssdpcid INNER JOIN SSD AS t13 ON t12.rpcxssdssdid=t13.ssdid INNER JOIN RPCXHDD AS t14 ON t1.pcid=t14.rpcxhddpcid INNER JOIN HDD AS t15 ON t14.rpcxhddhddid=t15.hddid INNER JOIN RPCXPSU AS t16 ON t1.pcid=t16.rpcxpsupcid INNER JOIN PSU AS t17 ON t16.rpcxpsupsuid=t17.psuid WHERE pcid = ?";
					
    //$sql = "SELECT * FROM PC AS t1 INNER JOIN CPU AS t2 on t1.pccpuid=t2.cpuid INNER JOIN GPU AS t3 on t1.pcgpuid=t3.gpuid INNER JOIN RAM AS t4 on t1.pcramid=t4.ramid INNER JOIN OS AS t5 on t1.pcosid=t5.osid INNER JOIN MOTHER AS t6 on t1.pcmotherid=t6.motherid INNER JOIN HDD AS t7 on t1.pchddid=t7.hddid INNER JOIN SSD AS t8 on t1.pcssdid=t8.ssdid WHERE pcid = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                //$cpu = $row["cpuname"]." ".$row["cpumodel"];
                //$man = $row["man"];
                } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View PC Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
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
                        <h1>View PC info</h1>
                    </div>
					<div class="form-group">
                        <label>PC id</label>
                        <p class="form-control-static"><?php echo $row["pcid"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>CPU info</label>
                        <p class="form-control-static"><?php echo $row["cpuname"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Motherboard info</label>
                        <p class="form-control-static"><?php echo $row["motherman"]." ".$row["mothername"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>RAM info</label>
                        <p class="form-control-static"><?php echo $row["ramman"]." ".$row["ramname"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>GPU info</label>
                        <p class="form-control-static"><?php echo $row["gpuman"]." ".$row["gpuname"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>SSD info</label>
                        <p class="form-control-static"><?php echo $row["ssdman"]." ".$row["ssdmodel"]." ".$row["ssdmem"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>HDD info</label>
                        <p class="form-control-static"><?php echo $row["hddman"]." ".$row["hddmodel"]." ".$row["hddmem"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>OS info</label>
                        <p class="form-control-static"><?php echo $row["osname"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Comment</label>
                        <p class="form-control-static"><?php echo $row["pccomment"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Last changes</label>
                        <p class="form-control-static"><?php echo $row["pcdate"]; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
