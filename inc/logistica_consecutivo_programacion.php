<?php
include 'conn.php';
include 'eas.php';
$eas = new eas();
$sql = "SELECT        MAX(DISTINCT NroProgramacion) + 1 AS NroProg
FROM            interAppCIL_Corte";
$statement = $pdo->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                     
        echo json_encode($results);
        

?>

