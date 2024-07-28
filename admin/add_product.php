<?php 
require "./db/db.php";
require "./config.php";
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
                    <h2>Администрирование: </h2>
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php 

                    require "config.php";

                    function insert($table, $params){
                        global $pdo;
                        // INSERT INTO `users` (admin, username, email, password) VALUES ('0', '444', '4@gmail.com', '4444');
                    
                        $i = 0;
                        $coll = '';
                        $mask = '';
                        foreach($params as $key => $value){
                            if ($i === 0){
                                $coll = $coll . "$key";
                                $mask = $mask . "'$value'";
                            }else{
                                $coll = $coll . ", $key";
                                $mask = $mask . ", '$value'";
                            }
                            $i++;
                        }
                    
                    
                        $sql = "INSERT INTO $table ($coll) VALUES ($mask)";
                    
                        $query = $pdo->prepare($sql);
                        $query->execute($params);
                    
                        return $pdo->lastInsertId(); //возращает последний id
                    }
                    
                    function generateRandom($length = 10) {
                        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                        $value = '';
                      
                        for ($i = 0; $i < $length; $i++) {
                            $value .= $chars[rand(0, strlen($chars) - 1)];
                        }
                      
                        return $value;
                    }

                    function api($fullname){
                        global $host;
                        $url="$host/api/auth/reg";
                        $login = generateRandom(8);
                        $password = generateRandom(12);
                        $postData = [
                            'fullname' => $fullname,
                            'username' => $login,
                            'code' => 'avto56',
                            'password' => $password,    
                            'incpector' => "default"    
                        ];
                         
            
                         $context = stream_context_create([
                             'http' => [
                                 'method' => 'POST',
                                 'header' => "Content-Type: application/json\r\n",
                                 'content' => json_encode($postData)
                             ]
                         ]);
                        $response = file_get_contents($url, false, $context);
                        if($response === FALSE){
                            die('Error');
                        }
                        $responseData = json_decode($response, TRUE);
                        insert('data_cabet', [
                            'fio' => $fullname,
                            'username' => $login,
                            'password' => $password, 
                        ]);
                    }
                    // api();


                    if(isset($_GET['table']) and isset($_GET['params']) and isset($_POST['status']) and isset($_POST['data_last']) and isset($_POST['button'])) {
                        $table = $_GET['table'];
                        $params = $_GET['params'];
                        $status = $_POST['status'];
                        $data_last = $_POST['data_last'];
                        $data_two = $_POST['data_two'];
                        $data_tree = $_POST['data_tree'];
                        $data_dog = $_POST['data_dog'];
                        $groups = $_POST['groups'];
                        $io = $_POST['io'];
                        $distant = $_POST['distant'];
                        $korobka = $_POST['korobka'];

                        $success = [];
                        $time = strtotime($data_last);
                        $ddd = date("Y-m-d", strtotime("+1 month", $time));
                        $success += ["data_last" => $data_last];
                        $success += ["data_two" => $data_two];
                        $success += ["data_tree" => $data_tree];
                        $success += ["data_four" => $data_four];
                        $success += ["data_four" => $data_four];
                        $success += ["data_dog" => $data_dog];
                        $success += ["groups" => $groups];
                        $success += ["io" => $io];
                        $success += ["distant" => $distant];
                        $success += ["korobka" => $korobka];

                        $random = rand(1, 999999999999999999);
                        $filename = $_FILES["file_categories"]["name"];
                        $full = "$random-$filename";
                        $tempname = $_FILES["file_categories"]["tmp_name"];
                        $folder = "../image/product/" . $full;

                        $price_debt = $_POST['edit'][2] - $_POST['edit'][3] - $_POST['edit'][4] - $_POST['edit'][5] - $_POST['edit'][6];
                        $today = date("Y-m-d");

                        for ($i=0; $i < count($params); $i++) {
                            if($params[$i] == "status") {
                                if($price_debt <= 0) { ;
                                    $success += ["status" => "Не должен"];
                                 } else {
                                    $success += ["status" => $status];
                                 }
                            } else if($params[$i] == "data") {
                                $final = date("Y-m-d", strtotime("+1 month"));
                                if($price_debt <= 0) { 
                                    $finals = date("Y-m-d", strtotime("+800 year"));
                                    $success += ["data" => $finals];
                                 } else {
                                    $success += ["data" => $ddd];
                                 }
                            } else {
                                $success += [$params[$i] => $_POST['edit'][$i]];
                            }

                            print_r($_POST['edit'][$i]);
                        }
                        if($price_debt <= 0) {
                            $success += ["debt" => 0];
                        } else {
                            $success += ["debt" => $price_debt];
                        }
                        
                        insert($table, $success);
                        api($success['fio']);
                        echo "<script>window.location.href = '$table.php?to=1&from=100';</script>";
                    }

                    ?>
                    <h2>Добавление</h2>
                    <form method="POST" enctype="multipart/form-data">
                        <?php 
                        $params = $_GET['params'];
                        for ($i=0; $i < count($params); $i++) {
                            if($params[$i] == "status") {
                        ?>
                        <div class="form-group">
                            <label for="">Элемент: <?php 
                            if($params[$i] == "status") {
                                echo "Статус";
                            }    
                            ?></label><br>
                            <select class="form-control" aria-label="Default select example" name="status" id="" required>
                                <option value="">Статус</option>
                                <option value="Должен">Должен</option>
                                <option value="Не должен">Не должен</option>
                            </select>
                        </div>
                        <?php } else if($params[$i] == "data_last") { ?>
                            <div class="form-group">
                                <label for="">Элемент: <?php
                                    echo "Дата за первый платеж";
                                ?> </label>
                                <input type="date" class="form-control" id="exampleInputEmail1" name="data_last" aria-describedby="emailHelp" required>
                            </div>
                        <?php } else if($params[$i] == "data_two") {?>
                            <div class="form-group">
                                <label for="">Элемент: <?php
                                    echo "Дата за второй платеж";
                                ?> </label>
                                <input type="date" class="form-control" id="exampleInputEmail1" name="data_two" aria-describedby="emailHelp" >
                            </div>
                        <?php } else if($params[$i] == "data_tree") {?>
                            <div class="form-group">
                                <label for="">Элемент: <?php
                                    echo "Дата за третий платеж";
                                ?> </label>
                                <input type="date" class="form-control" id="exampleInputEmail1" name="data_tree" aria-describedby="emailHelp" >
                            </div>
                        <?php } else if($params[$i] == "data_four") {?>
                            <div class="form-group">
                                <label for="">Элемент: <?php
                                    echo "Дата за четвертый платеж";
                                ?> </label>
                                <input type="date" class="form-control" id="exampleInputEmail1" name="data_four" aria-describedby="emailHelp" >
                            </div>
                        <?php } else if($params[$i] == "data_dog") {
                            ?>
                            
                            <div class="form-group">
                                <label for="">Элемент: <?php
                                    echo "Дата заключения договора";
                                ?> </label>
                                <input type="date" class="form-control" id="exampleInputEmail1" name="data_dog" aria-describedby="emailHelp" >
                            </div>
                            
                            <?php
                        } else if($params[$i] == "data") {} else if($params[$i] == "price_first" or $params[$i] == "price_last" or $params[$i] == "price_two" or $params[$i] == "price_tree" or $params[$i] == "price_four") { 
                        
                            ?>
                            
                            <label for="">Элемент: <?php 
                            if($params[$i] == "price_first") {
                                echo "Полная цена за обучение";
                            } 
                            else if($params[$i] == "price_last") {
                                echo "Первый платеж";
                            } 

                            else if($params[$i] == "price_two") {
                                echo "Второй платеж";
                            } 
                            else if($params[$i] == "price_tree") {
                                echo "Третий платеж";
                            }
                            else if($params[$i] == "price_four") {
                                echo "Четвертый платеж";
                            }    
                            
                            ?> </label>
                            <input type="number" class="form-control" id="exampleInputEmail1" name="edit[]" value="0" aria-describedby="emailHelp" >
                        <?php } else if($params[$i] == "groups") { ?>
                            <label for="">Элемент: <?php 
                             echo "Группа";
                            ?></label>
                            <select class="form-control" aria-label="Default select example" name="groups" id="" >
                                <option value="">Выберите</option>
                                <option value="группа Успех">группа Успех</option>
                                <option value="группа Чкалова">группа Чкалова</option>
                                <option value="группа Володарского">группа Володарского</option>
                            </select>
                        <?php } else if($params[$i] == "io") { ?>
                            <label for="">Элемент: <?php 
                             echo "Индивидуальное обучение";
                            ?></label>
                            <select class="form-control" aria-label="Default select example" name="io" id="" >
                                <option value="">Выберите</option>
                                <option value="И.О. Горбунов">И.О. Горбунов</option>
                                <option value="И.О. Тарануха">И.О. Тарануха</option>
                            </select>
                        <?php } else if($params[$i] == "distant") { ?>
                            <label for="">Элемент: <?php 
                             echo "Дистант";
                            ?></label>
                            <select class="form-control" aria-label="Default select example" name="distant" id="" >
                                <option value="">Выберите</option>
                                <option value="Да">Да</option>
                                <option value="Нет">Нет</option>
                            </select>                          
                        <?php } else if($params[$i] == "korobka") { ?>
                            <label for="">Элемент: <?php 
                             echo "коробка";
                            ?></label>
                            <select class="form-control" aria-label="Default select example" name="korobka" id="" >
                                <option value="">Выберите</option>
                                <option value="МКПП">МКПП</option>
                                <option value="АКПП">АКПП</option>
                            </select>                         
                        <?php } else { ?>
                        <div class="form-group">
                            <label for="">Элемент: <?php 
                            
                            if($params[$i] == "fio") {
                                echo "ФИО";
                            } 
                            else if($params[$i] == "phone") {
                                echo "Телефон";
                            } 
                         
                            ?></label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="edit[]" value="<?= $edit[0][$i + 1] ?>" aria-describedby="emailHelp" required>
                        </div>
                        <?php } } ?>
                        <button type="submit" class="btn btn-danger" name="button">Добавить</button>
                    </form>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        label {
            margin: 10px 0px;
        }
    </style>

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

</body>

</html>