<?php


include('database_connection.php');

if(isset($_POST["id"]) && isset($_POST["idd"]) )
{
 $query = "
 SELECT  
 (SELECT SUM(cantidad) FROM personal WHERE region = personal.region )AS 'total',
 (SELECT SUM(cantidad) FROM personal WHERE region = personal.region AND genero = 'hombres')AS 'hombres', 
 (SELECT SUM(cantidad) FROM personal WHERE region = personal.region AND genero = 'mujeres')AS 'mujeres',
 (SELECT SUM(cantidad) FROM personal WHERE region = personal.region AND plaza = 'docentes')AS 'docentes',
 (SELECT SUM(cantidad) FROM personal WHERE region = personal.region AND plaza = 'administrativo')AS 'administrativo',
 (SELECT SUM(cantidad) FROM personal WHERE region = personal.region AND tipo = 'base')AS 'base',
 (SELECT IFNULL(SUM(cantidad),0) FROM personal WHERE region = personal.region AND tipo = 'interino')AS 'interino',
 (SELECT IFNULL(SUM(cantidad),0) FROM personal WHERE region = personal.region AND tipo = 'contrato')AS 'contrato',
 (SELECT IFNULL(SUM(cantidad),0) FROM personal WHERE region = personal.region AND tipo = 'bachille')AS 'bachille'
 FROM personal  WHERE SUBSTRING(qna,1,4) = '".$_POST["id"]."' AND SUBSTRING(qna,5,6) = '".$_POST["idd"]."' GROUP BY region LIMIT 1
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();


 foreach($result as $row)
 {
  $output[] = array(
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