<?php
include_once("../templates/Page.php");
include_once("../templates/DBService.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();
$auswahl= 0;
$user = $page->getSession();
$daten = $db->getStammdaten($user);

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
if (isset($_POST["email"])) {
    if ($_POST["email"]=="") {
        $page->showError("Bitte etwas eingeben!");
        header("Location: http://localhost/DHBW-Web-Engeneering-II-WS2021/php/StammdatenAendern/Stammdaten.php?action=done");
    }
    $auswahl=2;
    $stammdaten="'".$_POST["email"]."'";
    $db->stammdatenUpdate($stammdaten, $user, $auswahl);
    header("Location: http://localhost/DHBW-Web-Engeneering-II-WS2021/php/StammdatenAendern/Stammdaten.php?action=done");
    $page->showSuccess("Email gespeichert");
}
if ((isset($_POST["pw"]) and isset($_POST["pwWdh"]))) {
    if (($_POST["pw"]==$_POST["pwWdh"])) {
        if ($_POST["pw"]=="") {
            $page->showError("Bitte etwas eingeben!");
            header("Location: http://localhost/DHBW-Web-Engeneering-II-WS2021/php/StammdatenAendern/Stammdaten.php?action=done");
        }
        $auswahl=3;
        $password = password_hash($_POST["pw"],PASSWORD_BCRYPT);
        $db->stammdatenUpdate($password, $user, $auswahl);
        $db->verifyLogin($daten[0][0],$password);
        #$page->getLoginstatus($_COOKIE['GradlappainCook']);
        header("Location: http://localhost/DHBW-Web-Engeneering-II-WS2021/php/StammdatenAendern/Stammdaten.php?action=done");
        $page->showSuccess("Passwort gespeichert");
    }
    else {
        header("Location: http://localhost/DHBW-Web-Engeneering-II-WS2021/php/StammdatenAendern/Stammdaten.php?action=done");
        $page->showError("Passwort und PasswortWDH müssen übereinstimmen!");
    }
}
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

if (isset($_POST["nachname"]) and $daten[0][4]==NULL) {
    if ($_POST["nachname"]=="") {
        $page->showError("Bitte etwas eingeben!");
        header("Location: http://localhost/DHBW-Web-Engeneering-II-WS2021/php/StammdatenAendern/Stammdaten.php?action=done");
    }
    $auswahl=5;
    $stammdaten="'".$_POST["nachname"]."'";
    $db->stammdatenUpdate($stammdaten, $user, $auswahl);
    header("Location: http://localhost/DHBW-Web-Engeneering-II-WS2021/php/StammdatenAendern/Stammdaten.php?action=done");
    $page->showSuccess("Nachname geändert");
}elseif (isset($_POST["nachname"]) and !($daten[0][4]==NULL)) {
    header("Location: http://localhost/DHBW-Web-Engeneering-II-WS2021/php/StammdatenAendern/Stammdaten.php?action=done");
    $page->showError("Nachname kann nur einmal gesetzt werden!");
}


$page->addCs('StammdatenAendernCss/Stammdaten.css');
$string = '
<div  class="container">
    <div class="row">
        <div class="col-lg"></div>   
        <form class="col-lg main_window">
            <h2>Stammdaten ändern</h2>
            <div>
                <label class="info_text">Name: '. $daten[0][3].'</label>
                <br>
                <a class="btn btn-primary text-decoration-none" href="SDName.php" >Ändern</a>
                <br>
                <br>
            </div>
            <div>
                <label class="info_text">Nachname: '. $daten[0][4].'</label>
                <br>
                <a class="btn btn-primary text-decoration-none" href="SDNachname.php" >Ändern</a>
                <br>
                <br>
            </div>
            <div>
                <label class="info_text">Login: '. $daten[0][0].'</label>
                <br>
                <a class="btn btn-primary text-decoration-none" href="SDLogin.php" >Ändern</a>
                <br>
                <br>
            <div>
                <label class="info_text">Email: '. $daten[0][1].' </label>
                <br>
                <a class="btn btn-primary text-decoration-none" href="SDEmail.php">Ändern</a>
                <br>
                <br>
            </div>
                <label class="info_text">Passwort</label>
                <br>
                <a class="btn btn-primary text-decoration-none" href="SDPassword.php">Ändern</a>
            </div>
        </form>
        <div class="col-sm"></div>
    </div>
</div>
';
$page->addHtml($string);
$page->printPage();