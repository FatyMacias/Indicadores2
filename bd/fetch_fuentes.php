<?php

//fetch.php

include('database_connection.php');

if(isset($_POST["id"]))
{
 $query = "
 SELECT SUBSTRING(qna_pago,5,6) AS quin,fuente,SUM(importe) AS 'total', IF(SUBSTRING(fuente,1,4) = '2027','U080',fuentes.nom_fuente) AS cond FROM indicador 
 LEFT JOIN fuentes ON indicador.fuente = fuentes.clave
  WHERE SUBSTRING(qna_pago,1,4) = '".$_POST["id"]."'
  GROUP BY qna_pago, fuente ASC
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();


 foreach($result as $row)
 {
  $output[] = array(
   'nombre'  => $row["cond"],
   'concepto'   => $row["quin"],
   'fuente'   => $row["fuente"],
   'importe'  => floatval($row["total"]),
   
  );
 }
 echo json_encode($output);
}

?>