<?php


include_once 'c_contacts.php';
$controller = new manageTaskController();
$tasks = $controller->getTask();

?>
