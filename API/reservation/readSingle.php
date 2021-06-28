<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../config/Database.php';
include_once '../../models/RDV.php';
include_once '../../models/user.php';


$database = new Database();
$db = $database->connect();


$rdv = new RDV($db);
$users =new Users ($db);

$data = json_decode(file_get_contents("php://input"));
$rdv->id_user = $data->id_user;

$result = $rdv->getSingleRDV();
$num = $result->rowCount();
if ($num) {
    $rdv_arr = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $rdv_item = array(
            'cin' => $cin,
            'nom' => $nom,
            'id_RDV' => $id_RDV,
            'date' => $date,
            'heur' => $heur,
            'sujet' => $sujet
        );

        array_push($rdv_arr, $rdv_item);
    }
    echo json_encode($rdv_arr);
} else {
    echo json_encode(
        array("no")
    );
}
