<!-- ADD E-BOOK Modal -->
<div class="modal fade" id="addE_BookModal" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="addE_BookModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <form class="modal-content" id="addE_BookForm" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addE_BookModalLabel">Add New E-Book</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label for="bookName" class="form-label">Book Name</label>
                    <input type="text" class="form-control" id="bookName" name="bookName" required>
                </div>

                <div class="mb-3">
                    <label for="bookImage" class="form-label">Book Cover Image (Max: 64KB)</label>
                    <input type="file" class="form-control" id="bookImage" name="bookImage" accept="image/*" required>
                    <div class="form-text">Upload an image under 64KB.</div>
                </div>

                <div class="mb-3">
                    <label for="authorName" class="form-label">Author Name</label>
                    <input type="text" class="form-control" id="authorName" name="authorName" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="binding" class="form-label">Binding</label>
                    <input type="text" class="form-control" id="binding" name="binding" required>
                </div>

                <div class="mb-3">
                    <label for="pages" class="form-label">Number of Pages</label>
                    <input type="number" class="form-control" id="pages" name="pages" required>
                </div>

                <div class="mb-3">
                    <label for="publisher" class="form-label">Publisher</label>
                    <input type="text" class="form-control" id="publisher" name="publisher" required>
                </div>

                <div class="mb-3">
                    <label for="releaseDate" class="form-label">Released Date</label>
                    <input type="date" class="form-control" id="releaseDate" name="releaseDate" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>

                <div class="mb-3">
                    <label for="pdf" class="form-label">Upload E-Book pdf</label>
                    <input type="file" name="pdf" accept="application/pdf" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="addE_Book" class="btn btn-primary">Add E-Book</button>
            </div>
        </form>
    </div>
</div>

<!-- E-BOOK EDIT MODEL -->
<div class="modal fade" id="editE_BookModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit E-Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="bookId" id="edit-ebookId">

                    <div class="mb-3"><label>Book Name</label>
                        <input type="text" name="name" id="edit-ename" class="form-control">
                    </div>

                    <div class="mb-3"><label>Author</label>
                        <input type="text" name="author" id="edit-eauthor" class="form-control">
                    </div>

                    <div class="mb-3"><label>Description</label>
                        <textarea name="info" id="edit-einfo" class="form-control"></textarea>
                    </div>

                    <div class="mb-3"><label>Binding</label>
                        <input type="text" name="binding" id="edit-ebinding" class="form-control">
                    </div>

                    <div class="mb-3"><label>Pages</label>
                        <input type="number" name="pages" id="edit-epages" class="form-control">
                    </div>

                    <div class="mb-3"><label>Publisher</label>
                        <input type="text" name="publisher" id="edit-epublisher" class="form-control">
                    </div>

                    <div class="mb-3"><label>Released Date</label>
                        <input type="date" name="released_date" id="edit-edate" class="form-control">
                    </div>
                    
                    <div class="mb-3"><label>Price</label>
                        <input type="number" name="price" id="edit-eprice" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Book Image (64KB max)</label>
                        <input type="file" name="bookImage" id="edit-ebookImage" class="form-control">
                        <img id="preview-eimage" src="" alt="Image Preview"
                            style="margin-top:10px; max-height:150px; display: none;" />
                    </div>

                    <div class="mb-3">
                        <label>Replace PDF (optional):</label>
                        <input type="file" name="pdf" accept="application/pdf" class="form-control"><br>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="editE_Book" class="btn btn-success">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Edit button click
document.querySelectorAll('.edit-ebook-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('edit-ebookId').value = this.dataset.id;
        document.getElementById('edit-ename').value = this.dataset.name;
        document.getElementById('edit-eauthor').value = this.dataset.author;
        document.getElementById('edit-einfo').value = this.dataset.info;
        document.getElementById('edit-ebinding').value = this.dataset.binding;
        document.getElementById('edit-epages').value = this.dataset.pages;
        document.getElementById('edit-epublisher').value = this.dataset.publisher;
        document.getElementById('edit-edate').value = this.dataset.date;
        document.getElementById('edit-eprice').value = this.dataset.price;
        const preview = document.getElementById('preview-eimage');
        preview.src = this.dataset.image;
        preview.style.display = 'block';
    });
});

