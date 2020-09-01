<?php  

include("bd/database_connection.php");

$query = "SELECT SUBSTRING(qna_pago,1,4) AS 'year' FROM indicador GROUP BY year ASC";
$queryC = "SELECT cve_cpto, concepto FROM `cat_conceptos`";
//$query = "SELECT SUBSTRING(qna_pago,1,4) AS 'year' FROM indicador GROUP BY year DESC";
$queryM = "SELECT mes,id_mes,nombre FROM `cat_mes` JOIN nom_mes ON cat_mes.mes = nom_mes.id_mes GROUP BY mes ORDER BY id_quin";

$statement = $connect->prepare($query);
$statementC = $connect->prepare($queryC);
$statementM = $connect->prepare($queryM);

$statement->execute();
$statementC->execute();
$statementM->execute();

$result = $statement->fetchAll();
$resultC = $statementC->fetchAll();
$resultM = $statementM->fetchAll();

?>  

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>INDICADORES</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
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
              <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Ver gráficas</a>
              <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="inicio.php" onclick="openMenu('general')">Global</a>
                </li>
                <li>
                    <a href="grafica_concepto.php" onclick="openMenu('conceptos')">Por concepto</a>
                </li>
                <li>
                    <a href="#">Por banco</a>
                </li>
                <li>
                    <a href="#">Por género</a>
                </li>
              </ul>
            </li>


           
            <li>
              <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Por subsitema</a>
              <ul class="collapse list-unstyled" id="pageSubmenu">
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

        
  <div class="modal fade" id="myModaluno" role="dialog">
    <div class="modal-dialog" style="max-width: 100%;" role="document">
    
      <!-- Modal content POR CONCEPTOS-->
      <div class="modal-content">
        <div class="modal-header">
          
        <h4 class="modal-title w-100 text-center" class="modal-title">CONCEPTOS POR AÑO</h4>

        </div>
        <div class="modal-body" id="bodyuno">
                    <div class="table-bordered table-responsive text-center">
            <table id = "tabladata" class="table table-hover table-bordered" style="width:100%; border: 1px solid #ddd !important;">
                
                      <thead class="thead-dark">
                            <tr>
                              <th scope="col">Mes</th>
                              <th scope="col">Clave</th>
                              <th scope="col">Nombre del Concepto</th>
                              <th scope="col">Deducci&oacute;n o Percepci&oacute;n</th>
                              <th scope="col">Importe</th>
                            </tr>
                    </thead>
                    <tbody id="coluno">

                    </tbody>
                    <tfoot>
                             <tr>
                              <th scope="col">Mes</th>
                              <th scope="col">Clave</th>
                              <th scope="col">Nombre del Concepto</th>
                              <th scope="col">Deducci&oacute;n o Percepci&oacute;n</th>
                              <th scope="col">Importe</th>
                            </tr>

                    </tfoot>
            </table>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
      
    </div>
  </div>


           
        <div id="general" class="w3-container menu">
          <center><h1>INDICADORES</h1></center>
          <div>
      
              
                <select name="id" class="form-control" id="id" style="width: 300px; height: 35px;">
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
    	<thead class="thead-dark">
                <tr>
                  <th scope="col">Meses</th>
                </tr>
        </thead>
        <tr id="col1">
        	
        </tr>
        <thead class="thead-dark">
                <tr>
                  <th scope="col">Importe</th>
                </tr>
        </thead>
        <tr id="col2">
            
        </tr>
        <tr id="col2_1">
            
        </tr>
     
    </tbody>
