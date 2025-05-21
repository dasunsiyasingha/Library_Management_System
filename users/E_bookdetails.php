<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../assets/css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <title>E-Books Details</title>
</head>

<body>

    <?php 
      include("../components/navbar.php");
      
      if(isset($_GET['ebookId'])){
        $ebookId = intval($_GET['ebookId']);
        $sql="SELECT * FROM ebook_details WHERE ebookId=$ebookId";
        if ($result = $conn->query($sql)) {
          if($row = $result->fetch_assoc()){
            $bookName = $row['name'];
            $author = $row['author'];
            $info = $row['info'];
            $binding = $row['binding'];
            $pages = $row['pages'];
            $publisher = $row['publisher'];
            $releasedDate = $row['released_date'];
            $image = $row['image'];
            $available = $row['available'];
            $pdf_path = $row['pdf_path'];
            $price = $row['price'];
          }
        }
      }
  ?>

    <!-- Book Details Section -->
    <div class="container ">
        <div class="row">
            <!-- Book Image -->
            <div class="col-md-4 text-center">
                <img src="data:image/jpeg; base64, <?php echo base64_encode($image) ?>" alt="Book Cover"
                    class="book-image"> <!-- Replace with your book image -->
            </div>
            <!-- Book Information -->
            <div class="col-md-8 ">
                <h4><?php echo $info ?></h4>
                <div class="info-section mt-3">
                    <p><strong>Author:</strong> <?php echo $author ?></p>
                    <p><strong>Binding:</strong> <?php echo $binding ?></p>
                    <p><strong>Pages:</strong> <?php echo $pages ?></p>
                    <p><strong>Publisher:</strong> <?php echo $publisher ?></p>
                    <p><strong>Released Date:</strong> <?php echo $releasedDate ?></p>
                    <p><strong>Book Price:</strong> Rs. <?php echo $price ?>/=</p>
                    <p class="availability">Available</p>
                </div>
                <?php 
                  if($username){
                    $buyStatus = '';
                    $sql="SELECT request_date, expire_date, status, reference_no 
                          FROM ebook_requests 
                          WHERE ebookId = $ebookId AND username = '$username' 
                          ORDER BY rec_id DESC 
                          LIMIT 1";
                    if ($result = $conn->query($sql)) {
                      if($row = $result->fetch_assoc()){
                        $buyStatus = $row['status'];
                        $requestDate = $row['request_date'];
                        $expireDate = $row['expire_date'];
                        $referenceNo = $row['reference_no'];
                      }
                    }
                    if($buyStatus == "accepted" && strtotime($expireDate) > time()){
                      // if (file_exists("pdfs/" . $row['pdf_path'])):
                      echo '<a href="viewpdf.php?ebookId='.urlencode($ebookId) .'" target="_blank" class="btn btn-outline-success mt-3">view E-Book</a>';
                    }else{
                      echo '<button class="btn btn-outline-success mt-3" data-bs-toggle="modal" data-bs-target="#buyBookModal">Get</button>';
                    }
                  }else{
                    echo '<button class="btn btn-outline-success mt-3" data-bs-toggle="modal" data-bs-target="#alertModal">Get</button>';
                  }
                ?>

            </div>
        </div>
    </div>

    <!-- Modal for Alert -->
    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="alertModalLabel">Alert</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body text-center">
                    <p>First you have to register in the system.</p>
                    <button class="btn btn-secondary" onclick="location.href='register.php'">Create an Account</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for buy book -->
    <div class="modal fade" id="buyBookModal" tabindex="-1" aria-labelledby="buyBookModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="buyBookModalLabel">Request Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                  <?php if ($buyStatus == "pending") echo 
                    '<h6 class="text-start">Bank Details:</h6>
                    <p class="mb-2"><strong>Bank Name:</strong> ABC Bank</p>
                    <p class="mb-2"><strong>Account Number:</strong> 1234567890</p>
                    <p class="mb-3"><strong>Account Holder:</strong> BookStore Pvt Ltd</p>' ?>
                    
                    <p class="mb-3"><strong>Book Price:</strong> <?php echo $price ?></p>
                    <form method="POST">
                        <div class="mb-3">
                            <?php if ($buyStatus == "pending") { echo '<label for="referenceNumber" class="form-label">Payment Reference Number</label>'; 
                            } else{
                              echo '<p>Please Request Book after display referance number and bank details </p>';
                            } ?>
                            
                            <input type="<?php if ($buyStatus == "pending") { echo "text"; } else{echo "hidden";} ?>" class="form-control" name="referenceNumber" id="referenceNumber"
                                readonly>
                        </div>
                        <Button type="submit" name="requestBook" id="requestBook" class="btn btn-primary w-100 mb-3" <?php if ($buyStatus == "pending") echo 'disabled'; ?>>
                            Send Request for Book
                        </Button>
                    </form>
                    <!-- WhatsApp Button -->
                     <?php if ($buyStatus == "pending") echo '<a href="#" id="whatsappLink" target="_blank" class="btn btn-success w-100" >
                        Send Receipt via WhatsApp
                    </a>'; ?>
                    
                </div>
            </div>
        </div>
    </div>

    <script>
    // Generate reference when modal is shown
    const modal = document.getElementById('buyBookModal');
    modal.addEventListener('shown.bs.modal', function() {
        
        const buyStatus = "<?php echo $buyStatus; ?>";
        const referenceNo = "<?php echo $referenceNo; ?>";
        let refNumber = '';
        
        if(buyStatus === "pending"){
          refNumber = referenceNo;
        }else{
          const datePart = new Date().toISOString().slice(0, 10).replace(/-/g, '');
          const randomPart = Math.floor(1000 + Math.random() * 9000); // 4-digit random
          refNumber = `REF_EBK${datePart}${randomPart}`;
        }

        // Set the generated reference
        document.getElementById('referenceNumber').value = refNumber;

        // Set WhatsApp link
        const whatsappNumber = "94786569924"; // your WhatsApp number
        const message = `I have paid for the book. My reference number is: ${refNumber}`;
        const encodedMsg = encodeURIComponent(message);
        const url = `https://wa.me/${whatsappNumber}?text=${encodedMsg}`;
        document.getElementById('whatsappLink').href = url;
    });
    </script>

    <!-- footer section -->
    <footer class="bg-dark py-5 mt-5">
        <div class="container text-light text-center">
            <p class="display-7 mb-5">Online Books Management System</p>
            <small class="text-white-50">Copyright @2024 by ByteGrad. All rights reserved.<br>Tel: +94 77 631 9567 | +94
                76
                786 7053</small>
        </div>

    </footer>
</body>

</html>

<?php 
  if(isset($_POST['requestBook'])){

    $ref_number = $_POST['referenceNumber'];
    $updateStatus = "pending";

    $stmt = $conn->prepare("INSERT INTO ebook_requests(username, ebookId, status, reference_no) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $username, $ebookId, $updateStatus, $ref_number);
    if ($stmt->execute()) {
        echo "<script>appendAlert('Book request successfully! !', 'success');</script>";
        echo "<script>history.back();</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
  }
?>