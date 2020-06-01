<?php
session_start();
//error_reporting(E_ALL);
//ini_set("display_errors",1);
foreach($_POST as $campo => $valor){
        //echo "<br />- ". $campo ." = ". $valor;
        $_POST[$campo] = filter_var($_POST[$campo], FILTER_SANITIZE_STRING);
}

$errors =0;
if(isset($_SESSION["usuari_valid"])){
    $user = filter_var($_SESSION["usuari_valid"]['cn'], FILTER_SANITIZE_STRING);
    $pass = filter_var($_SESSION["usuari_valid"]['pass'], FILTER_SANITIZE_STRING);
}else{
    $errors++;
    $cadenaretorn .= '<span class="error">No has iniciat Sessió ves a index</span><br>';
}
    
if(isset($_POST["submit"]) && !empty($_POST["submit"])) {
	if($_POST['huma_robot'] == "robot"){
		$errors++;
		$cadenaretorn .= '<span class="error">No pots ser un Robot</span><br>';
	}
	
    if($_POST['password1'] == null || $_POST['password2'] == null){
        $errors++;
        $cadenaretorn .= '<span class="error">No has ficat cap cn</span><br>';
    }else if($_POST['password1'] != $_POST['password2']){
        $errors++;
        $cadenaretorn .= '<span class="error">La contrasenya es Diferent torna enrera</span><br>';
    }

    if($errors == 0){
        $basedn = "dc=daw2joanmarc,dc=com";
        $ad = ldap_connect("ldap://daw2joanmarc.com:389") or die("No se pudo conectar al servidor LDAP.");

        // Autenticar contra el servidor LDAP
        ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);
        $ldapconn =ldap_bind($ad, "cn={$user},{$basedn}", $pass);

        if ($ldapconn) {

            //if(ldap_mod_replace($ldapconn, "cn={$user},{$basedn}", array('userpassword' => "{MD5}".base64_encode(pack("H*",md5($_POST['password1'])))))){ 
            $info['userPassword'] = "{MD5}".base64_encode(pack("H*",md5($_POST['password1'])));
            if (ldap_mod_replace($ad, "cn={$user},{$basedn}", $info)){
                $msg .= "<p class='aqua'>S'ha canviat correctement la contrasenya</p>";
            } else { 
                $msg .= "<p class='error'>Error: No s'ha canviat la contrasenya</p>";
            }

        }else {
            // Si falla la autenticación, retornar error
             $msg .= "<p class='error'>Usuari i/o contrasenya incorrecta torna a index </p>";
        }
        //Sempre tanco la conexió
        ldap_close($ad);
    }
}
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
    <main>
        <section id="principal">
            <h2 class="titol">Inicia Sessió</h2>

            <?php
                echo "<p>".$cadenaretorn."</p>" ;
            ?>
            <div class="taula">
                <?php
                    echo $msg;
                ?>
            </div>
            <div class="buttons">
                <a class="home" href="index.php">Torna a index </a>
            </div>
            </fieldset>
        </section>
    </main>
</body>

</html>