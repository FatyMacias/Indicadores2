<?php
Include("bd/database_connection.php");
$queryC = "SELECT SUBSTRING(qna_pago,1,4) AS 'year' FROM indicador GROUP BY year ASC";
//$query = "SELECT SUBSTRING(qna_pago,1,4) AS 'year' FROM indicador GROUP BY year DESC";
$queryM = "SELECT SUBSTRING(qna_pago,5,6) AS 'year' FROM indicador GROUP BY year ASC";



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
    <title>INICIO</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
     <!-- de aqui para abajo no se que pdo --> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
     <!-- importacion css para el toast-->
     <link href="css/toastr.min.css" rel="stylesheet"/>
    
  </head>
  <body>
    
    <div class="wrapper d-flex align-items-stretch">
      <nav id="sidebar">
      <center><a class="navbar-brand" href="inicio.php">INICIO</a></center>  
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
            

        <div id="conceptos" >
          <center><h1>INDICADORES POR GENERO</h1></center>

          <div>

          
               
               
                <div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        <select name="idr" class="form-control" id="idr" style="width: 300px; height: 35px;">
                            <option value="">Por Nivel / Region</option>
                            <option>Region</option>
                            <option>Nivel</option>
                </select>
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
                            <option value="">Seleccionar subsistema</option>
                            <?php
                            foreach($resultM as $row)
                            {
                                echo '<option value="'.$row["year"].'">'.$row["year"].'</option>';
                            }
                            ?>
                </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">

        </div>
    </div>
</div>
               
                
             

          </div>
          <br>
          <br>
          <div class="panel-body">
  <div style="width: 200px; height: 10px;"></div>
</div>
<div class="panel-body menu" style="display:">
  <div class="table-bordered text-center" id="Region" style= "display:">
    <h3><strong>Reporte Por Region</strong></h3>
    <table id="example2" class="table table-hover table-bordered" style="border: 1px solid #ddd !important;">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Region</th>
          <th scope="col">Total</th>
          <th scope="col">Hombres</th>
          <th scope="col">Mujeres</th>
          <th scope="col">Docentes</th>
          <th scope="col">Administrativo</th>
          <th scope="col">Base</th>
          <th scope="col">Interino</th>
          <th scope="col">Contrato</th>
          <th scope="col">Bachilleres</th>
        </tr>
      </thead>
      <tbody id="colsubsis"></tbody>
      <tfoot class="table-dark text-light" id="colsubsis2">
        <tr>
          <th scope="col">Total</th>
          <th scope="col">Hombres</th>
          <th scope="col">Mujeres</th>
          <th scope="col">Docentes</th>
          <th scope="col">Administrativo</th>
          <th scope="col">Base</th>
          <th scope="col">Interino</th>
          <th scope="col">Contrato</th>
          <th scope="col">Bachilleres</th>
        </tr>
      </tfoot>

    </table>
    <table>
      <tr id = "colbuts">

      </tr>
    </table>
    <div class="panel-body">
      <div id="chart_area3" style="width: 1200px; height: 500px; visibility: hidden;"></div>
    </div>
    <div class="panel-body">
      <div id="chart_area2" style="width: 1200px; height: 500px; visibility: hidden;"></div>
    </div>
  </div>
  <div style="width: 200px; height: 10px;"></div>
</div>
<div class="panel-body" style="display:none">
<div class="table-bordered text-center" id="Nivel" style="display:">
    <h3><strong>Reporte Por Nivel</strong></h3>
    <table id="example2" class="table table-hover table-bordered" style="border: 1px solid #ddd !important;">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Actividad</th>
          <th scope="col">Total</th>
          <th scope="col">Hombres</th>
          <th scope="col">Mujeres</th>
          <th scope="col">Docentes</th>
          <th scope="col">Administrativo</th>
          <th scope="col">Base</th>
          <th scope="col">Interino</th>
          <th scope="col">Contrato</th>
          <th scope="col">Bachilleres</th>
        </tr>
      </thead>
      <tbody id="colsubsis1"></tbody>
      <tfoot class="table-dark text-light" id="colsubsis3">
        <tr>
          <th scope="col">Actividad</th>
          <th scope="col">Total</th>
          <th scope="col">Hombres</th>
          <th scope="col">Mujeres</th>
          <th scope="col">Docentes</th>
          <th scope="col">Administrativo</th>
          <th scope="col">Base</th>
          <th scope="col">Interino</th>
          <th scope="col">Contrato</th>
          <th scope="col">Bachilleres</th>
        </tr>
      </tfoot>
    </table>
    <table>
      <tr id = "colbuts1">

      </tr>
    </table>
    <div class="panel-body">
      <div id="chart_area" style="width: 1200px; height: 500px; visibility: hidden;"></div>
    </div>
  </div>
