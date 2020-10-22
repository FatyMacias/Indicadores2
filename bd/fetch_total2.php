<?php


include('database_connection.php');

if(isset($_POST["id"]) && isset($_POST["idd"]) )
{
 $query = "
 SELECT 'Total' AS activ,
 (SELECT SUM(cantidad) FROM personal WHERE actividad = personal.actividad) AS 'total',
 (SELECT SUM(cantidad) FROM personal WHERE actividad = personal.actividad AND genero = 'hombres') AS 'hombres',
 (SELECT IF (SUM(cantidad) IS null, 0, SUM(cantidad)) FROM personal WHERE actividad = personal.actividad AND genero = 'mujeres') AS 'mujeres',
 (SELECT IF (SUM(cantidad) IS null, 0, SUM(cantidad)) FROM personal WHERE actividad = personal.actividad AND plaza = 'docentes') AS 'docentes',
 (SELECT IF (SUM(cantidad) IS null, 0, SUM(cantidad)) FROM personal WHERE actividad = personal.actividad AND plaza = 'administrativo') AS 'administrativo',
 (SELECT IF (SUM(cantidad) IS null, 0, SUM(cantidad)) FROM personal WHERE actividad = personal.actividad AND tipo = 'base') AS 'base',
 (SELECT IF (SUM(cantidad) IS null, 0, SUM(cantidad)) FROM personal WHERE actividad = personal.actividad AND tipo = 'interino') AS 'interino',(SELECT IF (SUM(cantidad) IS null, 0, SUM(cantidad)) FROM personal WHERE actividad = personal.actividad AND tipo = 'contrato') AS 'contrato',
 (SELECT IF (SUM(cantidad) IS null, 0, SUM(cantidad)) FROM personal WHERE actividad = personal.actividad AND tipo = 'bachille') AS  'bachille' 
 FROM personal GROUP BY actividad LIMIT 1
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();


 foreach($result as $row)
 {
  $output[] = array(
   'name'   => $row["activ"],
   'total'   => floatval($row["total"]),
   'hombres'   => floatval($row["hombres"]),
   'mujeres'   => floatval($row["mujeres"]),
   'docentes'   => floatval($row["docentes"]),
   'administrativo'   => floatval($row["administrativo"]),
   'base'   => floatval($row["base"]),
   'interino'   => floatval($row["interino"]),
   'contrato'   => floatval($row["contrato"]),
   'bachilleres'  => floatval($row["bachille"])
  );
 }
 echo json_encode($output);
}

?>