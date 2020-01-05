<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM CPU WHERE cpuid = ?";
    
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
                $man = $row["cpuman"];
				$name = $row["cpuname"];
                $model = $row["cpumodel"];
                $freq = $row["cpufreq"];
				$cores = $row["cpucores"];
                $threads = $row["cputreads"];
				$year = $row["cpuyear"];
                $cache = $row["cpucache"];
				$socket = $row["cpusocket"];
				
				
                
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
    <title>View Record</title>
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
                        <h1>View CPU</h1>
                    </div>
					<div class="form-group">
                        <label>Manufacturer</label>
                        <p class="form-control-static"><?php echo $row["cpuman"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <p class="form-control-static"><?php echo $row["cpuname"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Model</label>
                        <p class="form-control-static"><?php echo $row["cpumodel"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Cache size</label>
                        <p class="form-control-static"><?php echo $row["cpucache"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Clock frequency</label>
                        <p class="form-control-static"><?php echo $row["cpufreq"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Socket</label>
                        <p class="form-control-static"><?php echo $row["cpusocket"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Model</label>
                        <p class="form-control-static"><?php echo $row["cpucores"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Cache size</label>
                        <p class="form-control-static"><?php echo $row["cputhreads"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Year</label>
                        <p class="form-control-static"><?php echo $row["cpuyear"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Last changes</label>
                        <p class="form-control-static"><?php echo $row["cpudate"]; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
