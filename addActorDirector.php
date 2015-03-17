<html>
	<head>
		<title>Add Actor/Director</title>
		<style>
		.error {color: #FF0000;}
		</style>
		
		<link rel="stylesheet" href="./jquery-ui.css">
		<script src="./jquery-1.10.2.js"></script>
		<script src="./jquery-ui.js"></script>
		<!--
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
		<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
		<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
		-->
		<script>
			$(function() {
				$( "#datepicker" ).datepicker();
			});
		</script>
		<script>
			$(function() {
				$( "#datepicker2" ).datepicker();
			});
		</script>
	</head>
	<body>
	<h1>Add new actor/director:</h1>
	<br>
	
	<?php
	$firstErr = $lastErr = $dobErr = "";
	$result = "";
	if($_GET["submit"] == TRUE){
		if(empty($_GET["first"]))
			$firstErr = "First name is required";
		else
			$first = $_GET["first"];
		if(empty($_GET["last"]))
			$lastErr = "Last name is required";
		else
			$last = $_GET["last"];
		if(empty($_GET["dob"]))
			$dobErr = "Date of birth is required";
		else{
			$dob = $_GET["dob"];
			$dob = date("Y-m-d", strtotime($dob));
		}
			
	if(($firstErr == NULL) && ($lastErr == NULL) && ($dobErr == NULL)){
	require("./dbconfig.php");
	$ID = mysql_query("SELECT * FROM MaxPersonID", $db_connection);
	if($ID != NULL){
		$row = mysql_fetch_row($ID);
		$id = $row[0];
}
	$id = $id + 1;
	$identity = $_GET["identity"];
	$sex = $_GET["sex"];
	$dod = $_GET["dod"];
	$dod = (empty($dod)?"":date("Y-m-d", strtotime($dod)));
	$dod = (empty($dod)?"NULL":"'$dod'");
	echo $dod;
	if($identity == "Director")
		$query = "INSERT INTO $identity VALUES('$id', '$last', '$first', '$dob', $dod);";
	if($identity == "Actor")
		$query = "INSERT INTO $identity VALUES('$id', '$last', '$first', '$sex', '$dob', $dod);";
	//$sanitized_query = mysql_real_escape_string($query, $db_connection);
	$rs = mysql_query($query, $db_connection);
	if(!$rs){
		$result = "Insert unsuccessful. " . mysql_error();
	}
	else{
		$result = "Insert successful";
		mysql_query("UPDATE MaxPersonID SET id = '$id'", $db_connection);
	}
	mysql_close($db_connection);
	}
	}
?>
	<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		identity: 
		<input type="radio" name="identity" value="Actor" checked="true">Actor
		<input type="radio" name="identity" value="Director">Director
	<hr>
		First Name:	<input type="text" name="first" maxlength='20'>
		<span class="error">* <?php echo $firstErr;?></span><br>
		Last Name:	<input type="text" name="last" maxlength='20'>
		<span class="error">* <?php echo $lastErr;?></span><br>
		Sex: 
		<input type="radio" name="sex" value="Male" checked="true">Male
		<input type="radio" name="sex" value="Female">Female<br>
		Date of Birth: <input type="text" name="dob" id="datepicker">
		<span class="error">* <?php echo $dobErr;?></span><br>
		Date of Death: <input type="text" name="dod" id="datepicker2"><br>
		<input type="submit" value="insert" name="submit">
	</form>
	<?php echo $result;?>
	</body>
</html>