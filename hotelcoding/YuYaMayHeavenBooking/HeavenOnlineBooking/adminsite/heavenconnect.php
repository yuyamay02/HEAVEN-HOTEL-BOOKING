<?php

try {
    $db = new PDO("mysql:host=localhost;port=3306;dbname=heavenhotel","root","");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}    catch (PDOException $e) {
    echo "Connection failed: ".$e->getMessage();
    
}

?>