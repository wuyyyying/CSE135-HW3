<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $admin = $log_access = $error_access = $activity_access = "";
$email_err = $admin_err = $log_access_err = $error_access_err = $activity_access_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];

    // Validate email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter a email.";
    } elseif(!filter_var($input_email, FILTER_VALIDATE_EMAIL)){
        $email_err = "Please enter a valid email.";
    } else{
        $email = $input_email;
    }

    // Validate admin
    $input_admin = trim($_POST["admin"]);
    if(empty($input_admin)){
        $admin_err = "Please enter an admin, yes or no.";
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
    if(empty($email_err) && empty($admin_err) && empty($log_access_err) && empty($error_access_err) && empty($activity_access_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET email=?, admin=?, log_access=?, error_access=?, activity_access=? WHERE id=?";

        if($stmt = mysqli_prepare($db, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "siiiii", $param_email, $param_admin, $param_log_access, $param_error_access, $param_activity_access, $param_id);
            
            // Set parameters?
            $param_email = $email;
            $param_admin = $admin;
            $param_log_access = $log_access;
            $param_error_access = $error_access;
            $param_activity_access = $activity_access;
            $param_id = $id;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: backend_admin.php");
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
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM users WHERE id = ?";
        if($stmt = mysqli_prepare($db, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $email = $row["email"];
                    $admin = $row["admin"];
                    $log_access = $row["log_access"];
                    $error_access = $row["error_access"];
                    $activity_access = $row["activity_access"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    //header("location: error.php");
                    header("location: backend_admin.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($db);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        //header("location: error.php");
        header("location: backend_admin.php");
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
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_err;?></span>
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

                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="backend_admin.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
