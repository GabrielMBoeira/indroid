<?php
session_start();
require_once('template/header_admin.php');
require_once('src/db/connection.php');

?>

<link rel="stylesheet" href="src/assets/css/template.css" />
<link rel="stylesheet" href="src/assets/css/users.css" />

<main class="main d-flex flex-column">

    <div class="div-content">
        <div class="d-flex justify-content-center align-items-center mb-1 bg-dark text-light">
        <strong>LIBERAR USUARIO</strong>
        </div>
        <div class="search-box">
            <form action="search" method="post" class="form">
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
                    <?php

                    $conn = Connection::newConnection();

                    $sql = "SELECT * FROM login WHERE status <> 'active'";

                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                    ?>
                            <tr>
                                <td style="vertical-align: middle;" class="text-truncate"> <?= $row['id_user'] ?> </td>
                                <td style="vertical-align: middle;" class="text-truncate"> <?= $row['email'] ?> </td>
                                <td style="vertical-align: middle;" class="text-truncate"> <?= $row['phone'] ?> </td>
                                <td style="vertical-align: middle;" class="text-truncate"> <?= $row['status'] ?> </td>
                                <td style="vertical-align: middle;" class="text-truncate">
                                    <a href="../../src/db/dao_liberation.php?id= <?= $row['id_user'] ?>" class="btn btn-success" class="text-truncate">
                                        Liberar e enviar email
                                    </a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php
require_once('template/footer_admin.php');
$conn->close();
?>