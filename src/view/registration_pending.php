<?php
session_start();
require_once('template/header_home.php');
?>

<link rel="stylesheet" href="src/assets/css/template.css" />
<link rel="stylesheet" href="src/assets/css/registration_pending.css" />

<main class="main">
    <div class="div-content">
        <form action="" method="post" class="form">
            <h6 class="d-flex justify-content-center align-items-center mb-4"> Cadastro efetuado com sucesso | Aguardando pagamento </h6>
            <p>
                Para concluir o cadastro é necessário efetuar o pagamento através do link mercado pago.
            </p>
            <p>
                O <strong> inDROID </strong> é um jogo de perguntas e respostas bem divertido onde o espectador ficará impressionado com o robô adivinhando todas as questões, as informações de uso serão enviadas assim que o cadastro for concluído.
            </p>
            <p class="d-flex justify-content-center align-items-center">
                Clique aqui e experimente!
            </p>
            <div class="d-flex justify-content-center align-items-center">
                <!-- INICIO DO BOTAO PAGSEGURO -->
                <a href="https://mpago.la/2bzTRGg" target="_blank" title="Pagar com mercado pago">
                    <img src="src/assets/images/mercado-pago.png" alt="Pague com mercado pago - é rápido, grátis e seguro!" />
                </a>
                <!-- FIM DO BOTAO PAGSEGURO -->
            </div>
            <p class="info-pay d-flex justify-content-center align-items-center">
                A segurança do mercado pago inclui certificação PCI.
            </p>
            <p>
                <u>Liberação de cadastro</u>
                <br>
                Pagamento com pix será liberado em instantes.
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