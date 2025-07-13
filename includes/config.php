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
// echo "Connected successfully";

// Update expired requests
$sql = "UPDATE ebook_requests SET status = 'expired' WHERE expire_date < CURDATE()";

if ($conn->query($sql) === TRUE) {
    // echo "Expired statuses updated successfully.";
} else {
    // echo "Error updating records: " . $conn->error;
}
// Update over Due books
$sql = "UPDATE borrowed_book SET status = 'over due' WHERE expire_date < CURDATE() AND status = 'accepted'";

if ($conn->query($sql) === TRUE) {
    // echo "Expired statuses updated successfully.";
} else {
    // echo "Error updating records: " . $conn->error;
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
    $mail->Username   = 'siyasinghad@gmail.com'; 
    $mail->Password   = '----------';   // App Password 
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;


    //Recipients
    $mail->setFrom('siyasinghad@gmail.com', 'Smart Library');
    

} catch (Exception $e) {
    // echo "Email failed. Error: {$mail->ErrorInfo}";
}

?>

