<?php

//fetch.php
//SELECT mes,concepto,SUBSTRING(qna_pago,1,4),SUM(importe) AS 'total' FROM indicador JOIN cat_mes ON indicador.qna_pago = cat_mes.id_quin WHERE concepto = '01'AND mes = '1' AND SUBSTRING(qna_pago,1,4) = '2020' GROUP BY mes ASC
// SELECT cve_cpto,cat_conceptos.concepto AS nomcom,cat_subsitema.cve_subsistema,cat_subsitema.des_subs, SUM(importe) AS 'total',per_ded FROM indicador JOIN cat_conceptos ON indicador.concepto = cat_conceptos.cve_cpto JOIN cat_subsitema ON indicador.subsistema = cat_subsitema.cve_subsistema 
// WHERE SUBSTRING(qna_pago,1,4) = '2016' AND des_subs = 'telesecundaria' 
// group BY cve_cpto

include('database_connection.php');

if(isset($_POST["id"]) && isset($_POST["idd"]) )
{
 $query = "
 SELECT actividad,
 (SELECT SUM(cantidad) FROM personal WHERE actividad = p.actividad) AS 'total',
 (SELECT SUM(cantidad) FROM personal WHERE actividad = p.actividad AND genero = 'hombres') AS 'hombres',
 (SELECT IF (SUM(cantidad) IS null, 0, SUM(cantidad)) FROM personal WHERE actividad = p.actividad AND genero = 'mujeres') AS 'mujeres',
 (SELECT IF (SUM(cantidad) IS null, 0, SUM(cantidad)) FROM personal WHERE actividad = p.actividad AND plaza = 'docentes') AS 'docentes',
 (SELECT IF (SUM(cantidad) IS null, 0, SUM(cantidad)) FROM personal WHERE actividad = p.actividad AND plaza = 'administrativo') AS 'administrativo',
 (SELECT IF (SUM(cantidad) IS null, 0, SUM(cantidad)) FROM personal WHERE actividad = p.actividad AND tipo = 'base') AS 'base',
 (SELECT IF (SUM(cantidad) IS null, 0, SUM(cantidad)) FROM personal WHERE actividad = p.actividad AND tipo = 'interino') AS 'interino',(SELECT IF (SUM(cantidad) IS null, 0, SUM(cantidad)) FROM personal WHERE actividad = p.actividad AND tipo = 'contrato') AS 'contrato',
 (SELECT IF (SUM(cantidad) IS null, 0, SUM(cantidad)) FROM personal WHERE actividad = p.actividad AND tipo = 'bachille') AS  'bachille' 
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