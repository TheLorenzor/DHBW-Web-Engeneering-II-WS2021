<?php
include_once("./templates/Page.php");
include_once("./templates/DBService.php");
include_once("./templates/Table.php");
$page = new Page();
$page->getLoginstatus($_COOKIE['GradlappainCook']);
$db = $page->getDBService();

switch ($page->getSession()) {
    case 1:
        $table = new Table($db->getAdminTable());
        $table->addColumn("ID",0,false);
        $table->addColumn("Projekt",1);
        $table->addColumn("Submission Date",5);
        $table->addColumn("Completed",4);
        $table->addColumn("Groups overall",3);
        $editButton = '<button class="btn btn-secondary" onclick="editProject(this);">Edit</button>';
        $table->addColumn("Edit Project",-1,true,$editButton);
        $table->addColumn("See",-1,true,'<button class="btn btn-info" onClick="seeDetails(this);">See Details</button>');
        $table->addButton("New Project","");
        $table->addButton("New Group","");
        $page->addElement($table);
        $page->addJs("tablebuttons_home.js");
        break;
    case 2:
        break;
    case 3:
        break;
}
$page->printPage();
