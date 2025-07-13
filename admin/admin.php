<?php
    session_start();
    error_reporting(0);
    include('../includes/config.php');
    // if(strlen($_SESSION['adminLogin'])==0){ 
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

<body>
    <?php include('../components/admin_navbar.php'); ?>
    <div class="container mt-5">
        <h1 class="mb-4">Library Admin Dashboard</h1>

        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs mb-4" id="dashboardTabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#users">Manage Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#books">Manage Books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#ebooks">Manage E-Books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#inventory">Inventory</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#notifications">Notifications</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Users Tab -->
            <div class="tab-pane fade show active" id="users">
                <h4>Manage Users</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Chamindu Dilshan</td>
                            <td>Student</td>
                            <td><button class="btn btn-sm btn-primary">Edit</button>
                                <button class="btn btn-sm btn-danger"> delete </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Books Tab -->
            <div class="tab-pane fade" id="books">
                <h4>Manage Books</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Book Name</th>
                            <th scope="col">image</th>
                            <th scope="col">Author</th>
                            <th scope="col">info</th>
                            <th scope="col">binding</th>
                            <th scope="col">pages</th>
                            <th scope="col">publisher</th>
                            <th scope="col">Released Date</th>
                            <th scope="col">available</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                          $sql="SELECT * FROM book_details";
                          if ($result = $conn->query($sql)) {
                            while($row = $result->fetch_assoc()){
                              echo '<tr role="row">';
                              echo '<td>'.$row['bookId'].'</td>';
                              echo '<td>'.$row['name'].'</td>';
                              echo '<td><img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" width="100"/></td>';
                              echo '<td>'.$row['author'].'</td>';
                              echo '<td>'.$row['info'].'</td>';
                              echo '<td>'.$row['binding'].'</td>';
                              echo '<td>'.$row['pages'].'</td>';
                              echo '<td>'.$row['publisher'].'</td>';
                              echo '<td>'.$row['released_date'].'</td>';
                              if($row['available']){
                                  echo '<td> YES </td>';
                              }else{
                                  echo '<td> NO </td>';
                              }
                              echo '<td><button class="btn btn-sm btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editBookModal"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editBookModal"
                                    data-id="'.$row['bookId'].'"
                                    data-image="data:image/jpeg;base64,'.base64_encode($row['image']).'"
                                    data-name="'.htmlspecialchars($row['name']).'"
                                    data-author="'.htmlspecialchars($row['author']).'"
                                    data-info="'. htmlspecialchars($row['info']).'"
                                    data-binding="'.htmlspecialchars($row['binding']) .'"
                                    data-pages="'.$row['pages'].'"
                                    data-publisher="'.htmlspecialchars($row['publisher']).'"
                                    data-date="'.$row['released_date'].'"
                                    >Edit</button>

                                    <button class="btn btn-sm btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteBookModal" data-name="'.$row['name'].'" data-id="'.$row['bookId'].'"> delete </button></td> </tr>';
                            }
                          }
                          ?>
                    </tbody>
                </table>

                <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal"
                    data-bs-target="#addBookModal">Add New Book</button>
            </div>

            <!-- E-Books Tab -->
            <div class="tab-pane fade" id="ebooks">
                <h4>Manage E-Books</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Book Name</th>
                            <th scope="col">image</th>
                            <th scope="col">Author</th>
                            <th scope="col">info</th>
                            <th scope="col">binding</th>
                            <th scope="col">pages</th>
                            <th scope="col">publisher</th>
                            <th scope="col">Released Date</th>
                            <th scope="col">available</th>
                            <th scope="col">pdf Link</th>
                            <th scope="col">Action</th>
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
                                    >Edit</button>

                                    <button class="btn btn-sm btn-danger delete-ebook-btn" data-bs-toggle="modal" data-bs-target="#deleteE_BookModal" data-name="'.$row['name'].'" data-id="'.$row['ebookId'].'" data-pdfpath="'.$row['pdf_path'].'"> delete </button></td> </tr>';
                            }
                          }
                          ?>
                    </tbody>
                </table>

                <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal"
                    data-bs-target="#addE_BookModal">Add New E-Book</button>
            </div>

            <!-- Inventory Tab -->
            <div class="tab-pane fade" id="inventory">
                <h4>Inventory Overview</h4>
                <p>Borrowing limit: <strong>14 days</strong></p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Book Title</th>
                            <th>Referance number</th>
                            <th>Borrow Date</th>
                            <th>Return Deadline</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $today = date('Y-m-d');
                        $enddate = date('Y-m-d', strtotime('+14 days'));

                          $sql="SELECT * FROM ebook_requests";
                          if ($result = $conn->query($sql)) {
                            while($row = $result->fetch_assoc()){
                                $ebookId =  $row['ebookId'];
                                $sql="SELECT name FROM ebook_details WHERE ebookId = $ebookId";
                                $bookRow = $conn->query($sql)->fetch_assoc();
                                echo '<tr>';
                                echo '<td>'.$row['username'].'</td>';
                                echo '<td>'.$bookRow['name'].'</td>';
                                echo '<td>'.$row['reference_no'].'</td>';
                                if($row['request_date'] == null) {echo '<td>'.$today.'</td>';} else{echo '<td>'.$row['request_date'].'</td>';}
                                if($row['expire_date'] == null) {echo '<td>'.$enddate.'</td>';} else{echo '<td>'.$row['expire_date'].'</td>';}
                                if($row['status'] === 'pending'){
                                    echo '<td> <form method="POST" class="d-flex gap-2">
                                            <input type = "hidden" name="rec_id" value="'.$row['rec_id'].'"> 
                                            <button type="submit" name="accepted" class="btn btn-sm btn-success">Accepted</button>
                                            <button type="submit" name="rejected" class="btn btn-sm btn-danger">Rejected</button>
                                          </form></td>';
                                } else if($row['status'] === 'accepted'){
                                    echo '<td> <button class="btn btn-sm btn-success accept-btn" disabled > Accepted </Button> </td>';
                                } else if($row['status'] === 'rejected'){
                                    echo '<td> <button class="btn btn-sm btn-danger reject-btn" disabled > Rejected </Button> </td>';
                                }        
                                
                                echo '</tr>';
                            }
                           }?>
                    </tbody>
                </table>
            </div>

            <!-- Notifications Tab -->
            <div class="tab-pane fade" id="notifications">
                <h4>Send Notifications</h4>
                <button class="btn btn-warning">Send Reminder</button>
            </div>
        </div>
    </div>
    <?php include('book_functions.php') ?>
    <?php include('e_book_functions.php') ?>
    <?php include('inventory_functions.php') ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>