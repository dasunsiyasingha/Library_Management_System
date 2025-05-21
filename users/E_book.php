<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="../assets/css/style.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <title>E-Books</title>
</head>

<body>
  <?php include("../components/navbar.php") ?>
  <!-- Search Bar -->
  <div class="container my-3 justify-content-center">
    <form class="d-flex">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-primary" type="submit">Search</button>
    </form>
  </div>

  <!----- card section ------>

  <div class="row row-cols-1 row-cols-md-5 g-4 justify-content-center">
    <?php 
      $sql="SELECT * FROM ebook_details";
      if ($result = $conn->query($sql)) {
        while($row = $result->fetch_assoc()){
    ?>
    <div class="col">
      <a href="../users/E_bookdetails.php?ebookId=<?php echo $row['ebookId'] ?>" class="text-decoration-none">
      <div class="card h-100">
        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['image']) ?>" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title"><?php echo $row['name'] ?></h5>
          <p class="card-text"><?php echo $row['info'] ?></p>
        </div>
      </div>
      </a>
    </div>
    <?php }}?>
    
  </div>

  <!-- footer section -->
  <footer class="bg-dark py-5 mt-5">
    <div class="container text-light text-center">
      <p class="display-7 mb-5">Online Books Management System</p>
      <small class="text-white-50">Copyright @2024 by ByteGrad. All rights reserved.<br>Tel: +94 77 631 9567 | +94 76
        786 7053</small>
    </div>

  </footer>

</body>

</html>