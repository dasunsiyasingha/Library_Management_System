<?php 

// DB credentials.
$servername = "localhost";
$username = "root";
$password = "";
$database = "library_management_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

// Update expired requests
$sql = "UPDATE ebook_requests SET status = 'expired' WHERE expire_date < CURDATE()";

if ($conn->query($sql) === TRUE) {
    echo "Expired statuses updated successfully.";
} else {
    echo "Error updating records: " . $conn->error;
}

require __DIR__ . '/../vendor/autoload.php'; // Corrected autoload path
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'siyasinghad@gmail.com'; // Your Gmail   ejgn pymz jvvp jxwm
    $mail->Password   = 'ejgn pymz jvvp jxwm';   // App Password 
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;


    //Recipients
    $mail->setFrom('siyasinghad@gmail.com', 'Smart Library');
    $today = new DateTime();
    $sql = "SELECT user.email, user.username, ebook_requests.expire_date, ebook_requests.status, ebook_details.name
            FROM ebook_requests 
            JOIN ebook_details ON ebook_requests.ebookId = ebook_details.ebookId 
            JOIN user ON ebook_requests.username = user.username
            ORDER BY ebook_requests.rec_id";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if ($result = $stmt->get_result()){
      while ($row = $result->fetch_assoc()) {
        $status = $row['status'];
        $book_name = $row['name'];
        $user_email = $row['email'];
        $usrName = $row['username'];
        $ex_date = $row['expire_date'];

        $expireDate = new DateTime($ex_date);

        $interval = $today->diff($expireDate);
        $daysToExpire = $interval->format('%r%a');

        $mail->addAddress($user_email, $usrName);
        
        if($daysToExpire == 13 && $status == "accepted"){
          echo $status;
        echo $daysToExpire;
          //Content
          $mail->isHTML(false);
          $mail->Subject = "Reminder: Your eBook access expires in 3 days";
          $mail->Body    = "Dear $usrName,\n\nYour access to the $book_name eBook will expire in 3 days on $ex_date.\nPlease take any necessary action.\n\nThank you!";
          $mail->send();
        }else if($daysToExpire == -1 && $status == "expired"){
           //Content
          $mail->isHTML(false);
          $mail->Subject = "Reminder: Your eBook access expired ";
          $mail->Body    = "Dear $usrName,\n\nYour access to the $book_name eBook expired.\n\nThank you!";
          $mail->send();

        }
    }
  }
    echo 'Reminder email sent successfully.';
} catch (Exception $e) {
    echo "Email failed. Error: {$mail->ErrorInfo}";
}

?>

