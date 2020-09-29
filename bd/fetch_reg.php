<?php
// SELECT mes,cve_cpto,cat_conceptos.concepto AS nomcom,per_ded,qna_pago,SUM(importe) AS 'total' FROM indicador JOIN cat_mes ON indicador.qna_pago = cat_mes.id_quin JOIN cat_conceptos ON indicador.concepto = cat_conceptos.cve_cpto 
// WHERE SUBSTRING(qna_pago,1,4) = '".$_POST["id"]."'
// GROUP BY mes ORDER BY qna_pago ASC
//SELECT cve_cpto,cat_conceptos.concepto AS nomcom,per_ded,qna_pago,SUM(importe) AS 'total' FROM indicador JOIN cat_conceptos ON indicador.concepto = cat_conceptos.cve_cpto 
// WHERE SUBSTRING(qna_pago,1,4) = '2016' group BY cve_cpto
// SELECT CONCAT(regiones.id_region,': ',regiones.region) AS region, 
// SUM(IMPO_DOCENTE+IMPO_ADMVOS) AS total, SUM(IMPO_DOCENTE) AS docente, SUM(IMPO_ADMVOS) AS admvos
// FROM `cifras_region` 
// JOIN regiones ON cifras_region.REGION = regiones.id_region
// GROUP BY region

// UNION

// SELECT 'Total' AS total, SUM(IMPO_DOCENTE+IMPO_ADMVOS) AS Total, 
// SUM(IMPO_DOCENTE) AS docente, SUM(IMPO_ADMVOS) AS admvos
// FROM `cifras_region` 
// JOIN regiones ON cifras_region.REGION = regiones.id_region
// GROUP BY QNA  
// ORDER BY region + 0
// SELECT CONCAT(regiones.id_region,': ',regiones.region) AS region,
// (SELECT SUM(IMPO_DOCENTE + IMPO_ADMVOS) FROM cifras_region WHERE region = cr.region)AS importeT,
// (SELECT SUM(IMPO_DOCENTE) FROM cifras_region WHERE region = cr.region)AS importeD,
// (SELECT SUM(IMPO_ADMVOS) FROM cifras_region WHERE region = cr.region)AS importeA
//  FROM cifras_region cr 
//  JOIN regiones ON cr.region = regiones.id_region
//  GROUP BY cr.region
//  UNION
//  SELECT '14 Total' as tot, SUM(IMPO_DOCENTE + IMPO_ADMVOS), SUM(IMPO_DOCENTE), SUM(IMPO_ADMVOS)
//  FROM cifras_region cr
//  JOIN regiones ON cr.region = regiones.id_region
//  ORDER BY CAST(region AS UNSIGNED) , region
include('database_connection.php');

if(isset($_POST["id"]) && isset($_POST["idd"]))
{
 $query = "
 SELECT CONCAT(regiones.id_region,': ',regiones.region) AS region, 
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
   
    'region'  => $row["region"],
    'total'  => $row["total"],
    'docente'  => $row["docente"],
    'admvos'  => $row["admvos"],
  );
 }
 echo json_encode($output);
}

?>