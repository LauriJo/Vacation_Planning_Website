<?php

 //Alla oleva php-ohjelma ottaa ensin session k�ytt��n lauseella session_start();
 //Sessioita k�ytett�ess� t�m�n lauseen pit�� olla ihan ensimm�isen�.
 //Sitten ohjelma saa edell� olevalta lomakkeelta sy�tteena k�ytt�j�tiedot JSON-muotoisena merkkijonona avaimella 'user',
 //joka luetaan t�ss� muuttujaan $json. JSON-merkkijono muutetaan php-olioksi aliohjelmassa tarkistaJson.

session_start();
$json=isset($_POST["user"]) ? $_POST["user"] : "";

if (!($user=tarkistaJson($json))){
    print "Fill all fields";
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try{
    $yhteys=mysqli_connect("localhost", "TRTKP21A3_1", "IFkw9SsG", "wp_TRTKP21A3_1");
}
catch(Exception $e){
    print "Yhteysvirhe";
    exit;
}

//Tehd��n sql-lause, jossa kysymysmerkeillä osoitetaan paikat
//joihin laitetaan muuttujien arvoja
$sql="select * from users where tunnus=? and salasana=SHA2(?, 256)";
try{
    //Valmistellaan sql-lause
    $stmt=mysqli_prepare($yhteys, $sql);
    //Sijoitetaan muuttujat oikeisiin paikkoihin
    mysqli_stmt_bind_param($stmt, 'ss', $user->tunnus, $user->salasana);
    //Suoritetaan sql-lause
    mysqli_stmt_execute($stmt);
    //Koska luetaan prepared statementilla, tulos haetaan
    //metodilla mysqli_stmt_get_result($stmt);
    $tulos=mysqli_stmt_get_result($stmt);
    if ($rivi=mysqli_fetch_object($tulos)){
        $_SESSION["kayttaja"]="$rivi->tunnus";
        print "ok";
        exit;
    }
    //Suljetaan tietokantayhteys
    mysqli_close($yhteys);
    print $json;
}
catch(Exception $e){
    print "Jokin virhe!";
}
?>


<?php
function tarkistaJson($json){
    if (empty($json)){
        return false;
    }
    $user=json_decode($json, false);
    if (empty($user->tunnus) || empty($user->salasana)){
        return false;
    }
    return $user;
}

?>