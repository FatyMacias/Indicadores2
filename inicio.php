<?php  

include("bd/database_connection.php");

$query = "SELECT SUBSTRING(qna_pago,1,4) AS 'year' FROM indicador GROUP BY year ASC";
$queryC = "SELECT cve_cpto, concepto FROM `cat_conceptos`";
//$query = "SELECT SUBSTRING(qna_pago,1,4) AS 'year' FROM indicador GROUP BY year DESC";
$queryM = "SELECT mes,id_mes,nombre FROM `cat_mes` JOIN nom_mes ON cat_mes.mes = nom_mes.id_mes GROUP BY mes ORDER BY id_quin";
$queryS = "SELECT des_subs FROM `cat_subsitema`";

$statement = $connect->prepare($query);
$statementC = $connect->prepare($queryC);
$statementM = $connect->prepare($queryM);
$statementS = $connect->prepare($queryS);

$statement->execute();
$statementC->execute();
$statementM->execute();
$statementS->execute();

$result = $statement->fetchAll();
$resultC = $statementC->fetchAll();
$resultM = $statementM->fetchAll();
$resultS = $statementS->fetchAll();

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

        
  <div class="modal fade" id="myModaluno" role="dialog">
    <div class="modal-dialog" style="max-width: 100%;" role="document">
    
      <!-- Modal content POR CONCEPTOS-->
      <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="btn close" 
                            data-dismiss="modal" aria-label="Close"> 
                            <span class="float-right" aria-hidden="true">×</span>
                        </button> 
        <!-- <button type="button" class="close" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button> -->
        <h4 class="modal-title w-100 text-center" class="modal-title">CONCEPTOS POR AÑO</h4>

        </div>
        <div class="modal-body" id="bodyuno">
            <div class="table-responsive">
                    <table id = "example" class="table table-hover table-bordered" style="width:100%; border: 1px solid #ddd !important;">
                        
                              <thead class="thead-dark">
                                    <tr>
                                      <!-- <th scope="col">Mes</th> -->
                                      <th scope="col">Clave</th>
                                      <th scope="col">Nombre del Concepto</th>
                                      <th style="width:15px" scope="col">Deducción o Percepción</th>
                                      <th scope="col">Importe</th>
                                    </tr>
                            </thead>
                            <tbody id="coluno">

                            </tbody>
                            <tfoot class="thead-dark">
                                     <tr>
                                      <!-- <th scope="col">Mes</th> -->
                                      <th scope="col">Clave</th>
                                      <th scope="col">Nombre del Concepto</th>
                                      <th style="width:15px" scope="col">Deducción o Percepción</th>
                                      <th scope="col">Importe</th>
                                    </tr>

                            </tfoot>
                    </table>
            </div>
        </div>
        <div class="modal-body" id="body">
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        </div> 
</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
          </button>
        </div>
          </div>  
    </div>




           
        <div id="general" class="w3-container menu">
          <center><h1>INDICADORES</h1></center>
          <div>
      
              
                <select name="id" class="form-control" id="id"  style="width: 300px; height: 35px;">
                            <option value="">Selecciona un año</option>
                            <?php
                            foreach($result as $row)
                            {
                                echo '<option value="'.$row["year"].'">'.$row["year"].'</option>';
                            }
                            ?>
                </select>
          </div>
         
            <br>
            <br>
          <div class="panel-body" >

          <div style="width: 200px; height: 10px;"></div>
          </div>
          <div class="panel-body">

          <div class="table-bordered table-responsive text-center">
<table class="table table-hover table-bordered" style="border: 1px solid #ddd !important;">
    <tbody>
      <tr id="colbut" class="">
        
      </tr>
    </tbody>
</table>
</div>

<div class="table-bordered table-responsive text-center">
<table class="table table-hover table-bordered" style="border: 1px solid #ddd !important;">
    <tbody>
        <tr id="col1">
        	
        </tr>
        <tr id="col2">
            
        </tr>
        <tr id="col2_2">
            
        </tr>
        <tr id="col2_1">
            
        </tr>

     
    </tbody>
