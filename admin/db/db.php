<?php

$user = "root";
$pass = "";

$pdo = new PDO("mysql:host=localhost;dbname=avto56;charset=utf8mb4",$user,$pass);

if(!$pdo) {
    die("Error connect db");
} 