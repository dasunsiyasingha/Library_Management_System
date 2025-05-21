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
  <title>Home</title>
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

  <!-- Banner Section -->
  <div class="banner">
    <img src="../assets/img/banner.jpg" alt="Library Management System">
  </div>

  <!----- card section ------>
  <div class="row row-cols-1 row-cols-md-5 g-4 justify-content-center">
  <?php 
    $sql="SELECT * FROM book_details";
    if ($result = $conn->query($sql)) {
      while($row = $result->fetch_assoc()){
        echo '
                <div class="col">
                  <div class="card h-100">
                  <a href="../users/bookdetails.php?bookId='.$row['bookId'].'" class="text-decoration-none" style="color: #000000;">
                    <img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">'.$row['name'].'</h5>
                      <p class="card-text">'.$row['info'].'</p>
                    </div>
                    </a>
                  </div>
                </div>
              ';
      }
    }
  ?>
</div>
  <!-- footer section -->
  <?php include("../components/footer.php") ?>

</body>

</html>