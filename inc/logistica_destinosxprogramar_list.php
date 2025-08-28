<?php
include 'conn.php';
include 'eas.php';
$eas = new eas();
$sql = "SELECT DISTINCT CIUDADCLI AS Destino
FROM            interAppCIL_Corte
WHERE        (idEstadoProgramacion = 1)
ORDER BY Destino";
$statement = $pdo->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                     
        echo json_encode($results);
        

?>

