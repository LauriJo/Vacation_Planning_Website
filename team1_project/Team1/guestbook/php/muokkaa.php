<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Guestbook">
    <meta name="keywords" content="HTML, CSS">
    <meta name="author" content="Miika Koivisto">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Guestbook</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#" >Traveling Guide</a>
         
          <div class="navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../../../Team1/index.html">Home</a>
              </li>
	    </ul>
          </div>
        </div>
      </nav>






<?php

$muokattava=isset($_GET["muokattava"]) ? $_GET["muokattava"] : ""; //Haetaan arvot kohteelle "muokattava" Get komennolla //

//Jos käyttäjältä ei ole saatu tietoa niin palataan takaisin kohteeseen tervetuloaadmin.php //
if (empty($muokattava)){
    header("Location:./tervetuloaadmin.php");
    exit;
}

//Luodaan yhteys tietokantaan ja käytetään try-catch-lohkoa virheiden varalta//
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
try{
    $yhteys=mysqli_connect("localhost", "TRTKP21A3_1", "IFkw9SsG", "wp_TRTKP21A3_1");
}
catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}

$sql="select * from kirja where id=?"; //valitaan kaikki kohteesta kirja joissa id on käyttäjän antama//
$stmt=mysqli_prepare($yhteys, $sql); //Funkio palauttaa oliot joita tarvitaan parametreina seuraavissa lauseissa//
mysqli_stmt_bind_param($stmt, 'i', $muokattava); //Sijoittaa muuttujat oikeisiin kohtiin//
mysqli_stmt_execute($stmt); // Suoritetaan komento//
$tulos=mysqli_stmt_get_result($stmt);  // prepared statement joten tulos haetaan kyseisellä metodilla
if (!$rivi=mysqli_fetch_object($tulos)){ // Luetaan muuttujasta $tulos sen ainoa tietue, jos tietuetta ei ole niin siirrytään header-funktiolla kohtaan yhteysvirhe.html//
    header("Location:../html/yhteysvirhe.html");
    exit;
}
?>

<form action='./paivita.php' method='post'> 
id:<input type='text' name='id' value='<?php print $rivi->id;?>' readonly><br> 
Comment:<input type='text' name='nimi' value='<?php print $rivi->kommentti;?>'><br> 
Grade:<input type='text' name='arvosana' value='<?php print $rivi->arvosana;?>'><br>
<input type='submit' name='ok' value='ok'><br>
</form>

<?php
mysqli_close($yhteys); //Suljetaan yhteys tietokantaan //
?>

<footer>
      <p class="footertext">
        <br> Terms of service
        <br> Authors of this webpage:
        <br>Lauri Jokinen
        <br>Miika Koivisto
        <br>Arttu Altio
        </p>

        <p class="INC">
          www.LMA.com

        </p>
     </footer>

</body>
</html>