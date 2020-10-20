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