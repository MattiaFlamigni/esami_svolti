<?php

class DatabaseHelper{
    private $db;
    function __construct($servername, $username, $password, $dbname){
        $this->db=new mysqli($servername, $username, $password, $dbname);

        if($this->db->connect_error){
            die($this->db->connect_error);
        }
    }



    function isAvaiable($sequenza){
        $query = ("SELECT COUNT(*) as count FROM numeri where sequenza=?");

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $sequenza);
        $stmt->execute();
        $result = $stmt->get_result();


        $row = $result->fetch_row();
        

        if($row[0] == 0){
            return 1;
        }


        return 0;
        
    }



    function readNumber(){
        $query = ("SELECT numero FROM numeri");
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $numeriArray = $result->fetch_all(MYSQLI_ASSOC);

        return $numeriArray;
    }
}



?>