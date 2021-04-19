<?php
session_start();
require_once('template/header_home.php');
?>

<link rel="stylesheet" href="src/assets/css/login.css" />

<main class="main">
   <div class="div-content">
      <div class="container-fluid">
         <div class="row row-form">
            <form class="form" action="src/db/dao_login.php" method="post">
               <?php
               if (isset($_SESSION['login_msg'])) {
                  print_r($_SESSION['login_msg']);
                  unset($_SESSION['login_msg']);
               }
               ?>
               <div class="form-group">
                  <label class="label" for="email">
                     E-mail:
                  </label>
                  <input type="email" class="form-control" id="email" name="email" required />
               </div>
               <div class="form-group">
                  <label class="label" for="password">
                     Senha:
                  </label>
                  <input type="password" class="form-control" id="password" name="password" required />
               </div>
               <div class="div-button">
                  <a type="submit" href="password_forgot" class="btn btn-success btn-sm mt-4" name="password_forgo">
                     Esqueci a senha
                  </a>
                  <button type="submit" class="btn btn-primary btn-sm mt-4" name="login">
                     Entrar
                  </button>
               </div>
            </form>
         </div>
      </div>
   </div>
   </div>
</main>

<?php
require_once('template/footer_home.php');
?>