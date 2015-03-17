<html>
<head>
	<h1>Add your Comment:</h1>
</head>
 <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "GET">   
 		Movie:
 		<?php
		require "./dbconfig.php";
		$mid = $_GET["mid"];
		$movie = mysql_query("SELECT title,year,id FROM Movie ORDER BY title", $db_connection);
		?>
 		<SELECT NAME="movie_id">
       <?php while($rows=mysql_fetch_row($movie)){
	?>
    
            <option VALUE = "<?php echo $rows[2];?>"
            <?php
                if ($rows[2] == $mid){
                    echo "SELECTED";
                } 
            ?> >
            <?php echo $rows[0]; ?> 
            </option>
     <?php } ?>
   		</SELECT>
 		Rating: 
        <SELECT NAME="score">
        <OPTION VALUE = 5>5 excellent!
        <OPTION VALUE = 4>4 good!
        <OPTION VALUE = 3 SELECTED>3 just so so
        <OPTION VALUE = 2>2 Not worth the ticket
        <OPTION VALUE = 1>1 Totally bullshit!
        </SELECT>
        <br>
        Your name:
        <input type = "text" value = "Anonymous" name = "name">
        <br>
        Comment:<br>
		<TEXTAREA NAME = "comment" ROWS = 5 COLS = 30></TEXTAREA>
		<br>
		<input type = "submit" name = "submit" value = "Submit Comment">
    </form>
<?php
require("./dbconfig.php");
$name = $_GET["name"];
$mid = $_GET["movie_id"];
$rating = $_GET["score"];
$comment = $_GET["comment"];
$timestamp = date('Y-m-d G:i:s');

$score = "INSERT INTO Review(name, time, mid, rating, comment) VALUES ('$name', '$timestamp', '$mid', '$rating', '$comment');";
//$score = "INSERT INTO Review(name, time, mid, rating, comment) VALUES($name, date("Y-m-d H:i",time()), $mid, $rating, $comment)";
$usersub = $_GET["submit"];
if($usersub == TRUE){
if(mysql_query($score, $db_connection)){
	echo "New Comment created successfully!";
}
else{
	echo "Error: " . $score . "<br>" . $db_connection->error;
}
}




mysql_close($db_connection);
?>
</html>