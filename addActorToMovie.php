<html>
<head>
	<h1>Add new Actor in a movie:</h1>
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
        Actor:
        <?php
        require "./dbconfig.php";
        $actor = mysql_query("SELECT first,last,id FROM Actor ORDER BY first", $db_connection);
        ?>
        <SELECT NAME="actor_id">
       <?php while($rows=mysql_fetch_row($actor)){
    ?>
    
            <option VALUE = "<?php echo $rows[2];?>" >
            <?php echo $rows[0]." ".$rows[1]; ?> 
            </option>
     <?php } ?>
        </SELECT>
        Role:
        <input type="text" name= "role">
        <br>
        <input type = "submit" name = "submit" value="add it!">
    </form>
       




<?php
$movie_id = $_GET["movie_id"];
$actor_id = $_GET["actor_id"];
$role = $_GET["role"];
$score = "INSERT INTO MovieActor VALUES ('$movie_id', '$actor_id','$role');";
//$score = "INSERT INTO Review(name, time, mid, rating, comment) VALUES($name, date("Y-m-d H:i",time()), $mid, $rating, $comment)";
$usersub = $_GET["submit"];
if($usersub == TRUE){
if(mysql_query($score, $db_connection)){
	echo "New role added successfully!";
}
else{
	echo "Error adding this role";
}
}




mysql_close($db_connection);
?>
</html>