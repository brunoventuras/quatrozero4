<?php 
// require_once('functions.php');
require('valida_sessao.php');

session_start();
$getModules = buildMenu(null, $_SESSION['perfil']);

?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />

  <title>QuatroZero4 Sistemas</title>

  <link rel="shortcut icon" href="imgs/ectsys/ico.ico?version=<?php echo $version ?>" >

  <link href="css/bootstrap-3.3.2.min_print.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/_topos.css" rel="stylesheet">

  <style>
    .navbar-new {
        position: relative;
        min-height: 50px;
        margin-bottom: 0px;
        border: 1px solid transparent;
    }

    .style42 {
      font-size: small;
      font-family: Verdana, Arial, Helvetica, sans-serif;
      color: #006699;
      font-weight: bold;
      width:960px;
      text-align:left;
      margin-top:1%;
      padding-left:0;
    }
    body{
      margin-bottom:50;

    }
    .mg-modal{
      margin-top: 30px;
    }
    .mg-icon{
      margin-right: 10px;
    }
    .hgt-menutab{
    height: 350px;
    overflow-y: scroll;
   }
    .tab-content1 > ::-webkit-scrollbar {
      width: 10px;
      margin-left: 50%;
      height: 80%
    }

    .tab-content1 > ::-webkit-scrollbar-track {
      box-shadow: inset 0 0 5px #337ab7; 
      border-radius: 10px;
       margin-left: 50%;
    }
     
    .tab-content1 > ::-webkit-scrollbar-thumb {
      background: #2A6496; 
      border-radius: 10px;
    }

    .tab-content1 > ::-webkit-scrollbar-thumb:hover {
      background: #2A6496; 
    }
    .rodape-button{
      background-color: #236DAE; 
      position: absolute;
      bottom: 0;
      margin-left: 0px;
      width: 100%;
  }
  .navbar-brand img {
    display: inline-block;
    height: 40px;
    right: 0;
    margin: 14px 20px 1px;
}


@media (max-width: 575.98px) {
.navbar-brand img {
    display: inline-block;
    height: 40px;
    right: 0;
    margin: 14px -53px 1px;
  }
}
  </style>

  <link rel="stylesheet" type="text/css" href="css/menu_style.css">
       
<div class="navbar-new" style="background-color:#FFF;font-family: 'Source Sans Pro', sans-serif; border: 0 0 1 0; margin-bottom: solid 1px;">
  <div class="menu-head" style="    margin-top: 15px; margin-left: 40px;">
    <a href="#" class="push_menu" style="margin-bottom: -20px;"><span class="glyphicon glyphicon-align-justify" style="font-size: 15pt;"></span></a>
  </div>             
  <div style="height: 60px; margin-left: 43%; margin-top: -40px;"><a href="home.php" class="navbar-brand"><img src="imgs/logo/Expert.png?version=<?php echo $version ?>" class="logo" alt=""></a>
  </div>
</div>

<div class="container" style="width: 100%">
  <div class="row">
    <div class="wrapper active">   
     <div class="side-bar">
      <ul>
          <div style="text-align: center;">
              <img src="imgs/avatar.png" alt="Avatar" class="avatar">
          </div>
          <div style="text-align: center;">
            <label style="margin-top: 10px;"><?php echo $_SESSION['login']?></label><br>
          </div>
          <hr style="color: #1E6EB5; border-color: #1E6EB5; background-color: #1E6EB5;"  />
          <div class="tab-content1">
            <div id="home" class="hgt-menutab">
              <div class="menu">
                <?php foreach($getModules as $key => $value){?>
                  <li>
                    <a href="<?php echo $value['DC_URL'] ?>"><?php echo $value['NM_MENU'];?></a>
                  </li>
                  <?php }?>
              </div> 
            </div>
          </div>                  
        </ul>
        <div class="rodape-button">
           <?php if($_SESSION['perfil'] == 3){?>
              <a data-tooltip="tooltip" title="Perfis e Permissões" data-placement="bottom" href="acesso.php" class="btn btn-link">
                <i class="fa fa-drivers-license-o" aria-hidden="true" style="font-size:25px; padding-left: 28px;"></i>
              </a>
              <a class="btn btn-xs" title="Cadastrar Usuário" data-toggle="modal" data-target="#cadastro_usuario"> 
                <i class="fa fa-user-plus" aria-hidden="true" style="font-size:22px; color: #FFF;"></i>
              </a>
            <?php }?>
            <a class="btn btn-link" title="Alterar dados" data-toggle="modal" data-target="#altera_senha">
              <i class="fa fa-address-book" aria-hidden="true" style="font-size:22px"></i>
            </a>
            <a data-tooltip="tooltip" title="Sair" data-placement="bottom" href="engenharia/_botao_logout.php" class="btn btn-link" style="">
              <i style="font-size: 23px;" class="fa fa-power-off fa-lg"></i>
            </a>
        </div>
     </div> 

<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap-3.3.2.min.js"></script>
<script type="text/javascript" src="js/_topos.js"></script>

<script>
  $(document).ready(function(){
    $(".push_menu").click(function(){
      $(".wrapper").toggleClass("active");
    });
  });    
</script>

<?php 
require_once('modal_cad_usuario.php');
require_once('modal_alterar_dados.php');
?>
<script type="text/javascript" src="js/modal_alterar_senha.js"></script>
</head>