</table>
</div>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td>$170,750</td>
            </tr>
            <tr>
                <td>Ashton Cox</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009/01/12</td>
                <td>$86,000</td>
            </tr>
            <tr>
                <td>Cedric Kelly</td>
                <td>Senior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2012/03/29</td>
                <td>$433,060</td>
            </tr>
            <tr>
                <td>Airi Satou</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>33</td>
                <td>2008/11/28</td>
                <td>$162,700</td>
            </tr>
            <tr>
                <td>Brielle Williamson</td>
                <td>Integration Specialist</td>
                <td>New York</td>
                <td>61</td>
                <td>2012/12/02</td>
                <td>$372,000</td>
            </tr>
            <tr>
                <td>Herrod Chandler</td>
                <td>Sales Assistant</td>
                <td>San Francisco</td>
                <td>59</td>
                <td>2012/08/06</td>
                <td>$137,500</td>
            </tr>
            <tr>
                <td>Rhona Davidson</td>
                <td>Integration Specialist</td>
                <td>Tokyo</td>
                <td>55</td>
                <td>2010/10/14</td>
                <td>$327,900</td>
            </tr>
            <tr>
                <td>Colleen Hurst</td>
                <td>Javascript Developer</td>
                <td>San Francisco</td>
                <td>39</td>
                <td>2009/09/15</td>
                <td>$205,500</td>
            </tr>
            <tr>
                <td>Sonya Frost</td>
                <td>Software Engineer</td>
                <td>Edinburgh</td>
                <td>23</td>
                <td>2008/12/13</td>
                <td>$103,600</td>
            </tr>
            <tr>
                <td>Jena Gaines</td>
                <td>Office Manager</td>
                <td>London</td>
                <td>30</td>
                <td>2008/12/19</td>
                <td>$90,560</td>
            </tr>
            <tr>
                <td>Quinn Flynn</td>
                <td>Support Lead</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2013/03/03</td>
                <td>$342,000</td>
            </tr>
            <tr>
                <td>Charde Marshall</td>
                <td>Regional Director</td>
                <td>San Francisco</td>
                <td>36</td>
                <td>2008/10/16</td>
                <td>$470,600</td>
            </tr>
            <tr>
                <td>Haley Kennedy</td>
                <td>Senior Marketing Designer</td>
                <td>London</td>
                <td>43</td>
                <td>2012/12/18</td>
                <td>$313,500</td>
            </tr>
            <tr>
                <td>Tatyana Fitzpatrick</td>
                <td>Regional Director</td>
                <td>London</td>
                <td>19</td>
                <td>2010/03/17</td>
                <td>$385,750</td>
            </tr>
            <tr>
                <td>Michael Silva</td>
                <td>Marketing Designer</td>
                <td>London</td>
                <td>66</td>
                <td>2012/11/27</td>
                <td>$198,500</td>
            </tr>
            <tr>
                <td>Paul Byrd</td>
                <td>Chief Financial Officer (CFO)</td>
                <td>New York</td>
                <td>64</td>
                <td>2010/06/09</td>
                <td>$725,000</td>
            </tr>
            <tr>
                <td>Gloria Little</td>
                <td>Systems Administrator</td>
                <td>New York</td>
                <td>59</td>
                <td>2009/04/10</td>
                <td>$237,500</td>
            </tr>
            <tr>
                <td>Bradley Greer</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>41</td>
                <td>2012/10/13</td>
                <td>$132,000</td>
            </tr>
            <tr>
                <td>Dai Rios</td>
                <td>Personnel Lead</td>
                <td>Edinburgh</td>
                <td>35</td>
                <td>2012/09/26</td>
                <td>$217,500</td>
            </tr>
            <tr>
                <td>Jenette Caldwell</td>
                <td>Development Lead</td>
                <td>New York</td>
                <td>30</td>
                <td>2011/09/03</td>
                <td>$345,000</td>
            </tr>
            <tr>
                <td>Yuri Berry</td>
                <td>Chief Marketing Officer (CMO)</td>
                <td>New York</td>
                <td>40</td>
                <td>2009/06/25</td>
                <td>$675,000</td>
            </tr>
            <tr>
                <td>Caesar Vance</td>
                <td>Pre-Sales Support</td>
                <td>New York</td>
                <td>21</td>
                <td>2011/12/12</td>
                <td>$106,450</td>
            </tr>
            <tr>
                <td>Doris Wilder</td>
                <td>Sales Assistant</td>
                <td>Sydney</td>
                <td>23</td>
                <td>2010/09/20</td>
                <td>$85,600</td>
            </tr>
            <tr>
                <td>Angelica Ramos</td>
                <td>Chief Executive Officer (CEO)</td>
                <td>London</td>
                <td>47</td>
                <td>2009/10/09</td>
                <td>$1,200,000</td>
            </tr>
            <tr>
                <td>Gavin Joyce</td>
                <td>Developer</td>
                <td>Edinburgh</td>
                <td>42</td>
                <td>2010/12/22</td>
                <td>$92,575</td>
            </tr>
            <tr>
                <td>Jennifer Chang</td>
                <td>Regional Director</td>
                <td>Singapore</td>
                <td>28</td>
                <td>2010/11/14</td>
                <td>$357,650</td>
            </tr>
            <tr>
                <td>Brenden Wagner</td>
                <td>Software Engineer</td>
                <td>San Francisco</td>
                <td>28</td>
                <td>2011/06/07</td>
                <td>$206,850</td>
            </tr>
            <tr>
                <td>Fiona Green</td>
                <td>Chief Operating Officer (COO)</td>
                <td>San Francisco</td>
                <td>48</td>
                <td>2010/03/11</td>
                <td>$850,000</td>
            </tr>
            <tr>
                <td>Shou Itou</td>
                <td>Regional Marketing</td>
                <td>Tokyo</td>
                <td>20</td>
                <td>2011/08/14</td>
                <td>$163,000</td>
            </tr>
            <tr>
                <td>Michelle House</td>
                <td>Integration Specialist</td>
                <td>Sydney</td>
                <td>37</td>
                <td>2011/06/02</td>
                <td>$95,400</td>
            </tr>
            <tr>
                <td>Suki Burks</td>
                <td>Developer</td>
                <td>London</td>
                <td>53</td>
                <td>2009/10/22</td>
                <td>$114,500</td>
            </tr>
            <tr>
                <td>Prescott Bartlett</td>
                <td>Technical Author</td>
                <td>London</td>
                <td>27</td>
                <td>2011/05/07</td>
                <td>$145,000</td>
            </tr>
            <tr>
                <td>Gavin Cortez</td>
                <td>Team Leader</td>
                <td>San Francisco</td>
                <td>22</td>
                <td>2008/10/26</td>
                <td>$235,500</td>
            </tr>
            <tr>
                <td>Martena Mccray</td>
                <td>Post-Sales support</td>
                <td>Edinburgh</td>
                <td>46</td>
                <td>2011/03/09</td>
                <td>$324,050</td>
            </tr>
            <tr>
                <td>Unity Butler</td>
                <td>Marketing Designer</td>
                <td>San Francisco</td>
                <td>47</td>
                <td>2009/12/09</td>
                <td>$85,675</td>
            </tr>
            <tr>
                <td>Howard Hatfield</td>
                <td>Office Manager</td>
                <td>San Francisco</td>
                <td>51</td>
                <td>2008/12/16</td>
                <td>$164,500</td>
            </tr>
            <tr>
                <td>Hope Fuentes</td>
                <td>Secretary</td>
                <td>San Francisco</td>
                <td>41</td>
                <td>2010/02/12</td>
                <td>$109,850</td>
            </tr>
            <tr>
                <td>Vivian Harrell</td>
                <td>Financial Controller</td>
                <td>San Francisco</td>
                <td>62</td>
                <td>2009/02/14</td>
                <td>$452,500</td>
            </tr>
            <tr>
                <td>Timothy Mooney</td>
                <td>Office Manager</td>
                <td>London</td>
                <td>37</td>
                <td>2008/12/11</td>
                <td>$136,200</td>
            </tr>
            <tr>
                <td>Jackson Bradshaw</td>
                <td>Director</td>
                <td>New York</td>
                <td>65</td>
                <td>2008/09/26</td>
                <td>$645,750</td>
            </tr>
            <tr>
                <td>Olivia Liang</td>
                <td>Support Engineer</td>
                <td>Singapore</td>
                <td>64</td>
                <td>2011/02/03</td>
                <td>$234,500</td>
            </tr>
            <tr>
                <td>Bruno Nash</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>38</td>
                <td>2011/05/03</td>
                <td>$163,500</td>
            </tr>
            <tr>
                <td>Sakura Yamamoto</td>
                <td>Support Engineer</td>
                <td>Tokyo</td>
                <td>37</td>
                <td>2009/08/19</td>
                <td>$139,575</td>
            </tr>
            <tr>
                <td>Thor Walton</td>
                <td>Developer</td>
                <td>New York</td>
                <td>61</td>
                <td>2013/08/11</td>
                <td>$98,540</td>
            </tr>
            <tr>
                <td>Finn Camacho</td>
                <td>Support Engineer</td>
                <td>San Francisco</td>
                <td>47</td>
                <td>2009/07/07</td>
                <td>$87,500</td>
            </tr>
            <tr>
                <td>Serge Baldwin</td>
                <td>Data Coordinator</td>
                <td>Singapore</td>
                <td>64</td>
                <td>2012/04/09</td>
                <td>$138,575</td>
            </tr>
            <tr>
                <td>Zenaida Frank</td>
                <td>Software Engineer</td>
                <td>New York</td>
                <td>63</td>
                <td>2010/01/04</td>
                <td>$125,250</td>
            </tr>
            <tr>
                <td>Zorita Serrano</td>
                <td>Software Engineer</td>
                <td>San Francisco</td>
                <td>56</td>
                <td>2012/06/01</td>
                <td>$115,000</td>
            </tr>
            <tr>
                <td>Jennifer Acosta</td>
                <td>Junior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>43</td>
                <td>2013/02/01</td>
                <td>$75,650</td>
            </tr>
            <tr>
                <td>Cara Stevens</td>
                <td>Sales Assistant</td>
                <td>New York</td>
                <td>46</td>
                <td>2011/12/06</td>
                <td>$145,600</td>
            </tr>
            <tr>
                <td>Hermione Butler</td>
                <td>Regional Director</td>
                <td>London</td>
                <td>47</td>
                <td>2011/03/21</td>
                <td>$356,250</td>
            </tr>
            <tr>
                <td>Lael Greer</td>
                <td>Systems Administrator</td>
                <td>London</td>
                <td>21</td>
                <td>2009/02/27</td>
                <td>$103,500</td>
            </tr>
            <tr>
                <td>Jonas Alexander</td>
                <td>Developer</td>
                <td>San Francisco</td>
                <td>30</td>
                <td>2010/07/14</td>
                <td>$86,500</td>
            </tr>
            <tr>
                <td>Shad Decker</td>
                <td>Regional Director</td>
                <td>Edinburgh</td>
                <td>51</td>
                <td>2008/11/13</td>
                <td>$183,000</td>
            </tr>
            <tr>
                <td>Michael Bruce</td>
                <td>Javascript Developer</td>
                <td>Singapore</td>
                <td>29</td>
                <td>2011/06/27</td>
                <td>$183,000</td>
            </tr>
            <tr>
                <td>Donna Snider</td>
                <td>Customer Support</td>
                <td>New York</td>
                <td>27</td>
                <td>2011/01/25</td>
                <td>$112,000</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot>
    </table>


