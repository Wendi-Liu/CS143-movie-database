<html>
    <html>
    <head>
        <title>Actor Information</title>
      
    </head> 
    <h1>--Show Actor Information</h1>
       <form action = "./search.php" method = "GET">
         
        <input type = "text" name = "keyword">
        <input type = "submit" value= "Search">
    </form>
    <?php
    require("./dbconfig.php");
    $aid = $_GET["aid"];
    if($aid!=NULL){
    echo "SHOW ACTOR INFO:";
    echo "<br/>";
    $name=mysql_query("SELECT first, last, sex, dob, dod FROM Actor WHERE id = $aid", $db_connection);
    $actor_name = mysql_fetch_row($name);
    echo "Name: ".$actor_name[0]." ".$actor_name[1];
    echo "<br/>";
    echo "Sex: ".$actor_name[2];
    echo "<br/>";
    echo "Date of Birth: ".$actor_name[3];
    echo "<br/>";

    echo "Date of death: ";
    if($actor_name[4]!=NULL)
        echo $actor_name[4];
    else
        echo "--Still Alive--";
    echo "<br/>";


    $ActIn = "SELECT mid, role FROM MovieActor WHERE aid = $aid";
    $rs = mysql_query($ActIn, $db_connection);
    echo "Act In...";
    echo "<br/>";

    while($row = mysql_fetch_row($rs)) {
  
    $MovieIn = mysql_query("SELECT title FROM Movie WHERE id = $row[0]", $db_connection);
    $row2 = mysql_fetch_row($MovieIn);
    echo "Act ".$row[1]."  In  "."<a href=./showMovie.php?mid=$row[0]>$row2[0]</a>";
    
    echo "<br/>";
    }
}
    mysql_close($db_connection);
    ?>
</html>