<?php 

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

  // include_once("../connections/conecta_mysql.php");
  include_once('../functions.php');
  // include_once('_topo_home.php');

  $soma      = 0;

  $printNota = $_POST['data'];
  $cliente   = $printNota[0][0];
  $carro     = $printNota[1];
  $placa     = $printNota[2];
  $servico   = $printNota[3];
  $valor     = $printNota[4];
  $data      = $printNota[5];

  $car;
  $pl;
  $serv;
  $vlr;
  $dt;
  // echo "<pre>";
  // print_r($servico);
  // echo "</pre>";

  $mes = date('m');
  switch ($mes){

	case 1: $mes = "Janeiro"; break;
	case 2: $mes = "Fevereiro"; break;
	case 3: $mes = "Março"; break;
	case 4: $mes = "Abril"; break;
	case 5: $mes = "Maio"; break;
	case 6: $mes = "Junho"; break;
	case 7: $mes = "Julho"; break;
	case 8: $mes = "Agosto"; break;
	case 9: $mes = "Setembro"; break;
	case 10: $mes = "Outubro"; break;
	case 11: $mes = "Novembro"; break;
	case 12: $mes = "Dezembro"; break;

	}


?>
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="/fonts/FONT/css/all.css" rel="stylesheet">
  <script src="js/jquery-3.4.1.js"></script>
  <script src="js/bootstrap.min.js"></script>


<meta charset="utf-8">
<div class="container" style="margin-top:100px;">
		
	<div class="panel" id="printableArea">
		<input style="float:right;margin-right:10px;"; type="button" onclick="printDiv('printableArea')" value="Imprimir" />
		<h2 style="margin-left:10px;">Cliente: <?php echo $cliente; ?></h2> 
		<table style="margin-top: 10px;" id="table" class="table"  width="100%">
		  <thead class="trTab">
		    <tr class="thLineTab">
		      <th class="col-md-2">Veiculo</th>
		      <th class="col-md-2">Placa</th>
		      <th class="col-md-2">Tipo de Serviço</th>
		      <th class="col-md-2">(R$)</th>
		      <th class="col-md-2">Data</th>
		    </tr>
		  </thead>
		  <tbody>  
		    <?php
		      foreach ($printNota[1] as $key => $value) {
		      	$car  = $carro[$key];
		      	$pl   = $placa[$key];
		      	$serv = $servico[$key];
		      	$vlr  = $valor[$key];
		      	$dt   = $data[$key];
		      	// $vlrStr = substr($vlr,2,10);
		      	$soma = $soma + (float)$vlr;
		      	$soma = number_format($soma, 2, '.', '');
			?>
		        <tr class="trLineTab">
		          <!-- <td class="col-md-1"><?= $key?></td> -->
		          <td class="col-md-2"><span class="carSalvo" id="carSalvo<?=$key?>"><?= $car?></span></td>
		          <td class="col-md-2"><span class="placaSalva" id="placaSalva<?=$key?>"><?= $pl?></span></td>
		          <td class="col-md-2"><span class="servSalvo" id="servSalvo<?=$key?>"><?= $serv?></span></td>
		          <td class="col-md-2"><span class="valor" id="valor<?= $key?>"><?= $vlr?></span></td>
		          <td class="col-md-2"><?= padrao_data($dt)?></td>
		        </tr>
			<?php   
		      }
		    ?>
		  </tbody>  
		  <tfoot>
		    <tr class="thLineTab">
		      <th class="col-md-2"></th>
		      <th class="col-md-2"></th>
		      <th class="col-md-2">(R$)</th>
		      <th class="col-md-2"><?= $soma ?></th>
		      <th class="col-md-2"></th>
		    </tr>    
		  </tfoot>
		</table>
		<div class="col-md-12" style="margin-top:50px;">
			<!-- <div style="float:right;margin-right:10px;"> -->
			<div class="col-md-6">
				<h4><span>Contratante:<br ?></span></h4>
				<span>________________________________________</span>
			</div>
			<div class="col-md-6">	
				<h4><span>Contratado:<br ?></span></h4>
				<span>________________________________________</span>
			</div>
			<div class="col-md-12" style="margin-top: 100px;text-align: center;">
				<span style="font-weight:bold;">Juiz de Fora, <?= date('d') ?> de <?= $mes ?> de <?= date('Y') ?></span>
			</div>
		</div>
	</div>

</div>


<script type="text/javascript">
	function printDiv(divName) {
         var printContents = document.getElementById(divName).innerHTML;
         var originalContents = document.body.innerHTML;
         document.body.innerHTML = printContents;
         window.print();
         document.body.innerHTML = originalContents;
    }
</script>