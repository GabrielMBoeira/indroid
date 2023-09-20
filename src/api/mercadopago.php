<?php
require_once(dirname(__FILE__, 3) . '/vendor/autoload.php');
require_once(dirname(__FILE__, 2) . '/db/connection.php');

function mercadoPagoBuilderPayment($cliente_email, $external_reference, $val_amount)
{

    $envPath = realpath(dirname(__FILE__, 3) . '/.env');
    $env = parse_ini_file($envPath);
    $access_token = $env['ACCESS_TOKEN'];

    MercadoPago\SDK::setAccessToken($access_token);

    // Payment PIX
    $payment = new MercadoPago\Payment();
    $payment->transaction_amount = (float) $val_amount;
    $payment->payer = array(
        "email" => $cliente_email
    );

    $payment->payment_method_id = "pix";
    $payment->external_reference = (int) $external_reference;
    $payment->save();

    // // PIX
    // $copia_e_cola = $payment->point_of_interaction->transaction_data->qr_code;
    // $ticket_url = $payment->point_of_interaction->transaction_data->ticket_url;
    // $img_qr_code = 'data:image/png;base64, ' . $payment->point_of_interaction->transaction_data->qr_code_base64;

    return $payment;
}

function mercadoPagoNotificationPayment($id_collection)
{
    $envPath = realpath(dirname(__FILE__, 3) . '/.env');
    $env = parse_ini_file($envPath);
    $access_token = $env['ACCESS_TOKEN'];

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.mercadopago.com/v1/payments/' . $id_collection,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $access_token
        )
    ));

    $payment_json = curl_exec($curl);
    curl_close($curl);

    $payment_info = json_decode($payment_json);
    $payment_id = $payment_info->id;
    $status = $payment_info->status;
    $payment_info = json_encode($payment_info);

    $conn = Connection::newConnection();
    $sql = "INSERT INTO mercadopago (payment_id, status, payment_info) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iss', $payment_id, $status, $payment_info);
    $stmt->execute();
    $conn->close();

    if ($status == "approved") {

        $conn = Connection::newConnection();
        
        $sql = "select u.email 
                  from users u 
                  join mercadopago m 
                    on m.payment_id = u.payment_id 
                  where m.status = 'approved'
                    and u.status = 'pending'";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $emails = $stmt->get_result();

        while($email = $emails->fetch_assoc()) {

            $sql = "UPDATE users u
                        SET u.status = 'active'
                    WHERE u.email = ?
            ";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $email['email']);
            $stmt->execute();
        }

        $conn->close();
    }
}
