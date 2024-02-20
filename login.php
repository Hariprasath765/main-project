<?php
# Initialize session
session_start();

# Check if user is already logged in, If yes then redirect him to index page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == TRUE) {
  echo "<script>" . "window.location.href='./'" . "</script>";
  exit;
}

# Include connection
require_once "./config.php";

# Define variables and initialize with empty values
$user_login_err = $user_password_err = $login_err = "";
$user_login = $user_password = "";

# Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty(trim($_POST["user_login"]))) {
    $user_login_err = "Please enter your username or an email id.";
  } else {
    $user_login = trim($_POST["user_login"]);
  }

  if (empty(trim($_POST["user_password"]))) {
    $user_password_err = "Please enter your password.";
  } else {
    $user_password = trim($_POST["user_password"]);
  }

  # Validate credentials 
  if (empty($user_login_err) && empty($user_password_err)) {
    # Prepare a select statement
    $sql = "SELECT id, username, password FROM users WHERE username = ? OR email = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
      # Bind variables to the statement as parameters
      mysqli_stmt_bind_param($stmt, "ss", $param_user_login, $param_user_login);

      # Set parameters
      $param_user_login = $user_login;

      # Execute the statement
      if (mysqli_stmt_execute($stmt)) {
        # Store result
        mysqli_stmt_store_result($stmt);

        # Check if user exists, If yes then verify password
        if (mysqli_stmt_num_rows($stmt) == 1) {
          # Bind values in result to variables
          mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

          if (mysqli_stmt_fetch($stmt)) {
            # Check if password is correct
            if (password_verify($user_password, $hashed_password)) {

              # Store data in session variables
              $_SESSION["id"] = $id;
              $_SESSION["username"] = $username;
              $_SESSION["loggedin"] = TRUE;

              # Redirect user to index page
              echo "<script>" . "window.location.href='./'" . "</script>";
              exit;
            } else {
              # If password is incorrect show an error message
              $login_err = "The email or password you entered is incorrect.";
            }
          }
        } else {
          # If user doesn't exists show an error message
          $login_err = "Invalid username or password.";
        }
      } else {
        echo "<script>" . "alert('Oops! Something went wrong. Please try again later.');" . "</script>";
        echo "<script>" . "window.location.href='./login.php'" . "</script>";
        exit;
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
      width:100vw;
      height:100vh;
      background-image:url(./img1.jpg);
      background-position: center;
            background-size: cover;
            background-repeat: no-repeat;   
    }
    .form-wrap{
      
      position: relative;  
      border-radius:20px;
      box-shadow:0 0 12px black;
      overflow:hidden;
      padding:50px;
      margin:70px auto;
      width:400px;
      height:450px;
      
    }
    .form-wrap .blur{
      position: absolute;
      width:100%;
      height:100%;
      top:0;
      left:0;
      z-index: -1;
      background:teal;
      
    }
    .form-wrap h1{
      position: relative;
      top:-20px;
      text-align:center;
      z-index: 8;
    }
    .form-wrap h3{
       text-align:center;
    }
    .form-wrap input:hover{
       box-shadow:0 0 20px red;
    }
    .mb-3{
      margin-top:20px;
      position: relative;
    }
    .mb-3 label{
      border-radius:20px;
      text-align:center;
      width:130px;
      position:absolute;
      top:12px;
      left:10px
    }
    .mb-3 input{
      background:transparent;
      outline:none;
      border:1px solid blaack;
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
  .mb-2{
      margin-top:10px;
      position: relative;
      margin:20px 0 20px 0;
    }
    .mb-2 label{
      width:75px;
      text-align:center;
      border-radius:20px;
      position:absolute;
      top:12px;
      left:10px
    }
    .mb-2 input{
      background:transparent;
      outline:none;
      border:1px solid blaack;
      border-radius:20px;
      width:100%;
      padding:15px;
    }
    .mb-2 input:focus~ label{
      background:darkred; 
       top:-10px;
       color:aliceblue;
       transition:.5s;
    }
    .mb-2 input:valid~ label{
      background:darkred; 
       top:-10px;
       color:aliceblue;
    }
  .sub{
     margin-top:50px;
     margin-bottom:10px;
     border-radius:10px;
     width:100%;
     height:45px;
     position:relative;
  }
  .sub1{
      position:absolute;
      border-radius:20px;
      cursor:pointer;
      width:100%;
      height:100%;
      border:1px solid blaack;
  }
  .sub1:hover{
      transition:.5s;
      color:aliceblue;
      background:crimson;
  }
  form a{
    color:black;
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
        <?php
        if (!empty($login_err)) {
          echo "<div class='alert alert-danger'>" . $login_err . "</div>";
        }
        ?>
        <div class="form-wrap border rounded p-4">
          <div class="blur"></div>
          <h1>Log In</h1>
          <h3>Please login to continue</h3>
          <!-- form starts here -->
          <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate autocomplete="off">
            <div class="mb-3">
              <input type="text" class="form-control" name="user_login" id="user_login" value="<?= $user_login; ?>" required>
              <label for="user_login" class="form-label">Email or username</label>

              <small class="text-danger"><?= $user_login_err; ?></small>
            </div>
            <div class="mb-2">
              <input type="password" class="form-control" name="user_password" id="password" required>
              <label for="password" class="form-label">Password</label>
              <small class="text-danger"><?= $user_password_err; ?></small>
            </div>
            <div class="mb-3form-check">
              <input type="checkbox" class="form-check-input" id="togglePassword">
              <label for="togglePassword" class="form-check-label">Show Password</label>
            </div>
            <div class="sub">
              <input type="submit" class="sub1" name="submit" value="Log In">
            </div>
            <h3 class="mb-0">Don't have an account ? <a href="./register.php">Sign Up</a></h3>
          </form>
          <!-- form ends here -->
        </div>
      </div>
    </div>
  </div>
</body>
</html>