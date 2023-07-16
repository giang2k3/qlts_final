

<!DOCTYPE html>
<html>
<head>
<title>TRA CỨU THÍ SINH - Chương trình quản lý tuyển sinh</title>
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
                <a href="tracuusinhvien.php" class="nav-item nav-link active">VIEW STUDENT INFOR</a>
                <a href="xemranksvien.php" class="nav-item nav-link">STUDENT RANK</a>
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
                    <h1 class="display-3 text-white animated slideInDown">TRA CỨU THÍ SINH</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="./home.html">HOME</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">VIEW STUDENT INFOR</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!--Search bar Start-->
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <div class="container">

        <div class="row height d-flex justify-content-center align-items-center">

          <div class="col-md-6">

            <div class="form">
              <i class="fa fa-search"></i>
              <input type="text" name="student_id" class="form-control form-input" placeholder="Nhập tên/ Mã dự thi" required>
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
$conn = "";
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Xử lý khi giảng viên tra cứu
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["student_id"])) {
    $student_id = $_POST["student_id"];

    // Thực hiện truy vấn SELECT để lấy thông tin sinh viên
    $sql_student = "SELECT * FROM students WHERE student_id = '$student_id'";
    $result_student = mysqli_query($conn, $sql_student);

    // Kiểm tra kết quả
    if (mysqli_num_rows($result_student) > 0) {
        // Hiển thị thông tin sinh viên
        $row_student = mysqli_fetch_assoc($result_student);
        echo "<br>";
        echo "<div class='container'>";
        echo "<table class='table table-bordered'><tbody><tr>";
    //     echo "<thead><tr>
    //       <th scope='col-4'></th>
    //       <th scope='col-8'></th>
    //     </tr>
    //   </thead>";
        echo "<td>Mã sinh viên</td>";
        echo "<td>" .$row_student['student_id'] . "</td></tr>";
        echo "<tr><td>Họ tên</td>";
        echo "<td>" .$row_student['student_name'] . "</td></tr>";
        echo "<tr><td>Email</td>";
        echo "<td>" .$row_student['student_email'] . "</td></tr>";
        echo "<tr><td>Ngày sinh</td>";
        echo "<td>" .$row_student['student_date_of_birth'] . "</td></tr>";
        echo "<tr><td>Giới tính</td>";
        echo "<td>" .$row_student['student_gender'] . "</td></tr>";
        echo "<tr><td>Địa chỉ</td>";
        echo "<td>" .$row_student['student_address'] . "</td></tr>";
        echo "<tr><td>Khối thi</td>";
        echo "<td>" .$row_student['block_name'] . "</td></tr>";

        // Thực hiện truy vấn SELECT để lấy điểm số môn học của sinh viên
        $sql_results = "SELECT exams.exam_name, results.result_score
                        FROM exams
                        INNER JOIN results ON exams.exam_id = results.result_exam_id
                        WHERE results.result_student_id = '$student_id'";
        $result_results = mysqli_query($conn, $sql_results);

        // Kiểm tra kết quả
        if (mysqli_num_rows($result_results) > 0) {
            // Hiển thị tên môn kèm điểm số
            while ($row_results = mysqli_fetch_assoc($result_results)) {
                echo "<tr><td>Môn " . $row_results['exam_name'] . "</td>";
                echo "<td>" . $row_results['result_score'] . "</td></tr>";
            }

            $sql_major = "SELECT m.major_name, ms.major_level FROM majors m
                            INNER JOIN major_student ms ON m.major_id = ms.major_id
                            WHERE student_id = '$student_id'";
            $result_major = mysqli_query($conn, $sql_major);
            if (mysqli_num_rows($result_major) > 0) {
                // Hiển thị tên môn kèm điểm số
                while ($row_major = mysqli_fetch_assoc($result_major)) {
                    echo "<tr><td>Level: " . $row_major['major_level'] ."</td>";
                    echo "<td>Ngành: " . $row_major['major_name'] . "</td></tr>";
                }
            } else {
                echo "<td colspan='2'>Chưa đăng ký nguyện vọng nào.</td>";
            }
        } else {
            echo '<script>alert("Không có thông tin điểm số môn học của sinh viên này.")</script>';
        }
        echo "</tbody></table></div>";
    } else {
        echo '<script>alert("Không tìm thấy sinh viên với mã số: $student_id")</script>';
    }
}

mysqli_close($conn);
?>
    
    <!--Search bar End-->


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
