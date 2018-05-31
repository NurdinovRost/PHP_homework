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

  $query = "SELECT Busses.bus_ID, Drivers.driver_ID, pasport_date, class, bulk FROM Busses 
      INNER JOIN Drivers ON Busses.bus_ID = Drivers.bus_ID";

  $result = $link->query($query);
    $result1 = $link->query($query);
    $len = count(mysqli_fetch_row($result1));

  echo "<table border=1 width=30%>";
  echo "<caption><strong>Информация</strong></caption>";
    echo "<tr>";
    echo "<td align=center>bus_ID</td>";
    echo "<td align=center>driver_ID</td>";
    echo "<td align=center>pasport_date</td>";
    echo "<td align=center>class</td>";
    echo "<td align=center>bulk</td>";
    echo "</tr><br>";
    while ($row = mysqli_fetch_row($result)) {
      echo "<tr>";
        for ($j = 0 ; $j < $len; $j++) echo "<td align=center>$row[$j]</td>";
      echo "</tr>";
  }
  echo "</table>";





?>

<form name="form" method="GET" action="edit.php">
  <p>
  <p>
    <input type="submit" name="button_edit"  value="Редактировать" >
  </p>
  </p>
</form>















</body>
</html>