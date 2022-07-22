<?php
session_start();
require_once('template/header_admin.php');
require_once('src/db/connection.php');

$conn = Connection::newConnection();

$data = '';
$status = 'pending';

$sql = "SELECT * FROM messages WHERE status = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $status);
$stmt->execute();
$result = $stmt->get_result();

?>

<link rel="stylesheet" href="src/assets/css/template.css" />
<link rel="stylesheet" href="src/assets/css/messages.css" />

<main class="main d-flex flex-column">

    <div class="div-content">

        <?php
            if (isset($_SESSION['messages-msg'])) {
                print_r($_SESSION['messages-msg']);
                unset($_SESSION['messages-msg']);
            }
        ?>

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
                        <th scope="col"> Mensagem </th>
                        <th scope="col"> Ação </th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if ($result->num_rows > 0) {
                        
                        while ($data = $result->fetch_assoc()) {

                    ?>

                    <tr>
                        <td style="vertical-align: middle;" class="text-truncate"> <?= $data['id'] ?> </td>
                        <td style="vertical-align: middle;" class="text-truncate"> <?= $data['email'] ?> </td>
                        <td style="vertical-align: middle;" class="text-truncate"> <?= $data['message'] ?> </td>
                        <td>
                            <a style="vertical-align: middle;" href="src/db/dao_delete_messages.php?id=<?= $data['id'] ?>" class="btn btn-danger btn-sm">Deletar</a>
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