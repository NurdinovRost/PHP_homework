
<!doctype html>
<head>
    <meta charset="utf-8">
    <title>Админ-панель</title>
</head>
<body>



<form name="form" method="GET" onkeypress="if(event.keyCode == 13) return false;">
	<p><b> Выборка по стажу </b><br>
		<input type="text" name="search1" size="40" value="<?php echo( $_GET['search1'] );?>" >
	</p>

	<p><b> Выборка по вместимости </b><br>
		<input type="text" name="search2" size="40" value="<?php echo( $_GET['search2'] );?>" >
	</p>

	<p><input type="submit" name="start" value="Отправить"></p>

</form>


<?php
include('connection.php');
$link = mysqli_init();
if(!mysqli_real_connect($link, $host, $user, $password, $db)){
	die("Connect Error: " . mysqli_connect_error());
}
if(isset($_GET['search1']) or isset($_GET['search2'])){
	$input_str = $_GET['search1'];
	$input_value = $_GET['search2'];
	$input_str = str_replace("*", "_", $input_str);
	$input_value = str_replace("*", "0", $input_value);
	if(!is_numeric($input_value)){
		$input_value = 0;
	}
	$query = "SELECT Busses.bus_ID, Drivers.driver_ID, Routes.route_ID, pasport_date, class, bulk FROM Busses 
		  INNER JOIN Drivers ON Busses.bus_ID = Drivers.bus_ID
		  INNER JOIN Routes ON Busses.bus_ID = Routes.bus_ID
		  WHERE class LIKE '%$input_str%' AND bulk >= $input_value
		  ORDER BY bulk";
		  
	$result = $link->query($query);
    $result1 = $link->query($query);
    $len = count(mysqli_fetch_row($result1));
	echo "<table border=1 width=30%>";
	echo "<caption><strong>Информация</strong></caption>";
    echo "<tr>";
    echo "<td align=center>bus_ID</td>";
    echo "<td align=center>driver_ID</td>";
    echo "<td align=center>route_ID</td>";
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
}
?>	


</body>
</html>