<?php

session_start();

$username = 'root';
$password = '';
$host = 'localhost';
$db = 'test';
$connection = new PDO("mysql:dbname=$db;host=$host", $username, $password);

$sql = 'select * from cities;';
$query = $connection->prepare($sql);
$query->execute();
$cities = $query->fetchAll();

?>

<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <title>Добавление нового пользователя</title>
  <style>
    .success {
        color: green;
    }
    .error {
        color: red;
    }
  </style>
 </head>
 <body>
    <a href="/">Back</a>
    <?php if (isset($_SESSION['success'])): ?>
        <p class='success'><?= $_SESSION['success'] ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <p class='error'><?= $_SESSION['error'] ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <form method="POST" action="save.php">
        <p>Name</p>
        <input name="name" type="text" required>
        <p>Age</p> 
        <input name="age" type="number" min="10" max="100" required>
        <p>City</p>
        <select name="city_id">
            <?php foreach ($cities as $city): ?>
                <option value="<?= $city['id'] ?>"><?= $city['title'] ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <br>
        <button type="submit">create</button>
    </form>

 </body>
</html>