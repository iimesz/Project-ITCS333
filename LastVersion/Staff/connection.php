<?php
try{
$db = new PDO('mysql:host=localhost;dbname=supermarket;charset=utf8', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex) {
    echo "Error occured!"; //user friendly message
    die ($ex->getMessage());
}

?>
