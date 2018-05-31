<!doctype html>
<head>
    <meta charset="utf-8">
    <title>Админ-панель</title>
</head>
<body>


<?php

$user = 'user';
$password = '1234';
$db = 'park';
$host = 'localhost';
$port = 8888;

$link = mysqli_init();
if (!mysqli_real_connect($link, $host, $user, $password, $db))
  {
  die("Connect Error: " . mysqli_connect_error());
  }


$query = $link->query('DROP TABLE IF EXISTS Drivers');
if($query)
{
	echo "<p>Удаление TABLE Drivers \n</p>";
}

/*$query = $link->query('DROP TABLE IF EXISTS Controllers');
if($query)
{
	echo "<p>Удаление TABLE Controllers \n</p>";
} */


$query = $link->query('DROP TABLE IF EXISTS Breakings');
if($query)
{
	echo "<p>Удаление TABLE Breakings \n</p>";
}

$query = $link->query('DROP TABLE IF EXISTS Departures');
if($query)
{
	echo "<p>Удаление TABLE Departures \n</p>";
}

$query = $link->query('DROP TABLE IF EXISTS Repairs');
if($query)
{
	echo "<p>Удаление TABLE Repairs \n</p>";
}

$query = $link->query('DROP TABLE IF EXISTS Routes');
if($query)
{
	echo "<p>Удаление TABLE Routes \n</p>";
}

$query = $link->query('DROP TABLE IF EXISTS Busses');
if($query)
{
	echo "<p>Удаление TABLE Busses \n</p>";
}

$link->close();
?>


</body>
</html>