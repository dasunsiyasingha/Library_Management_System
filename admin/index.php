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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php include('../components/admin_navbar.php'); ?>
    <main class="flex-grow-1">
        <div class="container mt-5">
            <h4>Admin DashBoard</h4></br>

            <div class="row mb-4">

                <!-- Total Physical Books -->
                <div class="col-md-6 mb-3">
                    <div class="card shadow border-start border-primary border-4">
                        <div class="card-body d-flex align-items-center">
                            <i class="bi bi-book text-primary fs-2 me-3"></i>
                            <div>
                                <h5 class="card-title">Total Physical Books</h5>
                                <h3><?php echo getCountOfbooks("book_details"); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total E-Books -->
                <div class="col-md-6 mb-3">
                    <div class="card shadow border-start border-info border-4">
                        <div class="card-body d-flex align-items-center">
                            <i class="bi bi-tablet-landscape text-info fs-2 me-3"></i>
                            <div>
                                <h5 class="card-title">Total E-Books</h5>
                                <h3><?php echo getCountOfbooks("ebook_details"); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
                <hr><br>

            <h5>Physical Books</h5>
            <div class="row mb-4">
                <!-- Pending Book Requests -->
                <div class="col-md-4 mb-3">
                    <div class="card shadow border-start border-warning border-4">
                        <div class="card-body d-flex align-items-center">
                            <i class="bi bi-hourglass-split text-warning fs-2 me-3"></i>
                            <div>
                                <h5 class="card-title">Pending Requests</h5>
                                <h3><?php echo getCount("borrowed_book","pending"); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Accepted Book Requests -->
                <div class="col-md-4 mb-3">
                    <div class="card shadow border-start border-primary border-4">
                        <div class="card-body d-flex align-items-center">
                            <i class="bi bi-check-circle text-primary fs-2 me-3"></i>
                            <div>
                                <h5 class="card-title">Accepted Requests</h5>
                                <h3><?php echo getCount("borrowed_book","accepted"); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rejected Book Requests -->
                <div class="col-md-4 mb-3">
                    <div class="card shadow border-start border-secondary border-4">
                        <div class="card-body d-flex align-items-center">
                            <i class="bi bi-x-circle text-danger fs-2 me-3"></i>
                            <div>
                                <h5 class="card-title">Rejected Requests</h5>
                                <h3><?php echo getCount("borrowed_book", "rejected"); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Overdue Books -->
                <div class="col-md-4 mb-3">
                    <div class="card shadow border-start border-danger border-4">
                        <div class="card-body d-flex align-items-center">
                            <i class="bi bi-exclamation-circle text-danger fs-2 me-3"></i>
                            <div>
                                <h5 class="card-title">Overdue Books</h5>
                                <h3><?php echo getCount("borrowed_book", "over due"); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recieved Books -->
                <div class="col-md-4 mb-3">
                    <div class="card shadow border-start border-success border-4">
                        <div class="card-body d-flex align-items-center">
                            <i class="bi bi-arrow-return-left text-success fs-2 me-3"></i>
                            <div>
                                <h5 class="card-title">Recieved Books</h5>
                                <h3><?php echo getCount("borrowed_book", "received"); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <hr><br>
                <h5>E - Books</h5>
                <div class="row mb-4">
                    <!-- Pending Book Requests -->
                    <div class="col-md-4 mb-3">
                        <div class="card shadow border-start border-warning border-4">
                            <div class="card-body d-flex align-items-center">
                                <i class="bi bi-hourglass-split text-warning fs-2 me-3"></i>
                                <div>
                                    <h5 class="card-title">Pending Requests</h5>
                                    <h3><?php echo getCount("ebook_requests","pending"); ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Accepted Book Requests -->
                    <div class="col-md-4 mb-3">
                        <div class="card shadow border-start border-primary border-4">
                            <div class="card-body d-flex align-items-center">
                                <i class="bi bi-check-circle text-primary fs-2 me-3"></i>
                                <div>
                                    <h5 class="card-title">Accepted Requests</h5>
                                    <h3><?php echo getCount("ebook_requests","accepted"); ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rejected Book Requests -->
                    <div class="col-md-4 mb-3">
                        <div class="card shadow border-start border-secondary border-4">
                            <div class="card-body d-flex align-items-center">
                                <i class="bi bi-x-circle text-danger fs-2 me-3"></i>
                                <div>
                                    <h5 class="card-title">Rejected Requests</h5>
                                    <h3><?php echo getCount("ebook_requests","rejected"); ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </main>

    <?php include('inventory_bk_functions.php') ?>
    <?php include('../components/footer.php'); ?>
</body>

</html>
<?php 

function getCount($bktype, $status) {
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM $bktype WHERE status = ?");
    $stmt->bind_param("s", $status);
    $stmt->execute();
    $stmt->bind_result($total);
    $stmt->fetch();
    $stmt->close();
    return $total;
}

function getCountOfbooks($bktype) {
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM $bktype");
    $stmt->execute();
    $stmt->bind_result($total);
    $stmt->fetch();
    $stmt->close();
    return $total;
}


?>