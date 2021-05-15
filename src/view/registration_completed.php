<?php
session_start();
isset($_SESSION['userID']) ? '' : header('location: home');
require_once('template/header_home.php');
?>

<link rel="stylesheet" href="src/assets/css/template.css" />
<link rel="stylesheet" href="src/assets/css/registration_completed.css" />

<main class="main">
    <div class="div-content">
        <form action="" method="post" class="form">
            <h6 class="d-flex justify-content-center align-items-center mb-4"> Cadastro efetuado com sucesso | Aguardando pagamento </h6>
            <p>
                Para concluir o cadastro é necessário efetuar o pagamento através do link do mercado pago.
            </p>
            <p>
                O <strong> inDROID </strong> é um jogo de perguntas e respostas bem divertido onde o espectador ficará impressionado com o robô adivinhando todas as questões.
                Quem irá responder as questões será você mesmo dando a impressão de que o robô está adivinhando tudo... Seus amigos ficarão impressionados!!!
            </p>
            <p class="d-flex justify-content-center align-items-center">
                Conclua o cadastro e experimente!
            </p>
            <div class="d-flex justify-content-center align-items-center">
                <!-- INICIO DO BOTAO MercadoPago -->
                <a href="https://mpago.la/1SeeAmD" target="_blank" title="Pagar com mercado pago">
                    <img src="src/assets/images/mercado-pago.png" alt="Pague com mercado pago - é rápido, grátis e seguro!" />
                </a>
                <!-- FIM DO BOTAO MercadoPago -->
            </div>
            <p class="info-pay d-flex justify-content-center align-items-center">
                A segurança do mercado pago inclui certificação PCI.
            </p>
            <p>
                <u>Liberação de cadastro</u>
                <br>
                Pagamento com pix 01 (um) dia útil.
                <br>
                Pagamento com cartão ou boleto 03 (três) dias úteis.
                <br>
            </p>
            <p class="info-pay">
                O MercadoPago: É uma empresa que disponibiliza meios de pagamentos online,
                uma das empresas líder no mercado brasileiro e utiliza diversos protocolos de
                segurança para manter as informações pessoais seguras onde o vendedor não terá acesso a dados financeiros.
            </p>
        </form>
    </div>
</main>

<script>
    $("#phone").mask("(99) 99999.9999");
</script>

<?php
require_once('template/footer_home.php');
?>