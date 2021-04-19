<?php
session_start();
require_once('template/header_home.php');

require_once('src/db/connection.php');
require_once('src/functions/functions.php');
require_once('src/PHPmailer/actionsEmails/sendForgotEmail.php');


$conn = newConnection();

if (isset($_POST['password_forgot'])) {

    $email = mysqli_real_escape_string($conn, trim($_POST['email']));


    if (existEmail($email)) {

        // GERANDO CHAVE PARA ALTERAÇÃO DE SENHA
        $hash = newKeyAccess($email);

        // ENVIANDO EMAIL DE RECUPERAÇÃO DE SENHA
        sendForgotEmail($email, $hash);

        $_SESSION['alter_password-msg'] =  "<div class='alert alert-success' role='alert'>Email de recuperação enviado! <a href='login' class='alert-link'>Login!</a></div>";
        // header('location: ../../password_forgot');
    } else {

        $_SESSION['alter_password-msg'] =  "<div class='alert alert-danger mb-3' role='alert'> Email não cadastrado! </div>";
        // header('location: ../../password_forgot');
    }

    $conn->close();
}


?>

<link rel="stylesheet" href="src/assets/css/template.css" />
<link rel="stylesheet" href="src/assets/css/password_forgot.css" />

<main class="main">
    <div class="div-content">
        <div class="container-fluid">
            <div class="row row-form">
                <form class="form" action="#" method="post">
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