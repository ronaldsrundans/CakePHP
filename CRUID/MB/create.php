<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$man =$name = $totalram = $mem = $type = "";
$man_err =$name_err = $totalram_err = $mem_err = $type_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 	$input_man = trim($_POST["man"]);
	$input_name = trim($_POST["name"]);
	$input_mem = trim($_POST["mem"]);
    $input_totalram = trim($_POST["totalram"]);
	$input_type = trim($_POST["type"]);
	
	$man = $input_man;
	$name = $input_name;
	$mem = $input_mem;
	$totalram = $input_totalram;
	$type = $input_type;
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
    if(empty($name_err) && empty($man_err) && empty($mem_err)&& empty($totalram_err)&& empty($type_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO MOTHER (man, name, freq, mem, type) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_man, $param_name, $param_totalram, $param_mem, $param_type);
            
            // Set parameters
            $param_man = $man;
            $param_name = $name;
            $param_totalram = $totalram;
			$param_mem = $mem;
            $param_type = $type;
            
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
    <title>Create Motherboard Record</title>
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
                        <h2>Create Motherboard Record</h2>
                    </div>
                    <p>Please fill this form and submit to add Motherboard record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($man_err)) ? 'has-error' : ''; ?>">
                            <label>Manufacturer</label>
                            <input type="text" name="man" class="form-control" value="<?php echo $man; ?>">
                            <span class="help-block"><?php echo $man_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Model</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($totalram_err)) ? 'has-error' : ''; ?>">
                            <label>Frequency</label>
                            <input type="text" name="totalram" class="form-control" value="<?php echo $totalram; ?>">
                            <span class="help-block"><?php echo $totalram_err;?></span>
                        </div>
						  <div class="form-group <?php echo (!empty($mem_err)) ? 'has-error' : ''; ?>">
                            <label>Memory size</label>
                            <input type="text" name="mem" class="form-control" value="<?php echo $mem; ?>">
                            <span class="help-block"><?php echo $mem_err;?></span>
                        </div>
						  <div class="form-group <?php echo (!empty($type_err)) ? 'has-error' : ''; ?>">
                            <label>Memory type</label>
                            <input type="text" name="type" class="form-control" value="<?php echo $type; ?>">
                            <span class="help-block"><?php echo $type_err;?></span>
                        </div>
						
				<?php		
						           $sql = "SELECT * FROM RAM";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Manufacturer</th>";
                                        echo "<th>Model</th>";
                                        echo "<th>Memory size</th>";
                                        echo "<th>Memory frequency</th>";
										echo "<th>Type</th>";
										echo "<th>Last changes</th>";
										echo "<th>Options</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['man'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['mem'] . "</td>";
										echo "<td>" . $row['freq'] . "</td>";
										echo "<td>" . $row['type'] . "</td>";
										echo "<td>" . $row['reg_date'] . "</td>";
                                        echo "<td>";

                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Select RAM' data-toggle='tooltip'><span class='glyphicon glyphicon glyphicon-arrow-left'></span></a>";
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
					?>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
