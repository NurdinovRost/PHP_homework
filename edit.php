


<?php
include('connection.php');
$link = mysqli_init();
if(!mysqli_real_connect($link, $host, $user, $password, $db)){
	die("Connect Error: " . mysqli_connect_error());
}

$flag = False;

if(isset($_GET['input_bus'])){

	$input_bus = $_GET['input_bus'];
	$input_value1 = $_GET['input_value1'];


	if(is_numeric($input_bus)){
		if(!is_numeric($input_value1)){
			$input_value1 = 0;
		}


		$query = "UPDATE Busses SET bulk = $input_value1 WHERE bus_ID = $input_bus";
		$link->query($query);


	$flag = True;
	}

}

if(isset($_GET['input_driver'])){
	$input_driver = $_GET['input_driver'];
	$input_value2 = $_GET['input_value2'];

	if(is_numeric($input_driver)){
		if(is_null($input_value2)){
			$input_value2 = "";
		}

		$a = $_GET['vtkey'];

		$query = "UPDATE Drivers SET $a = '$input_value2' WHERE driver_ID = $input_driver";
		$link->query($query);


		$flag = True;
	}

}

if ($flag){
	header('Location:http://localhost:8888/list.php'); exit;
}

?>	


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>Админ-панель</title>
    <script type="text/javascript">
		function f() {
			var v = myForm.vtkey.options[0].text;

			return v;
		}
	</script>

</head>
<body>



	<form name = 'myForm' action='edit.php' method = 'get'>
	<table>
	<tr><th><i>Значение:</i></th></tr>
	<tr><td>bus_ID: <input name = 'input_bus' type = 'text' value=''></td></tr>
	<tr><td>bulk: <input name = 'input_value1' type = 'text' value=''></td></tr>
	<tr><td>driver_ID: <input name = 'input_driver' type = 'text' value=''></td></tr>
	<tr><td><select name="vtkey">
     <option value="pasport_date">pasport_date</option>
     <option value="class">class</option>
     <input name = 'input_value2' type = 'text' value=''></td></tr>
   </select></td></tr>
	</table>
	<br/>
	<input type = 'submit' value = 'button'>
	</form>


</body>
</html>