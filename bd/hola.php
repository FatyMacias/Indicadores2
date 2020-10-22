<?php


include('database_connection.php');

if(isset($_POST["id"]) && isset($_POST["idd"]) )
{
 $query = "
 SELECT actividad,
 (SELECT SUM(cantidad) FROM personal WHERE actividad = p.actividad
 AND SUBSTRING(qna,1,4) = '".$_POST["id"]."' AND SUBSTRING(qna,5,6) = '".$_POST["idd"]."') AS 'total',
 (SELECT SUM(cantidad) FROM personal WHERE actividad = p.actividad AND genero = 'hombres'
 AND SUBSTRING(qna,1,4) = '".$_POST["id"]."' AND SUBSTRING(qna,5,6) = '".$_POST["idd"]."') AS 'hombres',
 (SELECT IF (SUM(cantidad) IS null, 0, SUM(cantidad)) FROM personal WHERE actividad = p.actividad AND genero = 'mujeres'
 AND SUBSTRING(qna,1,4) = '".$_POST["id"]."' AND SUBSTRING(qna,5,6) = '".$_POST["idd"]."') AS 'mujeres',
 (SELECT IF (SUM(cantidad) IS null, 0, SUM(cantidad)) FROM personal WHERE actividad = p.actividad AND plaza = 'docentes'
 AND SUBSTRING(qna,1,4) = '".$_POST["id"]."' AND SUBSTRING(qna,5,6) = '".$_POST["idd"]."') AS 'docentes',
 (SELECT IF (SUM(cantidad) IS null, 0, SUM(cantidad)) FROM personal WHERE actividad = p.actividad AND plaza = 'administrativo'
 AND SUBSTRING(qna,1,4) = '".$_POST["id"]."' AND SUBSTRING(qna,5,6) = '".$_POST["idd"]."') AS 'administrativo',
 (SELECT IF (SUM(cantidad) IS null, 0, SUM(cantidad)) FROM personal WHERE actividad = p.actividad AND tipo = 'base'
 AND SUBSTRING(qna,1,4) = '".$_POST["id"]."' AND SUBSTRING(qna,5,6) = '".$_POST["idd"]."') AS 'base',
 (SELECT IF (SUM(cantidad) IS null, 0, SUM(cantidad)) FROM personal WHERE actividad = p.actividad AND tipo = 'interino'
 AND SUBSTRING(qna,1,4) = '".$_POST["id"]."' AND SUBSTRING(qna,5,6) = '".$_POST["idd"]."') AS 'interino',(SELECT IF (SUM(cantidad) IS null, 0, SUM(cantidad)) FROM personal WHERE actividad = p.actividad AND tipo = 'contrato') AS 'contrato',
 (SELECT IF (SUM(cantidad) IS null, 0, SUM(cantidad)) FROM personal WHERE actividad = p.actividad AND tipo = 'bachille'
 AND SUBSTRING(qna,1,4) = '".$_POST["id"]."' AND SUBSTRING(qna,5,6) = '".$_POST["idd"]."') AS  'bachille' 
 FROM personal p WHERE SUBSTRING(qna,1,4) = '".$_POST["id"]."' AND SUBSTRING(qna,5,6) = '".$_POST["idd"]."' GROUP BY actividad
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();


 foreach($result as $row)
 {
  $output[] = array(
   'name'   => $row["actividad"],
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