</div>

          <script>
            function myfunction(name){
              var x = document.getElementById("Region");
              var y = document.getElementById("Nivel");
              if (x.style.display === "none" && x == name) {
                x.style.display = "block";
                y.style.display = "none";
              } else {
                x.style.display = "none";
                y.style.display = "block";
              }
            }
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
              var x = document.getElementById('chart_area3');
              var y = document.getElementById('chart_area2');
              if (x.style.visibility === 'hidden' && y.style.visibility === 'hidden') {
                  x.style.visibility = 'visible';
                  y.style.visibility = 'visible';
              } else {
                  x.style.visibility = 'hidden';
                  y.style.visibility = 'hidden';
              }
               
            }
            function show2(){
              //document.getElementById('chart_area').visibility = "visible";
              var x = document.getElementById('chart_area');
              if (x.style.visibility === 'hidden') {
                  x.style.visibility = 'visible';
              } else {
                  x.style.visibility = 'hidden';
              }
               
            }
            function toggle(target, source) {
              this[target].parentNode.style.display = 'none'
              this[source].parentNode.style.display = 'block'
            }
          </script>
          
      
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>  
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
          <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script> 


    <script src="js/toastr.min.js"></script>

  </body>
</html>


<script type="text/javascript" src="./charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {packages: ['corechart', 'bar']});


google.charts.setOnLoadCallback();


//peticion para la grafica por conceptos
function load_subsis(id, idd)
{
    
    //var temp_title = title + ' '+id+'';
    $.ajax({
        url:"bd/fetch_region.php",
        method:"POST",
        data:{id:id, idd:idd},
        dataType:"JSON",
       success: function (data) {
          
                drawSubsis(data);
                drawSubsis2(data); 
                toastr.success('Datos cargados', '', {timeOut: 2000});
            },
        error: function (data) {
                toastr.error('No se encontraron datos', 'Error', {timeOut: 2000});
            }
        });
}

function load_regtot(id, idd)
{
    
    //var temp_title = title + ' '+id+'';
    $.ajax({
        url:"bd/hola.php",
        method:"POST",
        data:{id:id, idd:idd},
        dataType:"JSON",
        success:function(data)
        {
            drawregtot(data);   
        },
        error: function(data)
        {
            alert("No hay Datos");
        }
    });
}
function load_total(id, idd)
{
    
    //var temp_title = title + ' '+id+'';
    $.ajax({
        url:"bd/fetch_total.php",
        method:"POST",
        data:{id:id, idd:idd},
        dataType:"JSON",
        success:function(data)
        {
            drawtotal(data);
        },
        error: function(data)
        {
            alert("No hay Datos");
        }
    });
}
function load_total2(id, idd)
{
    
    //var temp_title = title + ' '+id+'';
    $.ajax({
        url:"bd/fetch_total2.php",
        method:"POST",
        data:{id:id, idd:idd},
        dataType:"JSON",
        success:function(data)
        {
            drawtotal2(data);  
        },
        error: function(data)
        {
            alert("No hay Datos");
        }
    });
}

