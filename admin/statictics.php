<?php 
require "./db/db.php";
require "./config.php";

session_start();

if($_SESSION['user']['login'] and $_SESSION['user']['role'] == "admin") {

} else {
    header("Location: ". "index.php");
}



function Product($id) {
    global $pdo;
    global $host;

    try {
        $query = $pdo->prepare("SELECT date_format(`data_dog`, '%m') as `data_mouth`, date_format(`data_dog`, '%Y') as `data_year` FROM `tables` WHERE 1");

        $query->execute();
        $result = $query->fetchAll();
        return $result;
    } catch (\Throwable $th) {
        echo json_encode([[
            "status" => 404,
            "message" => "Error"
        ]]);
    }
}

$id = $_GET["id"];

$product = Product($id);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./img/logo.png">

    <title>Admin</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <img src="./img/logo.png" width="120" height="50" alt="">
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Меню</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Навигация
            </div>


            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="tables.php?to=1&from=100">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Курсанты</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="statictics.php">
                <i class="fas fa-fw fa-chart-area"></i>
                    <span>Статистика</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <h2>Администрирование: <a href="logout.php">Выйти</a></h2>
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                </nav>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h2>Статистика договоров за месяц</h2>
                    <br>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Сколько заключено договоров в месяце</th>
                                <th>Месяц</th>
                                <th>Год</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $year = [];
                            $mouth = [];
                            $m1 = [];
                            $m2 = [];
                            $m3 = [];
                            $m4 = [];
                            $m5 = [];
                            $m6 = [];
                            $m7 = [];
                            $m8 = [];
                            $m9 = [];
                            $m10 = [];
                            $m11 = [];
                            $m12 = [];

                            for ($i=0; $i < count($product); $i++) {
                                array_push($year, $product[$i]["data_year"]);
                                array_push($mouth, $product[$i]["data_mouth"]);

                                if($product[$i]["data_mouth"] == 1) { array_push($m1, $product[$i]["data_mouth"]); }
                                else if($product[$i]["data_mouth"] == 2) { array_push($m2, $product[$i]["data_mouth"]); }
                                else if($product[$i]["data_mouth"] == 3) { array_push($m3, $product[$i]["data_mouth"]); }
                                else if($product[$i]["data_mouth"] == 4) { array_push($m4, $product[$i]["data_mouth"]); }
                                else if($product[$i]["data_mouth"] == 5) { array_push($m5, $product[$i]["data_mouth"]); }
                                else if($product[$i]["data_mouth"] == 6) { array_push($m6, $product[$i]["data_mouth"]); }
                                else if($product[$i]["data_mouth"] == 7) { array_push($m7, $product[$i]["data_mouth"]); }
                                else if($product[$i]["data_mouth"] == 8) { array_push($m8, $product[$i]["data_mouth"]); }
                                else if($product[$i]["data_mouth"] == 9) { array_push($m9, $product[$i]["data_mouth"]); }
                                else if($product[$i]["data_mouth"] == 10) { array_push($m10, $product[$i]["data_mouth"]); }
                                else if($product[$i]["data_mouth"] == 11) { array_push($m11, $product[$i]["data_mouth"]); }
                                else if($product[$i]["data_mouth"] == 12) { array_push($m12, $product[$i]["data_mouth"]); }
                            }
                            $year = array_unique($year);
                            $mouth = array_unique($mouth);
                            sort($year);
                            sort($mouth);
                                                         
                            for ($i=0; $i < 1; $i++) {
                                for ($i2=0; $i2 < count($mouth); $i2++) {                                  
                            ?>
                            <tr>
                                <td><?php 
                                if($mouth[$i2] == 1) { echo count($m1); }
                                else if($mouth[$i2] == 2) { echo count($m2); }
                                else if($mouth[$i2] == 3) { echo count($m3); }
                                else if($mouth[$i2] == 4) { echo count($m4); }
                                else if($mouth[$i2] == 5) { echo count($m5); }
                                else if($mouth[$i2] == 6) { echo count($m6); }
                                else if($mouth[$i2] == 7) { echo count($m7); }
                                else if($mouth[$i2] == 8) { echo count($m8); }
                                else if($mouth[$i2] == 9) { echo count($m9); }
                                else if($mouth[$i2] == 10) { echo count($m10); }
                                else if($mouth[$i2] == 11) { echo count($m11); }
                                else if($mouth[$i2] == 12) { echo count($m12); }
                                
                                ?></td>
                                <td><?php 
                                if($mouth[$i2] == 1) { echo "<a href='statics_mouth.php?mouth=1'>Январь</a>"; }
                                else if($mouth[$i2] == 2) { echo "<a href='statics_mouth.php?mouth=2'>Февраль</a>"; }
                                else if($mouth[$i2] == 3) { echo "<a href='statics_mouth.php?mouth=3'>Март</a>"; }
                                else if($mouth[$i2] == 4) { echo "<a href='statics_mouth.php?mouth=4'>Апрель</a>"; }
                                else if($mouth[$i2] == 5) { echo "<a href='statics_mouth.php?mouth=5'>Май</a>"; }
                                else if($mouth[$i2] == 6) { echo "<a href='statics_mouth.php?mouth=6'>Июль</a>"; }
                                else if($mouth[$i2] == 7) { echo "<a href='statics_mouth.php?mouth=7'>Июнь</a>"; }
                                else if($mouth[$i2] == 8) { echo "<a href='statics_mouth.php?mouth=8'>Август</a>"; }
                                else if($mouth[$i2] == 9) { echo "<a href='statics_mouth.php?mouth=9'>Сентябрь</a>"; }
                                else if($mouth[$i2] == 10) { echo "<a href='statics_mouth.php?mouth=10'>Октябрь</a>"; }
                                else if($mouth[$i2] == 11) { echo "<a href='statics_mouth.php?mouth=11'>Ноябрь</a>"; }
                                else if($mouth[$i2] == 12) { echo "<a href='statics_mouth.php?mouth=12'>Декабрь</a>"; }
                                
                                
                                ?></td>
                                <td><?php  
                                    if($mouth[$i2] == 10 || $mouth[$i2] == 11 || $mouth[$i2] == 12)  {
                                        echo "2023";
                                    } else {
                                        echo "2024";
                                    }                       
                                ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php 
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>&copy; Автошкола56.ru 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
</body>

</html>