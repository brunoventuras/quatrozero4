<?php 
	// require_once('classes/conecta_mysql.php'); //inclui a pagina de conexão
  // require_once('_verificar_usr.php');
 	// echo '<pre>';
 	// print_r($_GET);
 	// echo '</pre>';
?>


		<div class="panel panel-black">	
			<form method="POST" id="formCliente" style="text-align: center">

				<div class="col-md-3">
					<input type="text" name="nomeCliente" class="form-control" id="nomeCliente" placeholder="Nome do Cliente" maxlength="50" autofocus="true" required>
				</div>

				<div class="col-md-3">
					<select class="form-control tpCliente" name="tpCliente" id="tpCliente" required>
						<option disabled selected>Tipo de Cliente</option>
						<option>Comum</option>
						<option>Particular</option>
					</select>
					<!-- <input type="text" name="tpCliente" class="form-control" id="tpCliente" placeholder="Tipo de Cliente" maxlength="50" autofocus="true"> -->
				</div>

				<div class="col-md-1">	
					<input type="submit" value="Inserir" name="btnCadastrar" class="btn btn-success">
				</div>

			</form>

		</div>
		
		<div class="col-md-12 dadosBD" id="style-1">
			
		</div>


<script type="text/javascript">
	

	$('#formCliente').on('submit',function(e){
		e.preventDefault();
		var dados = $(this).serializeArray();
		if (tpCliente.value == 'Tipo de Cliente') {
			alert('Selecione o Tipo de Cliente!');
		} else {
			dados.push({name: "tipoCliente", value: tpCliente.value});			

			$.ajax({
		      type: 'POST',
		      url: 'controller.php?action=setClt',
		      data: {'dadosArr': dados},
		      cache: false,
		      success : function(data){
		          $.ajax({
		            type: 'POST',
		            url: 'oserv/cadCliente.php',
		            data: {'action':'home'},
		            cache: false,
		            success : function(data){
		              $('.page404').html(data);
		            window.location.href = data;
		              
		            }
		          });  
		      },
		      complete: function(e,status){
		       // $('#alert_status').modal("show");
		      }
		    });
		}		

	});

	$.ajax({
      type: 'POST',
      url: 'oserv/tableClientes.php',
      data: {},
      cache: false,
      success : function(data){
      	$('.dadosBD').html(data);
       // $('.modal-ap').html(data);
       
       //table.ajax.reload();
      },
      complete: function(e,status){
       // $('#alert_status').modal("show");
      }
    });

    $('.tpCliente').on('change', function(e){
	    var dados = $('.tpCliente').serializeArray();

		$.ajax({
	      type: 'POST',
	      url: 'oserv/tableClientes.php',
	      data: {'dadosArr': dados},
	      cache: false,
	      success : function(data){
	      	$('.dadosBD').html(data);
	       // $('.modal-ap').html(data);
	       
	       //table.ajax.reload();
	      },
	      complete: function(e,status){
	       // $('#alert_status').modal("show");
	      }
	    });
    });

</script>



<?php

include_once('_rodape.php');