<?php
include_once("../templates/Page.php");
include_once("../templates/DBService.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
$user = $page->getSession();
$daten = $db->getStammdaten($user);

if (isset($_POST["name"]) and $daten[0][3]==NULL) {
    if ($_POST["name"]=="") {
        $page->showError("Bitte etwas eingeben!");
        header("Location: http://localhost/DHBW-Web-Engeneering-II-WS2021/php/StammdatenAendern/Stammdaten.php?action=done");
    }
    $auswahl=4;
    $stammdaten="'".$_POST["name"]."'";
    $db->stammdatenUpdate($stammdaten, $user, $auswahl);
    header("Location: http://localhost/DHBW-Web-Engeneering-II-WS2021/php/StammdatenAendern/Stammdaten.php?action=done");
    $page->showSuccess("Name geändert");
}elseif (isset($_POST["name"]) and !($daten[0][3]==NULL)) {
    header("Location: http://localhost/DHBW-Web-Engeneering-II-WS2021/php/StammdatenAendern/Stammdaten.php?action=done");
    $page->showError("Name kann nur einmal gesetzt werden!");
}

$page->addCs('StammdatenAendernCss/Stammdaten.css');
$string = '
<div  class="container">
    <div class="row">
        <div class="col-lg"></div>   
        <form class="col-lg main_window" action="SDName.php" method="post">
            <h2>Name ändern</h2>
            <div>
            <br>
                <input name="name" placeholder="Neuer Name">
                <button class="btn-sm btn-primary">Speichern</button>
                <br>
                <br>
            </div>
        </form>
        <div class="col-sm"></div>
    </div>
</div>
';
$page->addHtml($string);
$page->printPage();