// Show selected image preview
document.getElementById('edit-ebookImage').addEventListener('change', function(event) {
    const preview = document.getElementById('preview-eimage');
    const file = event.target.files[0];

    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
});
</script>

<!-- DELETE E-BOOK MODAL -->
 <div class="modal fade" id="deleteE_BookModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="delete_bookId" id="delete_ebookId">
                    <input type="hidden" name="delete_pdfpath" id="delete_pdfpath">
                    Are you sure you want to delete <strong id="delete-ebookName"></strong>?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="deleteE_Book" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Delete button click
document.querySelectorAll('.delete-ebook-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('delete-ebookName').textContent = this.dataset.name;
        document.getElementById('delete_ebookId').value = this.dataset.id;
        document.getElementById('delete_pdfpath').value = this.dataset.pdfpath;

    });
});
</script>


<?php

// -------------------------------------************-------- MANAGE E-BOOKS -----------***************------------------------------------------
if(isset($_POST['addE_Book']) && isset($_FILES['pdf']) ){
   
  $bookName = $_POST['bookName'];
  // $bookImage = $_POST['bookImage'];
  $authorName = $_POST['authorName'];
  $description = $_POST['description'];
  $binding = $_POST['binding'];
  $pages = $_POST['pages'];
  $publisher = $_POST['publisher'];
  $releaseDate = $_POST['releaseDate'];
  $price = $_POST['price'];
   
  // Handle image
    if (isset($_FILES['bookImage']) && $_FILES['bookImage']['error'] === UPLOAD_ERR_OK) {
        // Limit file size (64KB = 65536 bytes)
        if ($_FILES['bookImage']['size'] > 65536 ) {
            die("Image is too large. Please upload an image less than 64KB.");
        }

        $imageData = file_get_contents($_FILES['bookImage']['tmp_name']);
    } else {
        die("Image upload failed.");
    }

   $uploadDir = '../uploads/ebooks/';
   if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
   $fileName = uniqid().'-'.basename($_FILES['pdf']['name']);
   $uploadFile = $uploadDir . $fileName;

    // Check file type
    $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    if ($fileType !== 'pdf') {
        die("Only PDF files are allowed.");
    }

    if (move_uploaded_file($_FILES['pdf']['tmp_name'], $uploadFile)) {
        // Prepare SQL query
        $stmt = $conn->prepare("INSERT INTO ebook_details(name, author, image, info, binding, pages, publisher, released_date, pdf_path, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssbssissss", $bookName, $authorName, $null, $description, $binding, $pages, $publisher, $releaseDate, $uploadFile, $price);


        // Send image as BLOB
        $null = NULL; // temporary placeholder
        $stmt->send_long_data(2, $imageData); // index 2
        // Execute
        if ($stmt->execute()) {
            echo "Book added successfully!";
            echo "<script>history.back();</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }else{
        echo "Upload failed.";
    }

}


//******************************  EDIT E-BOOK FUNCTION  *********************************
if(isset($_POST['editE_Book'])){
    $bookId =  (int) $_POST['bookId'];
    $edit_bookName = $_POST['name'];
    $edit_authorName = $_POST['author'];
    $edit_description = $_POST['info'];
    $edit_binding = $_POST['binding'];
    $edit_pages =  (int) $_POST['pages'];
    $edit_publisher = $_POST['publisher'];
    $edit_releaseDate = $_POST['released_date'];

    $updatePDF = false;
    $pdfPath = '';


    // Check if a new PDF was uploaded
    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0) {
        $allowedTypes = ['application/pdf'];
        if (!in_array($_FILES['pdf']['type'], $allowedTypes)) {
            die("Only PDF files are allowed.");
        }

        // Save new PDF
        $targetDir = "../uploads/ebooks/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $pdfPath = $targetDir . uniqid() . '_' . basename($_FILES['pdf']['name']);
        if (move_uploaded_file($_FILES['pdf']['tmp_name'], $pdfPath)) {
            $updatePDF = true;
        } else {
            echo("Failed to upload new PDF.");
            echo "<script>history.back();</script>";
        }
    }

    // Handle image
    if (isset($_FILES['bookImage']) && $_FILES['bookImage']['error'] === UPLOAD_ERR_OK) {
        // Limit file size (64KB = 65536 bytes)
        if ($_FILES['bookImage']['size'] > 65536) {
            die("Image is too large. Please upload an image less than 64KB.");
        }
        if($updatePDF){
            // Prepare SQL query
            $stmt = $conn->prepare("UPDATE ebook_details SET name = ?, author = ?, image = ?, info = ?, binding = ?, pages = ?, publisher = ?, released_date = ?, pdf_path = ?  WHERE ebookId = ?");
            $stmt->bind_param("ssbssisssi", $edit_bookName, $edit_authorName, $null, $edit_description, $edit_binding, $edit_pages, $edit_publisher, $edit_releaseDate, $pdfPath, $bookId);
        }else{
            // Prepare SQL query
            $stmt = $conn->prepare("UPDATE ebook_details SET name = ?, author = ?, image = ?, info = ?, binding = ?, pages = ?, publisher = ?, released_date = ? WHERE ebookId = ?");
            $stmt->bind_param("ssbssissi", $edit_bookName, $edit_authorName, $null, $edit_description, $edit_binding, $edit_pages, $edit_publisher, $edit_releaseDate, $bookId);

        }
       
        $imageData = file_get_contents($_FILES['bookImage']['tmp_name']);

        // Send image as BLOB
        $null = NULL; // temporary placeholder
        $stmt->send_long_data(2, $imageData); // index 2
        
    } else {
        if($updatePDF){
            // Prepare SQL query
            $stmt = $conn->prepare("UPDATE ebook_details SET name = ?, author = ?, info = ?, binding = ?, pages = ?, publisher = ?, released_date = ?, pdf_path = ? WHERE ebookId = ?");
            $stmt->bind_param("ssssisssi", $edit_bookName, $edit_authorName, $edit_description, $edit_binding, $edit_pages, $edit_publisher, $edit_releaseDate, $pdfPath, $bookId);
        }else{
            // Prepare SQL query
            $stmt = $conn->prepare("UPDATE ebook_details SET name = ?, author = ?, info = ?, binding = ?, pages = ?, publisher = ?, released_date = ? WHERE ebookId = ?");
            $stmt->bind_param("ssssissi", $edit_bookName, $edit_authorName, $edit_description, $edit_binding, $edit_pages, $edit_publisher, $edit_releaseDate, $bookId);
        }
        

    }
        
    // Execute
        if ($stmt->execute()) {
            echo "Book Update successfully!";
            echo "<script>history.back();</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

    $stmt->close();
    $conn->close();
}

//----------------****************** DELETE E-BOOK FUNCTION ********************* -------------------------
 if(isset($_POST['deleteE_Book'])){
        $delete_bookId = $_POST['delete_bookId'];
        $pdf_path = $_POST['delete_pdfpath'];

        if (unlink($pdf_path)) {
            $sql = "DELETE FROM ebook_details WHERE ebookId = '$delete_bookId';";

            if (mysqli_query($conn, $sql)) {
                echo "book is Deleted.";
                echo "<script>history.back();</script>";
            } else {
                echo "book delete Error: " . $sql . "<br>" . mysqli_error($conn);
                echo "<script>history.back();</script>";
            }
        }
        $conn->close();
    }


?>