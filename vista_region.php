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
              <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Ver gráficas</a>
              <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="inicio.php" >Global</a>
                </li>
                <li>
                    <a href="grafica_concepto.php">Por concepto</a>
                </li>
                <li>
                    <a href="#">Por banco</a>
                </li>
                <li>
                    <a href="grafica_region.php" onclick="openMenu('genero')">Por Region</a>
                </li>
                <li>
                    <a href="grafica_porgenero.php" onclick="openMenu('genero')">Por género</a>
                </li>
              </ul>
            </li>
            
            <li>
              <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Por subsistema</a>
              <ul class="collapse list-unstyled" id="pageSubmenu2">
                <li>
                    <a href="#">Page 1</a>
                </li>
                <li>
                    <a href="#">Page 2</a>
                </li>
                <li>
                    <a href="#">Page 3</a>
                </li>
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
          <center><h1>INDICADORES POR REGION</h1></center>

          <div>

          
               
               
        <div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        <h3>Seleccionar Vista</h3>
        <select name="idr" class="form-control" id="idr" style="width: 300px; height: 35px;">
                            <option value="">Por Nivel / Region</option>
                            <option>Region</option>
                            <option>Nivel</option>
                </select>
        </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">

    </div>
</div>
               
                
             

          </div>
          <br>
          <br>
          <div class="panel-body">
  <div style="width: 200px; height: 10px;"></div>
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
              var x = document.getElementById('example2');
              if (x.style.visivility === 'hidden') {
                  x.style.visivility = 'visible';
              } else {
                  x.style.visivility = 'hidden';
              }
               
            }
          </script>
          
      
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>  
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
          <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script> 
  </body>
</html>


<script type="text/javascript" src="./charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.load('current', {'packages':['table']});

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
        success:function(data)
        {
            drawSubsis(data);
            drawSubsis2(data);
            
        },
        error: function(data)
        {
            alert("No hay Datos");
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

    tablaData6 += '<td> <input type="button" class="btn btn-info" value="Por Subsistema" data-toggle="modal" data-target="#myModaldos"> </td>';
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

function drawSubsis(chart_data)
{
    var jsonData = chart_data;
    var temp = 1;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Regiones');
    data.addColumn('number', 'Cantidad');
    data.addColumn({
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
        data.addRows([[region, total, style]]);
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

    tablaData6 += '<td> <input type="button" class="btn btn-info" value="Por Subsistema" data-toggle="modal" data-target="#myModaldos"> </td>';
    $("#colbuts").append(tablaData6);
    //$("#colreg").append(tablaData2);
    $("#colsubsis").append(tablaData);
    var axis = data.getNumberOfRows();
   //alert('max data table value: ' + axis);
   for(var x=0;x<axis;x++){
    data.setValue(x, 2, '#'+Math.floor(Math.random()*16777215).toString(16));
   }
    var options = {
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


    
    var chart = new google.visualization.ColumnChart(document.getElementById('chart_area3'));
    chart.draw(data, options);

    
    
   
}

function drawSubsis2(chart_data)
{
    var jsonData = chart_data;
    var temp = 1;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Regiones');
    data.addColumn('number', 'Hombres');
    data.addColumn('number', 'Mujeres');
    
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
    data.addRows([
      ['Genero', total, total2]
    ]);
    var options = {
        title:"Mujeres y Hombres por Region",
        //legend: 'none',
        hAxis: {
            title: "Regiones"
        },
        vAxis: {
            title: 'Cantidades',
            //format: 'currency'
        }
    };
    var chart = new google.visualization.ColumnChart(document.getElementById('chart_area2'));
    chart.draw(data, options); 


    google.visualization.events.addListener(chart, 'select', selectHandler);
    function selectHandler() {
      var selection = chart.getSelection();
      for (var i =0; i<selection.length;i++){
        var item = selection[i];
        var str = data.getFormattedValue(item.row, item.column);
            if(str == '2,588'){
              $("#myModal").modal();
              $("#body").html(
                '<h5>'+tableData+'<h5>');
              $("#myModal").modal();
            }else{
              $("#myModal").modal();
              $("#body").html(
                '<h5>'+tableData2+'<h5>');
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


function drawregtot(chart_data)
{
  var jsonData = chart_data;
    var temp = 1;
    var data = new google.visualization.DataTable();
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

    tablaData6 += '<td> <input type="button" class="btn btn-info" value="Por Subsistema" data-toggle="modal" data-target="#myModaldos"> </td>';
    $("#colbuts").append(tablaData6);
    //$("#colreg").append(tablaData2);
    $("#colsubsis1").append(tablaData);
   
    var options = {
        title:"Mujeres y Hombres por Nivel",
        //legend: 'none',
        hAxis: {
            title: "Niveles"
        },
        vAxis: {
            title: 'Cantidades',
            //format: 'currency'
      
        }

    };
    
    var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));
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
      window.location.replace("grafica_region_niveles.php");
      //alert(idr);
    }
    if(idr != '' && idr == "Region")
    {
      //myfunction(idr)
      window.location.replace("grafica_region.php");
      //alert(idr);
    }
});

});

</script>



