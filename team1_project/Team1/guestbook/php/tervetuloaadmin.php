<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Guestbook">
    <meta name="keywords" content="HTML, CSS">
    <meta name="author" content="Lauri Jokinen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style2.css">
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


<!
Ohjelma käyttää sessiota Seuraavaksi tutkitaan,
onko sessiossa avaimella 'kayttaja' jokin arvo (ei väliä mikä, kunhan jotain).
Ellei ole, avataan sivu kirjauduajax.html.
-->

<?php
session_start();
if (!isset($_SESSION["kayttaja"])){
    header("Location:../html/kirjauduadmin.html");
    exit;
}
print "<h2>Welcome, ".$_SESSION["kayttaja"]."!</h2>";
?>

<a href='kirjauduulos.php'>Log out</a><br><br>

<?php
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
try{
    $yhteys=mysqli_connect("localhost", "TRTKP21A3_1", "IFkw9SsG", "wp_TRTKP21A3_1");
}
catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}
$tulos=mysqli_query($yhteys, "select * from kirja");
while ($rivi=mysqli_fetch_object($tulos)){
    print "<p>Comment:  $rivi->kommentti <br>
		Grade: $rivi->arvosana <br>
		 <a href='./deletecomment.php?poistettava=$rivi->id'>Delete</a><a href='./muokkaa.php?muokattava=$rivi->id'> Edit</a></p>";
}
mysqli_close($yhteys);
?>

<footer>
      <p class="footertext">
        <br> Terms of service
        <br> Authors of this webpage:
        <br>Lauri Jokinen
        <br>Miika Koivisto
        <br>Arttu Altio
	<br><a href="https://hameenamk-my.sharepoint.com/:w:/r/personal/lauri20118_student_hamk_fi/_layouts/15/Doc.aspx?sourcedoc=%7B4B987583-1239-47F8-9277-1503938E04B6%7D&file=webprojekti_doc.docx&wdOrigin=OFFICECOM-WEB.START.REC&ct=1645437890597&action=default&mobileredirect=true">Documentation</a></p>
        </p>

        <p class="INC">
          www.LMA.com

        </p>
     </footer>

</body>
</html>