<?php
include 'conn.php';
include 'eas.php';
$eas = new eas();
$sql = "select * from PruebaWilfred.dbo.interAppCIL_Conductor";
$statement = $pdo->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                     
        echo json_encode($results);
        

?>

