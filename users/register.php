<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create an Account</title>
  <link href="../assets/css/style.css" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <!-- LineIcons CSS -->
  <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css">
  <style>
    body {
      background-color: #f8f9fa; /* Light gray background */
    }
    .container {
      margin-top: 10px;
    }
    .header {
      background-color: #6c757d; /* Match green header */
      color: white;
      padding: 10px;
      text-align: center;
      font-weight: bold;
      border-radius: 10px;

    }
    .form-section {
      padding: 20px;
    }
    .btn-custom {
      width: 150px;
      margin-top: 15px;
    }
  </style>
</head>

<body>
  <?php include("../components/navbar.php") ?>
  <div class="container">
     <div id="liveAlertPlaceholder" class="mt-4"></div>
    <!-- Header section -->
    <div class="header">CREATE AN ACCOUNT</div>

    <!-- Form Section -->
    <div class="row justify-content-center">
      <div class="col-md-6 form-section">
        <form method="POST">
          <div class="mb-3">
            <label for="fullname" class="form-label">
              <i class="lni lni-user"></i> User Name
            </label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Enter user name">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">
              <i class="lni lni-envelope"></i> Email Address
            </label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">
              <i class="lni lni-key"></i> Password
            </label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
          </div>
          <div class="mb-3">
            <label for="confirm-password" class="form-label">
              <i class="lni lni-lock"></i> Confirm Password
            </label>
            <input type="password" class="form-control" name="confirm-password" id="confirm-password" placeholder="Confirm password">
          </div>
          <button type="submit" name="register_user" class="btn btn-secondary btn-custom">Create Account</button>
        </form>
      </div>
    </div>
  </div>

  <script>
  //FOR ALERT BOX
      const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
      const appendAlert = (message, type) => {
          const wrapper = document.createElement('div')
          wrapper.innerHTML = [
              `<div class="alert alert-${type} alert-dismissible text-${type} rounded-3 " role="alert">`,
              `   <div>${message}</div>`,
              '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
              '</div>'
          ].join('')

          alertPlaceholder.append(wrapper)
      }
  </script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
    if(isset($_POST['register_user'])){
        
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];

        if($password == $confirm_password){
          $hashPswd = password_hash($password, PASSWORD_DEFAULT);
           $sql="INSERT INTO  user(username, email, password ) VALUES('$username','$email','$hashPswd')";
          if (mysqli_query($conn, $sql)) {
              // echo "New record created successfully";
              echo "<script>appendAlert('Nice, Register Successfully !', 'success');</script>";
          } else {
              // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
              echo "<script>appendAlert('Error, Student Details Add Failed !', 'danger');</script>";
          }
        }

        

       

    }
?>
