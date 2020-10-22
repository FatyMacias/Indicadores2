<?php

include('database_connection.php');

if(isset($_POST["id"]) && isset($_POST["idd"]) )
{
 $query = "
 SELECT CONCAT(p.region,': ' ,regiones.region) AS region,
 (SELECT SUM(cantidad) FROM personal WHERE region = p.region AND SUBSTRING(qna,1,4) = '".$_POST["id"]."' AND SUBSTRING(qna,5,6) = '".$_POST["idd"]."' )AS 'total',
 (SELECT SUM(cantidad) FROM personal WHERE region = p.region AND genero = 'hombres' 
  AND SUBSTRING(qna,1,4) = '".$_POST["id"]."' AND SUBSTRING(qna,5,6) = '".$_POST["idd"]."')AS 'hombres', 
 (SELECT SUM(cantidad) FROM personal WHERE region = p.region AND genero = 'mujeres' 
  AND SUBSTRING(qna,1,4) = '".$_POST["id"]."' AND SUBSTRING(qna,5,6) = '".$_POST["idd"]."')AS 'mujeres',
 (SELECT SUM(cantidad) FROM personal WHERE region = p.region AND plaza = 'docentes' 
  AND SUBSTRING(qna,1,4) = '".$_POST["id"]."' AND SUBSTRING(qna,5,6) = '".$_POST["idd"]."')AS 'docentes',
 (SELECT SUM(cantidad) FROM personal WHERE region = p.region AND plaza = 'administrativo' 
  AND SUBSTRING(qna,1,4) = '".$_POST["id"]."' AND SUBSTRING(qna,5,6) = '".$_POST["idd"]."')AS 'administrativo',
 (SELECT SUM(cantidad) FROM personal WHERE region = p.region AND tipo = 'base' 
  AND SUBSTRING(qna,1,4) = '".$_POST["id"]."' AND SUBSTRING(qna,5,6) = '".$_POST["idd"]."')AS 'base',
 (SELECT IFNULL(SUM(cantidad),0) FROM personal WHERE region = p.region AND tipo = 'interino' 
  AND SUBSTRING(qna,1,4) = '".$_POST["id"]."' AND SUBSTRING(qna,5,6) = '".$_POST["idd"]."')AS 'interino',
 (SELECT IFNULL(SUM(cantidad),0) FROM personal WHERE region = p.region AND tipo = 'contrato' 
  AND SUBSTRING(qna,1,4) = '".$_POST["id"]."' AND SUBSTRING(qna,5,6) = '".$_POST["idd"]."')AS 'contrato',
 (SELECT IFNULL(SUM(cantidad),0) FROM personal WHERE region = p.region AND tipo = 'bachille' 
  AND SUBSTRING(qna,1,4) = '".$_POST["id"]."' AND SUBSTRING(qna,5,6) = '".$_POST["idd"]."')AS 'bachille'
  FROM personal p JOIN regiones ON p.region = regiones.id_region 
  WHERE SUBSTRING(qna,1,4) = '".$_POST["id"]."' AND SUBSTRING(qna,5,6) = '".$_POST["idd"]."' GROUP BY p.region +0
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();


 foreach($result as $row)
 {
  $output[] = array(
   'region'  => $row["region"],
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