<?php 
require "./db/db.php";
require "./config.php";

session_start();

if($_SESSION['user']['login'] and $_SESSION['user']['role'] == "admin") {

} else {
    header("Location: ". "index.php");
}



function Product($to, $from) {
    global $pdo;
    global $host;

    try {
        $art = ($to * $from) - $from;
        $query = $pdo->prepare("SELECT `id`, `fio`, `phone`, `price_first`, `price_last`, date_format(`data_last`, '%d/%m/%Y') as `data_last`, `price_two`, date_format(`data_two`, '%d/%m/%Y') as `data_two`, `price_tree`, date_format(`data_tree`, '%d/%m/%Y') as `data_tree`, `price_four`, date_format(`data_four`, '%d/%m/%Y') as `data_four`, `debt`, date_format(`data`, '%d/%m/%Y') as `data`, `status`, date_format(`data_dog`, '%d/%m/%Y') as `data_dog` FROM `tables` ORDER BY `tables`.`data` ASC LIMIT $art,50");
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

$to = $_GET["to"];
$from = $_GET["from"];

$product = Product($to, $from);

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

            <li class="nav-item" id="click">
                <a class="nav-link" href="#">
                <i class="fas fa-fw fa-chart-area"></i>
                    <span>Экспорт в Excel</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="statictics.php">
                <i class="fas fa-fw fa-chart-area"></i>
                    <span>Статистика</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="data_cabet.php?to=1&from=100">
                <i class="fas fa-fw fa-chart-area"></i>
                    <span>Карточки курсанта</span></a>
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
                <!-- End of Topbar -->
                <?php

                $final = date("Y-m-d", strtotime("+1 month"));
    
                if(isset($_POST['search'])) {
                    $search = $_POST['search'];

                    $query = $pdo->prepare("SELECT `id`, `fio`, `phone`, `price_first`, `price_last`, date_format(`data_last`, '%d/%m/%Y') as `data_last`, `price_two`, date_format(`data_two`, '%d/%m/%Y') as `data_two`, `price_tree`, date_format(`data_tree`, '%d/%m/%Y') as `data_tree`, `price_four`, date_format(`data_four`, '%d/%m/%Y') as `data_four`, `debt`, date_format(`data`, '%d/%m/%Y') as `data`, `status`, date_format(`data_dog`, '%d/%m/%Y') as `data_dog` FROM `tables` WHERE `fio` LIKE ?");
                    $query->execute(["%$search%"]);

                    $r = $query->fetchAll();
                    $product = $r;
                }

                $to2 = $_GET['to'];
                $from2 = $_GET['from'];
                $delete2 = $_POST['delete'];
                $r2 = (int)$delete2 + 1;
                // header("Location: ". "product.php?to=$to2&from=$from2#$r2");

                if(isset($_GET['params'])) {
                    $params = $_GET['params'];
                    $tos = $_GET['tos'];
                    $froms = $_GET['froms'];

                    foreach ($params as $key => $value) {
                        $query = $pdo->prepare("DELETE FROM `product` WHERE `id` = ?");
                        $query->execute([$value]);
                    }
                    
                    echo "<script>alert('Удаленно выделенное'); window.location.href = 'product.php?to=$tos&from=$froms';</script>";
                }
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <form action="" method="POST" style="margin-botton: 40px;">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Поиск</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="search">
                        </div>
                        <button type="submit" class="btn btn-danger">Найти</button>
                    </form>

                    <h2 style="margin: 40px 0px;">Курсанты</h2>
                    
                    <span style="display:flex;">
                        <a style="margin-right: 10px;" href="add_product.php?table=tables&id=<?=$product[$i]["id"]?>&params[]=fio&params[]=phone&params[]=price_first&params[]=price_last&params[]=data_last&params[]=price_two&params[]=data_two&params[]=price_tree&params[]=data_tree&params[]=price_four&params[]=data_four&params[]=data&params[]=status&params[]=data_dog&params[]=groups&params[]=io&params[]=distant&params[]=korobka" class="btn btn-success">Добавить</a>
                    </span>
                    <!-- params[]=price_two&params[]=price_tree& -->

                    <table class="table" style="margin: 40px 0px;" id="simpleTable1">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Кнопки</th>
                            <th scope="col">ФИО</th>
                            <th scope="col">Телефон</th>
                            <th scope="col">Полная цена за обучение</th>
                            <th scope="col">Первый платеж</th>
                            <th scope="col">Второй платеж</th>
                            <th scope="col">Третий платеж</th>
                            <th scope="col">Четвертый платеж</th>
                            <th scope="col">Долг</th>
                            <th scope="col">Дата</th>
                            <th scope="col">Статус</th>
                            <th scope="col">Дата заключения договора</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php 
                            for ($i=0; $i < count($product); $i++) { 
                             ?>
                          <tr style="max-height: 200px; height: 100px;" class="child child_<?= $i ?>" id="<?= $product[$i]["id"]; ?>">
                            <th scope="row">       
                                <?= $product[$i]["id"]; ?>
                            </th>
                            <td style="display:flex;">
                                <a style="margin-right: 10px" href="edit_product.php?table=tables&to=<?=$to?>&from=<?=$from?>&id=<?=$product[$i]["id"]?>&params[]=fio&params[]=phone&params[]=price_first&params[]=price_last&params[]=price_two&params[]=data_two&params[]=price_tree&params[]=data_tree&params[]=price_four&params[]=data_four&params[]=data_dog&params[]=status&params[]=groups&params[]=io&params[]=distant&params[]=korobka" class="btn btn-warning">Изменить</a>
                            </td>
                            <td class="fio"><a class="cabetsd cabets__" style="color: #000;" href="card_cabets.php?id=<?= $product[$i]["id"]; ?>"><?= $product[$i]["fio"]; ?></a></td>
                            <td><?= $product[$i]["phone"]; ?></td>
                            <td><?= $product[$i]["price_first"]; ?></td>
                            <td><?= $product[$i]["price_last"]; ?>р<br>Дата: <?= $product[$i]["data_last"]; ?></td>
                            <td><?= $product[$i]["price_two"]; ?>р<br>Дата: <?= $product[$i]["data_two"]; ?></td>
                            <td><?= $product[$i]["price_tree"]; ?>р<br>Дата: <?= $product[$i]["data_tree"]; ?></td>
                            <td><?= $product[$i]["price_four"]; ?>р<br>Дата: <?= $product[$i]["data_four"]; ?></td>
                            <td><?= $product[$i]["debt"]; ?></td>
                            <td><?= $product[$i]["data"]; ?></td> 
                            <td><?= $product[$i]["status"]; ?></td>
                            <td><?= $product[$i]["data_dog"]; ?></td>
                          </tr>
                            
                            <?php 
                            
                            if($to == 1) {
                                echo "<style>
                                .child:nth-child(1), .child:nth-child(2), .child:nth-child(3), .child:nth-child(4), .child:nth-child(5), .child:nth-child(6), .child:nth-child(7), .child:nth-child(8), .child:nth-child(9) {
                                    background: lightcoral;
                                    color: #fff;
                                }
                            </style>";
                            }
                            
                            if($product[$i]["debt"] == "0") { 
                                // $query = $pdo->prepare("UPDATE `tables` SET `data` = ?, debt = NULL, `status` = 'Не должен'  WHERE `id` = ?");
                                // $query->execute([date("Y-m-d", strtotime("+900 year")), $product[$i]["id"]]);
                                echo "
                                <style>
                                    .child_$i {
                                        background: lightgreen;
                                        color: #fff
                                    }
                                </style>";
                             } else if($product[$i]["debt"] == "") {
                                echo "
                                <style>
                                    .child_$i {
                                        background: lightgreen;
                                        color: #fff
                                    }
                                </style>";
                             } } ?>
                        </tbody>
                    </table>
                    
                    <style>
                        tr, td {
                            font-size: 14.5px;
                        }
                    </style>

                    <div class="paginate">
                        <?php 
                        
                        $query = $pdo->prepare("SELECT * FROM `tables` WHERE 1");
                        // id BETWEEN $to AND $from
                        $query->execute([$to,$from]);
                        $result = $query->fetchAll();
                        (int)$nums = count($result) / 20;
                        $nn = (int)$nums;
                        
                        for ($i=0; $i < $nn; $i++) {
                            $d = ($i+1)*100;
                            $s = 0;
                            $s += ($i)*100;
                            $sddffg = $i + 1
                        ?>
                            <a href="<?= "$host/tables.php?to=$sddffg&from=20" ?>"><?= $i + 1 ?></a>
                        <?php } ?>
                    </div>

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
    <script>
        let btn = document.getElementById("click");

        btn.addEventListener("click", (event) => {
            TableToExcel.convert(document.getElementById("simpleTable1"));
        })

    </script>

    <style>
        .paginate {
            margin: 40px 0px;
        }

        .paginate > a {
            background: lightgrey;
            padding: 4px 10px;
            font-size: 21px;
            color: #000;
            border-radius: 10px;
            transition: .3s;         
        }

        .paginate > a:hover {
            background: #e3e3e3;
        }

    </style>
</body>

</html>