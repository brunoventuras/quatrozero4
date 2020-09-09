<?php 

	require_once('functions.php');
  	$list = getReparo();
  // require_once('_verificar_usr.php');
 	// echo '<pre>';
 	// print_r($_GET);
 	// echo '</pre>';
?>


		<div class="panel panel-black">	
			<form method="POST" id="formReparo">

				<div class="col-md-3">
					<select class="form-control col-md-6" name="listReparos" id="listReparos">
                    <?php  foreach ($list as $key => $val) { ?>
                        <option value="<?= $key?>"><?= $val[1]?></option>
                      <?php } ?>
                    </select>
				</div>

				<div class="col-md-1">	
					<input type="hidden" name="hidden_framework" id="hidden_framework" />
					<input type="submit" value="Inserir" name="btnCadastrar" class="btn btn-success">
				</div>

			</form>

		</div>

		<div class="col-md-12 dadosBD" id="style-1">
			
		</div>



<script type="text/javascript">
	
$(document).ready(function(){


	$.ajax({
      type: 'POST',
      url: 'oserv/tableReparos.php',
      data: {},
      cache: false,
      success : function(data){
      	console.log(data);
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
