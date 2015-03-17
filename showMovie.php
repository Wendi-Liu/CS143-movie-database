<html>
    <html>
    <head>
        <title>Movie Information</title>
   
    </head> 
    <h1>--Show Movie Infomation</h1>  
       <form action = "./search.php" method = "GET">
         
        <input type = "text" name = "keyword">
        <input type = "submit" value= "Search">
    </form>
    <?php
    require("./dbconfig.php");
    $mid = $_GET["mid"];
    if($mid != NULL){
    $name = mysql_query("SELECT title, rating, company, year FROM Movie WHERE id = $mid", $db_connection);
    $movie_info = mysql_fetch_row($name);
    echo "--Show Movie Info--";
    echo "<br/>";
    echo "Title: ".$movie_info[0]."(".$movie_info[3].")";
    echo "<br/>";
    $id = mysql_query("SELECT did FROM MovieDirector WHERE mid = $mid", $db_connection);
    $did = mysql_fetch_row($id);
    $name = mysql_query("SELECT first, last FROM Director WHERE id = $did[0]", $db_connection);
    if($name!=NULL)
    $director_name = mysql_fetch_row($name);
    echo "Director: ".$director_name[0]." ".$director_name[1];
    echo "<br/>";
    echo "MPAA rating: ".$movie_info[1];
    echo "<br/>";
    echo "Production Company: ".$movie_info[2];
    echo "<br/>";
    $genre = mysql_query("SELECT genre FROM MovieGenre WHERE mid = $mid", $db_connection);
    echo "Genre: ";
    while($movie_genre = mysql_fetch_row($genre))
    echo $movie_genre[0]." ";
    echo "<br/>";
    $rs = mysql_query("SELECT aid FROM MovieActor WHERE mid = $mid", $db_connection);
    echo "--Show Actors In the Movie--";
    echo "<br/>";
    while($row = mysql_fetch_row($rs)) {
    $actor = mysql_query("SELECT first, last, dob FROM Actor WHERE id = $row[0]", $db_connection);
    $row2 = mysql_fetch_row($actor);
    echo "<a href=./showActor.php?aid=$row[0]>$row2[0] $row2[1] $row2[2]</a>";
    echo "<br/>";
    }
    echo "--User Review--";
    $score = mysql_query("SELECT AVG(rating),COUNT(*) FROM Review WHERE mid = $mid",$db_connection);
    $score_info = mysql_fetch_row($score);
    echo "Average Score: ".$score_info[0]."/5(5 is the best) by ".$score_info[1]." review(s).";
    echo "<a href=./addReview.php?mid=$mid>Add your review Now!</a>";
    echo "<br/>";
    echo "--Reviewd in Details--";
    echo "<br/>";
    $review = mysql_query("SELECT name, time, comment FROM Review WHERE mid = $mid",$db_connection);
    while($review_info = mysql_fetch_row($review)){
    if($review_info!=NULL){
    echo "In ".$review_info[1].", ".$review_info[0]." said: ";
    echo "<br/>";
    echo $review_info[2];
    echo "<br/>";
    }   }

}
    mysql_close($db_connection);
    ?>
</html>