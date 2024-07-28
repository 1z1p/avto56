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
        $query = $pdo->prepare("SELECT `id`, `fio`, `phone`, `price_first`, `price_last`, date_format(`data_last`, '%d/%m/%Y') as `data_last`, `price_two`, date_format(`data_two`, '%d/%m/%Y') as `data_two`, `price_tree`, date_format(`data_tree`, '%d/%m/%Y') as `data_tree`, `price_four`, date_format(`data_four`, '%d/%m/%Y') as `data_four`, `debt`, date_format(`data`, '%d/%m/%Y') as `data`, `status`, `groups`, `io`, `distant`, `korobka` FROM `tables` WHERE `id` = $id");
        // id BETWEEN $to AND $from
        // SELECT * FROM `tables` WHERE `data` > NOW() ORDER BY `tables`.`data` ASC
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
                    <img src="./img/user.png" width="200" height="200" style="background: lightgrey; border-radius: 15px; margin: 30px 0px;" alt="">
                    <h2>Полная инфорамция о курсанте:</h2>
                    <h4>Номер: <?= $product[0]["id"] ?></h4>
                    <h4>ФИО: <?= $product[0]["fio"] ?></h4>
                    <h4>Телефон: <?= $product[0]["phone"] ?></h4>
                    <h4>Цена за обучение: <?= $product[0]["price_first"] ?></h4>
                    <h4>Первый платеж: <?= $product[0]["price_last"] ?> - Дата: <?= $product[0]["data_last"] ?></h4>
                    <h4>Второй платеж: <?= $product[0]["price_two"] ?> - Дата: <?= $product[0]["data_two"] ?></h4>
                    <h4>Третий платеж: <?= $product[0]["price_tree"] ?> - Дата: <?= $product[0]["data_tree"] ?></h4>
                    <h4>Четвертый платеж: <?= $product[0]["price_four"] ?> - Дата: <?= $product[0]["data_four"] ?></h4>
                    <h4>Долг: <?= $product[0]["debt"] ?></h4>
                    <h4>Дата: <?= $product[0]["data"] ?></h4>
                    <h4>Статус: <?= $product[0]["status"] ?></h4>
                    <h4>Группа: <?= $product[0]["groups"] ?></h4>
                    <h4>И.О.: <?= $product[0]["io"] ?></h4>
                    <h4>Дистант: <?= $product[0]["distant"] ?></h4>
                    <h4>Коробка: <?= $product[0]["korobka"] ?></h4>

                    <a style="margin-right: 10px" href="edit_product.php?table=tables&to=1&from=100&id=<?=$product[0]["id"]?>&params[]=fio&params[]=phone&params[]=price_first&params[]=price_last&params[]=price_two&params[]=data_two&params[]=price_tree&params[]=data_tree&params[]=price_four&params[]=data_four&params[]=data_dog&params[]=status&params[]=groups&params[]=io&params[]=distant&params[]=korobka" class="btn btn-warning">Изменить</a>
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