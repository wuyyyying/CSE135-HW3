<?php
// Include config file
require_once "/var/www/html/config.php";

// Define variables and initialize with empty values
$email = $password = $admin = $log_access = $error_access = $activity_access =  "";
$email_err = $password_err = $admin_err = $log_access_err = $error_access_err = $activity_access_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
// if(!empty($_SERVER["REQUEST_METHOD"])){
    // Validate email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter an email.";
    } elseif(!filter_var($input_email, FILTER_VALIDATE_EMAIL)){
        $email_err = "Please enter a valid email.";
    } else{
        $email = $input_email;
    }
    
    // Validate password 
    $input_password = trim($_POST["password"]);
    if(empty($input_password)){
        $password_err = "Please enter an password.";     
    } else{
        $password = md5($input_password);
    }

    // Validate admin
    $input_admin = trim($_POST["admin"]);
    if(empty($input_admin)){
        $admin_err = "Please enter an admin.";     
    } else{
        if ($input_admin == "Yes") {
	    $admin = 1;
	}
        else {
	    $admin = 0;
	}
    }
    
    // Validate log_access
    $input_log_access = trim($_POST["log_access"]);
    if(empty($input_log_access)){
        $log_access_err = "Please enter log access, yes or no.";
    } else{
        if ($input_log_access == "Yes") {
	    $log_access = 1;
	}
        else {
	    $log_access = 0;
	}
    }

    // Validate error_access
    $input_error_access = trim($_POST["error_access"]);
    if(empty($input_error_access)){
        $error_access_err = "Please enter error access, yes or no.";
    } else{
        if ($input_error_access == "Yes") {
	    $error_access = 1;
	}
        else {
	    $error_access = 0;
	}
    }

    // Validate activity_access
    $input_activity_access = trim($_POST["activity_access"]);
    if(empty($input_activity_access)){
        $activity_access_err = "Please enter activity access, yes or no.";
    } else{
        if ($input_activity_access == "Yes") {
	    $activity_access = 1;
	}
        else {
	    $activity_access = 0;
	}
    }

    // Check input errors before inserting in database
    if(empty($email_err) && empty($password_err) && empty($admin_err)&& empty($log_access_err)&& empty($log_access_err)&& empty($error_access_err)&& empty($activity_access_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO users (email, password, admin, log_access, error_access, activity_access) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($db, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssiiii", $param_email, $param_password, $param_admin, $param_log_access, $param_error_access, $param_activity_access);
            
            // Set parameters
            $param_email = $email;
            $param_password = $password;
            $param_admin = $admin;
            $param_log_access = $log_access;
            $param_error_access = $error_access;
            $param_activity_access = $activity_access;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: http://157.230.57.144:8081/backend_admin");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($db);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control"><?php echo $password; ?></textarea>
                            <span class="help-block"><?php echo $password_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($admin_err)) ? 'has-error' : ''; ?>">
                            <label>Admin</label>
                            <select class="form-control" name="admin">
                               <option <?php if($admin==0){echo "selected";}?>>No</option>
                               <option <?php if($admin==1){echo "selected";}?>>Yes</option>
                            </select>
                            <span class="help-block"><?php echo $admin_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($log_access_err)) ? 'has-error' : ''; ?>">
                            <label>Log Access</label>
                            <select class="form-control" name="log_access">
                               <option <?php if($log_access==0){echo "selected";}?>>No</option>
                               <option <?php if($log_access==1){echo "selected";}?>>Yes</option>
                            </select>
                            <span class="help-block"><?php echo $log_access_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($error_access_err)) ? 'has-error' : ''; ?>">
                            <label>Error Access</label>
                            <select class="form-control" name="error_access">
                               <option <?php if($error_access==0){echo "selected";}?>>No</option>
                               <option <?php if($error_access==1){echo "selected";}?>>Yes</option>
                            </select>
                            <span class="help-block"><?php echo $error_access_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($activity_access_err)) ? 'has-error' : ''; ?>">
                            <label>Activity Access</label>
                            <select class="form-control" name="activity_access">
                               <option <?php if($activity_access==0){echo "selected";}?>>No</option>
                               <option <?php if($activity_access==1){echo "selected";}?>>Yes</option>
                            </select>
                            <span class="help-block"><?php echo $activity_access_err;?></span>
                        </div>
 
 
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="http://157.230.57.144:8081/backend_admin.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
