<?php 

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

  require_once('../functions.php');

  $soma   = 0;
  $somaPG = 0;
  if ($_GET['filtro'] == 'true'){    
    $servicoPG = fillServPG($_POST['dadosArr'][0]['value'],$_POST['dadosArr'][1]['value'],$_POST['dadosArr'][2]['value'],$_POST['dadosArr'][3]['value'],$_POST['dadosArr'][4]['value']);

  } else {
    $servicoPG = getServPG();
  }
  // echo "<pre>";
  // print_r($servico);
  // echo "</pre>";


?>

<!-- ORDENS PAGAS -->
  
<div class="panel panel-table2">
  <table>
    <thead class="trTab"><br/>
      <tr class="thLineTab">
<!--         <th class="col-md-1">#</th> -->
        <th class="col-md-1">Data</th>
        <th class="col-md-3">Nome Cliente</th>
        <th class="col-md-3">Veiculo</th>
        <th class="col-md-1">Placa</th>
        <th class="col-md-2">Tipo Serviço</th>
        <th class="col-md-1">(R$)</th>
        <th class="col-md-1"></th>
        <th class="col-md-1">Data PG</th>
        <th class="col-md-1"></th>
      </tr>    
    </thead>
  </table>
  <table>
    <tbody>  
      <?php 
        foreach ($servicoPG as $key => $value) {
          $somaPG = $somaPG + $value[6];
          $somaPG = number_format($somaPG, 2, '.', '');
       ?>     
          <tr class="trLineTab">
<!--             <td class="col-md-1"><?= $key?></td> -->
            <td class="col-md-1"><?= padrao_data($value[1])?></td>
            <td class="col-md-3"><?= $value[2]?></td>
            <td class="col-md-3"><?= $value[3]?></td>
            <td class="col-md-1"><?= $value[4]?></td>
            <td class="col-md-2"><?= $value[5]?></td>
            <td class="col-md-1"><span class="valor" id="valor<?= $key?>"><?= $value[6]?></span></td>
            <td class="col-md-1"></td>
            <td class="col-md-1"><?= padrao_data($value[7])?></td>
            <td class="col-md-1"></td>
          </tr>
       <?php   
        }
      ?>    
    </tbody>
  </table>
  <table>
    <tfoot>
      <tr class="thLineTab">
<!--         <th class="col-md-1"></th> -->
        <th class="col-md-1"></th>
        <th class="col-md-3"></th>
        <th class="col-md-3"></th>
        <th class="col-md-2"></th>
        <th class="col-md-2">(R$)</th>
        <th class="col-md-1"><?= $somaPG?></th>
        <th class="col-md-1"></th>
        <th class="col-md-1"></th>
        <th class="col-md-1"></th>
      </tr>
    </tfoot>
  </table>
</div>

