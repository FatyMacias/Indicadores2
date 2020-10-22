<?php
include('database_connection.php');

if(isset($_POST["id"]) && isset($_POST["idd"]))
{
 $query = "
 SELECT regiones.id_region AS idreg, CONCAT(regiones.id_region,': ',regiones.region) AS region, 
 TRUNCATE(SUM(IMPO_DOCENTE+IMPO_ADMVOS),2) AS total, TRUNCATE(SUM(IMPO_DOCENTE),2) AS docente, TRUNCATE(SUM(IMPO_ADMVOS),2) AS admvos
 FROM `cifras_region` 
 JOIN regiones ON cifras_region.REGION = regiones.id_region
 GROUP BY region
 ORDER BY cifras_region.region
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();

 
 foreach($result as $row) 
 {
  $output[] = array(
    'id' => $row["idreg"],
    'region'  => $row["region"],
    'total'  => $row["total"],
    'docente'  => $row["docente"],
    'admvos'  => $row["admvos"],
  );
 }
 echo json_encode($output);
}

?>