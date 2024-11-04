<?php
include_once 'c_contacts.php';
include_once 'm_contacts.php';

$manageContact = new ContactController();
if (empty($_REQUEST['modo'])) {
    $_REQUEST['modo'] = '';
}
switch ($_REQUEST['modo']) {
    case 'createContact':
        $manageContact->createContact();
        break;
    case 'deleteContact':
        $manageContact->deleteContact($_REQUEST['id']);
        break;
    case 'updateContact':
        $manageContact->updateContact($_REQUEST['id']);
        break;
    default:
        $manageContact->view();
        break;
}
