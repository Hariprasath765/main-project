<?php
# Include connection
require_once "./config.php";

# Define variables and initialize with empty values
$username_err = $email_err = $password_err = "";
$username = $email = $password = "";

# Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  # Validate username
  if (empty(trim($_POST["username"]))) {
    $username_err = "Please enter a username.";
  } else {
    $username = trim($_POST["username"]);
    if (!ctype_alnum(str_replace(array("@", "-", "_"), "", $username))) {
      $username_err = "Username can only contain letters, numbers and symbols like '@', '_', or '-'.";
    } else {
      # Prepare a select statement
      $sql = "SELECT id FROM users WHERE username = ?";

      if ($stmt = mysqli_prepare($link, $sql)) {
        # Bind variables to the statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        # Set parameters
        $param_username = $username;

        # Execute the prepared statement 
        if (mysqli_stmt_execute($stmt)) {
          # Store result
          mysqli_stmt_store_result($stmt);

          # Check if username is already registered
          if (mysqli_stmt_num_rows($stmt) == 1) {
            $username_err = "This username is already registered.";
          }
        } else {
          echo "<script>" . "alert('Oops! Something went wrong. Please try again later.')" . "</script>";
        }

        # Close statement 
        mysqli_stmt_close($stmt);
      }
    }
  }

  # Validate email 
  if (empty(trim($_POST["email"]))) {
    $email_err = "Please enter an email address";
  } else {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_err = "Please enter a valid email address.";
    } else {
      # Prepare a select statement
      $sql = "SELECT id FROM users WHERE email = ?";

      if ($stmt = mysqli_prepare($link, $sql)) {
        # Bind variables to the statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_email);

        # Set parameters
        $param_email = $email;

        # Execute the prepared statement 
        if (mysqli_stmt_execute($stmt)) {
          # Store result
          mysqli_stmt_store_result($stmt);

          # Check if email is already registered
          if (mysqli_stmt_num_rows($stmt) == 1) {
            $email_err = "This email is already registered.";
          }
        } else {
          echo "<script>" . "alert('Oops! Something went wrong. Please try again later.');" . "</script>";
        }

        # Close statement
        mysqli_stmt_close($stmt);
      }
    }
  }

  # Validate password
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter a password.";
  } else {
    $password = trim($_POST["password"]);
    if (strlen($password) < 8) {
      $password_err = "Password must contain at least 8 or more characters.";
    }
  }

  # Check input errors before inserting data into database
  if (empty($username_err) && empty($email_err) && empty($password_err)) {
    # Prepare an insert statement
    $sql = "INSERT INTO users(username, email, password) VALUES (?, ?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
      # Bind varibales to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);

      # Set parameters
      $param_username = $username;
      $param_email = $email;
      $param_password = password_hash($password, PASSWORD_DEFAULT);

      # Execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        echo "<script>" . "alert('Registeration completed successfully. Login to continue.');" . "</script>";
        echo "<script>" . "window.location.href='./login.php';" . "</script>";
        exit;
      } else {
        echo "<script>" . "alert('Oops! Something went wrong. Please try again later.');" . "</script>";
      }

      # Close statement
      mysqli_stmt_close($stmt);
    }
  }

  # Close connection
  mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User login system</title>
  <link rel="shortcut icon" href="./img/favicon-16x16.png" type="image/x-icon">
  <script defer src="./js/script.js"></script>
  <style>
     *{
       margin:0;
       padding:0;
       box-sizing:border-box;
    }
    body{
      color:white;
      width:100vw;
      height:100vh;
      background-image:url(./img2.jpg);
      background-position: center;
            background-size: cover;
            background-repeat: no-repeat;  
    }  
      .form-wrap{
        background:transparent;
        border-radius:30px;
        padding:30px;
        margin:50px auto;
         width:400px;
        border:1px solid black;
        position: relative;
        overflow:hidden;
        background:rebeccapurple;
    }
    .form-wrap .blur{
      position: absolute;
      width:100%;
      height:100%;
      top:0;
      left:0;
      z-index: -1;
      background:rebeccapurple;
      
    }
    .form-wrap h1,p{
      color:aliceblue;
        text-align:center;
    }
    .form-wrap h1{
      color:aliceblue;
      margin-bottom:5px;
    }
    
    .form-wrap input:hover{
       box-shadow:0 0 12px darkblue; 
    }
    .mb-3{
      margin-top:30px;
      position: relative;
    }
    .mb-3 label{
      width:80px;
      text-align:center;
      border-radius:20px;
      position:absolute;
      top:12px;
      left:10px;
    }
    .mb-3 input{
      background:transparent;
      outline:none;
      border:2px solid blaack;
      border-radius:20px;
      width:100%;
      padding:15px;
    }
    .mb-3 input:focus~ label{
      background:darkred; 
       top:-10px;
       color:aliceblue;
       transition:.5s;
    }
    .mb-3 input:valid~ label{
      background:darkred; 
      top:-10px;
      color:aliceblue;
    }

    .mb-3pass{
      margin-top:30px;
      position: relative;
      margin-bottom:50px;
    }
    .mb-3pass label{
      width:80px;
      border-radius:20px;
      text-align:center;
      position:absolute;
      top:12px;
      left:10px
    }
    .mb-3pass input{
      background:transparent;
      outline:none;
      border:2px solid blaack;
      border-radius:20px;
      width:100%;
      padding:15px;
    }
    .mb-3pass input:focus~ label{
      background:darkred; 
       top:-10px;
       color:aliceblue;
       transition:.5s;
    }
    .mb-3pass input:valid~ label{
      background:darkred; 
       top:-10px;
       color:aliceblue;
    }
    .mb-3email{
      margin-top:30px;
      position: relative;
      margin-bottom:40px;
    }
    .mb-3email label{
      width:105px;
      border-radius:20px;
      text-align:center;
      position:absolute;
      top:12px;
      left:10px
    }
    .mb-3email input{
      background:transparent;
      outline:none;
      border:2px solid blaack;
      border-radius:20px;
      width:100%;
      padding:15px;
    }
    .mb-3email input:focus~ label{
      background:darkred; 
       top:-10px;
       color:aliceblue;
       transition:.5s;
    }
    .mb-3email input:valid~ label{
      background:darkred; 
       top:-10px;
       color:aliceblue;
    }
    input[type="submit"]{
        cursor:pointer;
        font-size:17px;
        font-weight:bolder;
        margin-bottom:10px;
    }
    input[type="submit"]:hover{
      background:crimson;
      color:white;
    }
    form a{
      color:black;
      font-weight:bolder;
      text-decoration:none;
    }
    form a:hover{
        color:darkred;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row min-vh-100 justify-content-center align-items-center">
      <div class="col-lg-5">
        <div class="form-wrap border rounded p-4">
        <div class="blur"></div>
          <h1>Sign up</h1>
          <p>Please fill this form to register</p>
          <!-- form starts here -->
          <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate autocomplete="off">
            <div class="mb-3">
             
              <input type="text" class="form-control" name="username" id="username" value="<?= $username; ?>" required>
              <label for="username" class="form-label">Username</label>
              <small class="text-danger"><?= $username_err; ?></small>
            </div>
            <div class="mb-3email">         
              <input type="email" class="form-control" name="email" id="email" value="<?= $email; ?>" required>
              <label for="email" class="form-label">Email Address</label>
              <small class="text-danger"><?= $email_err; ?></small>
            </div>
            <div class="mb-3pass">
              <input type="password" class="form-control" name="password" id="password" value="<?= $password; ?>" required>
              <label for="password" class="form-label">Password</label>
              <small class="text-danger"><?= $password_err; ?></small>
            </div>
            <div class="mb-3form-check">
              <input type="checkbox" class="form-check-input" id="togglePassword">
              <label for="togglePassword" class="form-check-label">Show Password</label>
            </div>
            <div class="mb-3">
              <input type="submit" class="btn btn-primary form-control" name="submit" value="Sign Up">
            </div>
            <p class="mb-0">Already have an account ? <a href="./login.php">Log In</a></p>
          </form>
          <!-- form ends here -->
        </div>
      </div>
    </div>
  </div>
</body>
</html>