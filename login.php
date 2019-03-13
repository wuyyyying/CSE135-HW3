<!doctype html>
<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myemail = mysqli_real_escape_string($db,$_POST['email']);
      $mypassword = md5(mysqli_real_escape_string($db,$_POST['password']));
      
      $sql = "SELECT id FROM users WHERE email = '$myemail' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myemail and $mypassword, table row must be 1 row
		
      if($count == 1) {
        // session_register("myemail");
         $_SESSION['login_user'] = $myemail;
         header("location: http://157.230.57.144:8081/index.php");
      }else {
         $error = "Your Login Email or Password is invalid";
      }
   }
?>
<html class="no-js" lang="">

<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>CSE135 | Login</title>
   <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <link rel="manifest" href="site.webmanifest">
   <link rel="apple-touch-icon" href="icon.png">
   <!-- Place favicon.ico in the root directory -->

   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
      crossorigin="anonymous">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns"
      crossorigin="anonymous">
   <link rel="stylesheet" href="http://157.230.57.144:8081/login.css">
   <link rel="stylesheet" href="http://157.230.57.144:8081/normalize.css">
   <link rel="stylesheet" href="http://157.230.57.144:8081/main.css">

   <script>
      // redirect to home page if logged in
      if (sessionStorage.getItem('loginStatus')) {
         location.href = "http://157.230.57.144:8081/backend";
         exit;
      }
   </script>
</head>

<body>
   <div class="container">
      <div class="center-screen-ls">
         <h1>Log in to CSE135</h1>
         <form action = "" method = "post">
            <p class="text-center invisible" id="loginError">Invalid email or password.</p>
            <div class="form-group row">
               <label for="inputEmail3" class="col-sm-3 col-form-label" name = "emailLabel">Email</label>
               <div class="col-sm-9">
                  <input type="email" class="form-control" id="emailInput" name="email" placeholder="Email">
               </div>
            </div>
            <div class="form-group row">
               <label for="inputPassword3" class="col-sm-3 col-form-label" name = "passwordLabel">Password</label>
               <div class="col-sm-9">
                  <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Password">
               </div>
            </div>
            <div class="form-group row">
               <div class="col-sm-12 text-center">
                  <button id="loginBtn" class="btn btn-success">Log In</a>
               </div>
            </div>
         </form>
      </div>

   </div>

   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
      crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
      crossorigin="anonymous"></script>

</body>

</html>
