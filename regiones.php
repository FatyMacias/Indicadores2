<?php
Include("bd/database_connection.php");
$queryC = "SELECT SUBSTRING(qna_pago,1,4) AS 'year' FROM indicador GROUP BY year ASC";
//$query = "SELECT SUBSTRING(qna_pago,1,4) AS 'year' FROM indicador GROUP BY year DESC";
$queryM = "SELECT SUBSTRING(qna_ini,5,6) AS quincena FROM `cat_quincenas` LIMIT 24";
$statementC = $connect->prepare($queryC);
$statementM = $connect->prepare($queryM);

$statementC->execute();
$statementM->execute();

$resultC = $statementC->fetchAll();
$resultM = $statementM->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title>INDICADORES</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Rgoogle -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="main.css">  
      
      
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
     <!-- de aqui para abajo no se que pdo --> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
    <link href="css/toastr.min.css" rel="stylesheet"/>
  </head>
  
  <body>
    
    <div class="wrapper d-flex align-items-stretch">
      <nav id="sidebar">
      <center><a class="navbar-brand">INICIO</a></center>  
        <div class="p-4 pt-5">
          <a href="inicio.php" class="img logo thumbnailmb-5" style="background-image: url(images/zac.png);"></a>
          <br>
          <br>
          <ul class="list-unstyled components mb-5">
            <li class="active">
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">INFORMACIÓN FINANCIERA</a>
              <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="inicio.php" onclick="openMenu('general')">Gráfica Global</a>
                </li>
                <li>
                    <a href="grafica_concepto.php" onclick="openMenu('conceptos')">Gráfica Por Concepto</a>
                </li>
                <!-- <li>
                    <a href="#">Por banco</a>
                </li> -->
                <li>
                    <a href="grafica_subsistema.php" onclick="openMenu('genero')">Subsistemas</a>
                </li>
                <!-- <li>
                    <a href="grafica_porgenero.php" onclick="openMenu('genero')">Por género</a>
                </li> -->

                <li>
                    <a href="regiones.php">Regiones</a>
                </li> 

              </ul>
            </li>


           
            <li>
              <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">INFORMACIÓN DE PERSONAL</a>
              <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="grafica_genero.php" onclick="openMenu('subsis')">Gráfica Por Género</a>
                </li>
                <!-- <li>
                    <a href="#">Page 2</a>
                </li>
                <li>
                    <a href="#">Page 3</a>
                </li> -->
              </ul>
            </li>
          </ul>
       </div>
      </nav>
      
      

      

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
            <!-- Modal -->
   <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <!-- <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Modal title</h5> -->
          <h4 class="modal-title w-100 text-center" class="modal-title">INFORMACIÓN</h4>
        </div>
        <div class="modal-body" id="body">
        </div>
         <div class="modal-footer">
          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Cerrar</button>
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
      </div>
    </div>
  </div>

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Cerrar sesión</a>
                </li>
               </ul>
            </div>
          </div>
        </nav>




        <div id="conceptos" class="w3-container menu" style="display">
  <center>
    <h1>INDICADORES POR REGIONES</h1>
  </center>
  <div>
        <select name="id" class="form-control" id="id"style="width: 300px; height: 35px;">
                  <option value="">Seleccionar año</option>
                  <?php
                    foreach($resultC as $row)
                    {
                        echo '<option value="'.$row["year"].'">'.''.$row["year"] . ' ' .''.$row["concepto"].'</option>';
                    }
                  ?>
        </select>

        <select name="idd" class="form-control" id="idd" style="width: 300px; height: 35px;">
                  <option value="">Seleccionar quincena</option>
                  <?php
                    foreach($resultM as $row)
                    {
                        echo '<option value="'.$row["quincena"].'">'.$row["quincena"].'</option>';
                    }
                  ?>
        </select>
    </div>
  <div>
    <br>
    <br>
    <div class="panel-body">
      <div class="table-responsive">
        <table id="example2" class="table table-hover table-bordered" style="width:100%; border: 1px solid #ddd !important;">
          <thead class="thead-dark">
            <tr>
              <!-- <th scope="col">id</th> -->
              <th scope="col">Region</th>
              <th scope="col">Importe Total</th>
              <th scope="col">Importe/Docentes</th>
              <th scope="col">Importe/Administrativos</th>
            </tr>
          </thead>
          <tbody id="colsubsis"></tbody>
          <tfoot class="thead-dark">
          <tr>
              <!-- <th scope="col">id</th> -->
              <th scope="col">Importe/Docentes</th>
              <th scope="col">Importe Total</th>
              <th scope="col">Region</th>
              <th scope="col">Importe/Administrativos</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

                

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>    
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>    
    <script src="js/toastr.min.js"></script>
    <!--<script type="text/javascript" src="main.js"></script>-->
    
  </body>
