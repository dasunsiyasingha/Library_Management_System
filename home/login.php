<?php
  session_start();
  error_reporting(0);

  include('../includes/config.php');

  if($_SESSION['userLogin']!=''){
    $_SESSION['userLogin']='';
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="../assets/css/login.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <title>Login</title>
</head>

<body>
  <?php include("../components/navbar.php") ?>

  <div class="container">
    <div class="header">SIGN IN OR REGISTER</div>

    <div class="row">
      <!-- Login Section -->
      <div class="col-md-6 form-section">
        <small class="form-check-label text-danger" id="notice" style="visibility: hidden;">
            Invalid Details.. Please Try Again!
        </small>
        <form method="POST" id="loginForm">
          <div class="mb-3">
            <label for="role" class="form-label">
              <i class="lni lni-user"></i> Select Role
            </label>
            <select class="form-control" name="role" id="role">
              <option value="user"> User</option>
              <option value="admin"> Admin</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">
              <i class="lni lni-user"></i> Username
            </label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">
              <i class="lni lni-key"></i> Password
            </label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
          </div>
          <a href="#" class="text-decoration-none">Forgot your password?</a>
          <button type="submit" name="login" class="btn btn-secondary btn-custom">Login</button>
        </form>
      </div>

      <!-- Registration Section -->
      <div class="col-md-6 register-section">
        <h6>NEW HERE?</h6>
        <p>Registration is free and easy!</p>
        <ul class="list-unstyled">
          <li> Faster checkout</li>
        </ul>
        <button onclick="location.href='../users/register.php'" class="btn btn-secondary btn-custom">Create an Account</button>
      </div>
    </div>
  </div>
 
</body>
</html>

<?php
    if(isset($_POST['login'])){
      $logname = $_POST['username'];
      $password = $_POST['password'];
      $role = $_POST['role'];

      // $hashPswd = password_hash($password, PASSWORD_DEFAULT);
      // echo $hashPswd;
  
      if(empty($logname)){
        echo "<script type='text/javascript'>
        var notice = document.getElementById('notice');
        notice.innerHTML = 'Please enter Student ID';
        notice.style.visibility = 'visible';
        </script>";
  
      }else if(empty($password)){
        echo "<script type='text/javascript'>
        var notice = document.getElementById('notice');
        notice.innerHTML = 'Please enter password';
        notice.style.visibility = 'visible';
        </script>";
  
      }else{
        if($role == "user"){
          $sql = "SELECT username, password FROM user WHERE username=?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('s',$logname);
          $stmt->execute();
          $stmt->bind_result($dbusername,$dbpassword);
          $stmt->fetch();
          $stmt->close();

          if($dbpassword && password_verify($password, $dbpassword)){
            $_SESSION['userLogin'] = $logname;
            echo "<script type = 'text/javascript'>document.location = 'index.php';</script>";
          }else{
            echo "<script type='text/javascript'>document.getElementById('notice').style.visibility = 'visible';</script>";
          }
        }else if($role == "admin"){

          $sql = "SELECT username, password FROM admin WHERE username=?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('s',$logname);
          $stmt->execute();
          $stmt->bind_result($dbAdminName,$dbpassword);
          $stmt->fetch();
          $stmt->close();
          if($dbpassword && password_verify($password, $dbpassword)){
            $_SESSION['adminLogin'] = $logname;
            echo "<script type = 'text/javascript'>document.location = '../admin/manage_books.php';</script>";
          }else{
            echo "<script type='text/javascript'>document.getElementById('notice').style.visibility = 'visible';</script>";
          }
        }
       
      }
    }
  ?>
