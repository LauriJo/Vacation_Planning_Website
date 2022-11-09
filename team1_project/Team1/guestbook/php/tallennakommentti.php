<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Guestbook">
    <meta name="keywords" content="HTML, CSS">
    <meta name="author" content="Miika Koivisto">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Save comment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#" >Traveling Guide</a>
        
          <div class="navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="https://www.ebookers.com/">Reserve vacation</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="./guestbook/php/vieraskirja.php">Guestbook
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

<?php 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_INDEX);

$nimi=isset($_POST["nimi"]) ? $_POST["nimi"] : "";
$arvosana=isset($_POST["arvosana"]) ? $_POST["arvosana"] : "";
//näillä lauseilla tarkistetaan onko lomakkeelta tullut syötteenä nimi ja arvosana//

if (empty($nimi) || empty ($arvosana)){
    header("Location:../html/kommenttilomake.html");
    exit;
}
//mikäli nimi ja arvosana ei saa syötettä ohjataan käyttäjä toiselle sivulle//

try{
    $yhteys=mysqli_connect("localhost", "TRTKP21A3_1", "IFkw9SsG", "wp_TRTKP21A3_1");
}

catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}
//koitetaan saada yhteys tietokantaan, mikäli ei saada ohjataan käyttäjä yhteysvirhe sivulle//

$sql="insert into kirja (kommentti, arvosana) values(?, ?)";
//Tehdään sql-lause, jossa kysymysmerkeillä osoitetaan paikat joihin laitetaan muuttujien arvoja//

//Valmistellaan sql-lause//
$stmt=mysqli_prepare($yhteys, $sql);

//Sijoitetaan muuttujat oikeisiin paikkoihin//
mysqli_stmt_bind_param($stmt, 'sd', $nimi, $arvosana);

//Suoritetaan sql-lause//
mysqli_stmt_execute($stmt);

//Suljetaan tietokantayhteys//
mysqli_close($yhteys);


header("Location:../php/tervetuloa.php");
?>
//ohjaa tervetuloa sivulle//

</body>
</html>
