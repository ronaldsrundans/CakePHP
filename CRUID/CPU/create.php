<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$man=$name=$freq=$model=$socket=$cache=$cores=$threads=$year="";
$man_err =$name_err = $freq_err = $model_err = $socket_err = $cache_err = $cores_err = $threads_err = $year_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
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
	
    // Validate name
	/*
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
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
    if(empty($name_err) && empty($man_err) && empty($model_err)&& empty($freq_err) && empty($socket_err)&& empty($cores_err)&& empty($threads_err)&& empty($year_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO CPU (cpuman, cpuname, cpumodel, cpucache, cpufreq, cpusocket, cpucores, cputhreads, cpuyear) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt,"sssssssss",$param_man,$param_name,$param_model, $param_cache, $param_freq, $param_socket, $param_cores, $param_threads, $param_year);
            
            // Set parameters
            $param_man = $man;
            $param_name = $name;
			$param_model = $model;
            $param_freq = $freq;
			$param_cores = $cores;
            $param_threads = $threads;
			$param_socket = $socket;
            $param_year = $year;
			$param_cache = $cache;
            
            
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
    <title>Create CPU Record</title>
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
                        <h2>Create CPU Record</h2>
                    </div>
                    <p>Please fill this form and submit to add CPU record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
						<div class="form-group <?php echo (!empty($model_err)) ? 'has-error' : ''; ?>">
                            <label>Model</label>
                            <input type="text" name="model" class="form-control" value="<?php echo $model; ?>">
                            <span class="help-block"><?php echo $model_err;?></span>
                        </div>
					    <div class="form-group <?php echo (!empty($cache_err)) ? 'has-error' : ''; ?>">
                            <label>Cache size</label>
                            <input type="text" name="cache" class="form-control" value="<?php echo $cache; ?>">
                            <span class="help-block"><?php echo $cache_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($freq_err)) ? 'has-error' : ''; ?>">
                            <label>Frequency</label>
                            <input type="text" name="freq" class="form-control" value="<?php echo $freq; ?>">
                            <span class="help-block"><?php echo $freq_err;?></span>
                        </div>
						 <div class="form-group <?php echo (!empty($socket_err)) ? 'has-error' : ''; ?>">
                            <label>Socket</label>
                            <input type="text" name="socket" class="form-control" value="<?php echo $socket; ?>">
                            <span class="help-block"><?php echo $socket_err;?></span>
                        </div>
						  <div class="form-group <?php echo (!empty($cores_err)) ? 'has-error' : ''; ?>">
                            <label>Cores</label>
                            <input type="text" name="cores" class="form-control" value="<?php echo $cores; ?>">
                            <span class="help-block"><?php echo $cores_err;?></span>
                        </div>
						  <div class="form-group <?php echo (!empty($threads_err)) ? 'has-error' : ''; ?>">
                            <label>Threads</label>
                            <input type="text" name="threads" class="form-control" value="<?php echo $threads; ?>">
                            <span class="help-block"><?php echo $threads_err;?></span>
                        </div>
						  <div class="form-group <?php echo (!empty($year_err)) ? 'has-error' : ''; ?>">
                            <label>Years</label>
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