function drawtotal(chart_data)
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
    
   $('#colsubsis2').empty();
   $('#colbuts').empty();
   $('#colreg').empty();
   //tablaData +='<td class="table-dark text-light"><strong>Titulo</strong></td>';
   //tablaData2 +='<td class="table-dark text-light"><strong>Cantidades</strong></td>';
    $.each(jsonData, function(i, jsonData){
        //var mes = temp ++;
        var name = 'Total';
        var total = jsonData.total;
        var hombres = jsonData.hombres;
        var mujeres = jsonData.mujeres;
        var docentes = jsonData.docentes;
        var administrativo = jsonData.administrativo;
        var base = jsonData.base;
        var interino = jsonData.interino;
        var contrato = jsonData.contrato;
        var bachilleres = jsonData.bachilleres;
        /////////
        tablaData += '<tr>';
        tablaData += '<td>'+name+'</td>';
        tablaData += '<td>'+total+'</td>';
        tablaData += '<td>'+hombres+'</td>';
        tablaData += '<td>'+mujeres+'</td>';
        tablaData += '<td>'+docentes+'</td>';
        tablaData += '<td>'+administrativo+'</td>';
        tablaData += '<td>'+base+'</td>';
        tablaData += '<td>'+interino+'</td>';
        tablaData += '<td>'+contrato+'</td>';
        tablaData += '<td>'+bachilleres+'</td>';
        tablaData += '</tr>';
        
        //tablaData += '<tr>';
        //tablaData += '<td>'+'$'+jsonData.importe+'</td>';
        //tablaData += '</tr>';
        /////////

    });

    tablaData6 += '<td> <input type="button" class="btn btn-info" value="Mostrar Graficas" onclick="show()> </td>';
    $("#colbuts").append(tablaData6);
    //$("#colreg").append(tablaData2);
    $("#colsubsis2").append(tablaData);
    
 
}
function drawtotal2(chart_data)
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
    
   $('#colsubsis3').empty();
   $('#colbuts').empty();
   $('#colreg').empty();
   //tablaData +='<td class="table-dark text-light"><strong>Titulo</strong></td>';
   //tablaData2 +='<td class="table-dark text-light"><strong>Cantidades</strong></td>';
    $.each(jsonData, function(i, jsonData){
        //var mes = temp ++;
        var name = 'Total';
        var total = jsonData.total;
        var hombres = jsonData.hombres;
        var mujeres = jsonData.mujeres;
        var docentes = jsonData.docentes;
        var administrativo = jsonData.administrativo;
        var base = jsonData.base;
        var interino = jsonData.interino;
        var contrato = jsonData.contrato;
        var bachilleres = jsonData.bachilleres;
        /////////
        tablaData += '<tr>';
        tablaData += '<td>'+name+'</td>';
        tablaData += '<td>'+total+'</td>';
        tablaData += '<td>'+hombres+'</td>';
        tablaData += '<td>'+mujeres+'</td>';
        tablaData += '<td>'+docentes+'</td>';
        tablaData += '<td>'+administrativo+'</td>';
        tablaData += '<td>'+base+'</td>';
        tablaData += '<td>'+interino+'</td>';
        tablaData += '<td>'+contrato+'</td>';
        tablaData += '<td>'+bachilleres+'</td>';
        tablaData += '</tr>';
        
        //tablaData += '<tr>';
        //tablaData += '<td>'+'$'+jsonData.importe+'</td>';
        //tablaData += '</tr>';
        /////////

    });

    tablaData6 += '<td> <input type="button" class="btn btn-info" value="Por Subsistema" data-toggle="modal" data-target="#myModaldos"> </td>';
    $("#colbuts").append(tablaData6);
    //$("#colreg").append(tablaData2);
    $("#colsubsis3").append(tablaData);
    
    
    
 
    
    
    
   
}
var data3, options3, chart3;
function drawSubsis(chart_data)
{
    var jsonData = chart_data;
    var temp = 1;
    data3 = new google.visualization.DataTable();
    data3.addColumn('string', 'Regiones');
    data3.addColumn('number', 'Cantidad');
    data3.addColumn({
               type: 'string',
               role: 'style'
           });


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
   $('#colreg').empty();
   //tablaData +='<td class="table-dark text-light"><strong>Titulo</strong></td>';
   //tablaData2 +='<td class="table-dark text-light"><strong>Cantidades</strong></td>';
    $.each(jsonData, function(i, jsonData){
        //var mes = temp ++;
        var region = jsonData.region;
        var total = jsonData.total;
        var hombres = jsonData.hombres;
        var mujeres = jsonData.mujeres;
        var docentes = jsonData.docentes;
        var administrativo = jsonData.administrativo;
        var base = jsonData.base;
        var interino = jsonData.interino;
        var contrato = jsonData.contrato;
        var bachilleres = jsonData.bachilleres;
        var style = jsonData.style;
        data3.addRows([[region, total, style]]);
        /////////
        tablaData += '<tr>';
        tablaData += '<td class="text-left">'+region+'</td>';
        tablaData += '<td>'+total+'</td>';
        tablaData += '<td>'+hombres+'</td>';
        tablaData += '<td>'+mujeres+'</td>';
        tablaData += '<td>'+docentes+'</td>';
        tablaData += '<td>'+administrativo+'</td>';
        tablaData += '<td>'+base+'</td>';
        tablaData += '<td>'+interino+'</td>';
        tablaData += '<td>'+contrato+'</td>';
        tablaData += '<td>'+bachilleres+'</td>';
        tablaData += '</tr>';
        //tablaData += '<tr>';

        // if(i == 0){
        // tablaData2 += '<td>Hombres: '+jsonData.hombres+' Mujeres: '+mujeres+'</td>';
        // tablaData2 += '<br>';
        // }
        //selectHandler(i);
        

         
        //tablaData += '</tr>';
        /////////

    });
    
    tablaData6 += '<td> <input type="button" class="btn btn-info" value="Mostrar/Ocultar Graficas" onclick="show()"> </td>';
    $("#colbuts").append(tablaData6);
    //$("#colreg").append(tablaData2);
    $("#colsubsis").append(tablaData);
    var axis = data.getNumberOfRows();
   //alert('max data table value: ' + axis);
   for(var x=0;x<axis;x++){
    data3.setValue(x, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
   }



  
    options3 = {
        title:"Mujeres y Hombres por Region",
        legend: 'none',
        hAxis: {
            title: "Regiones"
        },
        vAxis: {
            title: 'Cantidades',
            //format: 'currency'
      
        }

    };


    
    chart3 = new google.visualization.ColumnChart(document.getElementById('chart_area3'));
    chart3.draw(data3, options3);
    google.visualization.events.addListener(chart3, 'select', selectHandler);
    // function selectHandler() {
    //   var selection = chart.getSelection();
    //   for (var i =0; i<selection.length;i++){
    //     var item = selection[i];
    //     var str = data.getValue(item.row, item.column);
    //     var num = data.getNumberOfRows()
    //     // for(var x=0;x<num;x++){
    //     //   alert(x);
    //     // }
    //     $("#body").empty();
    //     $.each(jsonData, function(i, jsonData){
    //       var hombres = jsonData.hombres;
    //       var mujeres = jsonData.mujeres;
    //       tablaData2 += '<td>Hombres: '+jsonData.hombres+' Mujeres: '+mujeres+'</td>';
    //       tablaData2 += '<br>';
    //       //i = 0;      
    //       if(str){
    //             $("#myModal").modal();
    //             $("#body").html('<br>'+tablaData2+'<br>');
    //             $("#myModal").modal();          
    //         }
    //       });
    //   }
    // }
    function selectHandler() {
      var selection = chart3.getSelection();
      for (var i =0; i<selection.length;i++){
        var item = selection[i];
        var str = data3.getValue(item.row, 0);
        var res = str.slice(0, 1);
        var stn = data3.getRowProperties(item.row);
        // var num = data.getDistinctValues(item.column);
        // if (num.indexOf(173) >=0 ) // check if the item exists on the array
        //     {
        //         alert('Match');
        //     } else {
        //         alert('No match found.');
        //     }
      $.each(jsonData, function(i, jsonData){
           var hombres = jsonData.hombres;
           var mujeres = jsonData.mujeres;
           if(str){
             if(i == res){
               //alert(i + res);
                $("#myModal").modal();
                $("#body").html(
                  '<br><strong>'+str+'</strong><br>'+
                  '<br>Cantidad de Hombres: '+hombres+' Cantidad de Mujeres: '+mujeres+'<br>');
                $("#myModal").modal();
             }
           }
        });
      }
   
} 
}
  function test3() {
  document.getElementById("chart_area3").style.display = "block";
  chart3.draw(data3, options3);
  }

var data2, options2, chart2;
function drawSubsis2(chart_data)
{
    var jsonData = chart_data;
    var temp = 1;
    data2 = new google.visualization.DataTable();
    data2.addColumn('string', 'Regiones');
    data2.addColumn('number', 'Hombres');
    data2.addColumn('number', 'Mujeres');
    
    //
    var tableData ='';
    var tableData2 ='';
    //
    $.each(jsonData, function(i, jsonData){
        var region = jsonData.region;
        var total = jsonData.total;
        var hombres = jsonData.hombres;
        var mujeres = jsonData.mujeres;
        var docentes = jsonData.docentes;
        var administrativo = jsonData.administrativo;
        var base = jsonData.base;
        var interino = jsonData.interino;
        var contrato = jsonData.contrato;
        var bachilleres = jsonData.bachilleres;
        var style = jsonData.style;
        tableData += '<td><strong>'+region+',  </strong></td>';
        tableData += '<td>Cantidad: <strong>'+hombres+'</strong></td>';
        tableData += '<br>';
        tableData2 += '<td><strong>'+region+',  </strong></td>';
        tableData2 += '<td>Cantidad: <strong>'+mujeres+'</strong></td>';
        tableData2 += '<br>';

        //data.addRows([[region, hombres, mujeres]]);

    });
    var total= 0;
    var total2 = 0;
    for(var i in jsonData){
      total += parseFloat(jsonData[i].hombres,10);
      total2 += parseFloat(jsonData[i].mujeres,10);
      //alert(totale);
    }
    data2.addRows([
      ['Genero', total, total2]
    ]);
    options2 = {
        title:"Mujeres y Hombres por Region",
        width: '100%',
        //legend: 'none',
        hAxis: {
            title: "Regiones"
        },
        vAxis: {
            title: 'Cantidades',
            //format: 'currency'
        }
    };
    chart2 = new google.visualization.ColumnChart(document.getElementById('chart_area2'));
    chart2.draw(data2, options2); 


    google.visualization.events.addListener(chart2, 'select', selectHandler);
    function selectHandler() {
      var selection = chart.getSelection();
      for (var i =0; i<selection.length;i++){
        var item = selection[i];
        var str = data2.getFormattedValue(item.row, item.column);
            if(str == '2,588'){
              $("#myModal").modal();
              $("#body").html(
                '<br>'+tableData+'<br>');
              $("#myModal").modal();
            }else{
              $("#myModal").modal();
              $("#body").html(
                '<br>'+tableData2+'<br>');
              $("#myModal").modal();
            }
            //alert(totale);
          

      }
      
      // var selectedValue = data.getValue(selection.row, 0);
      // var selectedImporte = data.getValue(selection.row, 1);
  //  alert('Seleccionaste el Mes:' + ' ' + selectedValue + ' ' +'con un importe de:'+ ' ' + selectedImporte);
   // $("#body").html('Seleccionaste el Mes:' + ' ' + selectedValue + ' ' +'con un importe de $:'+ ' ' + selectedImporte);

}
}
function test2() {
  document.getElementById("chart_area2").style.display = "block";
  chart2.draw(data2, options2);
  }


var data, options, chart;
function drawregtot(chart_data)
{
  var jsonData = chart_data;
    var temp = 1;
    data = new google.visualization.DataTable();
    data.addColumn('string', 'Regiones');
    data.addColumn('number', 'Hombres');
    data.addColumn('number', 'Mujeres');
    
   

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
   $('#colreg').empty();
   //tablaData +='<td class="table-dark text-light"><strong>Titulo</strong></td>';
   //tablaData2 +='<td class="table-dark text-light"><strong>Cantidades</strong></td>';
    $.each(jsonData, function(i, jsonData){
        //var mes = temp ++;
        var region = jsonData.name;
        var total = jsonData.total;
        var hombres = jsonData.hombres;
        var mujeres = jsonData.mujeres;
        var docentes = jsonData.docentes;
        var administrativo = jsonData.administrativo;
        var base = jsonData.base;
        var interino = jsonData.interino;
        var contrato = jsonData.contrato;
        var bachilleres = jsonData.bachilleres;
        
        data.addRows([[region, hombres, mujeres]]);
        /////////
        tablaData += '<tr>';
        tablaData += '<td class="text-left">'+region+'</td>';
        tablaData += '<td>'+total+'</td>';
        tablaData += '<td>'+hombres+'</td>';
        tablaData += '<td>'+mujeres+'</td>';
        tablaData += '<td>'+docentes+'</td>';
        tablaData += '<td>'+administrativo+'</td>';
        tablaData += '<td>'+base+'</td>';
        tablaData += '<td>'+interino+'</td>';
        tablaData += '<td>'+contrato+'</td>';
        tablaData += '<td>'+bachilleres+'</td>';
        tablaData += '</tr>';
        
        //tablaData += '<tr>';
        //tablaData += '<td>'+'$'+jsonData.importe+'</td>';
        //tablaData += '</tr>';
        /////////

    });

    tablaData6 += '<td> <input type="button" class="btn btn-info" value="Mostrar/Ocultar Graficas" onclick="show2()"> </td>';
    $("#colbuts1").append(tablaData6);
    //$("#colreg").append(tablaData2);
    $("#colsubsis1").append(tablaData);
   
     options = {
        title:"Mujeres y Hombres por Nivel",
        width: '100%',
        //legend: 'none',
        hAxis: {
            title: "Niveles"
        },
        vAxis: {
            title: 'Cantidades',
            //format: 'currency'
      
        }

    };
    chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));
    chart.draw(data, options);

}

function test() {
  document.getElementById("chart_area").style.display = "block";
  chart.draw(data, options);
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
            //alert(idr);
            load_subsis(id, idd);
            load_regtot(id, idd);
            load_total(id, idd);
            load_total2(id, idd);

        }
    });

});

$(document).ready(function(){

$('#idr').change(function(){
    var idr =$('#idr').val();
    if(idr != '' && idr == "Nivel")
    {
      //myfunction(idr)
      //window.location.replace("grafica_region_niveles.php");
      //alert(idr);
      toggle("Region", idr);
      test();
    }
    if(idr != '' && idr == "Region")
    {
      //myfunction(idr)
      //window.location.replace("grafica_region_niveles.php");
      //alert(idr);
      toggle("Nivel", idr);
      test2();
      test3();

    }
});

});

</script>



