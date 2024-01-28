<?php

class DatabaseHelper{
    private $db;
    function __construct($servername, $username, $password, $dbname){
        $this->db = new mysqli($servername, $username, $password, $dbname);
    }

    function insertValue($nome, $cognome, $cf, $dataN, $sesso){
        $sql = "INSERT INTO cittadino (nome, cognome, codicefiscale, datanascita, sesso) VALUES (?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sssss", $nome, $cognome, $cf, $dataN, $sesso);
        $stmt->execute();

        $result=$stmt->get_result();

        return $result;
        
    }


    function getPersona($id){
        if($id==-1){
            $sql = "SELECT * FROM cittadino";
            $stmt = $this->db->prepare($sql);
        }else{
            $sql = "SELECT * FROM cittadino where idcittadino=?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $id);
        }

        
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}


?>