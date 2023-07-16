<!DOCTYPE html>
<html>
<head>
<title>XẾP HẠNG SINH VIÊN THEO KHỐI - Chương trình quản lý tuyển sinh</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="../../../../img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../../../../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../../../../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../../../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../../../../css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="../../home2.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa-solid fa-school me-3"></i>AMSYS</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="../../home2.html" class="nav-item nav-link">Home</a>
                <a href="xemphanhoi.php" class="nav-item nav-link">VIEW REQUEST</a>
                <a href="nhanlaichosinhvien.php" class="nav-item nav-link">MESSAGE</a>
                <a href="chinhsuathongtinsvien.php" class="nav-item nav-link">EDIT INFOR</a>
                <a href="chinhsuadiemsvien.php" class="nav-item nav-link">EDIT GRADES</a>
                <a href="tracuusinhvien.php" class="nav-item nav-link">VIEW STUDENT INFOR</a>
                <a href="xemranksvien.php" class="nav-item nav-link active">STUDENT RANK</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <img
                        src="https://static.vecteezy.com/system/resources/thumbnails/006/877/520/small/work-character-solid-icon-illustration-office-workers-teachers-judges-police-artists-employees-free-vector.jpg"
                        class="rounded-circle"
                        height="20"
                        alt=""
                        loading="lazy"
                      />
                      ADMIN ACCOUNT                   
                    </a>
                    <div class="dropdown-menu fade-down m-0">
                        <!-- <a href="xemthongtinsvien.php" class="dropdown-item">View information</a> -->
                        <!-- <div class="dropdown-item" onclick="go()">Logout</div> -->
                        <a href="../../../../index.php" class="dropdown-item">Log out</a>

                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">XẾP HẠNG SINH VIÊN THEO KHỐI</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="./home.html">HOME</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">STUDENT RANK</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!--Search bar Start-->
    <form id="search-form" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <div class="container">
        <div class="row height d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="form">
                    <i class="fa fa-search"></i>
                    <input type="text" name="block_id" id="block-input" class="form-control form-input" placeholder="Mã khối" required>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
// Kết nối database
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "dbtest1";
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Xử lý khi giảng viên gửi yêu cầu xem xếp hạng sinh viên theo khối
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["block_id"])) {
    $block_id = $_POST["block_id"];

    // Xây dựng câu truy vấn SELECT để lấy thông tin sinh viên và tổng điểm các môn trong khối
    $sql = "SELECT Students.student_id, Students.student_name, SUM(Results.result_score) AS total_score
            FROM Students
            INNER JOIN Results ON Students.student_id = Results.result_student_id
            INNER JOIN Exam_Block ON Results.result_exam_id = Exam_Block.exam_id
            WHERE Exam_Block.block_id = '$block_id'
            GROUP BY Students.student_id
            ORDER BY total_score DESC";

    $result = mysqli_query($conn, $sql);
    $sql_block_name = "SELECT block_name FROM Blocks WHERE block_id = '$block_id' ";
    $result1 = mysqli_query($conn, $sql_block_name);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result1)) {
            $block_name = $row["block_name"];
        }
        echo "<br><div class='container'><table class='table table-bordered'>
        <thead>
          <tr>
            <th scope='col'>STT</th>
            <th scope='col'>Mã Sinh Viên</th>
            <th scope='col'>Tên Sinh Viên</th>
            <th scope='col'>Tổng Điểm</th>
          </tr>
        </thead>
        <tbody>";
        $rank = 1;

        while ($row = mysqli_fetch_assoc($result)) {
            $student_id = $row["student_id"];
            $student_name = $row["student_name"];
            $total_score = $row["total_score"];
            $total_score_formatted = number_format($total_score, 2);
            echo "<tr><th scope='row'>$rank</th>";
            echo "<td>$student_id</td><td>$student_name</td><td>$total_score_formatted</td></tr>";
            $rank++;
        }

        echo "</tbody></table></div>";
    } else {
        echo '<script>alert("Không có sinh viên trong khối này.")</script>';
    }
}

mysqli_close($conn);
?>

<script>
    document.getElementById('block-input').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Ngăn chặn việc gửi form mặc định

            var blockId = document.getElementById('block-input').value;
            // Thực hiện tìm kiếm hoặc xử lý kết quả tại đây
            console.log('Đã bấm Enter. Khối ID:', blockId);

            // Thay đổi action của form để gửi request đến server
            document.getElementById('search-form').action = '<?php echo $_SERVER["PHP_SELF"]; ?>';

            // Tạo một phần tử input ẩn để gửi giá trị block_id trong form
            var hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'block_id';
            hiddenInput.value = blockId;

            // Thêm phần tử input ẩn vào form và submit form
            document.getElementById('search-form').appendChild(hiddenInput);
            document.getElementById('search-form').submit();
        }
    });
</script>



    <!-- Search Bar End -->
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6 col-md-6">
                    <h4 class="text-white mb-3">Quick Link</h4>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Our Team</a>
                </div>
                <div class="col-lg-6 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Số 1 Đại Cồ Việt, phường Bách Khoa, quận Hai Bà Trưng, Hà Nội, Việt Nam</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">AMSYS</a>, All Right Reserved.

                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        <span style="color: #181d38;"></a>Designed By HTML Codex</span><br><br>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="">Home</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../lib/wow/wow.min.js"></script>
    <script src="../../../../lib/easing/easing.min.js"></script>
    <script src="../../../../lib/waypoints/waypoints.min.js"></script>
    <script src="../../../../lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../../../../js/main.js"></script>
    <script src="https://kit.fontawesome.com/533391d722.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>