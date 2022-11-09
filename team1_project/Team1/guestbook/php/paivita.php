<?php
//Luetaan lomakkeelta tulleet tiedot funktiolla $_POST
//jos syötteet ovat olemassa
$id=isset($_POST["id"]) ? $_POST["id"] : "";
$nimi=isset($_POST["nimi"]) ? $_POST["nimi"] : "";
$arvosana=isset($_POST["arvosana"]) ? $_POST["arvosana"] : 0;

//Jos ei jompaa kumpaa tai kumpaakaan tietoa ole annettu
//ohjataan pyyntö takaisin lomakkeelle
if (empty($id) || empty($nimi) || empty($arvosana)){
    header("Location:../html/yhteysvirhe.html");
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);


try{
    $yhteys=mysqli_connect("localhost", "TRTKP21A3_1", "IFkw9SsG", "wp_TRTKP21A3_1");
}
catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}

//Tehdään sql-lause, jossa kysymysmerkeillä osoitetaan paikat
//joihin laitetaan muuttujien arvoja
$sql="update kirja set kommentti=?, arvosana=? where id=?";

//Valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'sdi', $nimi, $arvosana, $id);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Suljetaan tietokantayhteys
mysqli_close($yhteys);

header("Location:./tervetuloaadmin.php");
?>