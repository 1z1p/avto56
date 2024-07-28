<?php 
require "./db/db.php";
require "./config.php";
session_start();

if($_SESSION['user']['login'] and $_SESSION['user']['role'] == "admin" or $_SESSION['user']['role'] == "user") {
    header("Location: ". "tables.php?to=1&from=100");
}
function Users() {
    global $pdo;
    global $host;

    if(isset($_POST["login"]) and isset($_POST["password"])) {
        try {
            $login = $_POST["login"];
            $password = $_POST["password"];
    
            $query = $pdo->prepare("SELECT * FROM `admin` WHERE `login` = ? AND `password` = ?");
            $query->execute([$login,$password]);
            $result = $query->fetchAll();

            if($result[0] == false) {
                return "Логин или Пароль неверный";
            }

            if($result[0]) {
                $_SESSION['user'] = [
                    "id" => $result[0]["id"],
                    "login" => $result[0]["login"],
                    "role" => $result[0]["role"],
                ];

                header("Location: ". "tables.php?to=1&from=100");
            }
        } catch (\Throwable $th) {
            echo json_encode([[
                "status" => 404,
                "message" => "Error"
            ]]);
        }
    }
}

$msg = Users();

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

    <form action="" method="post">
        <h2>Вход</h2>
        <h3 style="color: red"><?php echo $msg; ?></h3>
        <div class="form-group">
            <label for="exampleInputEmail1">Логин</label>
            <input type="text" name="login" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Логин">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Пароль</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Пароль">
        </div>
        <button type="submit" class="btn btn-danger">Войти</button>
    </form>

    <style>
        form {
            max-width: 450px;
            margin: 100px auto;
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