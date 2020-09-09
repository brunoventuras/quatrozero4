<?php 

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

  require_once('../functions.php');

  $soma   = 0;
  $somaPG = 0;
  // $printNota = false;
  if ($_GET['filtro'] == 'true'){
  	// $printNota = true;
    $servico   = fillServ($_POST['dadosArr'][0]['value'],$_POST['dadosArr'][1]['value'],$_POST['dadosArr'][2]['value'],$_POST['dadosArr'][3]['value'],$_POST['dadosArr'][4]['value']); 

  } else {
    $servico   = getServ();
  }
  // echo "<pre>";
  // print_r($servico);
  // echo "</pre>";


?>
<div class="panel panel-table2" >
	<table id="table" class="table-fixed table-condensed  table-responsive display border_custom"  width="100%">
	  <thead class="trTab">    
	    <tr class="thLineTab">
	      <!-- <th class="col-md-1">#</th> -->
	      <th class="col-md-1">Data</th>
	      <th class="col-md-3">Nome do Cliente</th>
	      <th class="col-md-3">Veiculo</th>
	      <th class="col-md-1">Placa</th>
	      <th class="col-md-2">Tipo de Serviço</th>
	      <th class="col-md-1">(R$)</th>
	      <th class="col-md-1">Editar</th>
	      <th class="col-md-1">
	        <button class="btn btn-danger btnDel" id="btnDel" data-info="delServ">
	          <i class="glyphicon glyphicon-trash"></i>
	        </button>
	      </th>
	      <th class="col-md-1">
	        <button class="btn btn-primary btnPago" id="btnPago" data-info="pgServ">
	          <i class="glyphicon glyphicon-usd"></i>
	        </button>
	      </th>
	      <th class="col-md-1">
	        <button class="btn btn-success btnNota" name="btnNota" id="btnNota" data-info="printNota">
	          <i class="glyphicon glyphicon-list-alt"></i>
	        </button>
	      </th>
	    </tr>
	  </thead>
	  <tbody>  
	    <?php 
	      foreach ($servico as $key => $value) {
	      	$soma = $soma + $value[5];
	      	$soma = number_format($soma, 2, '.', '');
	     ?>     
	        <tr class="trLineTab">
	          <td class="col-md-1">
              <span class="data" id="data<?=$key?>"><?= padrao_data($value[1])?></span>
            </td>
	          <td class="col-md-3">
              <span class="cltSalvo" id="cltSalvo<?=$key?>"><?= $value[2]?></span>
	            <div><select class="form-control selectClt" name="selectClt<?= $key?>" id="selectClt<?= $key?>"></select></div>
	          </td>
	          <td class="col-md-3">
              <span class="carSalvo" id="carSalvo<?=$key?>"><?= $value[3]?></span>
	            <div><select class="form-control selectCar" name="selectCar<?= $key?>" id="selectCar<?= $key?>"></select></div>
	          </td>
	          <td class="col-md-1">
              <span class="placaSalva" id="placaSalva<?=$key?>"><?= $value[6]?></span>
	            <div><input name="placa<?= $key?>" id="placa<?= $key?>" class="col-md-8 placa form-control" value="<?= $value[6]?>" maxlength="7"></div>
	          </td>
	          <td class="col-md-2">
              <span class="servSalvo" id="servSalvo<?=$key?>"><?= $value[4]?></span>
	            <div><select class="form-control selectServ" name="selectServ<?= $key?>" id="selectServ<?= $key?>"></select></div>
	          </td>
	          <td class="col-md-2">
              <span class="valor" id="valor<?= $key?>"><?= $value[5]?></span>
	            <div><input name="inputValor<?= $key?>" id="inputValor<?= $key?>" class="col-md-7 inputValor form-control" value="<?= $value[5]?>"></div>
	          </td>
	          <td class="col-md-1" style="text-align: center">
	            <button class="btn btn-warning btnEdit" id="btnEdit<?= $key?>" data-info="<?=  $key?>"><i class="glyphicon glyphicon-pencil"></i></button>
	            <div>
	              <button type="button" class="btn btn-primary btnSave" id="btnSave<?= $key?>" data-info="<?=  $key?>">
	                <i class="glyphicon glyphicon-floppy-disk"></i>
	              </button>
	            </div>
	          </td>
	          <td class="col-md-1" style="text-align: center">
	            <input type="checkbox" class="deletar" name="deletar<?= $key?>" value="<?= $key?>" id="<?= $key?>" data-info="<?= $key?>">
	          </td>
	          <td class="col-md-1" style="text-align: center">
	            <input type="checkbox" class="pagar" name="pagar<?= $key?>" value="<?= $key?>" id="<?= $key?>" data-info="<?= $key?>">
	          </td>
	          <td class="col-md-1" style="text-align: center">
	            <input type="checkbox" class="printNota" name="printNota<?= $key?>" value="<?= $key?>" id="<?= $key?>" data-info="<?= $key?>">
	          </td>
	        </tr>
	     <?php   
	      }
	    ?>
	  </tbody>  
	  <tfoot>
	    <tr class="thLineTab">
	      <th class="col-md-1"></th>
	      <th class="col-md-1"></th>
	      <th class="col-md-3"></th>
	      <th class="col-md-3"></th>
	      <th class="col-md-2">(R$)</th>
	      <th class="col-md-1"><?= $soma ?></th>
        <th class="col-md-1"></th>
	      <th class="col-md-1"></th>
	      <th class="col-md-1"></th>
	      <th class="col-md-1"></th>
	    </tr>    
	  </tfoot>
	</table>
