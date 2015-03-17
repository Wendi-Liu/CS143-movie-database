<?php

$string = "first.last@domain.uno.dos234";  
if (preg_match(  
"/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/",  
$string)) {  
echo "验证mail地址"; 
} 
?>