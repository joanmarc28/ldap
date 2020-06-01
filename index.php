<?php
    session_start();
    session_unset();
    session_destroy();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>JMCompany LDAP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="./web1.css">

</head>

<body>
    <div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>
    <form id="msform" method="post" action="home.php">
        <fieldset>
            <h2 class="titol">Inicia Sessió</h2>
            <h3 class="subtitol">Entra i descubreix el millor de tu</h3>
            <h3 class="subtitol">Recorda introduir nomes el cn i la Contrsenya</h3>
            <input type="text" name="cn" placeholder="CN" />
            <input type="password" name="pass" placeholder="Contrasenya" />
            <input type="submit" name="submit" class="submit action-button" value="Entrar" />
        </fieldset>
    </form>
    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>

</body>

</html>
