<?php
require_once(dirname(__FILE__, 2) . '/api/mercadopago.php');

if (isset($_REQUEST['data_id'])) {

    $id_collection = $_REQUEST['data_id'];
    mercadoPagoNotificationPayment($id_collection);

} else {
    die('Requisição não mapeada');
}
