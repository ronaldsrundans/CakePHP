<?php

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$man=$name=$freq=$model=$socket=$cache=$cores=$threads=$year="";
$man_err =$name_err = $freq_err = $model_err = $socket_err = $cache_err = $cores_err = $threads_err = $year_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
 	$input_man = trim($_POST["man"]);
	$input_name = trim($_POST["name"]);
	$input_model = trim($_POST["model"]);
    $input_freq = trim($_POST["freq"]);
	$input_cache = trim($_POST["cache"]);
    $input_socket = trim($_POST["socket"]);
	$input_cores = trim($_POST["cores"]);
	$input_threads = trim($_POST["threads"]);
	$input_year = trim($_POST["year"]);
	
	$man = $input_man;
	$name = $input_name;
	$model = $input_model;
	$freq = $input_freq;
	$socket = $input_socket;
	$cache = $input_cache;
	$cores = $input_cores;
	$threads = $input_threads;
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
    if(empty($name_err) && empty($man_err)){
        // Prepare an update statement
        $sql = "UPDATE OS SET osman=?, osname=? WHERE osid=?";

        if($stmt = mysqli_prepare($link, $sql)){
		
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt,"ssi",$param_man,$param_name, $param_id);

            // Set parameters
            $param_man = $man;
            $param_name = $name;
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
        $sql = "SELECT * FROM OS WHERE osid = ?";
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
                    $man = $row["osman"];
					$name = $row["osname"];
			
					
                 
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
                <div class="form-group <?php echo (!empty($man_err)) ? 'has-error' : ''; ?>">
                            <label>Manufacturer</label>
                            <input type="text" name="man" class="form-control" value="<?php echo $man; ?>">
                            <span class="help-block"><?php echo $man_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
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
