<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM SSD WHERE ssdid = ?";
    
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
                $man = $row["ssdman"];
		        $model = $row["ssdmodel"];
                $mem = $row["ssdmem"];
				$status = $row["ssdstatus"];
          
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
                        <h1>View SSD</h1>
                    </div>
					<div class="form-group">
                        <label>Manufacturer</label>
                        <p class="form-control-static"><?php echo $row["ssdman"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Model</label>
                        <p class="form-control-static"><?php echo $row["ssdmodel"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Memory size</label>
                        <p class="form-control-static"><?php echo $row["ssdmem"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>SSD status</label>
                        <p class="form-control-static"><?php echo $row["ssdstatus"]; ?></p>
                    </div>
		
					<div class="form-group">
                        <label>Last changes</label>
                        <p class="form-control-static"><?php echo $row["ssddate"]; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
