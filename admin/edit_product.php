<?php 
require "./db/db.php";
require "./config.php";

session_start();

if($_SESSION['user']['login'] and $_SESSION['user']['role'] == "admin") {

} else {
    header("Location: ". "index.php");
}
function Edit() {
    global $pdo;
    global $host;

    if(isset($_GET['table']) and isset($_GET['id'])) {
        $table = $_GET['table'];
        $id = $_GET['id'];

        try {
            if($table == "tables") {
                $query = $pdo->prepare("SELECT `fio`, `phone`, `price_first`, `price_last`, `price_two`, `data_two`, `price_tree`, `data_tree`, `price_four`, `data_four`, `data_dog`, `status`, `groups`, `io`, `distant`, `korobka` FROM `$table` WHERE `id`= ?");
                $query->execute([$id]);
                $result = $query->fetchAll();
                return $result;
            }
        } catch (\Throwable $th) {
            echo json_encode([[
                "status" => 404,
                "message" => "Error"
            ]]);
        }
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
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php 
                    $id = $_GET['id'];
                    function update($table, $id, $params){
                        global $pdo;
                        // UPDATE `users` SET username = 'test' WHERE `id` = 10;
                    
                        $i = 0;
                        $str = '';
                        foreach($params as $key => $value){
                            if ($i === 0){
                                $str = $str . $key . "= '$value'";
                            }else{
                                $str = $str . ", $key" . "= '$value'";
                            }
                            $i++;
                        }
                    
                    
                        $sql = "UPDATE $table SET $str WHERE id = $id";
                    
                        $query = $pdo->prepare($sql);
                        $query->execute($params);
                    }

                    if(isset($_POST['delete'])) {
                        $delete = $_POST['delete'];
    
                        $query = $pdo->prepare("DELETE FROM `tables` WHERE `id` = ?");
                        $query->execute([$delete]);
                        $id = (int)$_GET['id'] + 1;
                        $to = $_GET['to'];
                        $from = $_GET['from'];
                        echo "<script>window.location.href = 'tables.php?to=$to&from=$from#$id';</script>";
                    }    

                    if(isset($_POST['button'])) {
                        $table = $_GET['table'];
                        $id = $_GET['id'];
                        $to = $_GET['to'];
                        $from = $_GET['from'];
                        $params = $_GET['params'];
                        $data = $_POST['data'];
                        $groups = $_POST['groups'];
                        $io = $_POST['io'];
                        $distant = $_POST['distant'];
                        $korobka = $_POST['korobka'];
                        // print_r($incpector);
                        // $status = $_POST['status'];
                        $data_dog = $_POST['edit'][10];

                        $success = [];
                        $success += ["groups" => $groups];
                        $success += ["io" => $io];
                        $success += ["distant" => $distant];
                        $success += ["korobka" => $korobka];

                        $random = rand(1, 999999999999999999);
                        $filename = $_FILES["file_categories"]["name"];
                        $full = "$random-$filename";
                        $tempname = $_FILES["file_categories"]["tmp_name"];
                        $folder = "";
                        $folder = "../image/product/" . $full;
                        $today = date("Y-m-d");
                        $price_debt = $_POST['edit'][2] - $_POST['edit'][3] - $_POST['edit'][4] - $_POST['edit'][6] - $_POST['edit'][8];

                        for ($i=0; $i < count($params); $i++) {
                            if($params[$i] == "status") {
                                if($price_debt <= 0) { ;
                                    $success += ["status" => "Не должен"];
                                 }
                            } else if($params[$i] == "data") {
                                $final = date("Y-m-d", strtotime("+1 month"));
                                if($price_debt <= 0) { 
                                    $finals = date("Y-m-d", strtotime("+800 year"));
                                    $success += ["data" => $finals];
                                 } else {
                                    $success += ["data" => $final];
                                 }
                            } else {
                                $success += [$params[$i] => $_POST['edit'][$i]];
                            }

                        }

                        if($_POST['edit'][5] >= 1) {
                            $success += ["data_two" => $_POST['edit'][5]];
                        } else if($_POST['edit'][7] >= 1) {
                            $success += ["data_tree" => $_POST['edit'][7]];
                        } else if($_POST['edit'][9] >= 1) {
                            $success += ["data_four" => $_POST['edit'][9]];
                        }

                        // echo $_POST['edit'][3];
                        // echo " - ";
                        // echo $_POST['edit'][4];
                        // echo " - ";
                        // echo $_POST['edit'][6];
                        // echo " - ";
                        // echo $_POST['edit'][8];

                        if($price_debt <= 0) {
                            $success += ["debt" => 0];
                        } else {
                            $success += ["debt" => $price_debt];
                        }

                        // $success += ["data_two" => $today];
                        // print_r($data_dog);
                        // print_r($success);
                        update($table, $id, $success);
                        echo "<script>window.location.href = '$table.php?to=$to&from=$from#$id';</script>";
                    }

                    ?>
                    <h2>Изменения</h2>
                    <form method="POST" enctype="multipart/form-data">
                        <?php 
                        $edit = Edit();
                        $params = $_GET['params'];
                        
                        echo $_POST['edit'][7];
                        
                        for ($i=0; $i < count($edit[0]) / 2; $i++) {
                            if($params[$i] == "data") {
                        ?>

                        <?php } else if($params[$i] == "status") {} else if($params[$i] == "data_two" or $params[$i] == "data_tree" or $params[$i] == "data_four" or $params[$i] == "data_dog") { ?>
                            <div class="form-group">
                                <label for="">Элемент: <?php 
                                if($params[$i] == "data_two") {
                                    echo "Дата за второй платеж";
                                } 
                                else if($params[$i] == "data_tree") {
                                    echo "Дата за третий платеж";
                                } 
                                else if($params[$i] == "data_four") {
                                    echo "Дата за четвертый платеж";
                                }
                                else if($params[$i] == "data_dog") {
                                    echo "Дата заключения договора";
                                }
                                ?></label><br>
                                <input type="date" class="form-control" id="exampleInputEmail1" name="edit[]" value='<?= $edit[0][$i]; ?>'>
                            </div>

                            <!-- <select class="form-control" aria-label="Default select example" name="status" id="" required>
                                <option value="">Статус</option>
                                <option value="Должен">Должен</option>
                                <option value="Не должен">Не должен</option>
                            </select> -->
                        <?php } else if($params[$i] == "price_first" or $params[$i] == "price_last" or $params[$i] == "price_two" or $params[$i] == "price_tree" or $params[$i] == "price_four") { ?>
                            <div class="form-group">
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
                                
                                ?></label>
                            
                                <input type="number" class="form-control" id="exampleInputEmail1" name="edit[]" value='<?= $edit[0][$i]; ?>' aria-describedby="emailHelp">
                            </div>
                            <?php } else if($params[$i] == "groups") { ?>
                            <label for="">Элемент: <?php 
                             echo "Группа";
                            ?></label>
                            <select class="form-control" aria-label="Default select example" name="groups" id="" >
                                <option value="">Выберите</option>
                                <option value="группа Успех" <?php if($edit[0][$i] == "группа Успех") echo 'selected'; ?>>группа Успех</option>
                                <option value="группа Чкалова" <?php if($edit[0][$i] == "группа Чкалова") echo 'selected'; ?>>группа Чкалова</option>
                                <option value="группа Володарского" <?php if($edit[0][$i] == "группа Володарского") echo 'selected'; ?>>группа Володарского</option>
                            </select>
                        <?php } else if($params[$i] == "io") { ?>
                            <label for="">Элемент: <?php 
                             echo "Индивидуальное обучение";
                            ?></label>
                            <select class="form-control" aria-label="Default select example" name="io" id="" >
                                <option value="">Выберите</option>
                                <option value="И.О. Горбунов" <?php if($edit[0][$i] == "И.О. Горбунов") echo 'selected'; ?>>И.О. Горбунов</option>
                                <option value="И.О. Тарануха" <?php if($edit[0][$i] == "И.О. Тарануха") echo 'selected'; ?>>И.О. Тарануха</option>
                            </select>
                        <?php } else if($params[$i] == "distant") { ?>
                            <label for="">Элемент: <?php 
                             echo "Дистант";
                            ?></label>
                            <select class="form-control" aria-label="Default select example" name="distant" id="" >
                                <option value="">Выберите</option>
                                <option value="Да" <?php if($edit[0][$i] == "Да") echo 'selected'; ?>>Да</option>
                                <option value="Нет" <?php if($edit[0][$i] == "Нет") echo 'selected'; ?>>Нет</option>
                            </select>                          
                        <?php } else if($params[$i] == "korobka") { ?>
                            <label for="">Элемент: <?php 
                             echo "коробка";
                            ?></label>
                            <select class="form-control" selected="selected" aria-label="Default select example" name="korobka" id="" >
                                <option value="">Выберите</option>
                                <option value="МКПП" <?php if($edit[0][$i] == "МКПП") echo 'selected'; ?>>МКПП</option>
                                <option value="АКПП" <?php if($edit[0][$i] == "АКПП") echo 'selected'; ?>>АКПП</option>
                            </select>
                            <?php } else { ?>
                            <div class="form-group" id="id_<?php echo $i ?>">
                                <label for="">Элемент: <?php 
                                
                                if($params[$i] == "fio") {
                                    echo "ФИО";
                                } 
                                else if($params[$i] == "phone") {
                                    echo "Телефон";
                                } 

                                // else if($params[$i] == "incpector") {
                                //     echo "Инструктор";
                                // }

                                // else if($params[$i] == "groups") {
                                //     echo "Группа";
                                // }

                                ?></label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="edit[]" value='<?= $edit[0][$i]; ?>' aria-describedby="emailHelp">
                            </div>
                        <?php } } ?>
                        <button type="submit" class="mt-3 btn btn-primary" name="button">Сохранить</button>
                    </form>
                    <form method="POST" style="margin-top: 20px;">
                        <button type="submit" name="delete" value="<?=$id;?>" class="btn btn-danger">Удалить</button>
                    </form>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <style>
                
            </style>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>&copy; Parilka56.ru 2023</span>
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