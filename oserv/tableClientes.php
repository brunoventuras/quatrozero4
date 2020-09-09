<?php 
  // error_reporting(E_ALL);
  // ini_set('display_errors', 'On');

  require_once('../functions.php');
  
  if (isset($_POST['dadosArr'][0]['value'])){
    $cliente = fillClt($_POST['dadosArr'][0]['value']);
  } else {
    $cliente = getClt();
  }  
 
?>
<div class="panel panel-table2" id="style-1">
<table id="table" class="table-fixed table-condensed  table-responsive display border_custom"  width="100%">
  <thead class="trTab">    
    <tr class="thLineTab">
      <th class="col-md-1">#</th>
      <th class="col-md-3">Nome do Cliente</th>
      <th class="col-md-3">Tipo de Cliente</th>
      <th class="col-md-1">Editar</th>
      <th class="col-md-1">Excluir</th>
    </tr>
  </thead>
  <tbody>  
    <?php 
      foreach ($cliente as $key => $value) {
     ?>     
        <tr class="trLineTab">
          <td class="col-md-1"><?= $key?></td>
          <td class="col-md-2"><span class="cliente" id="cliente<?= $key?>"><?= $value[0]?></span>
            <div>
              <input name="inputNome<?= $key?>" id="inputNome<?= $key?>" class="col-md-7 inputNome form-control" value="<?= $value[0]?>">
            </div>
          </td>
          <td class="col-md-4">
            <span class="tipoSalvo" id="tipoSalvo<?= $key?>"><?= $value[1]?></span>
            <div>
              <select name="tipoClt<?= $key?>" id="tipoClt<?= $key?>" class="col-md-4 tipoClt form-control" value="<?= $value[1]?>">
        				<option>Comum</option>
        				<option>Particular</option>
              </select>
            </div>
          </td>
          <td class="col-md-1">
          	<button class="btn btn-warning btnEdit" id="btnEdit<?= $key?>" data-info="<?=  $key?>"><i class="glyphicon glyphicon-pencil"></i></button>
            <div>
              <button type="button" class="btn btn-primary btnSave" id="btnSave<?= $key?>" data-info="<?=  $key?>"><i class="glyphicon glyphicon-floppy-disk"></i></button>
            </div>
          </td>
          <td class="col-md-1">
            <button class="btn btn-danger btnDel" id="btnDel<?= $key?>" data-info="<?= $key?>"><i class="glyphicon glyphicon-trash"></i></button>
            <div>
              <button type="button" class="btn btn-danger btnCancel" id="btnCancel<?= $key?>" data-info="<?=  $key?>"><i class="glyphicon glyphicon-remove"></i></button>
            </div>
          </td>
        </tr>
     <?php   
      }
    ?>
  </tbody>
</table>
</div>
<script>	
  $('.btnSave').hide();
  $('.btnCancel').hide();
  $('.inputNome').hide();
  $('.tipoClt').hide();

  $('.btnEdit').on('click',function(){
      var idEdit      = this.id;
      var nId         = idEdit.substr(7);
      var idDel       = "btnDel".concat(nId);
      var idSave      = "btnSave".concat(nId);
      var idCancel    = "btnCancel".concat(nId);
      var idCliente   = "cliente".concat(nId);
      var idInputNome = "inputNome".concat(nId);
      var idTipoSalvo = "tipoSalvo".concat(nId);
      var idTipoClt   = "tipoClt".concat(nId);

      var btnDel    = document.getElementById(idDel);
      var btnSave   = document.getElementById(idSave);
      var btnCancel = document.getElementById(idCancel);
      var cliente   = document.getElementById(idCliente);
      var inputNome = document.getElementById(idInputNome);
      var tipoSalvo = document.getElementById(idTipoSalvo);
      var tipoClt   = document.getElementById(idTipoClt);
      
      $(this).hide();
      $(btnDel).hide();
      $(cliente).hide();
      $(tipoSalvo).hide();

      $('.btnEdit').prop('disabled', true);
      $('.btnDel').prop('disabled', true);

      $(btnCancel).show();
      $(btnSave).show();
      $('#'+idTipoClt).show();
      $('#'+idTipoClt).val( $('option:contains("'+tipoSalvo.textContent+'")').val() );
      $(inputNome).show();
      $(inputNome).select();
  });

  $('.btnSave').on('click',function(){
    var conf = confirm("Deseja realmente alterar?");
    if (conf) {
      var idSave      = this.id;
      var nId         = idSave.substr(7);
      var idInputNome = "inputNome".concat(nId);
      var inputNome   = document.getElementById(idInputNome);
      var idTipoClt = "tipoClt".concat(nId);
      var tipoClt   = document.getElementById(idTipoClt);

      var dados = $(inputNome).serializeArray();
      dados.push({name: "tipo", value: tipoClt.value});
      dados.push({name: "id", value: nId});
       $.ajax({
          type: 'POST',
          url: 'controller.php?action=editClt',
          data: {'dadosArr': dados},
          cache: false,
          success : function(data){
            let rota = 'oserv/cadCliente.php';
            let action = 'home';
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
          }
         });
    } else {
      $('.btnCancel').hide();
      $('.inputNome').hide();
      $('.tipoClt').hide();
      $('.btnSave').hide();

      $('.btnEdit').show();
      $('.btnDel').show();
      $('.cliente').show();

      $('.btnEdit').prop('disabled', false);
      $('.btnDel').prop('disabled', false);
    }
  });

  $('.btnCancel').on('click',function(){
    $(this).hide();
    $('.inputNome').hide();
    $('.tipoClt').hide();
    $('.btnSave').hide();

    $('.btnEdit').show();
    $('.btnDel').show();
    $('.cliente').show();
    $('.tipoSalvo').show();
    $('.btnEdit').prop('disabled', false);
    $('.btnDel').prop('disabled', false);
  });

  $('.btnDel').on('click',function(){
    var conf = confirm("Deseja realmente excluir?");
    if (conf) {
      $.ajax({
        type: 'POST',
        url: 'controller.php',
        data: {action:"delClt",delClt:$(this).attr('data-info')},
        cache: false,
        success : function(data){
          let rota = 'oserv/cadCliente.php';
          let action = 'home';
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
        }

      });
    }
  });
</script>