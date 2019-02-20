<?php

session_start();

$username = 'root';
$password = '';
$host = 'localhost';
$db = 'test';
$connection = new PDO("mysql:dbname=$db;host=$host", $username, $password);

$sql = 'select u.name, u.age, c.title as city_title from users u left join cities c on u.city_id = c.id order by u.id;';
$query = $connection->prepare($sql);
$query->execute();
$users = $query->fetchAll();

?>


<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<style>
.divTable{
	display: table;
	width: 100%;
}
.divTableRow {
	display: table-row;
}
.divTableHeading {
	background-color: #EEE;
	display: table-header-group;
}
.divTableCell, .divTableHead {
	border: 1px solid #999999;
	display: table-cell;
	padding: 3px 10px;
}
.divTableHeading {
	background-color: #EEE;
	display: table-header-group;
	font-weight: bold;
}
.divTableFoot {
	background-color: #EEE;
	display: table-footer-group;
	font-weight: bold;
}
.divTableBody {
	display: table-row-group;
}
</style>
</head>
<body>
<a href="/create.php">Create user</a>
<br>
<div class="divTable">
    <div class="divTableHeading">
        <div class="divTableRow">
            <div class="divTableHead">Name</div>
            <div class="divTableHead">Age</div>
            <div class="divTableHead">City</div>
        </div>
    </div>
    <div class="divTableBody">
        <?php foreach ($users as $user): ?>
            <div class="divTableRow">
                <div class="divTableCell"><?= $user['name'] ?></div>
                <div class="divTableCell"><?= $user['age'] ?></div>
                <div class="divTableCell"><?= $user['city_title'] ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>