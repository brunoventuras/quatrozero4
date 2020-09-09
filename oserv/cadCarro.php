<?php 
	// require_once('../connections/conecta_mysql.php'); //inclui a pagina de conexão
  // require_once('_verificar_usr.php');
 	// echo '<pre>';
 	// print_r($_GET);
 	// echo '</pre>';
?>



		<div class="panel panel-black">	
			<form method="POST" id="formCarro">

				<div class="col-md-3">
					<input type="text" name="modeloCarro" class="form-control" id="modeloCarro" placeholder="Modelo do Carro" maxlength="50" autofocus="true" required>
				</div>

				<div class="col-md-1">	
					<input type="submit" value="Inserir" name="btnCadastrar" class="btn btn-success">
				</div>

			</form>

		</div>

		<div class="col-md-12 dadosBD" id="style-1">
			
		</div>




<script type="text/javascript">
	


	$('#formCarro').on('submit',function(e){
		e.preventDefault();
		var dados = $(this).serializeArray();
		$.ajax({
	      type: 'POST',
	      url: 'controller.php?action=setCar',
	      data: {'dadosArr': dados},
	      cache: false,
	      success : function(data){
	          $.ajax({
	            type: 'POST',
	            url: 'oserv/cadCarro.php',
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
	});

	$.ajax({
      type: 'POST',
      url: 'oserv/tableCarros.php',
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




</script>



<?php

include_once('_rodape.php');