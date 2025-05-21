<?php
session_start();
include('../includes/config.php');

if (!isset($_GET['ebookId']) || !isset($_SESSION['userLogin'])) {
    echo "Access Denied.";
    exit;
}

$username = $_SESSION['userLogin'];
$ebookId = intval($_GET['ebookId']);

// Fetch request and check expiration
$sql = "SELECT ebook_requests.expire_date, ebook_details.pdf_path, ebook_details.name FROM ebook_requests 
        JOIN ebook_details ON ebook_requests.ebookId = ebook_details.ebookId 
        WHERE ebook_requests.ebookId = ? AND ebook_requests.username = ? 
        ORDER BY ebook_requests.rec_id DESC LIMIT 1";

$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $ebookId, $username);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $expire_date = $row['expire_date'];
    $pdf_path = $row['pdf_path'];
    $pdf_name = $row['name'];
    
    $full_path = '../uploads/ebooks/' . basename($pdf_path);

    if (date('Y-m-d') <= $expire_date && file_exists($full_path)) {
        // Show HTML PDF viewer (not direct headers)
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Secure PDF View</title>
            <link rel="stylesheet" href="../assets/css/pdfview.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
                    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
            <script src= "https://cdn.jsdelivr.net/npm/pdfjs-dist@2.7.570/build/pdf.min.js"></script>
        </head>
        <body>
           <div class="container py-4">
            <h3 class="text-center mb-4"><?php echo $pdf_name ?></h3>
            
            <div class="d-flex pdf-controls gap-2 flex-wrap mb-3">
                <button id="prev" class="btn btn-primary">Previous</button>
                <button id="next" class="btn btn-primary">Next</button>
                <button id="zoomIn" class="btn btn-success">Zoom In +</button>
                <button id="zoomOut" class="btn btn-danger">Zoom Out -</button>
            </div>
            <div class="d-flex pdf-controls gap-2 flex-wrap mb-3">
                <span class="">Page: <span id="page_num">1</span>/<span id="page_count">--</span></span>
            </div>
            

            <div id="canvas_container">
                <canvas id="pdf_canvas"></canvas>
            </div>
        </div>


           <script>
                pdf_path = "<?php echo  $full_path ?>";
                console.log(pdf_path);
                var pdfDoc = null,
                pageNum = 1,
                pageRendering = false,
                pageNumPending = null,
                scale = 1,
                canvas = document.getElementById("pdf_canvas")
                ctx = canvas.getContext('2d')

                function renderPage(num){
                    var current_Pagenum = num;
                    pageRendering = true
                    pdfDoc.getPage(num).then((page)=>{
                        var viewport = page.getViewport({scale:scale});
                        canvas.height = viewport.height
                        canvas.width = viewport.width
                        
                        var renderContext = {
                            canvasContext: ctx,
                            viewport: viewport
                        }
                        var renderTask = page.render(renderContext)
                        renderTask.promise.then(()=>{
                            pageRendering = false;
                            if(pageNumPending !== null){
                                renderPage(pageNumPending)
                                pageNumPending = null
                            }
                        })
                    })
                    document.getElementById('page_num').textContent = current_Pagenum;
                }

                function queueRenderPage(num){
                    if(pageRendering){
                        pageNumPending = num
                    }else{
                        renderPage(num)
                    }
                }

                function onPrevPage(){
                    if(pageNum <= 1){
                        return
                    }
                    pageNum--;
                    queueRenderPage(pageNum)
                }
                document.getElementById('prev').addEventListener('click', onPrevPage)

                function onNextPage(){
                    if(pageNum >= pdfDoc.numPages){
                        return;
                    }
                    pageNum++;
                    queueRenderPage(pageNum)
                }
                document.getElementById('next').addEventListener('click', onNextPage)

                function zoomOut(){
                    scale -=0.1
                    renderPage(pageNum)
                }
                document.getElementById('zoomOut').addEventListener('click', zoomOut)

                function zoomIn(){
                    scale +=0.1
                    renderPage(pageNum)
                }
                document.getElementById('zoomIn').addEventListener('click', zoomIn)




                pdfjsLib.getDocument(pdf_path).promise.then((doc)=>{
                    pdfDoc = doc
                    document.getElementById('page_count').textContent = doc.numPages;
                    renderPage(pageNum)
                })
           </script>
        </body>
        </html>
        <?php
    } else {
        echo "Your access to this E-Book has expired.";
    }
} else {
    echo "E-Book not found or unauthorized.";
}
?>