</div>

           
           
              <div id="chart_area" style="width: 1200px; height: 500px; visibility: hidden;"></div>
              
          </div>
          
          <div class="table-bordered table-responsive text-center">
<table class="table table-hover table-bordered" style="border: 1px solid #ddd !important;">
    <tbody>
    	<thead class="thead-dark">
                <tr>
                  <th scope="col">Quincenas</th>
                </tr>
        </thead>
        <tr id="col3">
        	
        </tr>
        <thead class="thead-dark">
                <tr>
                  <th scope="col">Importe</th>
                </tr>
        </thead>
        <tr id="col4">
            
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
          
          

        
     
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
    <script src="cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>    
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    
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
        tablaData += '<td>'+mes+'</td>';
        tablaData += '<td>'+clave+'</td>';
        tablaData += '<td>'+nombre+'</td>';
        tablaData += '<td>'+deduc+'</td>';
        tablaData += '<td>'+'$'+importe.toFixed(2)+'</td>';
        tablaData += '</tr>';
        
        //tablaData += '<tr>';
        //tablaData += '<td>'+'$'+jsonData.importe+'</td>';
        //tablaData += '</tr>';
        /////////

    });
    
    tablaData6 += '<td> <input type="button" class="btn btn-info" value="Por Conceptos" data-toggle="modal" data-target="#myModaluno"> </td>';
    $("#colbut").append(tablaData6);
    $("#coluno").append(tablaData);
   
    
    
    
   
}

