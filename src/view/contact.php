<?php
session_start();
require_once('template/header_home.php');
?>

<link rel="stylesheet" href="src/assets/css/template.css" />
<link rel="stylesheet" href="src/assets/css/contact.css" />

<main class="main">
    <div class="div-content">
        <div class="container-fluid">
            <?php
            if (isset($_SESSION['contact_msg'])) {
                print_r($_SESSION['contact_msg']);
                unset($_SESSION['contact_msg']);
            }
            ?>
            <div class="row">
                <div class="col-md-6 local-contact">
                    <h4>Localização</h4>
                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d113157.28894550656!2d-48.547653!3d-27.588405!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95273817bc3c85ad%3A0x93f9cf04bbb0cc22!2sAv.%20Trompowsky%20-%20Centro%2C%20Florian%C3%B3polis%20-%20SC%2C%2088010-400!5e0!3m2!1spt-BR!2sbr!4v1617211835668!5m2!1spt-BR!2sbr" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <div class="adress mt-1">
                        <i>
                            Rua: Av. Trompowsky, 354
                            <br>
                            Bairro: Centro
                            <br>
                            Cidade: Florianópolis
                            <br>
                            Santa Catarina / Brasil
                            <br>
                            E-mail: indroidbot@gmail.com
                        </i>
                    </div>
                </div>
                <div class="col-md-6 form-contact">

                    <form action="src/db/dao_contact.php" method="post">
                        <div class="content-form-contact">
                            <h4>Contato:</h4>
                            <p>
                                Entre em contato caso haja alguma dúvida sobre a utlização da aplicação ou qualquer outro assunto que desejar saber.
                                Estaremos retornando assim que vizualizarmos a mensagem.
                                <br>
                                Estamos à disposição. Obrigado
                            </p>
                            <div class="form-group">
                                <label class="label" for="email">
                                    <i>Informe seu email:</i>
                                </label>
                                <input type="email" class="form-control col-md-8" id="email" name="email" value="" required />
                            </div>
                            <div class="form-group">
                                <label class="label" for="phone">
                                    <i>Mensagem:</i>
                                </label>
                                <textarea name="message" class="form-control" cols="30" rows="2"  maxlength="300" required></textarea>
                            </div>
                            <div class="form-group d-flex justify-content-center">
                                <button class="btn btn-primary btn-sm">Enviar</button>
                            </div>
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