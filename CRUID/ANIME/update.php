<?php

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$title=$type=$size=$sizegb=$year="";
$title_err = $type_err = $size_err = $sizegb_err = $year_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
 	$input_title = trim($_POST["title"]);
	$input_type = trim($_POST["type"]);
	$input_sizegb = trim($_POST["sizegb"]);
    $input_size = trim($_POST["size"]);
	$input_year = trim($_POST["year"]);
	
	$title = $input_title;
	$type = $input_type;
	$size = $input_size;
	$sizegb = $input_sizegb;
	$year = $input_year;
    /*
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate address address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } else{
        $address = $input_address;
    }
    
    // Validate salary
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Please enter a positive integer value.";
    } else{
        $salary = $input_salary;
    }
    */
    // Check input errors before inserting in database
    if(empty($name_err) && empty($title_err) ){
        // Prepare an update statement
        $sql = "UPDATE MYANIMELIST SET title=?, type=?, sizegb=?, size=?,year=? WHERE id=?";

        if($stmt = mysqli_prepare($link, $sql)){
		
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt,"ssssi",$param_title,$param_type, $param_sizegb, $param_freq, $param_size, $param_year, $param_id);

            // Set parameters
            $param_title = $title;
            //$param_name = $name;
			$param_type = $type;
            //$param_freq = $freq;
			//$param_cores = $cores;
            //$param_threads = $threads;
			$param_size = $size;
            $param_year = $year;
			$param_sizegb = $sizegb;
            $param_id = $id;
              
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} 
else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM MYANIMELIST WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                   // Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop 
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $title = $row["title"];
			
					$type = $row["type"];
					
					$sizegb = $row["sizegb"];
				    $size = $row["size"];
		
					$year = $row["year"];
					
                 
                } else{
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                <div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
                            <span class="help-block"><?php echo $title_err;?></span>
                        </div>
                     
						<div class="form-group <?php echo (!empty($type_err)) ? 'has-error' : ''; ?>">
                            <label>Type</label>
                            <input type="text" name="type" class="form-control" value="<?php echo $type; ?>">
                            <span class="help-block"><?php echo $type_err;?></span>
                        </div>
					    <div class="form-group <?php echo (!empty($sizegb_err)) ? 'has-error' : ''; ?>">
                            <label>Sizegb size</label>
                            <input type="text" name="sizegb" class="form-control" value="<?php echo $sizegb; ?>">
                            <span class="help-block"><?php echo $sizegb_err;?></span>
                        </div>
                  
						 <div class="form-group <?php echo (!empty($size_err)) ? 'has-error' : ''; ?>">
                            <label>Size</label>
                            <input type="text" name="size" class="form-control" value="<?php echo $size; ?>">
                            <span class="help-block"><?php echo $size_err;?></span>
                        </div>
					
					
						  <div class="form-group <?php echo (!empty($year_err)) ? 'has-error' : ''; ?>">
                            <label>Years</label>
                            <input type="text" name="year" class="form-control" value="<?php echo $year; ?>">
                            <span class="help-block"><?php echo $year_err;?></span>
                        </div>
				
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
