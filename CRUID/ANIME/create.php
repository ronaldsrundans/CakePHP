<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$type =$title=$size=$sizegb=$year = "";
$type_err =$title_err=$size_err =$sizegb_err=$year_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 	$input_title = trim($_POST["title"]);
	$input_type = trim($_POST["type"]);
	$input_size = trim($_POST["size"]);
	$input_sizegb = trim($_POST["sizegb"]);
	$input_year = trim($_POST["year"]);

	$type = $input_title;
	$title = $input_type;
	$size = $input_size;
	$sizegb = $input_sizegb;
	$year = $input_year;
	
	// Validate name
	/*
    $input_type = trim($_POST["name"]);
    if(empty($input_type)){
        $title_err = "Please enter a name.";
    } elseif(!filter_var($input_type, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $title_err = "Please enter a valid name.";
    } else{
        $title = $input_type;
    }
    */
    // Validate address
	/*
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } else{
        $address = $input_address;
    }
    */
    // Validate salary
	/*
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
    if(empty($title_err) && empty($type_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO MYANIMELIST (title, type, size) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_title, $param_type, $param_size);
            
            // Set parameters
            $param_title = $type;
            $param_type = $title;
			$param_size = $size;
            $param_sizegb = $sizegb;
			$param_year = $year;
            
                        
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
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
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create ANIME Record</title>
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
                        <h2>Create ANIME Record</h2>
                    </div>
                    <p>Please fill this form and submit to add OS record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                    	<div class="form-group <?php echo (!empty($size_err)) ? 'has-error' : ''; ?>">
                            <label>Size</label>
                            <input type="text" name="size" class="form-control" value="<?php echo $size; ?>">
                            <span class="help-block"><?php echo $size_err;?></span>
                        </div>
                    	<div class="form-group <?php echo (!empty($sizegb_err)) ? 'has-error' : ''; ?>">
                            <label>Size GB</label>
                            <input type="text" name="sizegb" class="form-control" value="<?php echo $sizegb; ?>">
                            <span class="help-block"><?php echo $sizegb_err;?></span>
                        </div>
                    	<div class="form-group <?php echo (!empty($year_err)) ? 'has-error' : ''; ?>">
                            <label>Year</label>
                            <input type="text" name="year" class="form-control" value="<?php echo $year; ?>">
                            <span class="help-block"><?php echo $year_err;?></span>
                        </div>
                    
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
