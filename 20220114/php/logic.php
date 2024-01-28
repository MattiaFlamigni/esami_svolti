<?php
require("bootstrap.php");
$id = $_POST["id_inviato"];
$nome = $_POST["nome"];
$cognome = $_POST["cognome"];
$cf = $_POST["CF"];
$dataN = $_POST["dataN"];
$sesso = $_POST["sesso"];





if(empty($id)){
    if(!empty($nome) && !empty($cognome) && !empty($cf) && !empty($dataN) && !empty($sesso) && is_string($nome) && is_string($cognome) && strlen($cf)==16 && $sesso=="M" || $sesso=="A" || $sesso=="F"){
        $dbh->insertValue($nome, $cognome, $cf, $dataN, $sesso);
        echo "Dati inseriti con successo";
    }

    echo "
        <table>
            <tr> 
                <th>id</th> <th>nome</th>   <th>cognome</th>    <th>cf</th> <th>datanascita</th>    <th>sesso</th>
            </tr>
    ";
    foreach($dbh->getPersona(-1) as $row){
        echo"

            <tr>
                <td> {$row['idcittadino']}</td>
                <td> {$row['nome']}</td>
                <td> {$row['cognome']}</td>
                <td> {$row['codicefiscale']}</td>
                <td> {$row['datanascita']}</td>
                <td> {$row['sesso']}</td>

            </tr>
        ";
    }

    echo "</table>";


}else{




    echo "
        <table>
            <tr> 
                <th>id</th> <th>nome</th>   <th>cognome</th>    <th>cf</th> <th>datanascita</th>    <th>sesso</th>
            </tr>
    ";
    foreach($dbh->getPersona($id) as $row){
        echo"

            <tr>
                <td> {$row['idcittadino']}</td>
                <td> {$row['nome']}</td>
                <td> {$row['cognome']}</td>
                <td> {$row['codicefiscale']}</td>
                <td> {$row['datanascita']}</td>
                <td> {$row['sesso']}</td>

            </tr>
        ";
    }

    echo "</table>";
}



?>