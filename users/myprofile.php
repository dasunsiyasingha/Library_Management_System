

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
  <title>My Profile</title>
</head>

<body>
  <?php include("../components/navbar.php") ?>
  <?php
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
      if($row = $result->fetch_assoc()){
        $email = $row['email'];
      }

 ?>
  <!-- Header Section -->
  <div class="bgcolor text-white py-5">
    <div class="container text-center">
      <h1 class="mb-1">My Account</h1>
      <p>Welcome,</p>
    </div>
  </div>

  <!-- Content Section -->
  <div class="container my-5">
    <div class="row align-items-center border p-4 rounded shadow">
      <!-- Profile Image -->
      <div class="col-md-3 text-center">
        <img src="../assets/img/profile2.png" alt="Profile" class="rounded-circle img-fluid" width="150">
      </div>

      <!-- Username and Email -->
      <div class="col-md-9">
        <h3 class="mb-3">Username: <span class="text-primary"><?php echo $username ?></span></h3>
        <p class="mb-11"><strong>Email:</strong> <?php echo $email ?></p>
      </div>
    </div>
  </div>

  <!-- Borrowed Books -->
  <div class="container col-md-8">
    <h4>Borrowed Books</h4>

    <h5>E - Books</h5>
    <table class="table table-bordered">
      <thead class="table-light">
        <tr>
          <th>Title</th>
          <th>Borrowed Date</th>
          <th>Due Date</th>
          <th>Remaining</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $today = new DateTime();
          $sql = "SELECT ebook_requests.expire_date, ebook_requests.request_date, ebook_requests.status, ebook_details.pdf_path, ebook_details.name FROM ebook_requests 
                  JOIN ebook_details ON ebook_requests.ebookId = ebook_details.ebookId 
                  WHERE ebook_requests.username = ? AND ebook_requests.status != 'expired'
                  ORDER BY ebook_requests.rec_id";

          $stmt = $conn->prepare($sql);
          $stmt->bind_param("s", $username);
          $stmt->execute();
          if ($result = $stmt->get_result()){
            while ($row = $result->fetch_assoc()) {
              $status = $row['status'];
              $pdf_name = $row['name'];
              $request_date = $row['request_date'];
              $ex_date = $row['expire_date'];
              $expireDate = new DateTime($ex_date);

              $interval = $today->diff($expireDate);
              $daysToExpire = $interval->format('%r%a');
              
              echo '<tr>
                    <td>'.$pdf_name.'</td>' ?>
                    <?php  if($status === 'pending'){ echo '<td>Pending</td>';}else{ echo '<td>'. $request_date .'</td>'; } ?> 
                    <?php  if($status === 'pending'){ echo '<td>Pending</td>';}else{ echo '<td>'. $ex_date .'</td>'; } ?> 
                    <?php  if($daysToExpire>=4){
                          echo '<td><span class="badge bg-success"><strong>'.$daysToExpire.' days </strong></span></td>';
                      }else{
                          echo '<td><span class="badge bg-danger"><strong>'.$daysToExpire.' days </strong></span></td>';
                      }?>
                    <?php echo '<tr>'; 
            } 
          }?>
      </tbody>
    </table>

    <h5>Hard copy Books</h5>
    <table class="table table-bordered">
      <thead class="table-light">
        <tr>
          <th>Title</th>
          <th>Borrowed Date</th>
          <th>Due Date</th>
          <th>Remaining</th>
        </tr>
      </thead>
      <tbody>
         <?php 
      $today = date('Y-m-d');
      $enddate = date('Y-m-d', strtotime('+14 days'));
      $for_date = new DateTime();

        $sql="SELECT user.email, book_details.name, borrowed_book.username, borrowed_book.bookId, borrowed_book.rec_id, borrowed_book.reference_no, borrowed_book.borrow_date, borrowed_book.expire_date, borrowed_book.received_date, borrowed_book.status, borrowed_book.available 
              FROM borrowed_book 
              JOIN user ON borrowed_book.username = user.username 
              JOIN book_details ON borrowed_book.bookId = book_details.bookId
              WHERE borrowed_book.username = ? AND borrowed_book.status != 'received' AND borrowed_book.status != 'rejected'
              ORDER BY borrowed_book.rec_id";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        if ($result = $stmt->get_result()){   
          while($row = $result->fetch_assoc()){
              $expireDateObj = new DateTime($row['expire_date']);
              $bookId =  $row['bookId'];
              $book_name =  $row['name'];
              $usr_name = $row['username'];
              $usr_email = $row['email'];
              $status = $row['status'];
              $rec_id = $row['rec_id'];

              echo '<tr>';
              // echo '<td>'.$usr_name.'</td>';
              echo '<td>'.$book_name.'</td>';
              // echo '<td>'.$row['reference_no'].'</td>';
              if($row['borrow_date'] == null) {echo '<td>Not Yet</td>';} else{echo '<td>'.$row['borrow_date'].'</td>';}
              if($row['expire_date'] == null) {echo '<td>Not Yet</td>';} else{echo '<td>'.$row['expire_date'].'</td>';}
              // if($row['received_date'] == null && $row['status'] === 'accepted') {
                    
              // }
              $interval = $for_date->diff($expireDateObj);
              $remainingDates = (int)$interval->format('%r%a');
              
              switch ($status) {
                  case 'pending':
                      echo '<span class="badge bg-warning">Pending...</span>';
                      break;

                  case 'accepted':
                  case 'over due':
                      if($remainingDates>=4){
                          echo '<td><span class="badge bg-success"><strong>'.$remainingDates.' days </strong></span></td>';
                      }else if($remainingDates<=0){
                          echo '<td>
                                  <span class="badge bg-danger"><strong>'.$remainingDates.' days </strong></span>
                                  <p style="color:red">charge for each aditional days.</P>
                                </td>';
                      }else{
                          echo '<td><span class="badge bg-warning"><strong>'.$remainingDates.' days </strong></span></td>';
                      }
                      break;

                  case 'rejected':
                      echo '<td><button class="btn btn-sm btn-danger reject-btn" disabled>Rejected</button></td>';
                      break;  

                  case 'received':
                      echo '<td><button class="btn btn-sm btn-warning receive-btn" disabled>received</button></td>';
                      break;
              }      
            
          }
          }?>
      </tbody>
    </table>
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

</html>