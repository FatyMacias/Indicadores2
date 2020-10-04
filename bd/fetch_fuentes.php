<?php

//fetch.php

include('database_connection.php');

if(isset($_POST["id"]))
{
 $query = "
 SELECT SUBSTRING(qna_pago,5,6) AS quin,fuente,SUM(importe) AS 'total' FROM indicador
 WHERE SUBSTRING(qna_pago,1,4) = '".$_POST["id"]."' 
 GROUP BY qna_pago, fuente ASC
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();


 foreach($result as $row)
 {
  $output[] = array(
   'concepto'   => $row["quin"],
   'fuente'   => $row["fuente"],
   'importe'  => floatval($row["total"]),
   
  );
 }
 echo json_encode($output);
}

?>