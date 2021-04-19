<?php
session_start();
require_once('template/header_home.php');
?>

<link rel="stylesheet" href="src/assets/css/template.css" />
<link rel="stylesheet" href="src/assets/css/responsability.css" />

<main class="main">
    <div class="div-content">
        <div class="container-fluid">
            <div class="row">
                <form class="form" action="src/db/dao_user_register.php" method="post">
                    <div class="header-form">
                        <label>
                            Termo de responsabilidade
                        </label>
                    </div>

                    <p class="paragraph-term">
                        Eu estou ciente de que o inDROID é um jogo de perguntas e respostas, no qual quem irá responder as questões será eu mesmo(a) dando a impressão que é a inteligencia artificial que estará respondendo.
                        <br>
                        <br>
                        Todas as perguntas feitas e respondidas serão de minha responsabilidade. Estou ciente também, que as perguntas feitas no quadro de questões NÃO ficarão armazenadas em nenhum banco de dados
                        e com isso isenta a responsabilidade desta aplicação de prestar esclarecimentos ou afins, para todo e qualquer determinado assunto.
                        <br>
                        <br>
                        Eu saliento que não irei fazer questionamento que prejudique ou irá expor meu convidado a nenhum constrangimento de qualquer natureza.
                        <br>
                        <br>
                        Ciente disto confirmo abaixo.
                    </p>

                    <a href="user_register" class="btn btn-success btn-sm">Estou ciente</a>

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