</table>
</div>



</div>

              <div id="chart_area" style="width: 1200px; height: 500px; visibility: hidden;"></div>
              
          </div>
          <div class="table-bordered table-responsive text-center">
<table class="table table-hover table-bordered" style="border: 1px solid #ddd !important;">
    <tbody>
      <tr id="colbuts" class="">
        
      </tr>
    </tbody>
</table>
</div>
         

          <div class="table-bordered table-responsive text-center">
<table class="table table-hover table-bordered" style="border: 1px solid #ddd !important;">
    <tbody>
        <tr id="col3">
        	
        </tr>
        <tr id="col4">
            
        </tr>
        <tr id="col4_2">
            
        </tr>
        <tr id="col4_1">
            
        </tr>
     
    </tbody>
</table>
</div>

          <div class="panel-body">
            
              <div id="chart_area2" style="width: 1200px; height: 500px; visibility: hidden;"></div>
              
          </div>
          
          </div>


          <div id="conceptos" class="w3-container menu" style="display:none">
            <center><h1>INDICADORES POR CONCEPTO</h1></center>
          <div>
      
              
                <select name="idc" class="form-control" id="idc" style="width: 300px; height: 35px;">
                            <option value="">Seleccionar Concepto</option>
                            <?php
                            foreach($resultC as $row)
                            {
                                echo '<option value="'.$row["cve_cpto"].'">'.$row["concepto"].', codigo: '.$row["cve_cpto"].'</option>';
                            }
                            ?>
                </select>

                
                <select name="idm" class="form-control" id="idm">
                            <option value="">Seleccionar Mes</option>
                            <?php
                            foreach($resultM as $row)
                            {
                                echo '<option value="'.$row["mes"].'">'.$row["nombre"].'</option>';
                            }
                            ?>
                </select>
          </div>
          <div class="panel-body">
           
              <div style="width: 200px; height: 10px;"></div>
            
          </div>
          <div class="panel-body">
           
              <div id="chart_area3" style="width: 1200px; height: 500px;"></div>
            
          </div>
          </div>

          <div id="subsis" class="w3-container menu" style="display:none">
            <center><h1>INDICADORES POR SUBSISTEMA</h1></center>
          <div>
      
          </div>
          <div class="panel-body">
           
              <div style="width: 200px; height: 10px;"></div>
            
          </div>
          </div>


          
          <script>

            function openMenu(menuName) {
              var i;
              var x = document.getElementsByClassName("menu");
              for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";  
                  }
              document.getElementById(menuName).style.display = "block";  
            }
            

            function show(){
              //document.getElementById('chart_area').visibility = "visible";
              var x = document.getElementById('chart_area');
              if (x.style.visibility === 'hidden') {
                  x.style.visibility = 'visible';
              } else {
                  x.style.visibility = 'hidden';
              }
               
            }
            function show2(){
              //document.getElementById('chart_area').visibility = "visible";
              var x = document.getElementById('chart_area2');
              if (x.style.visibility === 'hidden') {
                  x.style.visibility = 'visible';
              } else {
                  x.style.visibility = 'hidden';
              }
               
            }
          </script>
          
          

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>    
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>    
     
    <!--<script type="text/javascript" src="main.js"></script>-->
    
  </body>
</html>

<!-- libreria de google con internet <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
<!-- libreria de google sin internet-->
<script type="text/javascript" src="./charts/loader.js"></script>
<script type="text/javascript">

google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.load('current', {'packages':['table']});
//google.charts.load('current', {packages: ['table']});
google.charts.setOnLoadCallback();


