<?php if ( !defined('URL_BASE')) exit; ?>
<section class="main">
  <div class="sidebar">
    <h3>Home</h3>
    <a href="#" class="sidebar-active">home</a>
    <a href="<?php echo URL_BASE ?>moviments">moviment</a>
    <a href="<?php echo URL_BASE ?>reports">reports</a>
    <a href="<?php echo URL_BASE ?>users">users</a>
    <br>
    <hr>
  </div>

  <div class="content">
    <div class="title-secao">
      <h2>Cash balance</h2>
      <hr>
      <p>Valores</p>
    </div>

    <div class="box">
      <div style="background: linear-gradient(45deg, #ff5370, #ff869a)" class="box-single">
        <div class="single-text">
          <h3>Entrada / R$
          <?php 
            $entrada_total = 0;
            foreach($data['inp_out'] AS $input_output){
              $entrada_total += $input_output['input'];
            }
            echo $entrada_total;
          ?>
          </h3>
        </div>
      </div>
      <div style="background: linear-gradient(45deg, #4099ff, #73b4ff)" class="box-single">
        <div class="single-text">
          <h3>Saída / R$<?php
           $saida_total = 0;
           foreach($data['inp_out'] AS $input_output){
            $saida_total += $input_output['output'];
            }
            echo $saida_total;
          ?></h3>
        </div>
      </div>
      <div style="background: linear-gradient(45deg, #2ed8b6, #59e0c5)" class="box-single">
        <div class="single-text">
          <h3>Total / R$<?php echo $data['cash_balance']?></h3>
        </div>
      </div>
    </div>
    <div id="chart-div" style="border-radius: 10px; margin-top: 10px; width: 100%; height: 500px;"></div>
  </div><!--content-->
</section><!--main-->

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data','Entrada', 'Saída'],
            <?php
            foreach($data['inp_out'] AS $inp_out){
              $data = $inp_out['date'];
              $entrada = $inp_out['input'];
              $saida = $inp_out['output'];
              echo "['$data', $entrada, $saida],";
            }
            ?>
        ]);

        var options = {
          title: 'Gastos e Lucros',
          hAxis: {title: 'Data',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart-div'));
        chart.draw(data, options);
      }
    </script>
  <style>
    html,body{height:100%;}
    .main{
      display:flex;
      flex-wrap:wrap;
      height:100%;
    }
    .sidebar{
      width:20%;
      background-color: white;
      height:100%;
    }
    .sidebar h3{
      color: #333;
      font-size: 20px;
      margin: 10px;
    }
    .sidebar a{
      display: block;
      text-decoration: none;
      padding: 10px 15px;
      color: #444;

    }
    .sidebar a:hover{
      border-left: 5px solid #73b4ff;
      background-color: rgb(245,245,245);
      color: #777;
      font-weight: bold;
    }


    .sidebar a.sidebar-active{
      border-left: 5px solid #73b4ff;
      background-color: rgb(245,245,245);
      color: #777;
      font-weight: bold;

    }
    .content{
      width:80%;
      background-color: rgb(245,245,245);
      padding: 20px;
    }
    .title-secao{
      background-color: white;
      padding: 10px;
      border-radius: 15px;

    }
    .title-secao h2{
      margin-top: 10px;
      font-size: 30px;
      background-image: linear-gradient(#001fff, #8406d6);
      background-clip:text;
      -webkit-background-clip: text;
      color:black;
    }
    .title-secao p{
      font-size: 18px;
    }

    .box{
      display: flex;
      width: 100%;
      margin-top: 20px;
      justify-content: space-between; 
    }
    .box-single{
      display: flex;
      justify-content: space-between;
      border-radius: 10px;
      width: 100%;
      margin: 0 10px;
      padding: 30px;
    }
    .box-single h3{
      color: white;
    }
  </style>