</div>

<script>
  var deletar    = [];
  var pagar      = [];

  var printNota  = [];
  var printClt   = [];
  var printCar   = [];
  var printPlaca = [];
  var printServ  = [];
  var printValor = [];
  var printData  = [];

  // if (printNota == true){
  //   // $('.btnNota').prop('disabled', false);
  // } else {
  //   // $('.btnNota').prop('disabled', true);
  // }

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
      var idCltSalvo   = "cltSalvo".concat(nId);
      var idSelectCar  = "selectCar".concat(nId);
      var idCarSalvo   = "carSalvo".concat(nId);
      var idPlaca      = "placa".concat(nId);
      var idPlacaSalva = "placaSalva".concat(nId);
      var idSelectServ = "selectServ".concat(nId);
      var idServSalvo  = "servSalvo".concat(nId);
      var idInputValor = "inputValor".concat(nId);
      var idValor      = "valor".concat(nId);

      var btnDel    = document.getElementById(idDel);
      var btnSave   = document.getElementById(idSave);
      var btnCancel = document.getElementById(idCancel);
      var btnPago   = document.getElementById(idPago);

      var selectClt  = document.getElementById(idSelectClt);
      var cltSalvo   = document.getElementById(idCltSalvo);
      var selectCar  = document.getElementById(idSelectCar);
      var carSalvo   = document.getElementById(idCarSalvo);
      var placa      = document.getElementById(idPlaca);
      var placaSalva = document.getElementById(idPlacaSalva);
      var selectServ = document.getElementById(idSelectServ);
      var servSalvo  = document.getElementById(idServSalvo);
      var inputValor = document.getElementById(idInputValor);
      var valor      = document.getElementById(idValor);

      $(this).hide();
      $(btnDel).hide();
      $(cltSalvo).hide();
      $(carSalvo).hide();
      $(placaSalva).hide();
      $(servSalvo).hide();
      $(valor).hide();
      
      $('.btnEdit').prop('disabled', true);
      $('.btnDel').prop('disabled', true);
      $('.btnPago').prop('disabled', true);

      $(btnCancel).show();
      $(btnSave).show();
      $(selectClt).show();
      $(selectClt).val( $('option:contains("'+cltSalvo.textContent+'")').val() );
      $(selectCar).show();
      $(selectCar).val( $('option:contains("'+carSalvo.textContent+'")').val() );
      $(placa).show();
      $(selectServ).show();
      $(selectServ).val( $('option:contains("'+servSalvo.textContent+'")').val() );
      $(inputValor).show();
      $(inputValor).select();
  });

  $('.btnSave').on('click',function(){
    var conf = confirm("Deseja realmente alterar?");
    if (conf) {
	  var idSave = this.id;
	  var nId    = idSave.substr(7);

      var idSelectClt  = "selectClt".concat(nId);
      var idSelectCar  = "selectCar".concat(nId);
      var idPlaca      = "placa".concat(nId);
      var idSelectServ = "selectServ".concat(nId);
      var idInputValor = "inputValor".concat(nId);

      var selectClt  = document.getElementById(idSelectClt);
      var selectCar  = document.getElementById(idSelectCar);
      var placa      = document.getElementById(idPlaca);
      var selectServ = document.getElementById(idSelectServ);
      var inputValor = document.getElementById(idInputValor);

	    var valor = inputValor.value;
	    valor = valor.replace(',', '.');
	    inputValor.value = valor;

	    var dados = $(selectClt).serializeArray();
	    dados.push({name: "carro", value: selectCar.value});
	    dados.push({name: "placa", value: placa.value});
	    dados.push({name: "serv", value: selectServ.value});
	    dados.push({name: "valor", value: inputValor.value});
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
    $('.cltSalvo').show();
    $('.carSalvo').show();
    $('.placaSalva').show();
    $('.servSalvo').show();
    $('.valor').show();

    $('.btnEdit').prop('disabled', false);
    $('.btnDel').prop('disabled', false);
    $('.btnPago').prop('disabled', false);
  });

  $('.deletar').on('click', function(){

    if ($(this).is(':checked')) {
      deletar.push(this.id);
    } else {
      deletar.splice(deletar.indexOf(this.id), 1);
    }
  });

  $('.btnDel').on('click',function(){
    if(deletar.length == 0) {
      alert("Nenhum serviço selecionado");
    } else {
      var conf = confirm("Deseja realmente excluir?");
      if (conf) {
        $.ajax({
          type: 'POST',
          url: 'controller.php',
          data: {action:"delServ",delServ:deletar.toString()},
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
    } 

  });

  $('.pagar').on('click', function(){

    if ($(this).is(':checked')) {
      pagar.push(this.id);
    } else {
      pagar.splice(pagar.indexOf(this.id), 1);
    }
  });

  $('.btnPago').on('click',function(){
    if(pagar.length == 0) {
      alert("Nenhum serviço selecionado");
    } else {
      var conf = confirm("Confirmar pagamento?");
      if (conf) {
        $.ajax({
          type: 'POST',
          url: 'controller.php',
          data: {action:"pgServ",pgServ:pagar.toString()},
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
    }     
  });

  $('.printNota').on('click', function(){
    var clt     = "cltSalvo".concat(this.id);
    var cliente = document.getElementById(clt);
    var car     = "carSalvo".concat(this.id);
    var carro   = document.getElementById(car);
    var pl      = "placaSalva".concat(this.id);
    var placa   = document.getElementById(pl);
    var serv    = "servSalvo".concat(this.id);
    var servico = document.getElementById(serv);
    var vlr     = "valor".concat(this.id);
    var valor   = document.getElementById(vlr);
    var dt      = "data".concat(this.id);
    var data    = document.getElementById(dt);



    if ($(this).is(':checked')) {
      if ((printClt.length > 0) && (printClt.indexOf(cliente.textContent) == -1)) {
        alert("Selecione 1 cliente por vez");
        $(this).prop("checked", false);
      } else {  
        printClt.push(cliente.textContent);
        printCar.push(carro.textContent);
        printPlaca.push(placa.textContent);
        printServ.push(servico.textContent);
        printValor.push(valor.textContent);
        printData.push(data.textContent);
      }
    } else {
      printClt.splice(printClt.indexOf(cliente.textContent), 1);
      printCar.splice(printCar.indexOf(carro.textContent), 1);
      printPlaca.splice(printPlaca.indexOf(placa.textContent), 1);
      printServ.splice(printServ.indexOf(servico.textContent), 1);
      printValor.splice(printValor.indexOf(valor.textContent), 1);
      printData.splice(printData.indexOf(data.textContent), 1);
    }
  });

  $('.btnNota').on('click',function(){

    if (printClt.length == 0) {
      alert("Selecione ao menos 1 cliente");
    } else {
      printNota = [];
      var printCltDist   = [...new Set(printClt)];

      printNota.push(printCltDist);
      printNota.push(printCar);
      printNota.push(printPlaca);
      printNota.push(printServ);
      printNota.push(printValor);
      printNota.push(printData);

      var sendData = function() {
      $.post('oserv/printNota.php', {
        data: printNota
      }, function(response) {
			var w = window.open('about:blank', 'Nota de Serviços');
			w.document.write(response);
		    w.document.close();
         });
      }
      sendData();
    }
  });




  $(document).ready(function(){

    populaSel('cliente',$('.selectClt'));
    populaSel('servico',$('.selectServ'));
    populaSel('carro',$('.selectCar'));

  });


  function populaSel(act,tag){

    $.ajax({
      type: 'POST',
      url: '../auxiliares/getDadosSel.php',
      data: {act:act},
      cache: false,
      success : function(data){
        tag.html(data);
        tag.val('');
      }
    });

  }

</script>