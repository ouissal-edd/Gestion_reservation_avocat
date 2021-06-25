<?php
class RDV {
private $conn ;
private $table = 'rdv';


public $id_RDV;
public $sujet;
public $date;
public $fk_creneau ;
public $fk_user;
public $fk_reference_user;

public function __construct($db){
    $this -> conn = $db ;
}

public function read_RDV () {
    $query = 'SELECT id_RDV ,sujet,date,fk_creneau , fk_user FROM ' . $this->table . ' ';
    $stm = $this->conn->prepare($query);
    $stm -> execute();
    
    return $stm;
}



public function Insert_RDV () {
       
    $query = 'INSERT INTO ' . $this->table . ' SET  sujet = :sujet, date = :date ,fk_creneau = :fk_creneau , fk_user = :fk_user ';
    $stmt = $this->conn->prepare($query);

    $this->sujet=htmlspecialchars(strip_tags($this->sujet));
    $this->date=htmlspecialchars(strip_tags($this->date));
    $this->fk_creneau=htmlspecialchars(strip_tags($this->fk_creneau));
    $this->fk_user=htmlspecialchars(strip_tags($this->fk_user));

    $stmt->bindParam(":sujet", $this->sujet);
    $stmt->bindParam(":date", $this->date);
    $stmt->bindParam(":fk_creneau", $this->fk_creneau);
    $stmt->bindParam(":fk_user", $this->fk_user);




    if ($stmt -> execute()){
    return true;
    }
    
        return false;
    
}

public function delete_RDV() {
    $query = 'DELETE FROM ' . $this->table . ' WHERE id_RDV = :id_RDV';

    $stmt = $this->conn->prepare($query);
    $this->id_RDV = htmlspecialchars(strip_tags($this->id_RDV));

    $stmt-> bindParam(':id_RDV', $this->id_RDV);

    if($stmt->execute()) {
      return true;
    }
}



}
?>