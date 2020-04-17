<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$persName =$persSurname=$persPhone=$persEmail = "";
$persName_err =$persSurname_err=$persPhone_err =$persEmail_err = "";
/*
$educName =$educFac=$educProg=$educLevel=educTime = "";
$educName_err =$educFac_err=$educProg_err =$educLevel_err=$educTime_err = "";
$jobTitle =$jobCompany=$jobLoad=$jobTime = "";
$jobTitle_err =$jobCompany_err=$jobLoad_err =$jobTime_err = "";*/

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 	$input_persName = trim($_POST["persName"]);
	$input_persSurname = trim($_POST["persSurname"]);
	$input_persPhone = trim($_POST["persPhone"]);
	$input_persEmail = trim($_POST["persEmail"]);
	
/*   $input_educName = trim($_POST["EducName"]);
	$input_educFac = trim($_POST["EducFac"]);
	$input_educProg = trim($_POST["EducProg"]);
	$input_educLevel = trim($_POST["EducLevel"]);
	$input_educTime = trim($_POST["EducTime"]);
	
	$input_jobTitle = trim($_POST["JobTitle"]);
	$input_jobCompany = trim($_POST["JobCompany"]);
	$input_jobLoad = trim($_POST["JobLoad"]);
	$input_jobTime = trim($_POST["JobTime"]);*/
//	$input_educTime = trim($_POST["EducTime"]);

	$persName = $input_persName;
	$persSurname = $input_persSurname;
	$persPhone = $input_persPhone;
	$persEmail = $input_persEmail;
	
 /*   $educName = $input_educName;
	$educFac = $input_educFac;
	$educProg = $input_educProg;
	$educLevel = $input_educLevel;
	$educTime = $input_educTime;
	
	$jobTitle = $input_jobTitle;
	$jobCompany = $input_jobCompany;
	$jobLoad = $input_jobLoad;
	$jobTime = $input_jobTime;*/
	//$job = $input_job;
	
	// Validate name
	
    $input_persName = trim($_POST["persName"]);
    if(empty($input_persName)){
        $persName_err = "Lūdzu ievadiet vārdu.";
    } elseif(!filter_var($input_persName, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $persName_err = "Please enter a valid name.";
    } else{
        $persName = $input_persName;
    }
    
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
    if(empty($persName_err) && empty($persSurname_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO Persons (persName, persSurname, persPhone, persEmail) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_persName, $param_persSurname, $param_persPhone, $param_persEmail);
            
            // Set parameters
            $param_persName = $persName;
            $param_persSurname = $persSurname;
			$param_persPhone = $persPhone;
            $param_persEmail = $persEmail;
			//$param_job = $job;
            
                        
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Kaut kas nogāja greizi. Lūdzu mēģiniet atkal.";
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
    <title>Pievienot jaunu CV</title>
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
                        <h2>Pievienot jaunu CV</h2>
                    </div>
                    <p>Lūdzu aizpildiet laukus un sūtiet uz datubāzi.</p>
                    <p><h2>Pamatdati</h2></p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                           <div class="form-group <?php echo (!empty($persName_err)) ? 'has-error' : ''; ?>">
                            <label>Vārds</label>
                            <input type="text" name="persName" class="form-control" value="<?php echo $persName; ?>">
                            <span class="help-block"><?php echo $persName_err;?></span>
                        </div> 
						<div class="form-group <?php echo (!empty($persSurname_err)) ? 'has-error' : ''; ?>">
                            <label>Uzvārds</label>
                            <input type="text" name="persSurname" class="form-control" value="<?php echo $persSurname; ?>">
                            <span class="help-block"><?php echo $persSurname_err;?></span>
                        </div>
                    	<div class="form-group <?php echo (!empty($persPhone_err)) ? 'has-error' : ''; ?>">
                            <label>Tālrunis</label>
                            <input type="text" name="persPhone" class="form-control" value="<?php echo $persPhone; ?>">
                            <span class="help-block"><?php echo $persPhone_err;?></span>
                        </div>
                  
                    	<div class="form-group <?php echo (!empty($persEmail_err)) ? 'has-error' : ''; ?>">
                            <label>E-pasts</label>
                            <input type="text" name="persEmail" class="form-control" value="<?php echo $persEmail; ?>">
                            <span class="help-block"><?php echo $persEmail_err;?></span>
                        </div>
                        
                                                <p><h2>Izglītība</h2></p>
                        <div class="form-group <?php echo (!empty($educName_err)) ? 'has-error' : ''; ?>">
                            <label>Izglītības iestādes nosaukums</label>
                            <input type="text" name="educName" class="form-control" value="<?php echo $educName; ?>">
                            <span class="help-block"><?php echo $educName_err;?></span>
                        </div>
                                               <div class="form-group <?php echo (!empty($educFac_err)) ? 'has-error' : ''; ?>">
                            <label>Fakultāte</label>
                            <input type="text" name="educFac" class="form-control" value="<?php echo $educFac; ?>">
                            <span class="help-block"><?php echo $educFac_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($educProg_err)) ? 'has-error' : ''; ?>">
                            <label>Studiju virziens</label>
                            <input type="text" name="educProg" class="form-control" value="<?php echo $educProg; ?>">
                            <span class="help-block"><?php echo $educProg_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($educLevel_err)) ? 'has-error' : ''; ?>">
                            <label>Izglītības līmenis</label>
                            <input type="text" name="educLevel" class="form-control" value="<?php echo $educLevel; ?>">
                            <span class="help-block"><?php echo $educlevel_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($educTime_err)) ? 'has-error' : ''; ?>">
                            <label>Mācību laiks</label>
                            <input type="text" name="educTime" class="form-control" value="<?php echo $educTime; ?>">
                            <span class="help-block"><?php echo $educTime_err;?></span>
                        </div>
                                                   <p><h2>Darba pieredze</h2></p>
                        <div class="form-group <?php echo (!empty($jobCompany_err)) ? 'has-error' : ''; ?>">
                            <label>Darba vietas nosaukums</label>
                            <input type="text" name="jobCompany" class="form-control" value="<?php echo $jobCompany; ?>">
                            <span class="help-block"><?php echo $jobCompany_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($jobTitle_err)) ? 'has-error' : ''; ?>">
                            <label>Amata nosaukums</label>
                            <input type="text" name="jobTitle" class="form-control" value="<?php echo $jobTitle; ?>">
                            <span class="help-block"><?php echo $jobTitle_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($jobLoad_err)) ? 'has-error' : ''; ?>">
                            <label>Darba slodze</label>
                            <input type="text" name="jobLoad" class="form-control" value="<?php echo $jobLoad; ?>">
                            <span class="help-block"><?php echo $jobLoad_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($jobTime_err)) ? 'has-error' : ''; ?>">
                            <label>Kopā nostrādātais laiks</label>
                            <input type="text" name="jobTime" class="form-control" value="<?php echo $jobTime; ?>">
                            <span class="help-block"><?php echo $jobTime_err;?></span>
                        </div>
               
                        
                        

                
                    
                        <input type="submit" class="btn btn-primary" value="Sūtīt">
                        <a href="index.php" class="btn btn-default">Atcelt</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
