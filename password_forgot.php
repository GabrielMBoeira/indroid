<?php
session_start();
require_once('template/header_home.php');
?>

<link rel="stylesheet" href="src/assets/css/template.css" />
<link rel="stylesheet" href="src/assets/css/password_forgot.css" />

<main class="main">
    <div class="div-content">
        <div class="container-fluid">
            <div class="row row-form">
                <form class="form" action="src/db/dao_password_forgot.php" method="post">
                    <?php
                    if (isset($_SESSION['alter_password-msg'])) {
                        print_r($_SESSION['alter_password-msg']);
                        unset($_SESSION['alter_password-msg']);
                    }
                    ?>
                    <div class="form-group title-recovery">
                        <label class="label">
                            RECUPERAÇÃO DE SENHA
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="label" for="email">
                            E-mail:
                        </label>
                        <input type="email" class="form-control" name="email" autocomplete="off" required />
                    </div>
                    <div class="div-button">
                        <button type="submit" class="btn btn-primary btn-sm mt-4" name="password_forgot">
                            Enviar solicitação
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