<?php
session_start();
require_once('template/header.php');
require_once(dirname(__FILE__, 2) . '/db/connection.php');
require_once(dirname(__FILE__, 2) . '/functions/functions.php');

// VALIDANDO SESSÃO
if (isset($_SESSION['userID'])) {

    $conn = Connection::newConnection();
    $idUser = mysqli_real_escape_string($conn, $_SESSION['userID']);
    $idUser = htmlspecialchars($idUser);

    if (getUser($idUser)) {
        $user = getUser($idUser);

        $user_email = $user['email'];
        $user_status = $user['status'];

        if ($user_status !== 'active') {
            header('location: registration_pending');
        }

    } else {
        header('location: registration_pending');
    }
    
} else {
    header('location: login');
}

?>

<link rel="stylesheet" href="src/assets/css/template.css" />
<link rel="stylesheet" href="src/assets/css/alter_password.css" />

<main class="main">
    <div class="div-content">
        <div class="container-fluid">
            <div class="row">
                <form class="form" action="src/db/dao_alter_password.php" method="post"> 
                    <input type="hidden" name="userID" value="<?= $idUser ?>">
                    <div class="header-form">
                        <label>
                            Alterar Senha
                        </label>
                    </div>
                    <?php
                    if (isset($_SESSION['alter_password-msg'])) {
                        print_r($_SESSION['alter_password-msg']);
                        unset($_SESSION['alter_password-msg']);
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
                        <button type="submit" class="btn btn-primary btn-sm mt-2" name="user_register">
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