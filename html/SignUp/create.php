<?php
// Include config file
include "../Config/config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $first_name = $last_name = $email = "";
$username_err = $password_err = $confirm_password_err = $first_name_err = $last_name_err = $email_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
	
	//Validate First Name
	 if(empty(trim($_POST["first_name"]))){
        $first_name_err = "Please enter your first name.";     
    } else{
        $first_name = trim($_POST["first_name"]);
    }
	
	//Validate Last Name
	 if(empty(trim($_POST["last_name"]))){
        $last_name_err = "Please enter your last name.";     
    } else{
        $last_name = trim($_POST["last_name"]);
    }
	 if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email.";     
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
	
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($first_name_err) && empty($last_name_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, first_name, last_name, email, password) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_first_name, $param_last_name, $param_email, $param_password);
            
            // Set parameters
            $param_username = $username;
			$param_first_name = $first_name;
			$param_last_name = $last_name;
			$param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
				session_start();
				$_SESSION['email'] = $email;
                header("location:/validate.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../Styles/emailAlias.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body class="loginBody">
	<img src="../Styles/Logo.png" alt="Logo" style="width:50%;">
    <div>
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
		<p> After creating your account an email will be sent to the one provided for email verification </p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
               
                <input type="text" name="username" placeholder = "Username" class="form-control" value="<?php echo $username; ?>"> </br>
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>  
			 <div class="form-group <?php echo (!empty($first_name_err)) ? 'has-error' : ''; ?>">
               
                <input type="text" name="first_name" placeholder = "First Name" class="form-control" value="<?php echo $first_name; ?>"> </br>
                <span class="help-block"><?php echo $first_name_err; ?></span>
            </div> 
			 <div class="form-group <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="last_name" placeholder = "Last Name" class="form-control" value="<?php echo $last_name; ?>"> </br>
                <span class="help-block"><?php echo $last_name_err; ?></span>
            </div> 
	
			 <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="email" placeholder = "Email" class="form-control" value="<?php echo $email; ?>"> </br>
                <span class="help-block"><?php echo $email_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
               
                <input type="password" name="password" placeholder="Password" class="form-control" value="<?php echo $password; ?>"> </br>
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" value="<?php echo $confirm_password; ?>"> </br>
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
			
			
            <div class="form-group">
                <input type="submit" class="submitButtons" value="Submit">
                <input type="reset" class="submitButtons" value="Reset">
            </div>
            <p>Already have an account? <a href="../Login/Login.php">Login here</a>.</p>
        </form>

    </div>    
</body>
</html>