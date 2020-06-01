<?php
//error_reporting(E_ALL);
//ini_set("display_errors",1);
    session_start();
    foreach($_POST as $campo => $valor){
        //echo "<br />- ". $campo ." = ". $valor;
        $_POST[$campo] = filter_var($_POST[$campo], FILTER_SANITIZE_STRING);
    }

    $errors =0;

    if(isset($_POST["submit"]) && !empty($_POST["submit"])) {
        if($_POST['cn'] == null){
            $errors++;
            $cadenaretorn .= '<span class="error">No has ficat cap cn</span><br>';
        }
        if($_POST['pass'] == null){
            $errors++;
            $cadenaretorn .= '<span class="error">No has ficat cap Contrasenya</span><br>';
        }
    }

    if(isset($_SESSION["usuari_valid"])){
        $user = $_SESSION["usuari_valid"]['cn'];
        $pass = $_SESSION["usuari_valid"]['pass'];
    }else{
        $user = $_POST['cn'];
        $pass = $_POST['pass'];
    }

    if($errors == 0){
        $basedn = "dc=daw2joanmarc,dc=com";
        $ad = ldap_connect("ldap://daw2joanmarc.com:389") or die("No se pudo conectar al servidor LDAP.");

        // Autenticar contra el servidor LDAP
        ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);
        if (ldap_bind($ad, "cn={$user},{$basedn}", $pass)) {

            $array = ["cn" => $user, "pass" => $pass];
            $_SESSION["usuari_valid"] = $array;
            $botopass = "<a class='home' href='canviar_pass.php'> Canviar la Contrasenya </a>";
            // En caso de exit, agafem les dades del usuari
            $result = ldap_search($ad, $basedn, "(cn={$user})");
            $entries = ldap_get_entries($ad, $result);

            if ($entries["count"]>0) {
                $informacio.= "<table>";
                foreach($entries[0] as $campo => $valor){
                    $informacio.= "<tr>";
                    if(!is_numeric($campo) && $campo != "count") {
                        if(is_array( $valor)){ 
                            $informacio.= "<td>".ucwords($campo)."</td><td>". $valor[0]."</td>";
                        }else{
                            $informacio.= "<td>".ucwords($campo)."</td><td>". $valor."</td>";
                        }
                    }
                    $informacio.= "</tr>";
                }
                $informacio.= "</table>";
                $msg = "<p class='aqua'>Conectat com {$entries[0]['givenname'][0]} {$entries[0]['sn'][0]}</p>";

            }else {
                $msg = "<p class='error'>Error desconegut</p>";
            }
        }
        else {
            // Si falla la autenticación, retornar error
                $msg = "<p class='error'>Usuari i/o contrasenya incorrecta</p>";
        }
        //Sempre tanco la conexió
        ldap_close($ad);
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
            <h2 class="titol">Web JMCompany (Versió BETA)</h2>

            <?php
                echo "<p>".$cadenaretorn."</p>" ;
            ?>
            <div class="taula">
                <?php
                    echo $msg;
                    echo $informacio;
                ?>
            </div>
            <div class="buttons">
                <a class="home" href="index.php">Torna a index </a>
                <?php
                    echo $botopass;
                ?> 
            </div>
            </fieldset>
        </section>
    </main>
</body>

</html>