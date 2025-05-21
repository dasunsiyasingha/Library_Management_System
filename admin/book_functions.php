<!-- ADD BOOK Modal -->
<div class="modal fade" id="addBookModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addBookModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <form class="modal-content" id="addBookForm" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addBookModalLabel">Add New Book</h1>
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
                    <label for="releaseDate" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="addBook" class="btn btn-primary">Add Book</button>
            </div>
        </form>
    </div>
</div>


<!-- DELETE BOOK MODAL -->
<div class="modal fade" id="deleteBookModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="delete_bookId" id="delete_bookId">
                    Are you sure you want to delete <strong id="delete-bookName"></strong>?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="deleteBook" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Delete button click
document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('delete-bookName').textContent = this.dataset.name;
        document.getElementById('delete_bookId').value = this.dataset.id;
    });
});
</script>

<!-- EDIT BOOK MODEL -->
<div class="modal fade" id="editBookModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="bookId" id="edit-bookId">

                    <div class="mb-3"><label>Book Name</label>
                        <input type="text" name="name" id="edit-name" class="form-control">
                    </div>

                    <div class="mb-3"><label>Author</label>
                        <input type="text" name="author" id="edit-author" class="form-control">
                    </div>

                    <div class="mb-3"><label>Description</label>
                        <textarea name="info" id="edit-info" class="form-control"></textarea>
                    </div>

                    <div class="mb-3"><label>Binding</label>
                        <input type="text" name="binding" id="edit-binding" class="form-control">
                    </div>

                    <div class="mb-3"><label>Pages</label>
                        <input type="number" name="pages" id="edit-pages" class="form-control">
                    </div>

                    <div class="mb-3"><label>Publisher</label>
                        <input type="text" name="publisher" id="edit-publisher" class="form-control">
                    </div>

                    <div class="mb-3"><label>Released Date</label>
                        <input type="date" name="released_date" id="edit-date" class="form-control">
                    </div>

                    <div class="mb-3"><label>Price</label>
                        <input type="number" name="edit-price" id="edit-price" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Book Image (64KB max)</label>
                        <input type="file" name="bookImage" id="edit-bookImage" class="form-control">
                        <img id="preview-image" src="" alt="Image Preview"
                            style="margin-top:10px; max-height:150px; display: none;" />
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="editBook" class="btn btn-success">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Edit button click
document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('edit-bookId').value = this.dataset.id;
        document.getElementById('edit-name').value = this.dataset.name;
        document.getElementById('edit-author').value = this.dataset.author;
        document.getElementById('edit-info').value = this.dataset.info;
        document.getElementById('edit-binding').value = this.dataset.binding;
        document.getElementById('edit-pages').value = this.dataset.pages;
        document.getElementById('edit-publisher').value = this.dataset.publisher;
        document.getElementById('edit-date').value = this.dataset.date;
        document.getElementById('edit-price').value = this.dataset.price;
        const preview = document.getElementById('preview-image');
        preview.src = this.dataset.image;
        preview.style.display = 'block';
    });
});

// Show selected image preview
document.getElementById('edit-bookImage').addEventListener('change', function(event) {
    const preview = document.getElementById('preview-image');
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

<?php
    if(isset($_POST['addBook'])){
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
            if ($_FILES['bookImage']['size'] > 65536) {
                die("Image is too large. Please upload an image less than 64KB.");
            }

            $imageData = file_get_contents($_FILES['bookImage']['tmp_name']);
        } else {
            die("Image upload failed.");
        }

        // Prepare SQL query
        $stmt = $conn->prepare("INSERT INTO book_details(name, author, image, info, binding, pages, publisher, released_date, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssbssisss", $bookName, $authorName, $null, $description, $binding, $pages, $publisher, $releaseDate, $price);


        // Send image as BLOB
        $null = NULL; // temporary placeholder
        $stmt->send_long_data(2, $imageData); // index 2
        // Execute
        if ($stmt->execute()) {
            echo "Book added successfully!";
            echo "<script>history.back();</script>";
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();

    }
// --------------------- BOOK DELETE FUNCTION -----------------------------
    if(isset($_POST['deleteBook'])){
        $delete_bookId = $_POST['delete_bookId'];

        $sql = "DELETE FROM book_details WHERE bookId = '$delete_bookId';";

        if (mysqli_query($conn, $sql)) {
            echo "book is Deleted.";
            echo "<script>history.back();</script>";
        } else {
            echo "book delete Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        $conn->close();
    }



    if(isset($_POST['editBook'])){
        $bookId = $_POST['bookId'];
        $edit_bookName = $_POST['name'];
        // $bookImage = $_POST['bookImage'];
        $edit_authorName = $_POST['author'];
        $edit_description = $_POST['info'];
        $edit_binding = $_POST['binding'];
        $edit_pages = $_POST['pages'];
        $edit_publisher = $_POST['publisher'];
        $edit_releaseDate = $_POST['released_date'];
        $edit_price = $_POST['price'];

        // Handle image
        if (isset($_FILES['bookImage']) && $_FILES['bookImage']['error'] === UPLOAD_ERR_OK) {
            // Limit file size (64KB = 65536 bytes)
            if ($_FILES['bookImage']['size'] > 65536) {
                die("Image is too large. Please upload an image less than 64KB.");
            }
            // Prepare SQL query
            $stmt = $conn->prepare("UPDATE book_details SET name = ?, author = ?, image = ?, info = ?, binding = ?, pages = ?, publisher = ?, released_date = ?, price = ? WHERE bookId = ?");
            $stmt->bind_param("ssbssissss", $edit_bookName, $edit_authorName, $null, $edit_description, $edit_binding, $edit_pages, $edit_publisher, $edit_releaseDate, $edit_price, $bookId);

            $imageData = file_get_contents($_FILES['bookImage']['tmp_name']);

            // Send image as BLOB
            $null = NULL; // temporary placeholder
            $stmt->send_long_data(2, $imageData); // index 2
            
        } else {
            // Prepare SQL query
            $stmt = $conn->prepare("UPDATE book_details SET name = ?, author = ?, info = ?, binding = ?, pages = ?, publisher = ?, released_date = ? WHERE bookId = ?");
            $stmt->bind_param("ssssisss", $edit_bookName, $edit_authorName, $edit_description, $edit_binding, $edit_pages, $edit_publisher, $edit_releaseDate, $bookId);
        }
        // Execute
            if ($stmt->execute()) {
                echo "Book added successfully!";
                echo "<script>history.back();</script>";
            } else {
                echo "Error: " . $stmt->error;
            }

        $stmt->close();
        $conn->close();

    }
?>