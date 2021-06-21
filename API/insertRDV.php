



<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/Database.php';
    include_once '../models/RDV.php';
    include_once '../models/user.php';


    $database = new Database();
    $db = $database->connect();

    $rdv = new RDV($db);


    if(session_id()==''){
  
        session_start();
      }
      $fk_user =$_SESSION['id_user'];
  
    // utiliser le "php://input" avec la fonction file_get_contents() qui nous aide à recevoir les données JSON sous forme de fichier et à les lire dans une chaîne.
    // Plus tard, nous pouvons utiliser la fonction json_decode() pour décoder la chaîne JSON.
    
    $data = json_decode(file_get_contents("php://input"));
  
    $rdv->date = $data->date;
    $rdv->fk_user = $data->fk_user;
    $rdv->fk_creneau = $data->fk_creneau;

    
    if($rdv->Insert_RDV()){
        echo 'RDV created successfully.';
    } else{
        echo 'RDV could not be created.';
    }
?>