</html>

<!-- libreria de google con internet <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
<!-- libreria de google sin internet-->
<script type="text/javascript" src="./charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {packages: ['corechart', 'bar']});
// google.charts.load('current', {'packages':['table']});

google.charts.setOnLoadCallback();


//peticion para la grafica por conceptos
function load_subsis(id, idd)
{
 

    //var temp_title = title + ' '+id+'';
    $.ajax({
        url:"bd/fetch_reg.php",
        method:"POST",
        data:{id:id, idd:idd},
        dataType:"JSON",
        success: function (data) {
                drawSubsis(data);
                toastr.success('Datos cargados', '', {timeOut: 2000});
            },
        error: function (data) {
                data = 0;
                drawSubsis(data);
                toastr.error('No se encontraron datos', 'Error', {timeOut: 2000});
            }
        });
    }

function drawSubsis(chart_data,success)
{
    var jsonData = chart_data;
    //alert(jsonData.length);
    var temp = 1;
    //
    var tablaData ='';
    var tablaData2 ='';
    var tablaData3 ='';
    var tablaData4 ='';
    var tablaData5 ='';
    var tablaData6 ='';
    //
    
   $('#colsubsis').empty();
   $('#colbuts').empty();
   //$('#col2_1').empty();
    $.each(jsonData, function(i, jsonData){
       // var mes = temp ++;
        var region = jsonData.region;
        var total = jsonData.total;
        var docente = jsonData.docente;
        var admvos = jsonData.admvos;
        //var importe = parseFloat($.trim(jsonData.importe));
        /////////
        tablaData += '<tr>';
        //tablaData += '<td>'+mes+'</td>';
        tablaData += '<td>'+region+'</td>';
        tablaData += '<td>'+'$'+total.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'</td>';
        tablaData += '<td>'+'$'+docente.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'</td>';
        tablaData += '<td>'+'$'+admvos.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'</td>';
        tablaData += '</tr>';
        
        //tablaData += '<tr>';
        //tablaData += '<td>'+'$'+jsonData.importe+'</td>';
        //tablaData += '</tr>';
        /////////
        


    });
    
    tablaData6 += '<td> <input type="button" class="btn btn-info" value="Por Subsistema" data-toggle="modal" data-target="#myModaldos"> </td>';
    var total = 0, total2 = 0, total3 = 0;
    for (var i in jsonData){
      total += parseInt(jsonData[i].total, 10);
      total2 += parseInt(jsonData[i].docente, 10);
      total3 += parseInt(jsonData[i].admvos, 10);
      
    }
    tablaData+='<td>'+'Total:'+'</td>';
    tablaData+='<td>'+'$'+total.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'</td>';
    tablaData+='<td>'+'$'+total2.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'</td>';
    tablaData+='<td>'+'$'+total3.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'</td>';
    
    
    $("#colbuts").append(tablaData6);
    $("#colsubsis").append(tablaData);

}

</script>






<script>
    // Detectar seleccion del select option
$(document).ready(function(){

    $('#id, #idd').change(function(){
        var id =$('#id').val();
        var idd = $('#idd').val();
        if(id != '' && idd != '')
        {
            //alert("The text has been changed.");
            load_subsis(id, idd);

        }
    });

});

</script>