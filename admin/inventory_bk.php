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
                        <th>expire Date</th>
                        <th>Return Date</th>
                        <th>remaining/over due</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $today = date('Y-m-d');
                        $enddate = date('Y-m-d', strtotime('+14 days'));

                          $sql="SELECT user.email, book_details.name, borrowed_book.username, borrowed_book.bookId, borrowed_book.rec_id, borrowed_book.reference_no, borrowed_book.borrow_date, borrowed_book.expire_date, borrowed_book.received_date, borrowed_book.status, borrowed_book.available 
                                FROM borrowed_book 
                                JOIN user ON borrowed_book.username = user.username 
                                JOIN book_details ON borrowed_book.bookId = book_details.bookId;";
                          if ($result = $conn->query($sql)) {
                            while($row = $result->fetch_assoc()){
                                $expireDateObj = new DateTime($row['expire_date']);
                                $bookId =  $row['bookId'];
                                $book_name =  $row['name'];
                                $usr_name = $row['username'];
                                $usr_email = $row['email'];
                                $status = $row['status'];
                                $rec_id = $row['rec_id'];

                                echo '<tr>';
                                echo '<td>'.$usr_name.'</td>';
                                echo '<td>'.$book_name.'</td>';
                                echo '<td>'.$row['reference_no'].'</td>';
                                if($row['borrow_date'] == null) {echo '<td>'.$today.'</td>';} else{echo '<td>'.$row['borrow_date'].'</td>';}
                                if($row['expire_date'] == null) {echo '<td>'.$enddate.'</td>';} else{echo '<td>'.$row['expire_date'].'</td>';}
                                if($row['received_date'] == null) {
                                    echo '<td>Not Yet</td>';
                                } else{
                                    echo '<td>'.$row['received_date'].'</td>';
                                }

                                if($row['received_date'] == null && $row['status'] === 'accepted') {
                                    $for_date = new DateTime();  
                                } else{
                                    $for_date = new DateTime($row['received_date']);
                                }
                                $interval = $for_date->diff($expireDateObj);
                                $remainingDates = (int)$interval->format('%r%a');
                                if($remainingDates>=0){
                                    echo '<td style="color:green"><strong>'.$remainingDates.' days </strong></td>';
                                }else{
                                    echo '<td style="color:red"><strong>'.$remainingDates.' days </strong></td>';
                                }

                                echo '<td><form method="POST" class="d-flex gap-2">
                                        <input type="hidden" name="rec_id" value="' . $rec_id . '">
                                        <input type="hidden" name="usr_name" value="' . $usr_name . '">
                                        <input type="hidden" name="usr_email" value="' . $usr_email . '">
                                        <input type="hidden" name="book_name" value="' . $book_name . '">';

                                switch ($status) {
                                    case 'pending':
                                        echo '<button type="submit" name="accepted" class="btn btn-sm btn-success">Accept</button>
                                            <button type="submit" name="rejected" class="btn btn-sm btn-danger">Reject</button>';
                                        break;

                                    case 'accepted':
                                    case 'over due':
                                        echo '<button type="submit" name="received" class="btn btn-sm btn-success receive-btn">receive</button>';
                                        break;

                                    case 'rejected':
                                        echo '<button class="btn btn-sm btn-danger reject-btn" disabled>Rejected</button>';
                                        break;

                                    case 'received':
                                        echo '<button class="btn btn-sm btn-warning receive-btn" disabled>received</button>';
                                        break;
                                }      
                                
                                echo '</form></td> </tr>';
                            }
                           }?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include('inventory_bk_functions.php') ?>
    <?php include('../components/footer.php'); ?>
</body>

</html>