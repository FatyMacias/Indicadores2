<?php
// SELECT mes,cve_cpto,cat_conceptos.concepto AS nomcom,per_ded,qna_pago,SUM(importe) AS 'total' FROM indicador JOIN cat_mes ON indicador.qna_pago = cat_mes.id_quin JOIN cat_conceptos ON indicador.concepto = cat_conceptos.cve_cpto 
// WHERE SUBSTRING(qna_pago,1,4) = '".$_POST["id"]."'
// GROUP BY mes ORDER BY qna_pago ASC
//SELECT cve_cpto,cat_conceptos.concepto AS nomcom,per_ded,qna_pago,SUM(importe) AS 'total' FROM indicador JOIN cat_conceptos ON indicador.concepto = cat_conceptos.cve_cpto 
// WHERE SUBSTRING(qna_pago,1,4) = '2016' group BY cve_cpto

include('database_connection.php');

if(isset($_POST["id"]) && isset($_POST["idd"]))
{
 $query = "
 SELECT CONCAT(regiones.id_region,': ',regiones.region) AS region, 
 SUM(IMPO_DOCENTE+IMPO_ADMVOS) AS total, SUM(IMPO_DOCENTE) AS docente, SUM(IMPO_ADMVOS) AS admvos
 FROM `cifras_region` 
 JOIN regiones ON cifras_region.REGION = regiones.id_region
 WHERE SUBSTRING(QNA,1,4) = '2020' AND SUBSTRING(QNA,5,6) = '16'
 GROUP BY regiones.region
 UNION
 SELECT 'Total' AS total, SUM(IMPO_DOCENTE+IMPO_ADMVOS) AS Total, 
 SUM(IMPO_DOCENTE) AS docente, SUM(IMPO_ADMVOS) AS admvos
 FROM `cifras_region` 
 JOIN regiones ON cifras_region.REGION = regiones.id_region
 WHERE SUBSTRING(QNA,1,4) = '2020' AND SUBSTRING(QNA,5,6) = '16'
 GROUP BY QNA  
 ORDER BY `region`
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();

 
 foreach($result as $row)
 {
  $output[] = array(
   
    'region'  => $row["region"],
    'total'  => $row["total"],
    'docente'  => $row["docente"],
    'admvos'  => $row["admvos"],
  );
 }
 echo json_encode($output);
}

?>