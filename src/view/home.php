<?php
session_start();
session_unset();
session_destroy();

require_once('template/header_home.php');
?>

<link rel="stylesheet" href="src/assets/css/home.css" />

<main class="main">
   <div class="main-content">

      <h1 class=" mt-5 ">
         <strong>
            <i> inDROID </i>
         </strong>
      </h1>

      <h6>
         <i> Inteligência Artificial </i>
      </h6>

      <p style="display:none"><span class="text-slider-items">Surpreenda seus amigos,Divirta-se,Impressione,O Robô mais inteligente da web</span></p>
      <div class="mt-5">
         <h3 class="text-slider-tag">
            <strong class="text-slider"></strong>
         </h3>
      </div>
      <div class="mt-5 text-call">
         <strong><i>Experimente e impressione seu amigos!</i></strong>
      </div>
      <div class="mt-5">
         <a href="user_register" class="btn btn-primary"> Cadastrar </a>
      </div>
   </div>
</main>

<script src="src/js/slider-items.js"></script>

<?php
require_once('template/footer_home.php');
?>