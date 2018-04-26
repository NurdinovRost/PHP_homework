<!doctype html>
<head>
    <meta charset="utf-8">
    <title>Админ-панель</title>
</head>
<body>


<?php


  include('connection.php');

	$link = mysqli_init();
	if (!mysqli_real_connect($link, $host, $user, $password, $db))
	{
		die("Connect Error: " . mysqli_connect_error());
  	}

   $sql = "SELECT Busses.bus_ID, Drivers.driver_ID, pasport_date, Routes.route_ID FROM Busses 
		  INNER JOIN Drivers ON Busses.bus_ID = Drivers.bus_ID
		  INNER JOIN Routes ON Busses.bus_ID = Routes.bus_ID";

   $result = $link->query($sql);
   $result1 = $link->query($sql);
   $len = count(mysqli_fetch_row($result1));


   echo "<table border=1 align=center width=30%>";
   echo "<caption><strong>Информация</strong></caption>";
   echo "<tr>";
   echo "<td align=center>bus_ID</td>";
   echo "<td align=center>driver_ID</td>";
   echo "<td align=center>pasport_date</td>";
   echo "<td align=center>route_ID</td>";
   echo "</tr><br>";

   while ($row = mysqli_fetch_row($result)) {
    echo "<tr>";
        for ($j = 0 ; $j < $len; $j++) echo "<td align=center>$row[$j]</td>";
    echo "</tr>";
}

	echo "</table>";

?>


</body>
</html>