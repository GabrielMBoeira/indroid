<?php
session_start();
require_once('template/header_home.php');
?>

<link rel="stylesheet" href="src/assets/css/template.css" />
<link rel="stylesheet" href="src/assets/css/user_register.css" />

<main class="main">
    <div class="div-content">
        <div class="container-fluid">
            <div class="row">
                <form class="form" action="src/db/dao_user_register.php" method="post">
                    <div class="header-form">
                        <label>
                            Cadastrar Usuário
                        </label>
                    </div>
                    <?php
                    if (isset($_SESSION['register_msg'])) {
                        print_r($_SESSION['register_msg']);
                        unset($_SESSION['register_msg']);
                    }
                    ?>
                    <div class="form-group">
                        <label class="label" for="email">
                            Cadastre seu email:
                        </label>
                        <input type="email" class="form-control" id="email" name="email" required />
                    </div>
                    <div class="form-group">
                        <label class="label" for="phone">
                            Cadastre seu telefone:
                        </label>
                        <input type="phone" class="form-control" id="phone" name="phone" required />
                    </div>
                    <div class="form-group">
                        <label class="label" for="password">
                            Cadastre sua senha:
                        </label>
                        <input type="password" class="form-control" id="password" name="password" required />
                    </div>
                    <div class="form-group">
                        <label class="label" for="password_cofirm">
                            Confirme sua senha:
                        </label>
                        <input type="password" class="form-control" id="password_cofirm" name="password_cofirm" required />
                    </div>

                    <div class="responsability">
                        <div class="accept">
                            <input type="checkbox" name="checkbox" required >
                            Li o termo e estou ciente
                        </div>
                        <a href="responsability" class="mt-1 text-white" name="responsability">
                            <strong class="access_term_responsability">Acessar Termo de responsabilidade</strong>
                        </a>
                    </div>
                    <div class="div-button">
                        <button type="submit" class="btn btn-primary btn-sm mt-2" name="user_register">
                            Cadastrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    $("#phone").mask("(99) 99999.9999");
</script>

<?php
require_once('template/footer_home.php');
?>