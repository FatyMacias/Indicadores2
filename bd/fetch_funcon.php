<?php

include('database_connection.php');


if(isset($_POST["idc"]) && isset($_POST["idm"]) )
{
 $query = "
 SELECT mes,concepto,SUBSTRING(qna_pago,1,4),SUM(importe) AS 'total',fuente,IF(SUBSTRING(fuente,1,4) = '2027','U080',fuentes.nom_fuente) AS cond FROM indicador 
 JOIN cat_mes ON indicador.qna_pago = cat_mes.id_quin
 LEFT JOIN fuentes ON indicador.fuente=fuentes.clave
  WHERE concepto = '".$_POST["idc"]."' AND mes = '".$_POST["idm"]."'
  GROUP BY SUBSTRING(qna_pago,1,4), fuente ASC
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();


 foreach($result as $row)
 {
  $output[] = array(
    'nombre' => $row["cond"],
    'fuente'  => $row["fuente"],
    'concepto'   => $row["SUBSTRING(qna_pago,1,4)"],
    'importe'  => floatval($row["total"])
  );
 }
 echo json_encode($output);
}

?>