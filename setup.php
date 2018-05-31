<!doctype html>
<head>
    <meta charset="utf-8">
    <title>Админ-панель</title>
</head>
<body>


<?php

include('connection.php');


// CREATE BD


$link = mysqli_init();
if (!mysqli_real_connect($link, $host, $user, $password, $db))
  {
  die("Connect Error: " . mysqli_connect_error());
  }


$query = "CREATE TABLE Busses
(
    bus_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    type_bus VARCHAR(200) NOT NULL,
    bulk INT NOT NULL,
    status_bus VARCHAR(200) NOT NULL
)";
$result = mysqli_query($link, $query) or die("Ошибка  Table Busses :( " . mysqli_error($link)); 
if($result)
{
    echo "<p>Создание таблицы Busses прошла успешно \n</p>";
}

$query = "CREATE TABLE Routes
(
    route_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    bus_ID INT NOT NULL,
    time_start_motion INT NOT NULL,
    time_end_motion INT NOT NULL,
    distance_spasing INT NOT NULL,
    distance_in_minutes INT NOT NULL,
    FOREIGN KEY (`bus_ID`) REFERENCES `Busses` (`bus_ID`)
)";
$result = mysqli_query($link, $query) or die("Ошибка Table Routes :( " . mysqli_error($link)); 
if($result)
{
    echo "<p>Создание таблицы Routes прошла успешно \n</p>";
}

$query = "CREATE TABLE Drivers
(
    driver_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    bus_ID INT NOT NULL,
    route_ID INT NOT NULL,
    pasport_date VARCHAR(200) NOT NULL,
    class VARCHAR(45) NOT NULL,
    salary INT NOT NULL,
    status_drive VARCHAR(200) NOT NULL,
    graph_work VARCHAR(200) NOT NULL,
    FOREIGN KEY (`bus_ID`) REFERENCES `Busses` (`bus_ID`),
    FOREIGN KEY (`route_ID`) REFERENCES `Routes` (`route_ID`)
)";
$result = mysqli_query($link, $query) or die("Ошибка Table Drivers :( " . mysqli_error($link)); 
if($result)
{
    echo "<p>Создание таблицы Drivers прошла успешно \n</p>";
}

/*$query = "CREATE TABLE Controllers
(
    controller_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    bus_ID INT NOT NULL,
    pasport_date VARCHAR(200) NOT NULL,
    graph_work VARCHAR(200) NOT NULL,
    salary INT NOT NULL,
    FOREIGN KEY (`bus_ID`) REFERENCES `Busses` (`bus_ID`)
)";
$result = mysqli_query($link, $query) or die("Ошибка Table Controllers :( " . mysqli_error($link));
if($result)
{
    echo "Создание таблицы Controllers прошла успешно \n</p>";
}
*/


$query = "CREATE TABLE Repairs
(
    repair_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    value_repair INT NOT NULL,
    guarantees VARCHAR(200) NOT NULL,
    fio_master VARCHAR(200) NOT NULL,
    date_begin_work DATE NOT NULL,
    date_end_work DATE NOT NULL
)";
$result = mysqli_query($link, $query) or die("Ошибка Table Repairs :( " . mysqli_error($link));
if($result)
{
    echo "<p>Создание таблицы Repairs прошла успешно \n</p>";
}

$query = "CREATE TABLE Breakings
(
    break_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    bus_ID INT NOT NULL,
    repair_ID INT NOT NULL,
    date_break DATETIME NOT NULL,
    FOREIGN KEY (`bus_ID`) REFERENCES `Busses` (`bus_ID`),
    FOREIGN KEY (`repair_ID`) REFERENCES `Repairs` (`repair_ID`)
)";
$result = mysqli_query($link, $query) or die("Ошибка Table Breakings :( " . mysqli_error($link));
if($result)
{
    echo "<p>Создание таблицы Breakings прошла успешно \n</p>";
}

$query = "CREATE TABLE Departures
(
    departure_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    driver_ID INT NOT NULL,
    bus_ID INT NOT NULL,
    route_ID INT NOT NULL,
    break_ID INT,
    place VARCHAR(45) NOT NULL,
    FOREIGN KEY (`bus_ID`) REFERENCES `Busses` (`bus_ID`),
    FOREIGN KEY (`route_ID`) REFERENCES `Routes` (`route_ID`),
    FOREIGN KEY (`driver_ID`) REFERENCES `Drivers` (`driver_ID`),
    FOREIGN KEY (`break_ID`) REFERENCES `Breakings` (`break_ID`)
)";
$result = mysqli_query($link, $query) or die("Ошибка Table Departures :( " . mysqli_error($link)); 
if($result)
{
    echo "<p>Создание таблицы Departures прошла успешно \n</p>";
}


