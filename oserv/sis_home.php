<?php 
  require_once("../connections/conectar.php"); //inclui a pagina de conexão
  require_once('../functions.php');

  $dtIn = dataInicio();

  // echo '<pre>';
  // print_r($dtIn);
  // echo '</pre>';
?>

<div class="panel panel-black"> 
      <form method="POST" id="formFilter">

        <div class="col-md-2 tit">De:
          <input type="date" class="form-control dtServIni" name="dtServIni" value="<?= $dtIn?>" required>
        </div>

        <div class="col-md-2 tit">Até:
          <input type="date" class="form-control" name="dtServFim" id="dtServFim" value="<?= date('Y-m-d')?>" required>
        </div>

        <div class="col-md-3 tit">Cliente
          <select class="form-control cliente" name="cliente"></select>
        </div>

        <div class="col-md-2 tit">Veículo
          <select class="form-control mdCar" name="mdCar" ></select>
        </div>       
        
        <div class="col-md-2 tit">Serviço
          <select class="form-control tpServ" name="tpServ" ></select>
        </div>

        <div class="col-md-1"><br>  
          <input type="submit" value="Filtrar" name="btnFiltrar" id="btnFiltrar" class="btn btn-success">
        </div>
      </form>

    </div>


		<div class="col-md-12 dadosBD" id="style-1">
			
		</div>





<script type="text/javascript">

  $(document).ready(function(){

    populaSel('cliente',$('.cliente'));
    populaSel('servico',$('.tpServ'));
    populaSel('carro',$('.mdCar'));

  });

  $.ajax({
    type: 'POST',
    url: 'oserv/tableGen.php?filtro=false',
    data: {},
    cache: false,
    success : function(data){
      $('.dadosBD').html(data);
    }
  });


  $('#formFilter').on('submit',function(e){
      e.preventDefault();
      var dados = $(this).serializeArray();
      $.ajax({
        type: 'POST',
        url: 'oserv/tableGen.php?filtro=true',
        data: {'dadosArr': dados},
        cache: false,
        success : function(data){
        	console.log(dados);
              $('.dadosBD').html(data);
        },
        complete: function(e,status){
         // $('#alert_status').modal("show");
        }
      });
  });



  function populaSel(act,tag){

    $.ajax({
      type: 'POST',
      url: 'auxiliares/getDadosSel.php',
      data: {act:act},
      cache: false,
      success : function(data){
        tag.html(data);
        tag.val('');
      }
    });

  }




</script>



