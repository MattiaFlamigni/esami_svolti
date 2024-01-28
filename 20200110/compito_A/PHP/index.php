<?php
  class DatabaseHelper{
    private $db;

    function __construct($servername, $username, $password, $dbname){
        $this->db = new mysqli($servername, $username, $password, $dbname);
        if($this->db->connect_error){
            die("Connection failed: " . $this->db->connect_error);
        }
    }


    function getCitta(){
      $query = "SELECT citta FROM temperature";
      $stmt = $this-> db->prepare($query);
      $stmt->execute();
        
      $result = $stmt ->get_result();


      return $result->fetch_all(MYSQLI_ASSOC);
    }

    function getTemperatura($citta){
      $query = "SELECT min, max FROM temperature where citta=?";
      $stmt = $this->db->prepare($query);
      $stmt ->bind_param("s", $citta);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);
    }
  }



    $dbh = new DatabaseHelper("localhost", "root", "", "climate");













  
?>

<html lang="it">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title>Città Italiane</title>
  </head>
  <body>
    <form action="index.php" method="GET">
      <label for="citta">Città</label>
      <select name="citta">
        <?php
          foreach($dbh->getCitta() as $citta){ ?>

            <option value="<?php echo $citta["citta"]; ?>"><?php echo $citta["citta"] ;   ?></option>
          <?php } ?>
      
      </select>
      <input type="submit" value="Invia" />
    </form>


    <?php 
      if(isset($_GET["citta"])){ 

        $temperatura = $dbh->getTemperatura($_GET["citta"]);



        echo " <p> Citta: " .$_GET["citta"]. " </p>";
        echo "<p>temperatura minima: ".$temperatura[0]["min"]. "</p>";
        echo "<p>temperatura massima: ".$temperatura[0]["max"]. "</p>";
        /*<p> Temperatura minima: <?php echo json_encode($dbh->getTemperatura($_GET["citta"]));     ?></p>
        <p> Temperatura massima: </p>*/
      } 
      
      
      ?>
    
    

  </body>
</html>
