<?php
session_start();
require_once('./src/db/connection.php');
require_once('./src/functions/functions.php');
require_once('template/header_home.php');

$conn = newConnection();

if (isset($_GET['user']) && isset($_GET['key'])) {

    $user = mysqli_real_escape_string($conn, htmlspecialchars($_GET['user']));
    $key = mysqli_real_escape_string($conn, htmlspecialchars($_GET['key']));

    !existEmail($user) ? header('location: login') : '';

    if (checkKey($user, $key)) {

        $userID = getIdUser($user);
    }
}

?>

<link rel="stylesheet" href="src/assets/css/template.css" />
<link rel="stylesheet" href="src/assets/css/alter_password.css" />

<main class="main">
    <div class="div-content">
        <div class="container-fluid">
            <div class="row">
                <form class="form" action="src/db/dao_alter_password_forgot.php" method="post">
                    <input type="hidden" name="userID" value="<?= $userID ?>">
                    <div class="header-form">
                        <label>
                            Alterar Senha
                        </label>
                    </div>
                    <?php
                    if (isset($_SESSION['alter_password-forgot-msg'])) {
                        print_r($_SESSION['alter_password-forgot-msg']);
                        unset($_SESSION['alter_password-forgot-msg']);
                    }
                    ?>
                    <div class="form-group">
                        <label class="label" for="password">
                            Nova senha:
                        </label>
                        <input type="password" class="form-control" id="password" name="password" required />
                    </div>
                    <div class="form-group">
                        <label class="label" for="password_cofirm">
                            Confirmar nova senha:
                        </label>
                        <input type="password" class="form-control" id="password_cofirm" name="password_cofirm" required />
                    </div>
                    <div class="div-button">
                        <button type="submit" class="btn btn-primary mt-2" name="user_register">
                            Salvar
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>

<?php
require_once('template/footer_home.php');
?>