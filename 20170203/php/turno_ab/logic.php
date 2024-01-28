<?php
require "bootstrap.php";
require_once("db/DatabaseHelper.php");

$sequenza = $_GET["sequenza"];

/*controllo che la variabile non sia nulla*/

if(!empty($sequenza) && $sequenza>=0 && $dbh->isAvaiable($sequenza)==1){
    echo json_encode ($dbh->readNumber());
}

?>