// INSERT 


$query = "INSERT INTO Busses (bus_ID, type_bus, bulk, status_bus)
VALUES (1, 'VAZ2107', 31, 'workable'),
       (2, 'GAZEL', 20, 'workable'),
       (3, 'VAZ2107', 45, 'unworkable'),
       (4, 'KAVZ', 23, 'workable'),
       (5, 'PAZ-603', 38, 'workable'),
       (6, 'PAZ-603', 38, 'workable'),
       (7, 'VAZ2107', 55, 'workable')";

if ($link->query($query)) {
    echo "<p>Table Busses заполнена \n</p>";
} else {
    echo "Error: " . $query . "<br>" . $link->error;
}

$query = "INSERT INTO Routes (route_ID, bus_ID, time_start_motion, time_end_motion, distance_spasing, distance_in_minutes)
VALUES (1, 2, 2000, 3000, 500, 1000),
       (2, 7, 1000, 3000, 550, 2000),
       (3, 6, 500, 3500, 600, 3000),
       (4, 4, 300, 3000, 400, 2700),
       (5, 5, 2100, 3000, 300, 900),
       (6, 3, 600, 3000, 200, 2400),
       (7, 1, 1000, 1500, 100, 500)";

if ($link->query($query)) {
    echo "<p>Table Routes заполнена \n</p>";
} else {
    echo "Error: " . $query . "<br>" . $link->error;
}

$query = "INSERT INTO Drivers (driver_ID, bus_ID, route_ID, pasport_date, class, salary, status_drive, graph_work)
VALUES (1, 2, 1, 'Vanya', 'Seniore', 35000, 'workable', 'monday - friday'),
       (2, 1, 7, 'Vasya', 'middle1', 25000, 'workable', 'monday - friday'),
       (3, 5, 5, 'Petr', 'senior', 35000, 'workable', 'monday - friday'),
       (4, 4, 4, 'Daniil', 'junior', 15000, 'workable', 'monday - friday'),
       (5, 3, 6, 'Sasha', 'middle2', 25000, 'unworkable', 'monday - friday'),
       (6, 6, 3, 'Natasha', 'senioR', 35000, 'workable', 'monday - friday'),
       (7, 7, 2, 'Ashot', 'begginer', 10000, 'workable', 'monday - friday')";

if ($link->query($query)) {
    echo "<p>Table Drivers заполнена \n</p>";
} else {
    echo "Error: " . $query . "<br>" . $link->error;
}

/*$query = "INSERT INTO Controllers (controller_ID, bus_ID, pasport_date, graph_work, salary)
VALUES (1, 2, 'Katya 972412-0123', 'monday - friday', 35000),
       (2, 1, 'Masha 322322-9322', 'monday - friday', 25000),
       (3, 5, 'Lida 823408-8732', 'monday - friday', 35000),
       (4, 4, 'Gleb 972364-7362', 'monday - friday', 15000),
       (5, 3, 'Sergey 9246428-6536', 'monday - friday', 25000),
       (6, 6, 'Dasha 972312-6284', 'monday - friday', 35000),
       (7, 7, 'Masha 637452-9822', 'monday - friday', 10000)";

if ($link->query($query)) {
    echo "<p>Table Controllers заполнена \n</p>";
} else {
    echo "Error: " . $query . "<br>" . $link->error;
}
*/

$query = "INSERT INTO Repairs (repair_ID, value_repair, guarantees, fio_master, date_begin_work, date_end_work)
VALUES (1, 10000, 'YES', 'Denis', '2018-01-12 21:15:32', '2018-01-27 12:00:00'),
       (2, 5300, 'YES', 'Denis', '2018-02-03 07:33:57', '2018-03-16 11:17:12')";

if ($link->query($query)) {
    echo "<p>Table Repairs заполнена \n</p>";
} else {
    echo "Error: " . $query . "<br>" . $link->error;
}

$query = "INSERT INTO Breakings (break_ID, bus_ID, repair_ID, date_break)
VALUES (1, 2, 1, '2018-01-11 23:15:43'),
       (2, 3, 2,  '2018-03-01 11:32:55')";

if ($link->query($query)) {
    echo "<p>Table Breakings заполнена \n</p>";
} else {
    echo "Error: " . $query . "<br>" . $link->error;
}

$query = "INSERT INTO Departures (departure_ID, driver_ID, bus_ID, route_ID, break_ID, place)
VALUES (1, 2, 1, 7, NULL ,NULL),
       (2, 3, 5, 5, 2, 'Naberejnaya')";

if ($link->query($query)) {
    echo "<p>Table Departures заполнена \n</p>";
} else {
    echo "Error: " . $query . "<br>" . $link->error;
}


$link->close();
?>


</body>
</html>














