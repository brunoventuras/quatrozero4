<?php 
	require_once('classes/conecta_mysql.php'); //inclui a pagina de conexão
	require_once('functions.php');
	$mdCar = getCar(); 
	$cliente = getClt();
	$tpServ = getReparo();
 	// echo '<pre>';
 	// print_r($cliente);
 	// echo '</pre>';
?>

<style>


</style>

<html lang="pt-br">

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<!-- <link href="/your-path-to-fontawesome/css/all.css" rel="stylesheet"> <!--load all styles -->
	<!-- Bootstrap CSS -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="/fonts/FONT/css/all.css" rel="stylesheet">
	<!-- <link href="css/signin.css" rel="stylesheet"> -->
	<script src="js/jquery-3.4.1.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<title>QuatroZero4</title>
	<link rel="stylesheet" type="text/css" href="css/sis_home.css">

<div class="bkg404">
	<nav class="navbar navbar-inverse">
	    <div class="navbar-header">
<!-- 	      <a class="navbar-menu404" href="#">
	        <i class="glyphicon glyphicon-menu-hamburger"></i>
	      </a> -->
	      <a class="navbar-brand" href="#">
	        <img alt="" src="img/logo404p.png">
	      </a>
	    </div>
	</nav>
	<div class="col-md-12" id = "menu404">

	</div>
	<div class="panel page404">
		<div class="panel panel-black">	
			<form method="POST" id="formServ" style="text-align: center">

				<div class="col-md-2 tit">Data
					<input type="date" class="form-control" name="dtServ" id="dtServ" value="<?= date('Y-m-d')?>" required>
				</div>

				<div class="col-md-3 tit">Cliente
					<select class="form-control cliente" name="cliente" id="cliente" required>
						<?php  foreach ($cliente as $key => $val) { ?>
							<option value="<?= $val[0]?>"><?= $val[0]?></option>
						<?php } ?>
					</select>
				</div>

				<div class="col-md-2 tit">Veículo
					<select class="form-control mdCar" name="mdCar" id="mdCar" required>
						<?php  foreach ($mdCar as $key => $val) { ?>
							<option value="<?= $val[1]?>"><?= $val[1]?></option>
						<?php } ?>
					</select>
				</div>				

				<div class="col-md-2 tit">Serviço
					<select class="form-control tpServ" name="tpServ" id="tpServ" required>
						<?php  foreach ($tpServ as $key => $val) { ?>
							<option value="<?= $val[1]?>"><?= $val[1]?></option>
						<?php } ?>
					</select>
				</div>

				<div class="col-md-2 tit">Valor
					<input type="number" class="form-control" name="vlServ" id="vlServ" placeholder="R$" min="0.00" max="1,000,000.00" step="0.01" required>
				</div>

				<div class="col-md-1"><br>	
					<input type="submit" value="Inserir" name="btnCadastrar" id="btnCadastrar" class="btn btn-success">
				</div>

			</form>

		</div>

		<div class="col-md-12 dadosBD" id="style-1">
			
		</div>
	</div>
</div>
</div>



<script type="text/javascript">
	
	// $('#valor_servico').onkeypress(function(){
	// 	$(this).mask('#.##0,00') {reverse: true};
	// });

	$(document).on('keypress', '#vlServ', function(e) {
    // var key = (window.event)?event.keyCode:e.which;
    // //console.log('key: '+key);
    // if((key > 47 && key < 58)) {
    //     return true; 
    // }else{
    //   return (key == 8 || key == 0)?true:false;
    // }
     // $("#vlServ").maskMoney();
  });
  
  // $('#vlServ').on('keypress', function(e) {
  // 		$(this).mask('#,##0.00', {reverse: true});
  // });

$(document).ready(function(){
	$('.cliente').val('');
	$('.mdCar').val('');
	$('.tpServ').val('');

	$('.page404').css('margin-top','6.5%');
	$('#menu404').addClass('menu404');
	$.ajax({
	  type: 'POST',
	  url: 'sis_menu.php?',
	  data: {},
	  cache: false,
	  success : function(data){
	  	// console.log(data);
	  	$('.menu404').html(data);
	  },
	  complete: function(e,status){
	   // $('#alert_status').modal("show");
	  }
	});
});

	// $('.glyphicon-menu-hamburger').on('click',function(){
	// 	if ($('#menu404').hasClass('menu404')) {
	// 		console.log('fecha menu');
	// 		$('#menu404').removeClass('menu404');
	// 		$('.page404').css('margin-top','.5%');
	// 	    $('#menu404').html('');
	// 	}else{
	// 		console.log('abre menu');
	// 		$('.page404').css('margin-top','6.5%');
	// 		$('#menu404').addClass('menu404');
	// 		$.ajax({
	// 	      type: 'POST',
	// 	      url: 'sis_menu.php?',
	// 	      data: {},
	// 	      cache: false,
	// 	      success : function(data){
	// 	      	// console.log(data);
	// 	      	$('.menu404').html(data);
	// 	      },
	// 	      complete: function(e,status){
	// 	       // $('#alert_status').modal("show");
	// 	      }
	// 	    });
	// 	}
	// });

	$('#formServ').on('submit',function(e){
		e.preventDefault();
		var dados = $(this).serializeArray();
		$.ajax({
	      type: 'POST',
	      url: 'controller.php?action=setServ',
	      data: {'dadosArr': dados},
	      cache: false,
	      success : function(data){
	      	// console.log(data);
	      	// alert(data);
	      	// $('.dadosBD').html(data);
	      	window.location.reload();
	      },
	      complete: function(e,status){
	       // $('#alert_status').modal("show");
	      }
	    });
	});

	$.ajax({
      type: 'POST',
      url: 'table_gen.php',
      data: {},
      cache: false,
      success : function(data){
      	// console.log(data);
      	$('.dadosBD').html(data);
       // $('.modal-ap').html(data);
       
       //table.ajax.reload();
      },
      complete: function(e,status){
       // $('#alert_status').modal("show");
      }
    });




</script>



<?php

include_once('_rodape.php');

