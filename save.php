<?php

session_start();

$username = 'root';
$password = '';
$host = 'localhost';
$db = 'test';
$connection = new PDO("mysql:dbname=$db;host=$host", $username, $password);

if (!empty($_POST)) {

    if (!isset($_POST['name']) && !isset($_POST['name']) && !isset($_POST['name'])) {
        $_SESSION['error'] = 'Переданы не все параметры';
    }

    if ($_POST['name'] == '') {
        $_SESSION['error'] = 'Имя не должно быть пустым';
    }

    if ($_POST['age'] < 10 || $_POST['age'] > 100) {
        $_SESSION['error'] = 'Возраст должен быть от 10 до 100';
    }

    if ($_POST['city_id'] == '') {
        $_SESSION['error'] = 'Необходимо указать город';
    }

    if (isset($_SESSION['error'])) {
        header("Location: /create.php");
        exit();
    }

    $query = $connection->prepare("insert into users (name, age, city_id) VALUES (:name, :age, :city_id)");
    $query->bindParam(':name', $_POST['name']);
    $query->bindParam(':age', $_POST['age']);
    $query->bindParam(':city_id', $_POST['city_id']);

    $query->execute();

    $_SESSION['success'] = 'Запись добавлена';
    header("Location: /create.php");
}
?>