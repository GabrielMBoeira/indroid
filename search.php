<?php
session_start();
require_once('template/header_admin.php');
require_once('src/db/connection.php');

$conn = newConnection($env);

$email = mysqli_real_escape_string($conn, trim($_POST['email']));
$phone = mysqli_real_escape_string($conn, trim($_POST['phone']));

if ($email === '' || $phone === '') {

    $data['id_user'] = 'Vazio';
    $data['email'] = 'Vazio';
    $data['phone'] = 'Vazio';
    $data['status'] = 'Vazio';
}

if (isset($email)) {

    $sql = "SELECT * FROM login WHERE email = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    }
}

if (isset($phone)) {

    $sql = "SELECT * FROM login WHERE phone = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    }
}

$conn->close();
?>

<link rel="stylesheet" href="src/assets/css/template.css" />
<link rel="stylesheet" href="src/assets/css/search.css" />

<main class="main d-flex flex-column">

    <div class="div-content">
        <div class="search-box">
            <form action="users" method="post" class="form">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="email">
                            <strong>E-mail</strong>
                        </label>
                        <input type="text" class="form-control inputs" name="email">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone">
                            <strong>Telefone</strong>
                        </label>
                        <input type="text" class="form-control inputs" name="phone">
                    </div>

                    <div class="btn-content">
                        <button class="btn btn-outline-primary" name="search">Pesquisar</button>
                    </div>
                </div>
            </form>
        </div>
        <br>
        <div class="table table-responsive-lg">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col"> ID </th>
                        <th scope="col"> Email </th>
                        <th scope="col"> Telefone </th>
                        <th scope="col"> Status </th>
                        <th scope="col"> Ação </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="vertical-align: middle;" class="text-truncate"> <?= $data['id_user'] ?> </td>
                        <td style="vertical-align: middle;" class="text-truncate"> <?= $data['email'] ?> </td>
                        <td style="vertical-align: middle;" class="text-truncate"> <?= $data['phone'] ?> </td>
                        <td style="vertical-align: middle;" class="text-truncate"> <?= $data['status'] ?> </td>
                        <td style="vertical-align: middle;" class="text-truncate">
                            <a href="../../src/db/dao_liberation.php?id= <?= $data['id_user'] ?>" class="btn btn-success" class="text-truncate">
                                Liberar
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php
require_once('template/footer_admin.php');
?>