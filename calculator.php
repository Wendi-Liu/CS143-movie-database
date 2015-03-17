<html>
<body>

<p1>Type an expression in the following box (e.g., 10.5+20*3/25). </p1>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
<input type="text" name="expression">
<input type="submit" value="calculate"><br>
</form>
<?php

$exp = $_GET["expression"]; 
preg_match("/^\s*(\-?\d+\.?\d*)(\s*(\+|\-|\*|\/)\s*(\-?\d+\.?\d*))*$/",$exp,$matches);

if($matches[0]!=NULL){
	$firsttime = 0;
	preg_replace('# #', '', $matches[0]);
	if(strstr($matches[0],"/0"))
		echo "Divide by 0 Error!";
	else{
		echo $matches[0];
		echo '=';
		$str=str_replace('--','- -',$matches[0]); 
		echo eval("return  \"$str\";");
	}
}
else{
	if($exp != NULL)
		echo "Invalid Expression!";
}

?>

</body>
</html> 