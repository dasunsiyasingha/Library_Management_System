<?php 

if($_SERVER['REQUEST_METHOD']==='POST'){
  $rec_id = $_POST['rec_id'];
  $usr_name = $_POST['usr_name'];
  $usr_email = $_POST['usr_email'];
  $book_name = $_POST['book_name'];
  
  $msg = "";
  if(isset($_POST['accepted'])){
    $msg = "accepted";
    $sql = "UPDATE ebook_requests SET request_date = '$today', expire_date = '$enddate', status = 'accepted' WHERE rec_id = '$rec_id';";
  }else if(isset($_POST['rejected'])){
    $msg = "rejected";
    $sql = "UPDATE ebook_requests SET request_date = '$today', expire_date = '$enddate', status = 'rejected' WHERE rec_id = '$rec_id';";
  }

  if (!empty($msg) && mysqli_query($conn, $sql)) {
    echo "<script>history.back();</script>";
  } else {
    echo "Update E book Request Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  
  try{
    $mail->addAddress($usr_email, $usr_name);
    $mail->isHTML(false);
    if($msg == "accepted"){
      $mail->Subject = "Your E - Book access accepted";
      $mail->Body    = "Dear $usr_name,\n\nYour access to the '$book_name' E-book has been accepted. It will expire in 14 days on $enddate.\n\nThank you!";
    }else if($msg == "rejected"){
      $mail->Subject = "Your E - Book access Rejected";
      $mail->Body    = "Dear $usr_name,\n\nUnfortunately, your request for '$book_name' was rejected. Please verify your payment or try again.\n\nThank you!";
    }
    $mail->send();
  } catch (Exception $e) {
    echo "Email failed. Error: {$mail->ErrorInfo}";
  }

}

?>