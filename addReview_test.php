<html>
<head>
</head>
<form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<?php
require "./dbconfig.php";
$mid = $_GET["mid"];
$movie = mysql_query("SELECT title,year,id FROM Movie", $db_connection);
?>
<select name ="movies">
<?php while($rows=mysql_fetch_row($movie)){
?>
    
            <option 
            <?php
                if ($rows[2] == $mid){
                    echo "SELECTED";
                } 
            ?> >
            <?php echo $rows[0]; ?> 
       
     <?php } ?>
   </select>
 
</html>