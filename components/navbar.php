<?php
  session_start();
  error_reporting(0);


 include('../includes/config.php');

  // if ($_SESSION['userLogin'] == '') {
  //   if(basename($_SERVER['PHP_SELF']) != "login.php"){
  //     header('Location: ../home/login.php');
  //     exit();
  //   }
  // }
?>

<style>
  .active{
    font-weight: bold;
  }
  <?php
    if($_SESSION['userLogin']!=''){
      $username = $_SESSION['userLogin'];
      echo '.logout-btn{
                display: block;
              }

            .login-btn{
                display: none;
              }';
    }else{
      $username = '';
      echo '.logout-btn{
              display: none;
            }

            .my-profile{
              display: none;
            }
                
            .login-btn{
              display: block;
            }';
    }

    
  ?>
</style>

<?php
  function isActive($page) {
      return basename($_SERVER['PHP_SELF']) === $page ? 'active' : '';
  }
?>

<nav class="navbar navbar-expand-lg navbar-light -bg">
    <div class="container"> 
      <a href="index.php" class="navbar-brand">
        <img src="../assets/img/logo.png" height="70" alt="CoolBrand">
      </a>

      <div class="collapse navbar-collapse gap-3" id="navbarCollapse">
        <div class="navbar-nav gap-3">
          <a href="../home/index.php" class="nav-item nav-link <?= isActive('index.php') ?>">HOME</a>
          <a href="../users/myprofile.php" class="nav-item nav-link my-profile <?= isActive('myprofile.php') ?>" >MY PROFILE</a>
          <a href="../users/E_book.php" class="nav-item nav-link <?= isActive('E_book.php') ?>">E-BOOKS</a>
          <a href="../home/Aboutus.php" class="nav-item nav-link <?= isActive('Aboutus.php') ?>">ABOUT US</a>
          <a href="../home/ContactUs.php" class="nav-item nav-link <?= isActive('ContactUs.php') ?>">CONTACT US</a>
        </div>
        <div class="navbar-nav ms-auto login-btn">
          <a href="../home/login.php" class="nav-item nav-link">Login</a>
        </div>
        <div class="navbar-nav ms-auto logout-btn">
          <a href="../home/logout.php" class="nav-item nav-link ">Log out</a>
        </div>
      </div>
    </div>
  </nav>