// peticion a la base para la gráfica global
function load_conceptowise_data(id, title)
{
    var temp_title = title + ' '+id+'';
    $.ajax({
        url:"bd/fetch.php",
        method:"POST",
        data:{id:id},
        dataType:"JSON",
        success:function(data)
        {
            drawMonthwiseChart(data, temp_title);
            
        },
        error: function(data)
        {
            alert("No hay Datos");
        }
    });
}
// peticion a la base de datos para la grafica por quincenas
function load_conceptowise2_data(id, title)
{
    var temp_title = title + ' '+id+'';
    $.ajax({
        url:"bd/nuevo_fetch.php",
        method:"POST",
        data:{id:id},
        dataType:"JSON",
        success:function(data)
        {
            drawMonthwiseChart2(data, temp_title);
        },
        error: function(data)
        {
            alert("No hay Datos");
        }
    });
}
//peticion para la grafica por conceptos
function load_conceptowise3_data(idc, idm, title)
{
    var temp_title = title + ' '+idc+''+' '+'del mes'+' '+idm+'';
    $.ajax({
        url:"bd/fetch_concepto.php",
        method:"POST",
        data:{idc:idc, idm:idm},
        dataType:"JSON",
        success:function(data)
        {
            drawMonthwiseChart3(data, temp_title);
        },
        error: function(data)
        {
            alert("No hay Datos");
        }
    });
}

//modal para traer el grid de coceptos
function load_modaldata(id)
{
    $('#colbut').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Cargando...');
    $.ajax({
        url:"bd/fetch_modal.php",
        method:"POST",
        data:{id:id},
        dataType:"JSON",
        success:function(data)
        {
            drawModaldata(data);
            
        },
        error: function(data)
        {
            alert("No hay Datos");
        }
    });
}


function drawModaldata(chart_data)
{
    var jsonData = chart_data;
    var temp = 1;
    //
    var tablaData ='';
    var tablaData2 ='';
    var tablaData3 ='';
    var tablaData4 ='';
    var tablaData5 ='';
    var tablaData6 ='';
    //
    
   $('#coluno').empty();
   $('#colbut').empty();
   //$('#col2_1').empty();
    $.each(jsonData, function(i, jsonData){
        var mes = temp ++;
        var importe = jsonData.importe;
        var clave = jsonData.clave;
        var nombre = jsonData.nombre;
        var deduc = jsonData.deduc;
        //var importe = parseFloat($.trim(jsonData.importe));
        /////////
        tablaData += '<tr>';
        //tablaData += '<td>'+mes+'</td>';
        tablaData += '<td>'+clave+'</td>';
        tablaData += '<td>'+nombre+'</td>';
        tablaData += '<td>'+deduc+'</td>';
        tablaData += '<td>'+'$'+importe.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'</td>';
        tablaData += '</tr>';
        
        //tablaData += '<tr>';
        //tablaData += '<td>'+'$'+jsonData.importe+'</td>';
        //tablaData += '</tr>';
        /////////

    });
    
    tablaData6 += '<td> <input type="button" class="btn btn-success" value="Por Conceptos" data-toggle="modal" data-target="#myModaluno"> </td>';
    $("#colbut").append(tablaData6);
    $("#coluno").append(tablaData);

    $(document).ready(function () {
      var table = $("#example").DataTable({
        lengthMenu: [
          [10, 25, 50, 100, 200, -1],
          [10, 25, 50, 100, 200, "All"],
        ],
        //para cambiar el lenguaje a español
        language: {
          lengthMenu: "Mostrar _MENU_ registros",
          zeroRecords: "No se encontraron resultados",
          info:
            "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
          infoFiltered: "(filtrado de un total de _MAX_ registros)",
          sSearch: "Buscar:",
          oPaginate: {
            sFirst: "Primero",
            sLast: "Último",
            sNext: "Siguiente",
            sPrevious: "Anterior",
          },
          sProcessing: "Procesando...",
        },
        });
        $('#id').change(function(){
          table.clear().destroy();
        });

        

      });

   
    
    
    
   
}

