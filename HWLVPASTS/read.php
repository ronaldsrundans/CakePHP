<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM Persons INNER JOIN Education ON PersEducID=EducID WHERE PersID = ?";
    
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
                $persName = $row["PersName"];
                $persSurname = $row["PersSurname"];
                $persPhone = $row["PersPhone"];
                $persEmail = $row["PersEmail"];
                
                $educName = $row["EducName"];
                $educFac = $row["EducFac"];
                $educProg = $row["EducProg"];
                $educLevel = $row["EducLevel"];
                
                
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
    <title>CV apskats</title>
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
                        <h1>CV apskats</h1>
                    </div>
					<div class="form-group">
                        <label>Vārds</label>
                        <p class="form-control-static"><?php echo $row["PersName"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Uzvārds</label>
                        <p class="form-control-static"><?php echo $row["PersSurname"]; ?></p>
                    </div>
			
					<div class="form-group">
                        <label>Tālrunis</label>
                        <p class="form-control-static"><?php echo $row["PersPhone"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>E-pasts</label>
                        <p class="form-control-static"><?php echo $row["PersEmail"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Izglītības iestādes nosaukums</label>
                        <p class="form-control-static"><?php echo $row["EducName"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Izglītības iestādes fakultāte</label>
                        <p class="form-control-static"><?php echo $row["EducFac"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Studiju virziens</label>
                        <p class="form-control-static"><?php echo $row["EducProg"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Mācību laiks</label>
                        <p class="form-control-static"><?php echo $row["EducTime"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Izglītības iestādes nosaukums</label>
                        <p class="form-control-static"><?php echo $row["EducName"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Izglītības iestādes fakultāte</label>
                        <p class="form-control-static"><?php echo $row["EducFac"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Studiju virziens</label>
                        <p class="form-control-static"><?php echo $row["EducProg"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Mācību laiks</label>
                        <p class="form-control-static"><?php echo $row["EducTime"]; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
