<?php


include('database_connection.php');

if(isset($_POST["id"]) && isset($_POST["idd"]) )
{
 $query = "
 SELECT cve_cpto,cat_conceptos.concepto AS nomcom,cat_subsitema.cve_subsistema AS subsis,cat_subsitema.des_subs AS nomsis, SUM(importe) AS 'total',per_ded FROM indicador JOIN cat_conceptos ON indicador.concepto = cat_conceptos.cve_cpto JOIN cat_subsitema ON indicador.subsistema = cat_subsitema.cve_subsistema 
 WHERE SUBSTRING(qna_pago,1,4) = '".$_POST["id"]."' AND des_subs = '".$_POST["idd"]."'
 GROUP BY cve_cpto 
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();


 foreach($result as $row)
 {
  $output[] = array(
    'clave'   => $row["cve_cpto"],
    'nombre'  => $row["nomcom"],
    'subsis'   => $row["subsis"],
    'nomsis'   => $row["nomsis"],
    'perded'   => $row["per_ded"],
   'importe'  => floatval($row["total"])
  );
 }
 echo json_encode($output);
}

?>