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
                Para concluir o cadastro é necessário efetuar o pagamento através do link PagSeguro.
            </p>
            <p>
                O <strong> inDROID </strong> é um jogo de perguntas e respostas bem divertido onde o espectador ficará impressionado com o robô adivinhando todas as questões.
            </p>
            <p class="d-flex justify-content-center align-items-center">
                Conclua o cadastro e experimente!
            </p>
            <div class="d-flex justify-content-center align-items-center">
                <!-- INICIO DO BOTAO PAGSEGURO -->
                <a href="https://pag.ae/7WWBFCAM6/button" target="_blank" title="Pagar com PagSeguro">
                    <img src="//assets.pagseguro.com.br/ps-integration-assets/botoes/pagamentos/205x30-pagar-laranja.gif" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
                </a>
                <!-- FIM DO BOTAO PAGSEGURO -->
            </div>
            <p class="info-pay d-flex justify-content-center align-items-center">
                A segurança do PagSeguro inclui certificação PCI.
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
                O PagSeguro: É uma empresa que disponibiliza meios de pagamentos online,
                sendo líder no mercado brasileiro. Pertence ao grupo UOL e utiliza diversos protocolos de
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