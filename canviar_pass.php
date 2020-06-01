<?php



?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>JMCompany LDAP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="./web1.css">
<!-- HOLA GITHUB I ECLIPSE -->
</head>

<body>
    <div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>
    <form id="msform" method="post" action="pass.php">
        <fieldset>
            <h2 class="titol">Finestra per canviar la contrasenya</h2>
            <h3 class="subtitol">Recorda: </h3>
            <input type="password" name="password1" placeholder="Contrasenya" />
            <input type="password" name="password2" placeholder="Repetir Contrasenya" />
            <input type="submit" name="submit" class="submit action-button" value="Entrar" />
        </fieldset>
        <input type="checkbox" id="huma" name="huma_robot" value="huma">
		<label for="huma_robot">Marca si ets un humà</label><br>
		<input type="checkbox" id="robot" name="huma_robot" value="robot">
		<label for="huma_robot">Marca si ets un robot</label><br>
    </form>
    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
    <script src="./script.js"></script>

</body>

</html>









