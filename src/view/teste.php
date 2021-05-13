<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>

html {
    height: 100vh;
}

body {
    height: 98%;
    background-color: blue;
    display: flex;
    flex-direction: column;
    background-color: #000;
}

header {
    height: 80px;
    background-color: grey;
}

main.main {
    flex: 1;
    background-image: url("src/assets/images/robot.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    background-position:center;
}

footer {
    height: 50px;
    background-color: green;
   
}

</style>
<body>
    <header class="header">Cabeçalho</header>
    <main class="main">Main</main>
    <footer class="footer">Rodapé</footer>
</body>
</html>