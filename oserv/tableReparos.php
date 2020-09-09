<?php 


  require_once('../functions.php');
  $reparo = getReparo();
 
?>
<div class="panel panel-table2" id="style-1">
<table id="table" class="table-fixed table-condensed table-responsive display border_custom"  width="100%">
  <thead class="trTab">    
    <tr class="thLineTab">
      <th class="col-md-1">#</th>
      <th class="col-md-3">Serviço</th>
      <th class="col-md-1">Editar</th>
      <th class="col-md-1">Excluir</th>
    </tr>
  </thead>
  <tbody>  
    <?php 
      foreach ($reparo as $key => $value) {
     ?>     
        <tr class="trLineTab">
          <td class="col-md-1"><?= $key?></td>
          <td class="col-md-4"><span class="reparo" id="reparo<?= $key?>"><?= $value[0]?></span>
            <div>
              <input name="inputReparo<?= $key?>" id="inputReparo<?= $key?>" class="col-md-4 inputReparo form-control" value="<?= $value[0]?>">
            </div>
          </td>
          <td class="col-md-1"><button class="btn btn-warning btnEdit" id="btnEdit<?= $key?>" data-info="<?=  $key?>"><i class="glyphicon glyphicon-pencil"></i></button>
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
  $('.inputReparo').hide();

  $('.btnEdit').on('click',function(){
      var idEdit        = this.id;
      var nId           = idEdit.substr(7);
      var idDel         = "btnDel".concat(nId);
      var idSave        = "btnSave".concat(nId);
      var idCancel      = "btnCancel".concat(nId);      
      var idInputReparo = "inputReparo".concat(nId);     
      var idReparo      = "reparo".concat(nId);

      var btnDel      = document.getElementById(idDel);
      var btnSave     = document.getElementById(idSave);
      var btnCancel   = document.getElementById(idCancel);
      var inputReparo = document.getElementById(idInputReparo);
      var reparo      = document.getElementById(idReparo);

      $(this).hide();
      $(btnDel).hide();
      $(reparo).hide();
      
      $('.btnEdit').prop('disabled', true);
      $('.btnDel').prop('disabled', true);

      $(btnCancel).show();
      $(btnSave).show();
      $(inputReparo).show();
      $(inputReparo).select();
  });

  $('.btnSave').on('click',function(){
    var conf = confirm("Deseja realmente alterar?");
    if (conf) {
      var idSave     = this.id;
      var nId        = idSave.substr(7);
      var idInputReparo = "inputReparo".concat(nId);
      var inputReparo   = document.getElementById(idInputReparo);

      var dados = $(inputReparo).serializeArray();
      dados.push({name: "id", value: nId});
       $.ajax({
          type: 'POST',
          url: 'controller.php?action=editReparo',
          data: {'dadosArr': dados},
          cache: false,
          success : function(data){
            let rota = 'oserv/cadReparos.php';
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
      $('.inputReparo').hide();
      $('.btnSave').hide();

      $('.btnEdit').show();
      $('.btnDel').show();
      $('.reparo').show();

      $('.btnEdit').prop('disabled', false);
      $('.btnDel').prop('disabled', false);
    }
  });

  $('.btnCancel').on('click',function(){
    $(this).hide();
    $('.inputReparo').hide();
    $('.btnSave').hide();

    $('.btnEdit').show();
    $('.btnDel').show();
    $('.reparo').show();

    $('.btnEdit').prop('disabled', false);
    $('.btnDel').prop('disabled', false);
  });

  $('.btnDel').on('click',function(){
    var conf = confirm("Deseja realmente excluir?");
    if (conf) {
      $.ajax({
        type: 'POST',
        url: 'controller.php',
        data: {action:"delReparo",delReparo:$(this).attr('data-info')},
        cache: false,
        success : function(data){
          let rota = 'oserv/cadReparos.php';
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