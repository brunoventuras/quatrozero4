<?php 

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

  include_once("../connections/conecta_mysql.php");
  require_once('../functions.php');

  $soma   = 0;
  $somaPG = 0;

  $boletos   = getVencimento();
  // echo "<pre>";
  // print_r($boletos);
  // echo "</pre>";


?>
<!--   <script src="js/jquery-3.4.1.js"></script>
  <script src="js/bootstrap.min.js"></script> -->
<div class="panel panel-table2" >
  <table id="table" class="table-fixed table-condensed  table-responsive display border_custom"  width="100%">
    <thead class="trTab">    
      <tr class="thLineTab">
        <!-- <th class="col-md-1">#</th> -->
        <th class="col-md-3">Descrição</th>
        <th class="col-md-3">Vencimento</th>
        <th class="col-md-3">(R$)</th>
        <th class="col-md-3">Visualizar</th>        
      </tr>
    </thead>
    <tbody>  
      <?php 
        foreach ($boletos as $key => $value) {
          $soma = $soma + $value[3];
          $soma = number_format($soma, 2, '.', '');
       ?>     
          <tr class="trLineTab">
            <!-- <td class="col-md-1"><?= $key?></td> -->            
            <td class="col-md-3"><span class="cltSalvo" id="cltSalvo<?=$key?>"><?= $value[1]?></span></td>
            <td class="col-md-3"><span class="data" id="data<?=$key?>"><?= padrao_data($value[2])?></span></td>
            <td class="col-md-3"><span class="valor" id="valor<?= $key?>"><?= number_format($value[3], 2, '.', '') ?></span></td>
            <td class="col-md-3" style="text-align: center">
              <button class="btn btn-warning btnBoleto" data-info="<?=  $key?>"><i class="glyphicon glyphicon-barcode"></i></button>
          </tr>
       <?php   
        }
      ?>
    </tbody>  
    <tfoot>
      <tr class="thLineTab">
        <th class="col-md-3"></th>
        <th class="col-md-3">(R$)</th>
        <th class="col-md-3"><?= $soma ?></th>
        <th class="col-md-3"></th>
      </tr>    
    </tfoot>
  </table>
</div>

<div class="modal" tabindex="-1" role="dialog">

</div>

<script>

  $('.btnBoleto').on('click', function(){
    // console.log('ok');
    $.ajax({
        type: 'POST',
        url: 'financeiro_modal.php',
        data: { },
        cache: false,
        success : function(data){
          // console.log(data);
              $('.modal').html(data);
              $('.modal').modal('show');
        },
        complete: function(e,status){
         // $('#alert_status').modal("show");
        }
      });
  })

</script>