// dibujar grafica 1 global
function drawMonthwiseChart(chart_data, chart_main_title)
{
    var jsonData = chart_data;
    
    var tablaData ='';
    var tablaData2 ='';
    var tablaData3 ='';
    
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

    $.each(jsonData, function(i, jsonData){
    	
        var concepto = jsonData.concepto;
        var importe = parseFloat($.trim(jsonData.importe));
        var style = jsonData.style;
        data.addRows([[concepto, importe, style]]);
        //tablaData += '<tr>';
        tablaData += '<td>'+jsonData.concepto+'</td>';
        tablaData2 += '<td>'+'$'+jsonData.importe.toFixed(2)+'</td>';
        //tablaData += '</tr>';
        //tablaData += '<tr>';
        //tablaData += '<td>'+'$'+jsonData.importe+'</td>';
        //tablaData += '</tr>';
        /////////

    });
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
      var selection = chart.getSelection()[0];
      var selectedValue = data.getValue(selection.row, 0);
      var selectedImporte = data.getValue(selection.row, 1);
    //alert('Seleccionaste el Mes:' + ' ' + selectedValue + ' ' +'con un Importe de:'+ ' ' + selectedImporte);
   
   //modal estatico dentro de las graficas
    $("#body").html(
      '<h5>Fuente: <strong>U080</strong>, importe total:'+ ' ' +'$'+ selectedImporte/4+'<h5><br>'+
      'Fuente: <strong>Estatal</strong>, importe total:'+ ' ' +'$'+ selectedImporte/4+'<br>'+
      'Fuente: <strong>Propios</strong>, importe total:'+ ' ' + '$'+selectedImporte/4+'<br>'+
      'Fuente: <strong>Fone Otros</strong>, importe total:'+ ' ' +'$'+ selectedImporte/4+'<br>');
    $("#myModal").modal();
}
}
// dibujar grafica 2 por mes
function drawMonthwiseChart2(chart_data, chart_main_title)
{
    var jsonData = chart_data;
    var tablaData ='';
    var tablaData2 ='';
    var tablaData3 ='';
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
    $.each(jsonData, function(i, jsonData){
        var concepto = jsonData.concepto;
        var importe = parseFloat($.trim(jsonData.importe));
        var style = jsonData.style;
        data.addRows([[concepto, importe, style]]);

        tablaData += '<td>'+jsonData.concepto+'</td>';
        tablaData2 += '<td>'+'$'+jsonData.importe.toFixed(2)+'</td>';


    });
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
      var selection = chart.getSelection()[0];
      var selectedValue = data.getValue(selection.row, 0);
      var selectedImporte = data.getValue(selection.row, 1);
  //  alert('Seleccionaste el Mes:' + ' ' + selectedValue + ' ' +'con un importe de:'+ ' ' + selectedImporte);
   // $("#body").html('Seleccionaste el Mes:' + ' ' + selectedValue + ' ' +'con un importe de $:'+ ' ' + selectedImporte);
   $("#myModal").modal();
    $("#body").html(
      '<h5>Fuente: <strong>U080</strong>, importe total:'+ ' ' +'$'+ selectedImporte/4+'<h5><br>'+
      'Fuente: <strong>Estatal</strong>, importe total:'+ ' ' +'$'+ selectedImporte/4+'<br>'+
      'Fuente: <strong>Propios</strong>, importe total:'+ ' ' + '$'+selectedImporte/4+'<br>'+
      'Fuente: <strong>Fone Otros</strong>, importe total:'+ ' ' +'$'+ selectedImporte/4+'<br>');
    $("#myModal").modal();
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

