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
        $query = $pdo->prepare("SELECT `id`, date_format(`data_dog`, '%m') as `data_mouth`, `fio`, `groups`, `io`, `distant`, `korobka` FROM `tables` WHERE date_format(`data_dog`, '%m') = $id");

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

$id = $_GET["mouth"];

$product = Product($id);

$groups_volodar = 0;
$groups_chkalov = 0;
$groups_ycpex = 0;
$io_gorbynov = 0;
$io_taranyxa = 0;
$distant = 0;
$korobka_akpp = 0;
$korobka_mkpp = 0;


for ($i=0; $i < count($product); $i++) { 
    if($product[$i]['groups'] == "группа Володарского") {
        $groups_volodar++;
    }
    if($product[$i]['groups'] == "группа Чкалова") {
        $groups_chkalov++;
    }
    if($product[$i]['groups'] == "группа Успех") {
        $groups_ycpex++;
    }
    if($product[$i]['io'] == "И.О. Горбунов") {
        $io_gorbynov++;
    }
    if($product[$i]['io'] == "И.О. Тарануха") {
        $io_taranyxa++;
    }
    if($product[$i]['distant'] == "Да") {
        $distant++;
    }

    if($product[$i]['korobka'] == "МКПП") {
        $korobka_mkpp++;
    }
    if($product[$i]['korobka'] == "АКПП") {
        $korobka_akpp++;
    }
}

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
                    <div class="stat">
                         <h4>группа Володарская: <strong><?= $groups_volodar ?></strong> </h4>  
                         <h4>группа Чкалова: <strong><?= $groups_chkalov ?></strong> </h4>  
                         <h4>группа Успех: <strong><?= $groups_ycpex ?></strong> </h4>  
                         <h4>И.О. Горбунов: <strong><?= $io_gorbynov ?></strong> </h4>  
                         <h4>И.О. Тарануха: <strong><?= $io_taranyxa ?></strong> </h4>  
                         <h4>Дистант: <strong><?= $distant ?></strong> </h4>  
                         <h4>Коробка передач АКПП: <strong><?= $korobka_akpp ?></strong></h4>  
                         <h4>Коробка передач МКПП: <strong><?= $korobka_mkpp ?></strong></h4>  
                    </div>
                    <br>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ФИО</th>
                                <th>Группа</th>
                                <th>Индивидуальное обучение</th>
                                <th>Дистант</th>
                                <th>Коробка передач</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            for ($i=0; $i < count($product); $i++) { 
                            ?>
                            <tr>
                                <td class="fio"><?= $product[$i]["id"] ?></td>
                                <td class="fio"><a class="cabetsd cabets__" style="color: #000;" href="card_cabets.php?id=<?= $product[$i]["id"]; ?>"><?= $product[$i]["fio"]; ?></a></td>
                                <td class="fio"><?= $product[$i]["groups"] ?></td>
                                <td class="fio"><?= $product[$i]["io"] ?></td>
                                <td class="fio"><?= $product[$i]["distant"] ?></td>
                                <td class="fio"><?= $product[$i]["korobka"] ?></td>
                            </tr>
                            <?php
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