<script>
  $('.btnSave').hide();
  $('.btnCancel').hide();
  $('.selectClt').hide();
  $('.placa').hide();
  $('.selectCar').hide();
  $('.selectServ').hide();
  $('.inputValor').hide();

  $('.btnEdit').prop('disabled', false);

  $('.btnEdit').on('click',function(){
      var idEdit   = this.id;
      var nId      = idEdit.substr(7);
      var idDel    = "btnDel".concat(nId);
      var idSave   = "btnSave".concat(nId);
      var idCancel = "btnCancel".concat(nId);      
      var idPago   = "btnPago".concat(nId);

      var idSelectClt  = "selectClt".concat(nId);
      var idSelectCar  = "selectCar".concat(nId);
      var idPlaca      = "placa".concat(nId);
      var idPlacaSalva = "placaSalva".concat(nId);
      var idSelectServ = "selectServ".concat(nId);
      var idInputValor = "inputValor".concat(nId);
      var idValor      = "valor".concat(nId);

      var btnDel    = document.getElementById(idDel);
      var btnSave   = document.getElementById(idSave);
      var btnCancel = document.getElementById(idCancel);
      var btnPago   = document.getElementById(idPago);

      var selectClt  = document.getElementById(idSelectClt);
      var selectCar  = document.getElementById(idSelectCar);
      var placa      = document.getElementById(idPlaca);
      var placaSalva = document.getElementById(idPlacaSalva);
      var selectServ = document.getElementById(idSelectServ);
      var inputValor = document.getElementById(idInputValor);
      var valor      = document.getElementById(idValor);

      $(this).hide();
      $(btnDel).hide();
      $(placaSalva).hide();
      $(valor).hide();
      
      $('.btnEdit').prop('disabled', true);
      $('.btnDel').prop('disabled', true);
      $('.btnPago').prop('disabled', true);

      $(btnCancel).show();
      $(btnSave).show();
      $(placa).show();
      $(inputValor).show();
      $(inputValor).select();
  });

  $('.btnSave').on('click',function(){
    var conf = confirm("Deseja realmente alterar?");
    if (conf) {
	    var idSave = this.id;
	    var nId    = idSave.substr(7);

	    var idInputClt   = "inputClt".concat(nId);
	    var idInputCar   = "inputCar".concat(nId);
	    var idPlaca      = "placa".concat(nId);
	    var idInputServ  = "inputServ".concat(nId);
	    var idInputValor = "inputValor".concat(nId);

	    var inputClt   = document.getElementById(idInputClt);
	    var inputCar   = document.getElementById(idInputCar);
	    var placa      = document.getElementById(idPlaca);
	    var inputServ  = document.getElementById(idInputServ);
	    var inputValor = document.getElementById(idInputValor);

	    var valor = inputValor.value;
	    valor = valor.replace(',', '.');
	    inputValor.value = valor;

	    var dados = $(inputValor).serializeArray();
	    dados.push({name: "placa", value: placa.value});
	    dados.push({name: "id", value: nId});

		$.ajax({
			type: 'POST',
			url: 'controller.php?action=editServ',
			data: {'dadosArr': dados},
			cache: false,
			success : function(data){
			$.ajax({
				type: 'POST',
				url: 'oserv/sis_home.php',
				data: {'dadosArr':dados},
				cache: false,
				success : function(data){
					$('.page404').html(data);
					window.location.href = data;
				  
				}
			});   

		},
		complete: function(e,status){
		}
		});

  	} else {
    	$('.btnCancel').hide();
    	$('.selectClt').hide();
    	$('.selectCar').hide();
    	$('.placa').hide();
    	$('.selectServ').hide();
    	$('.inputValor').hide();
    	$('.btnSave').hide();

    	$('.btnEdit').show();
      $('.btnDel').show();
    	$('.placaSalva').show();
    	$('.valor').show();

    	$('.btnEdit').prop('disabled', false);
    	$('.btnDel').prop('disabled', false);
    	$('.btnPago').prop('disabled', false);
  	}	    
  });
    
  $('.btnCancel').on('click',function(){
    $(this).hide();
    $('.selectClt').hide();
    $('.selectCar').hide();
    $('.placa').hide();
    $('.selectServ').hide();
    $('.inputValor').hide();
    $('.btnSave').hide();

    $('.btnEdit').show();
    $('.btnDel').show();
    $('.placaSalva').show();
    $('.valor').show();

    $('.btnEdit').prop('disabled', false);
    $('.btnDel').prop('disabled', false);
    $('.btnPago').prop('disabled', false);
  });

  $('.btnDel').on('click',function(){
    var conf = confirm("Deseja realmente excluir?");
    if (conf) {
      $.ajax({
        type: 'POST',
        url: 'controller.php',
        data: {action:"delServ",delServ:$(this).attr('data-info')},
        cache: false,
        success : function(data){

          dados = $('.dtServIni').serializeArray();
          $.ajax({
            type: 'POST',
            url: 'oserv/sis_home.php',
            data: {'dadosArr':dados},
            cache: false,
            success : function(data){
              $('.page404').html(data);
            window.location.href = data;
              
            }
          });   

        }

      });
    }

  });

  $('.btnPago').on('click',function(){
    var conf = confirm("Confirmar pagamento?");
    if (conf) {
      var idPago = this.id;
      var nId    = idPago.substr(7);

      var dados = [];
      dados.push({name: "id", value: nId});
      $.ajax({
        type: 'POST',
        url: 'controller.php?action=pgServ',
        data: {'dadosArr': dados},
        cache: false,
        success : function(data){
          dados = $('.dtServIni').serializeArray();
          console.log(dados);
          $.ajax({
            type: 'POST',
            url: 'oserv/sis_home.php',
            data: {'dadosArr':dados},
            cache: false,
            success : function(data){
              $('.page404').html(data);
            window.location.href = data;
              
            }
          });
        },
        complete: function(e,status){
        }
      });
    } else {
      //window.location.reload();
    }     
  });



</script>