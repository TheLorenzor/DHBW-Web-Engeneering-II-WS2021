<?php
include_once("../templates/Page.php");
include_once("../templates/DBService.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
$user = $page->getSession();

if (isset($_POST["login"])) {
    if ($_POST["login"]=="") {
        $page->showError("Bitte etwas eingeben!");
        header("Location: http://localhost/DHBW-Web-Engeneering-II-WS2021/php/StammdatenAendern/Stammdaten.php?action=done");
    }
    $auswahl=1;
    $stammdaten="'".$_POST["login"]."'";
    $db->stammdatenUpdate($stammdaten, $user, $auswahl);
    header("Location: http://localhost/DHBW-Web-Engeneering-II-WS2021/php/StammdatenAendern/Stammdaten.php?action=done");
    $page->showSuccess("Login gespeichert");
}

$page->addCs('StammdatenAendernCss/Stammdaten.css');
$string = '
<div  class="container">
    <div class="row">
        <div class="col-lg"></div>   
        <form class="col-lg main_window" action="SDLogin.php" method="post">
            <h2>Login ändern</h2>
            <div>
            <br>
                <input name="login" placeholder="Neuer Login">
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