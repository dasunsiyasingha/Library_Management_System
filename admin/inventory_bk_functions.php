<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $rec_id = $_POST['rec_id'];
  $usr_name = $_POST['usr_name'];
  $usr_email = $_POST['usr_email'];
  $book_name = $_POST['book_name'];
  $msg = "";
  if(isset($_POST['accepted'])){
      $msg = "accepted";
      $sql = "UPDATE borrowed_book SET borrow_date = '$today', expire_date = '$enddate', status = 'accepted' WHERE rec_id = '$rec_id';";
  }else if(isset($_POST['rejected'])){
      $msg = "rejected";
      $sql = "UPDATE borrowed_book SET borrow_date = '$today', expire_date = '$enddate', status = 'rejected' WHERE rec_id = '$rec_id';";
  }else if(isset($_POST['received'])){
      $msg = "received";
      $sql = "UPDATE borrowed_book SET received_date = '$today', status = 'received' WHERE rec_id = '$rec_id';";
  }

  if (!empty($msg) && mysqli_query($conn, $sql)) {
      echo "<script>history.back();</script>";
  } else {
      echo "Update book Request Error: " . mysqli_error($conn);
  }

  try{
    $mail->addAddress($usr_email, $usr_name);
    $mail->isHTML(false);
    if($msg == "accepted"){
      $mail->Subject = "Your Book access accepted";
      $mail->Body    = "Dear $usr_name,\n\nYour access to the '$book_name' book has been accepted. It will expire in 14 days on $enddate.\n\nThank you!";
    }else if($msg == "rejected"){
      $mail->Subject = "Your Book access Rejected";
      $mail->Body    = "Dear $usr_name,\n\nUnfortunately, your request for '$book_name' was rejected. Please verify your payment or try again.\n\nThank you!";
    }else if($msg == "received"){
      $mail->Subject = "Book Received Confirmation";
      $mail->Body    = "Dear $usr_name,\n\nThank you for returning the book '$book_name'. We hope to see you again!\n\nBest regards.";
    }
    $mail->send();
  } catch (Exception $e) {
    echo "Email failed. Error: {$mail->ErrorInfo}";
  }
}


?>