<html>
<head>
	<h1>Add new Director in a movie:</h1>
</head>
 <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "GET">   
 		Movie:
 		<?php
		require "./dbconfig.php";
		$movie = mysql_query("SELECT title,year,id FROM Movie ORDER BY title", $db_connection);
		?>
 		<SELECT NAME="movie_id">
       <?php while($rows=mysql_fetch_row($movie)){
	?>
            <option VALUE = "<?php echo $rows[2];?>" >
            <?php echo $rows[0].$row[1]; ?> 
            </option>
     <?php } ?>
   		</SELECT>
 	<br>
        Director:
        <?php
        require "./dbconfig.php";
        $director = mysql_query("SELECT first,last,id FROM Director ORDER BY first", $db_connection);
        ?>
        <SELECT NAME="director_id">
       <?php while($rows=mysql_fetch_row($director)){
    ?>
    
            <option VALUE = "<?php echo $rows[2];?>" >
            <?php echo $rows[0]." ".$rows[1]; ?> 
            </option>
     <?php } ?>
        </SELECT>
       
        <input type = "submit" name = "submit" value="add it!">
    </form>
       




<?php
$movie_id = $_GET["movie_id"];
$director_id = $_GET["director_id"];

$score = "INSERT INTO MovieDirector(mid, did) VALUES ('$movie_id','$director_id');";
//$score = "INSERT INTO Review(name, time, mid, rating, comment) VALUES($name, date("Y-m-d H:i",time()), $mid, $rating, $comment)";
$usersub = $_GET["submit"];
if($usersub == TRUE){
if(mysql_query($score, $db_connection)){
	echo "New director added successfully!";
}
else{
	echo "Error adding this director";
    die(mysql_error());
}
}




mysql_close($db_connection);
?>
</html>