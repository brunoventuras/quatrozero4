<?php 
  // require_once('connections/conecta_mysql.php'); //inclui a pagina de conexão
  require_once('../functions.php');
  // $mdCar = getCar(); 
  // $cliente = getClt();
  // $tpServ = getReparo();

?>

    <div class="panel panel-black"> 

        <div class="col-md-2 tit">Data
          <input type="date" class="form-control dtServ" name="dtServ" value="<?= date('Y-m-d')?>" required>
        </div>

        <div class="col-md-2 tit">Cliente
          <select class="form-control cliente" name="cliente" required></select>
        </div>

        <div class="col-md-2 tit">Veículo
          <select class="form-control mdCar" name="mdCar" required></select>
        </div>  

        <div class="col-md-1 tit">Placa
          <input type="text" class="form-control placa" id="placa" name="placa" placeholder="XXX0000" maxlength="7">
        </div>     
        
        <div class="col-md-2 tit">Serviço
          <select class="form-control tpServ" name="tpServ" required></select>
        </div>

        <div class="col-md-2 tit">Valor
          <input type="number" class="form-control vlServ" id="vlServ" name="vlServ" placeholder="R$" min="0.00" max="1,000,000.00" step="0.01" required>
        </div>

        <div class="col-md-1"><br>  
          <button class="btn btn-default" id="btnAdd"><i class="fas fa-plus-square"></i></button>
        </div>

    </div>

  <form method="POST" id="formServ" style="text-align: center">

     <div class="panel panel-table"> 
      <table id="table" class="table-fixed table-condensed table-responsive display border_custom"  width="100%">
        <thead class="trTab">    
          <tr class="thLineTab">
            <th>Data</th>
            <th>Cliente</th>
            <th>Veículo</th>
            <th>Placa</th>
            <th>Serviço</th>
            <th>Valor</th>
          </tr>
        </thead>
        <tbody class="servs"> 
        </tbody>

      </table>
      </div>
      <div class="panel panel-black"> 
        <div class="col-md-12 pull-right"><br>  
          <input type="submit" value="Inserir" name="btnCadastrar" id="btnCadastrar" class="btn btn-success">
        </div>
     </div>
  </form>



  <script type="text/javascript">
    var liberaInsert = false;

    $('#formServ').on('submit',function(e){
      if (liberaInsert == false) {
        
        return false;
      } else {
        e.preventDefault();
        var dados = $(this).serializeArray();

        $( ".trLineTab" ).each(function( index ) {
          var dados = {
            'dtServ'  :  $( this ).children()[6].value, 
            'cliente' :  $( this ).children()[7].value,
            'mdCar'   :  $( this ).children()[8].value,
            'placa'   :  $( this ).children()[9].value,
            'tpServ'  :  $( this ).children()[10].value,
            'vlServ'  :  $( this ).children()[11].value
          };          

          $.ajax({
            type: 'POST',
            url: '../controller.php?action=setServ',
            data: {'dadosArr': dados},
            cache: false,
            success : function(data){
                  //$('.dadosBD').html(data);
                  $.ajax({
                    type: 'POST',
                    url: 'oserv/insert_serv.php',
                    data: {'action':'home'},
                    cache: false,
                    success : function(data){
                      $('.page404').html(data);
                      window.location.href = data;
                    }
                  });                
            },
            complete: function(e,status){
                      sucesso = true;
            }
          });
        });    
        alert("Serviço inserido com sucesso.");    
      }
    });        
    
    $('#btnAdd').on('click', function(e){
      liberaInsert = true;
      e.preventDefault();
      let dtServ  = $('.dtServ').val();
      let cliente = $('.cliente').val();
      let mdCar   = $('.mdCar').val();
      let placa   = $('.placa').val();
      let tpServ  = $('.tpServ').val();
      let vlServ  = $('.vlServ').val();

      if (cliente == "") {
        alert("Selecione um Cliente");
      } else if (mdCar == "") {
        alert("Selecione um Veículo");
      } else if (tpServ == "") {
        alert("Selecione um Serviço");
      } else if (vlServ == "") {
        alert("Informe o Valor do Serviço");
        $('.vlServ').focus();
      } else {      
        let inServ = '<tr class="trLineTab"><td>'+dtServ+'</td><td>'+cliente+'</td><td>'+mdCar+'</td><td>'+placa+'</td><td>'+tpServ+'</td><td>'+vlServ+'</td><input type="hidden" value="'+dtServ+'" name="dtServ"><input type="hidden" value="'+cliente+'" name="cliente"><input type="hidden" value="'+mdCar+'" name="mdCar"><input type="hidden" value="'+placa+'" name="placa"><input type="hidden" value="'+tpServ+'" name="tpServ"><input type="hidden" value="'+vlServ+'" name="vlServ"></tr>';
        $('.servs').append(inServ);

        $('.dtServ').prop('disabled', true);
        $('.cliente').prop('disabled', true);
        $('.vlServ').prop('value', "");
        $('.vlServ').focus();
    }


    });

  $(document).ready(function(){

    populaSel('cliente',$('.cliente'));
    populaSel('servico',$('.tpServ'));
    populaSel('carro',$('.mdCar'));

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