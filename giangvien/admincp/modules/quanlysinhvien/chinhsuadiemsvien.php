<?php

// Kết nối database
$db_server= "localhost";
$db_user="root";    
$db_pass="";
$db_name="dbtest1";
$conn="";
$conn = mysqli_connect($db_server,$db_user,$db_pass,$db_name);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Xử lý khi giảng viên thực hiện chỉnh sửa điểm
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $student_id = $_POST["student_id5"];
    $exam_id = $_POST["exam_id5"];
    $new_score = $_POST["new_score5"];

    // Thực hiện truy vấn UPDATE để cập nhật điểm của sinh viên
    $sql = "UPDATE results
            SET result_score = '$new_score'
            WHERE result_student_id = '$student_id' AND result_exam_id = '$exam_id'";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Điểm của sinh viên đã được cập nhật thành công.")</script>';
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}
// if (isset($_POST["Back"])) {
//     // Chuyển hướng người dùng đến trang dangnhap.php
//     header('Location: luachongv.php');
//     exit();
// }

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
<title>CHỈNH SỬA ĐIỂM CỦA THÍ SINH - Chương trình quản lý tuyển sinh</title>
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
                <a href="chinhsuadiemsvien.php" class="nav-item nav-link active">EDIT GRADES</a>
                <a href="tracuusinhvien.php" class="nav-item nav-link">VIEW STUDENT INFOR</a>
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
                    <h1 class="display-3 text-white animated slideInDown">CHỈNH SỬA ĐIỂM CỦA THÍ SINH</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="./home.html">HOME</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">EDIT GRADES</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Box Start -->
    <div class="login-wrap">
            <div class="login-html">
                <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">CHỈNH SỬA ĐIỂM THÍ SINH</label>
                <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
  
                <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="login-form">
                    <div class="sign-in-htm">
                        <div class="group">
                            <label for="student_id5" class="label">Mã sinh viên</label>
                            <input type="text" name="student_id5" class="input" required><br>
                        </div>
                        <div class="group">
                            <label for="exam_id5" class="label">Mã bài thi</label>
                            <input type="text" name="exam_id5" class="input" required><br>
                        </div>
                        <div class="group">
                            <label for="new_score5" class="label">Điểm bài thi</label>
                            <input type="text" name="new_score5" class="input" required><br>
                        </div>
                        <div class="group">
                            <input type="submit" class="button" name="submit" value ="Cập nhật điểm">
                        </div>
                    </div>
                </form>
                
            </div>


        </div>
    <!--Box End -->

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
