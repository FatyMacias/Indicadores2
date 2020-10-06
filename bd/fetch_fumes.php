<?php

include('database_connection.php');


if(isset($_POST["id"]))
{
 $query = "
 SELECT mes,qna_pago,SUM(importe) AS 'total', fuente, IF(SUBSTRING(fuente,1,4) = '2027','U080',fuentes.nom_fuente) AS cond FROM indicador JOIN cat_mes ON indicador.qna_pago = cat_mes.id_quin 
 LEFT JOIN fuentes ON indicador.fuente = fuentes.clave
  WHERE SUBSTRING(qna_pago,1,4) = '".$_POST["id"]."'
  GROUP BY mes, fuente ORDER BY qna_pago ASC
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();


 foreach($result as $row)
 {
  $output[] = array(
   'nombre' => $row["cond"],
   'fuente'  => $row["fuente"],
   'concepto'   => $row["mes"],
   'importe'  => floatval($row["total"])
  );
 }
 echo json_encode($output);
}

?>