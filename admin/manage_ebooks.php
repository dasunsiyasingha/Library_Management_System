<?php
    session_start();
    error_reporting(0);
    include('../includes/config.php');
    // if(strlen($_SESSION['alogin'])==0){ 
    //     header('location:../home/home.php');
    // }else{
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php include('../components/admin_navbar.php'); ?>
    <main class="flex-grow-1">
        <div class="container mt-5">
            <h4>Manage E-Books</h4>
            <div class="text-end mb-3">
                <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal"
                    data-bs-target="#addE_BookModal">Add New E-Book</button>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Book Name</th>
                        <th scope="col">image</th>
                        <th scope="col">Author</th>
                        <th scope="col" width=300;>info</th>
                        <th scope="col">binding</th>
                        <th scope="col">pages</th>
                        <th scope="col">publisher</th>
                        <th scope="col">Released Date</th>
                        <th scope="col">available</th>
                        <th scope="col">price</th>
                        <th scope="col">pdf Link</th>
                        <th scope="col" width=150;>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                          $sql="SELECT * FROM ebook_details";
                          if ($result = $conn->query($sql)) {
                            while($row = $result->fetch_assoc()){
                              echo '<tr role="row">';
                              echo '<td>'.$row['ebookId'].'</td>';
                              echo '<td>'.$row['name'].'</td>';
                              echo '<td><img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" width="100"/></td>';
                              echo '<td>'.$row['author'].'</td>';
                              echo '<td>'.$row['info'].'</td>';
                              echo '<td>'.$row['binding'].'</td>';
                              echo '<td>'.$row['pages'].'</td>';
                              echo '<td>'.$row['publisher'].'</td>';
                              echo '<td>'.$row['released_date'].'</td>';
                              echo $row['available']? '<td>YES</td>' : '<td>No</td>';
                              echo '<td>'.$row['price'].'</td>';
                              echo '<td><a href="' . $row['pdf_path'] . '" target="_blank">View PDF</a></td>';
                              echo '<td><button class="btn btn-sm btn-primary edit-ebook-btn" data-bs-toggle="modal" data-bs-target="#editE_BookModal"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editE_BookModal"
                                    data-id="'.$row['ebookId'].'"
                                    data-image="data:image/jpeg;base64,'.base64_encode($row['image']).'"
                                    data-name="'.htmlspecialchars($row['name']).'"
                                    data-author="'.htmlspecialchars($row['author']).'"
                                    data-info="'. htmlspecialchars($row['info']).'"
                                    data-binding="'.htmlspecialchars($row['binding']) .'"
                                    data-pages="'.$row['pages'].'"
                                    data-publisher="'.htmlspecialchars($row['publisher']).'"
                                    data-date="'.$row['released_date'].'"
                                    data-price="'.$row['price'].'"
                                    >Edit</button>

                                    <button class="btn btn-sm btn-danger delete-ebook-btn" data-bs-toggle="modal" data-bs-target="#deleteE_BookModal" data-name="'.$row['name'].'" data-id="'.$row['ebookId'].'" data-pdfpath="'.$row['pdf_path'].'"> delete </button></td> </tr>';
                            }
                          }
                          ?>
                </tbody>
            </table>
        </div>
        </div>
    </main>
    <?php include('e_book_functions.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php include('../components/footer.php'); ?>
</body>

</html>