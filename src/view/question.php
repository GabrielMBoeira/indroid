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

        $user_id         = $user['id'];
        $user_status     = $user['status'];
        // $user_qtd_access = $user['qtd_access'];

        if ($user_status !== 'active') {
            header('location: registration_pending');
        }

        // if ($user_qtd_access >= 1 && $user_status !== 'active') {
        //     header('location: registration_pending');
        // }

        //Acrescentando quantidade de acessos users
        // setQtdAccessUser($user_id, $user_qtd_access);
    } else {
        header('location: registration_pending');
    }

} else {
    header('location: login');
}
?>

<link rel="stylesheet" href="src/assets/css/template.css" />
<link rel="stylesheet" href="src/assets/css/question.css" />

<main class="main">

    <div class="div-content">
        <div class="box-content">
            <div class="box-header">
                <p class="title-box">
                    Reverencie o inDROID para ele responder
                </p>
            </div>
            <div class="box-main">
                <form id="form">
                    <input type="hidden" id="status" name="status" value="<?= $user_status; ?>">
                    <label class="label-question mt-3">
                        <strong>Qual é a sua pergunta?</strong>
                    </label>
                    <div class="input-box mt-4">
                        <textarea name="input-question" class="input-question m-2" id="input-question" cols="80" rows="3" oninput="indroidQuestion(event)"></textarea>
                    </div>
                </form>
                <div class="button d-flex justify-content-center w-100">
                    <!-- <button type="button" class="btn btn-secondary btn-sm m-4" onclick="clearGame()">Outra pergunta</button> -->
                    <button class="btn btn-primary btn-sm m-4" id="btn-question">Perguntar</button>
                </div>
            </div>
            <div class="box-footer"></div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade modal-answer" id="answerModal" tabindex="-1" role="dialog" aria-labelledby="answerModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        <strong><i>Resposta do inDROID!!!</i></strong>
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="box-modal-body">
                        <div class="box-answer" id="box-answer"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="clearGame()">Outra pergunta</button>
                </div>
            </div>
        </div>
    </div>

</main>

<script src="src/js/question.js"></script>

<?php
require_once('template/footer.php');
?>