<?php 
$poistettava=$_GET["poistettava"]; // Haetaan arvot kohdalle "poistettava" Get komennolla //

try{  /* Haetaan yhteys tietokantaan ja k�ytet��n try-catch-lohkoa k�sittelem��n virheet*/
    $yhteys=mysqli_connect("localhost", "TRTKP21A3_1", "IFkw9SsG", "wp_TRTKP21A3_1");
}
/* Jos virhe havaitaan niin palautetaan k�ytt�j� sivulle yhteysvirhe.html */
catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}
/* Tietokannasta poistetaan tieto "poistettava" jolle k�ytt�j� on antanut  tarvittavat tiedot */
mysqli_query($yhteys, "delete from kirja where id=$poistettava");

/* Suljetaan yhteys tietokantaan */
mysqli_close($yhteys);

/* Ohjataan k�ytt�j� takaisin sivulle tervetuloaadmin.php */
header("Location:./tervetuloaadmin.php");
?>