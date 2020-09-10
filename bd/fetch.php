<?php

//fetch.php
/*
SELECT 'TOTAL' AS data, SUM(cantidad) FROM personal JOIN regiones ON personal.region = regiones.id_region 
WHERE SUBSTRING(qna,1,4) = '2020' AND SUBSTRING(qna,5,6) = '16' AND personal.region = '0' 

UNION SELECT genero, SUM(cantidad) FROM personal JOIN regiones ON personal.region = regiones.id_region 
WHERE SUBSTRING(qna,1,4) = '2020' AND SUBSTRING(qna,5,6) = '16' AND personal.region = '0' 
GROUP BY genero 

UNION SELECT plaza, SUM(cantidad) FROM personal JOIN regiones ON personal.region = regiones.id_region 
WHERE SUBSTRING(qna,1,4) = '2020' AND SUBSTRING(qna,5,6) = '16' AND personal.region = '0' 
GROUP BY plaza 

UNION SELECT tipo, SUM(cantidad) FROM personal JOIN regiones ON personal.region = regiones.id_region 
WHERE SUBSTRING(qna,1,4) = '2020' AND SUBSTRING(qna,5,6) = '16' AND personal.region = '0' 
GROUP BY tipo

SELECT region, 
(SELECT SUM(cantidad) FROM personal WHERE region = p.region )AS 'total',
(SELECT SUM(cantidad) FROM personal WHERE region = p.region AND genero = 'hombres')AS 'hombres', 
(SELECT SUM(cantidad) FROM personal WHERE region = p.region AND genero = 'mujeres')AS 'mujeres',
(SELECT SUM(cantidad) FROM personal WHERE region = p.region AND plaza = 'docentes')AS 'docentes',
(SELECT SUM(cantidad) FROM personal WHERE region = p.region AND plaza = 'administrativo')AS 'administrativo',
(SELECT SUM(cantidad) FROM personal WHERE region = p.region AND tipo = 'base')AS 'base',
(SELECT IFNULL(SUM(cantidad),0) FROM personal WHERE region = p.region AND tipo = 'interino')AS 'interino',
(SELECT IFNULL(SUM(cantidad),0) FROM personal WHERE region = p.region AND tipo = 'contrato')AS 'contrato',
(SELECT IFNULL(SUM(cantidad),0) FROM personal WHERE region = p.region AND tipo = 'bachille')AS 'bachilleres'
FROM personal p WHERE SUBSTRING(qna,1,4) = '2020' AND SUBSTRING(qna,5,6) = '16' GROUP BY region
*/
include('database_connection.php');


if(isset($_POST["id"]))
{
 $query = "
 SELECT mes,qna_pago,SUM(importe) AS 'total' FROM indicador JOIN cat_mes ON indicador.qna_pago = cat_mes.id_quin
 WHERE SUBSTRING(qna_pago,1,4) = '".$_POST["id"]."' 
 GROUP BY mes ORDER BY qna_pago ASC 
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();


 foreach($result as $row)
 {
  $output[] = array(
   'concepto'   => $row["mes"],
   'importe'  => floatval($row["total"])
  );
 }
 echo json_encode($output);
}

?>