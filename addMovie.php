<html>
	<head>
		<title>Add Movie</title>
		<style>
		.error {color: #FF0000;}
		</style>
	</head>
	<body>
	<h1>Add new Movie:</h1>
	<br>
	
	<?php
	$titleErr = "";
	$prompt = "";
	if($_GET["submit"] == TRUE){
		if(empty($_GET["title"]))
			$titleErr = "Title is required";
		else
			$title = $_GET["title"];
			
	if(empty($titleErr)){
	require("./dbconfig.php");
	$ID = mysql_query("SELECT * FROM MaxMovieID", $db_connection);
	if($ID != NULL){
		$row = mysql_fetch_row($ID);
		$id = $row[0];
}
	$id = $id + 1;
	$year = $_GET["year"];
	$rating = $_GET["rating"];
	$rating = (empty($rating)?"NULL":"'$rating'");
	$company = $_GET["company"];
	$company = (empty($company)?"NULL":"'$company'");
	$query = "INSERT INTO Movie VALUES('$id', '$title', '$year', $rating, $company);";
	//$sanitized_query = mysql_real_escape_string($query, $db_connection);
	$rs = mysql_query($query, $db_connection);
	if(!$rs){
		$prompt = "Insert unsuccessful. " . mysql_error() ."<br>";
	}
	else{
		if(!empty($_GET['genre'])){
			foreach($_GET["genre"] as $gnr){
				$genreQuery = "INSERT INTO MovieGenre VALUES('$id', '$gnr')";
				$genreResult = mysql_query($genreQuery, $db_connection);
				if(!$genreResult){
					$prompt += "Insert unsuccessful. " . mysql_error() ."<br>";
				}
			}
		}
		if(empty($prompt)){
			$prompt = "Insert successful";
			mysql_query("UPDATE MaxMovieID SET id = '$id'", $db_connection);
		}
	}
	mysql_close($db_connection);
	}
	}
?>
	<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

		Title:	<input type="text" name="title" maxlength='20'>
		<span class="error">* <?php echo $titleErr;?></span><br>
		Year:	<select name="year">
		<?php
		for($i=1900;$i<=date("o");$i++)
		echo "<option> $i";
		?>
		</select><br> 
		Genre: <select name = "genre[]" MULTIPLE SIZE = 7>
		<OPTION>Drama
		<OPTION>Comedy
		<OPTION>Romance
		<OPTION>Crime
		<OPTION>Horror
		<OPTION>Mystery
		<OPTION>Thriller
		<OPTION>Action
		<OPTION>Adventure
		<OPTION>Fantasy
		<OPTION>Documentary
		<OPTION>Family
		<OPTION>Sci-Fi
		<OPTION>Animation
		<OPTION>Musical
		<OPTION>War
		<OPTION>Western
		<OPTION>Adult
		<OPTION>Short
		</select><br>
		Rating:	<select name="rating">
		<option>PG
		<option>R
		<option>PG-13
		<option>NC-17
		<option>surrendere
		<option>G
		<option value = "">Unknown
		</select><br>
		Company: <input type="text" name="company"><br>
		<input type="submit" value="insert" name="submit">
	</form>
	<?php echo $prompt;?>
	</body>
</html>