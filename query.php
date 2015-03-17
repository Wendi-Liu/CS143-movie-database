<html>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
<TEXTAREA NAME = "query" ROWS = 5 COLS = 30>
</TEXTAREA>
<input type = "submit" name = "submit" value = "Submit">
</form>

<?php
$db_connection = mysql_connect("localhost", "cs143","");
if(!$db_connection){
	die("Could not connect: " . mysql_error());
}
$db_selected = mysql_select_db("CS143", $db_connection);
if(!$db_selected){
	die('Can\'t use database: '.mysql_error());
}
$que = $_GET["query"];
$que = str_replace(array("\r", "\n"), " ", $que);
if($que!=NULL){
$sanitized_que = mysql_real_escape_string($que, $db_connection);
$rs = mysql_query($sanitized_que, $db_connection);

while($row = mysql_fetch_row($rs)) {
    foreach ($row as $attr) {
    	echo $attr." ";
    }
    echo "<br/>";
}
}
mysql_close($db_connection);
?>
</html>
</body>