<?php 
	require_once('functions.php');

  $boleto = getVencimento();
// echo "<pre>";
// print_r($boleto);
// echo "</pre>";
  
?>
<center>
	<div class="col-md-12 menu404-group">
  
  <!-- <?php if (isset($boleto)) { ?> -->
			
		<div class="col-md-12 btn404-def" data-info="home">		
				<div class="col-md-12 btn404-min">
					<i class="glyphicon glyphicon-home"></i>
				</div>
				<div class="col-md-12 hide">
					<span style="font-size:16px!important;">Home</span>
				</div>
		</div>

		<div class="col-md-12 btn404-def inServ" data-info="inServ">		
				<div class="col-md-12 btn404-min">
					<i class="fas fa-plus-square"></i>
				</div>
				<div class="col-md-12 hide" >
					<span style="font-size:16px!important;">Inserir</span>
				</div>
		</div>

		<div class="col-md-12 btn404-def" data-info="cdCar">		
				<div class="col-md-12 btn404-min">
					<i class="fas fa-car"></i>
				</div>
				<div class="col-md-12 hide">
					<span style="font-size:16px!important;">Carros</span>
				</div>
		</div>

		<div class="col-md-12 btn404-def" data-info="cdClt">		
				<div class="col-md-12 btn404-min">
					<i class="glyphicon glyphicon-user"></i>
				</div>
				<div class="col-md-12 hide">
					<span style="font-size:16px!important;">Clientes</span>
				</div>
		</div>

		<div class="col-md-12 btn404-def" data-info="cdTpServ">		
				<div class="col-md-12 btn404-min">
					<i class="glyphicon glyphicon-wrench"></i>
				</div>
				<div class="col-md-12 hide">
					<span style="font-size:16px!important;">Serviços</span>
				</div>
		</div>

		<div class="col-md-12 btn404-def" data-info="cdOrdensPagas">		
				<div class="col-md-12 btn404-min">
					<i class="glyphicon glyphicon-usd"></i>
				</div>
				<div class="col-md-12 hide">
					<span style="font-size:16px!important;">Ordens Pagas</span>
				</div>
		</div>

  <!-- <?php } ?> -->

<!--     <div class="col-md-12 btn404-def" data-info="financeiro">   
        <div class="col-md-12 btn404-min">
          <i class="glyphicon glyphicon glyphicon-barcode"></i>
        </div>
        <div class="col-md-12 hide">
          <span style="font-size:16px!important;">Financeiro</span>
        </div>
    </div> -->

		<div class="col-md-12 btn404-def" data-info="sair">		
				<div class="col-md-12 btn404-min">
					<i class="glyphicon glyphicon glyphicon-off"></i>
				</div>
				<div class="col-md-12 hide">
					<span style="font-size:16px!important;">Sair</span>
				</div>
		</div>

	</div>
</center>

<script type="text/javascript">
	
	$('.btn404-def').on('click',function(){
		let rota = 'controller.php';
		let action = 'home';
		switch($(this).attr('data-info')){
			case 'home':
				rota ='oserv/sis_home.php';
				break;
			case 'inServ':
				rota ='oserv/insert_serv.php';
				break;
			case 'cdCar':
				rota ='oserv/cadCarro.php';
				break;
			case 'cdClt':
				rota ='oserv/cadCliente.php';
				break;
			case 'cdTpServ':
				rota ='oserv/cadReparos.php';
				break;
			case 'cdOrdensPagas':
				rota ='oserv/ordensPagas.php';
				break;
      case 'financeiro':
        rota ='oserv/financeiro.php';
        action = 'fin';
        break;
			case 'sair':
				rota ='controller.php';
				action = 'sair';
				break;
		}

		$.ajax({
	      type: 'POST',
	      url: rota,
	      data: {'action':action},
	      cache: false,
	      success : function(data){
	      	$('.page404').html(data);
				window.location.href = data;
	      	
	      }
	    });
	});	

	$(document).ready(function(){
		// if (<?= $boleto ?>) {
      $.ajax({
  	      type: 'POST',
  	      url: 'oserv/sis_home.php',
  	      data: {},
  	      cache: false,
  	      success : function(data){
  	      	$('.page404').html(data);
  				window.location.href = data;
  	      	
  	      }
  	    });
      // }
	});

</script>
<?php
