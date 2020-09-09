<html lang="pt-br">


  <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"> 
  <!-- <link href="/your-path-to-fontawesome/css/all.css" rel="stylesheet"> -->
  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="/fonts/FONT/css/all.css" rel="stylesheet">
  <!-- <link href="css/signin.css" rel="stylesheet"> -->
  <title>QuatroZero4</title>
  <link rel="stylesheet" type="text/css" href="css/sis_home.css">

<div class="bkg404">
  <nav class="navbar navbar-inverse">
      <div class="navbar-header">
        <a class="navbar-brand" href="home.php">
          <img alt="" src="img/logo404p.png">
        </a>
      </div>
  </nav>
  <div class="col-md-12" id = "menu404">
    <!-- Insere menu -->
  </div>
  <div class="panel page404">
    <!-- Insere body -->
  </div>
</div>
</div>



  <script src="js/jquery-3.4.1.js"></script>
  <script src="js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){

  $('.cliente').val('');
  $('.mdCar').val('');
  $('.tpServ').val('');


  $('#menu404').addClass('menu404');
  $.ajax({
    type: 'POST',
    url: '_menu.php?',
    data: {},
    cache: false,
    success : function(data){
      $('.menu404').html(data);
    },
    complete: function(e,status){
     // $('#alert_status').modal("show");
    }
  });

});
</script>