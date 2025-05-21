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
            <!-- Inventory Tab -->
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

                          $sql="SELECT user.email, ebook_details.name, ebook_requests.username, ebook_requests.ebookId, ebook_requests.rec_id, ebook_requests.reference_no, ebook_requests.request_date, ebook_requests.expire_date, ebook_requests.status, ebook_details.available 
                                FROM ebook_requests 
                                JOIN user ON ebook_requests.username = user.username 
                                JOIN ebook_details ON ebook_requests.ebookId = ebook_details.ebookId";
                          if ($result = $conn->query($sql)) {
                            while($row = $result->fetch_assoc()){
                                $ebookId =  $row['ebookId'];
                                $book_name =  $row['name'];
                                $usr_name = $row['username'];
                                $usr_email = $row['email'];
                                $status = $row['status'];
                                $rec_id = $row['rec_id'];

                                echo '<tr>';
                                echo '<td>'.$usr_name.'</td>';
                                echo '<td>'.$book_name.'</td>';
                                echo '<td>'.$row['reference_no'].'</td>';
                                if($row['request_date'] == null) {echo '<td>'.$today.'</td>';} else{echo '<td>'.$row['request_date'].'</td>';}
                                if($row['expire_date'] == null) {echo '<td>'.$enddate.'</td>';} else{echo '<td>'.$row['expire_date'].'</td>';}
                                if($row['status'] === 'pending'){
                                    echo '<td> <form method="POST" class="d-flex gap-2">
                                            <input type = "hidden" name="rec_id" value="'.$row['rec_id'].'"> 
                                            <input type="hidden" name="usr_name" value="' . $usr_name . '">
                                            <input type="hidden" name="usr_email" value="' . $usr_email . '">
                                            <input type="hidden" name="book_name" value="' . $book_name . '">

                                            <button type="submit" name="accepted" class="btn btn-sm btn-success">Accept</button>
                                            <button type="submit" name="rejected" class="btn btn-sm btn-danger">Reject</button>
                                          </form></td>';
                                } else if($row['status'] === 'accepted'){
                                    echo '<td> <button class="btn btn-sm btn-success accept-btn" disabled > Accepted </Button> </td>';
                                } else if($row['status'] === 'rejected'){
                                    echo '<td> <button class="btn btn-sm btn-danger reject-btn" disabled > Rejected </Button> </td>';
                                } else if($row['status'] === 'expired'){
                                    echo '<td> <button class="btn btn-sm btn-warning reject-btn" disabled > expired </Button> </td>';
                                }         
                                
                                echo '</tr>';
                            }
                           }?>
                </tbody>
            </table>
        </div>
    </main>
    <?php include('inventory_ebk_functions.php') ?>
    <?php include('../components/footer.php'); ?>
</body>

</html>