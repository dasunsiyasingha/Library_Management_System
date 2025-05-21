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
  <title>Aboutus</title>

</head>

<body>
  <?php include("../components/navbar.php") ?>

  <!-- Header Section -->
  <div class="bgcolor text-white py-5">
    <div class="container text-left">
      <h1 class="mb-1">About Us</h1>
    </div>
  </div>

  <!-- Image Section -->
  <div class="container mt-4">
    <div class="row align-items-center">
      
      <div class="col-md-4">
        <img src="../assets/img/libraryBooks.jpg" alt="Library Image" class="img-fluid custom-rounded">
      </div>
      <!-- Text Column -->
      
      <!-- About Us Text section-->
      <div class="col-md-8 small-paragraph">
        <p style="text-align: justify;">
          Our online library management system is designed to enhance the accessibility and efficiency of
          library resources. We provide an intuitive platform for users to easily search, borrow, and manage their
          library accounts.
          For librarians, our system simplifies cataloging, tracking, and reporting, streamlining daily operations.
          With features such as digital lending, user-friendly interfaces, and robust search functions, we aim to create
          a seamless experience for both patrons and staff. Our mission is to foster a love for reading and learning by
          making knowledge readily available to everyone, anytime and anywhere.
        </p>

      </div>
    </div>
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