// dibujar grafica 1 global
function drawMonthwiseChart(chart_data, chart_main_title)
{
    var jsonData = chart_data;
    
    var tablaData ='';
    var tablaData2 ='';
    var tablaData3 ='';
    var tablaData4 ='';
    
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Quincenas');
    data.addColumn('number', 'Importe $');
    data.addColumn({
               type: 'string',
               role: 'style'
           });

   $('#col1').empty();
   $('#col2').empty();
   $('#col2_1').empty();
   $('#col2_2').empty();
      tablaData +='<td class="table-dark text-light"><strong>Meses</strong></td>';
      tablaData2 +='<td class="table-dark text-light"><strong>Importe</strong></td>';
      tablaData4 +='<td class="table-dark text-light"><strong>Total</strong></td>';
    $.each(jsonData, function(i, jsonData){
    	
        var concepto = jsonData.concepto;
        var importe = parseFloat($.trim(jsonData.importe));
        var style = jsonData.style;
        data.addRows([[concepto, importe, style]]);
        //tablaData += '<tr>';
        tablaData += '<td>'+jsonData.concepto+'</td>';
        tablaData2 += '<td>'+'$'+jsonData.importe.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'</td>';
        //tablaData += '</tr>';
        //tablaData += '<tr>';
        //tablaData += '<td>'+'$'+jsonData.importe+'</td>';
        //tablaData += '</tr>';
        /////////

    });
    var total = 0;
    for(var i in jsonData){
      total += parseFloat(jsonData[i].importe,10);
      //alert(total);
    }
   tablaData4 +='<td><strong>'+'$'+total.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'</strong></td>';
   tablaData3 += '<td> <input type="button" class="btn btn-success" value="Ocultar/Mostrar Grafica" onclick="show()"> </td>';
   var axis = data.getNumberOfRows();
   //alert('max data table value: ' + data.getValue(0, 0));
   for(var x=0;x<axis;x++){
    data.setValue(x, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
    //data.getValue(0,0)
   }

 $("#col1").append(tablaData);
 $("#col2").append(tablaData2);
 $("#col2_1").append(tablaData3);
 $("#col2_2").append(tablaData4);


    var options = {
        title:chart_main_title, 
        legend: 'none',
        hAxis: {
            title: "Quincenas"
        },
        vAxis: {
            title: 'Importe',
            format: 'currency'
        }
        
    };
 
    var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));
    chart.draw(data, options);
    google.visualization.events.addListener(chart, 'select', selectHandler);

    function selectHandler() {
      var selection = chart.getSelection();
      for (var i =0; i<selection.length;i++){
        var item = selection[i];
        var str = data.getValue(item.row, item.column);
        var strf = str/4;
        $("#myModal").modal();
        $("#body").html('Fuente: <strong>U080</strong>, importe total:'+ ' ' +'$'+ strf.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'<br>'+
          'Fuente: <strong>Estatal</strong>, importe total:'+ ' ' +'$'+ strf.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'<br>'+
          'Fuente: <strong>Propios</strong>, importe total:'+ ' ' + '$'+strf.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'<br>'+
          'Fuente: <strong>Fone Otros</strong>, importe total:'+ ' ' +'$'+ strf.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'<br>');
        $("#myModal").modal();
            //alert(totale);
      }

    }
}
// dibujar grafica 2 por mes
function drawMonthwiseChart2(chart_data, chart_main_title)
{
    var jsonData = chart_data;
    var tablaData ='';
    var tablaData2 ='';
    var tablaData3 ='';
    var tablaData4 ='';
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Quincenas');
    data.addColumn('number', 'Importe $');
    data.addColumn({
               type: 'string',
               role: 'style'
           });
    $('#col3').empty();
    $('#col4').empty();
    $('#col4_1').empty();
    $('#col4_2').empty();
    tablaData +='<td class="table-dark text-light"><strong>Quincenas</strong></td>';
    tablaData2 +='<td class="table-dark text-light"><strong>Importe</strong></td>';
    tablaData4 +='<td class="table-dark text-light"><strong>Total</strong></td>';
    $.each(jsonData, function(i, jsonData){
        var concepto = jsonData.concepto;
        var importe = parseFloat($.trim(jsonData.importe));
        var style = jsonData.style;
        data.addRows([[concepto, importe, style]]);

        tablaData += '<td>'+jsonData.concepto+'</td>';
        tablaData2 += '<td>'+'$'+jsonData.importe.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'</td>';


    });
    var total = 0;
    for(var i in jsonData){
      total += parseFloat(jsonData[i].importe,10);
      //alert(total);
    }
     tablaData4 +='<td><strong>'+'$'+total.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'</strong></td>';
     tablaData3 += '<td> <input type="button" class="btn btn-success" value="Ocultar/Mostrar Grafica" onclick="show2()"> </td>';
    
    //funcion para los colores aleatorios de la gráfica
    var axis = data.getNumberOfRows();
    //alert('max data table value: ' + axis.max);
    for(var x=0;x<axis;x++){
    data.setValue(x, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
   }
    
    $("#col3").append(tablaData);
    $("#col4").append(tablaData2);
    $("#col4_1").append(tablaData3);
    $("#col4_2").append(tablaData4);
    var options = {
        title:chart_main_title,
        legend: 'none',
        hAxis: {
            title: "Quincenas"
        },
        vAxis: {
            title: 'Importe',
            format: 'currency'
          
        }

    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_area2'));
    chart.draw(data, options);

    //evento de google para el modal
    google.visualization.events.addListener(chart, 'select', selectHandler);
    function selectHandler() {
      var selection = chart.getSelection();
      for (var i =0; i<selection.length;i++){
        var item = selection[i];
        var str = data.getValue(item.row, item.column);
        var strf = str/4;
        $("#myModal").modal();
        $("#body").html('Fuente: <strong>U080</strong>, importe total:'+ ' ' +'$'+ strf.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'<br>'+
          'Fuente: <strong>Estatal</strong>, importe total:'+ ' ' +'$'+ strf.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'<br>'+
          'Fuente: <strong>Propios</strong>, importe total:'+ ' ' + '$'+strf.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'<br>'+
          'Fuente: <strong>Fone Otros</strong>, importe total:'+ ' ' +'$'+ strf.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+'<br>');
        $("#myModal").modal();
            //alert(totale);
      }

    }
    
}
//dibujar graafica por conceptos
function drawMonthwiseChart3(chart_data, chart_main_title)
{
    var jsonData = chart_data;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Quincenas');
    data.addColumn('number', 'Importe $');
    data.addColumn({
               type: 'string',
               role: 'style'
           });
    $.each(jsonData, function(i, jsonData){
        var concepto = jsonData.concepto;
        var importe = parseFloat($.trim(jsonData.importe));
        var style = jsonData.style;
        data.addRows([[concepto, importe, style]]);


    });
    var axis = data.getNumberOfRows();
    //alert('max data table value: ' + axis);
    for(var x=0;x<axis;x++){
    data.setValue(x, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
   }
    
    var options = {
        title:chart_main_title,
        legend: 'none',
        hAxis: {
            title: "Quincenas"
        },
        vAxis: {
            title: 'Importe',
            format: 'currency'
      
        }

    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_area3'));
    chart.draw(data, options);
}
</script>


<script>
    // Detectar seleccion del select option
$(document).ready(function(){

    $('#id').change(function(){
        var id = $(this).val();
        if(id != '')
        {
            //alert("The text has been changed.");
            load_conceptowise_data(id, 'Importe por cada mes, quincenas correspondientes al año:');
            load_conceptowise2_data(id, 'Importe por cada quincena, quincenas correspondientes al año:');
            load_modaldata(id);
        }
    });

});

</script>


<script>
    // Detectar seleccion del select option
$(document).ready(function(){

    $('#idc, #idm').change(function(){
        var idc = $('#idc').val();
        var idm = $('#idm').val();
        if(idc != '' && idm != '')
        {
            //alert("The text has been changed.");
            
            load_conceptowise3_data(idc, idm, 'Importe anual, concepto:  ');
        }
    });

});

</script>

