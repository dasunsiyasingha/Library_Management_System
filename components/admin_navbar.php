
<?php
  session_start();
  error_reporting(0);


 include('../includes/config.php');

if ($_SESSION['adminLogin'] == '') {
    header('Location: ../home/login.php');
    exit();
}

?>
<link href="../assets/css/nav_style.css" rel="stylesheet">
<style>
  .active{
    font-weight: bold;
  }
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

    <div class="collapse navbar-collapse" id="adminNavbar">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a href="index.php" class="nav-link <?= isActive('index.php') ?>">Dashboard</a>
        </li>
        <li class="nav-item">
          <a href="manage_books.php" class="nav-link <?= isActive('manage_books.php') ?>">Manage Books</a>
        </li>
        <li class="nav-item">
          <a href="manage_ebooks.php" class="nav-link <?= isActive('manage_ebooks.php') ?>">Manage E-Books</a>
        </li>
        <li class="nav-item">
          <a href="inventory_bk.php" class="nav-link <?= isActive('inventory_bk.php') ?>">Inventory Book</a>
        </li>
        <li class="nav-item">
          <a href="inventory_ebk.php" class="nav-link <?= isActive('inventory_ebk.php') ?>">Inventory E-Book</a>
        </li>
      </ul>
        <a href="../home/logout.php" class="btn btn-outline-danger">Logout</a>
    </div>
  </div>
</nav>
