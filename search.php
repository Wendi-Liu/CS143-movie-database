<html>
<body>
    <h1>--Search for Actors/Movies--</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
<input type="text" name="query">
<input type = "submit" name = "submit" value = "Submit"><br>
</form>

<?php
require("./dbconfig.php");


$que_k = $_GET["keyword"];

$que = $que_k == NULL ? $_GET["query"] : $que_k;



if($que!=NULL){
$queforMovie = preg_replace('/\s+/', ' ', $que);
echo "<br/>";
echo "You are looking for ".$que;
echo "<br/>";
$que = preg_split('/\s+/', $que);
$searchMovie = "SELECT id, title FROM Movie WHERE title LIKE '%$queforMovie%' ORDER BY title";
$number = count($que);
if($number == 2)
{
$searchActor = "SELECT id,first,last,dob FROM Actor WHERE (last LIKE '%$que[0]%' AND first LIKE '%$que[1]') OR (last LIKE '%$que[1]%' AND first LIKE '%$que[0]') ORDER BY last";

}
else if($number == 1){
$searchActor = "SELECT id ,first,last,dob FROM Actor WHERE last LIKE '%$que[0]%' OR first LIKE '%$que[0]%' ORDER BY last";

}
$rs = mysql_query($searchActor, $db_connection);
echo "Searching match records in Actor database ...";
echo "<br/>";
while($row = mysql_fetch_row($rs)) {
        echo "<a href=./showActor.php?aid=$row[0]>$row[1] $row[2] $row[3]</a>";
   
    
    echo "<br/>";
}

$rs_movie = mysql_query($searchMovie, $db_connection);
echo "<br/>";
echo "Searching match records in Movie database ...";
echo "<br/>";
while($row = mysql_fetch_row($rs_movie)) {
   
    
    echo "<a href=./showMovie.php?mid=$row[0]>$row[1]</a>";
    echo "<br/>";
}

}


mysql_close($db_connection);
?>
</html>
</body>