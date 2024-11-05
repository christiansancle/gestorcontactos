<?php
include_once 'c_contacts.php';
include_once 'm_contacts.php';

$manageContact = new ContactController();

// Asegura que la variable 'modo' esté definida para evitar errores
if (empty($_REQUEST['modo'])) {
    $_REQUEST['modo'] = '';
}

// Manejo de la acción de eliminación de contacto en un formulario POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'delete' && isset($_POST['id'])) {
        $manageContact->deleteContact($_POST['id']); // Cambiado $controller a $manageContact
        exit; // Detenemos el script después de la redirección
    }
}

// Manejador principal de las acciones, usando el valor de 'modo'
switch ($_REQUEST['modo']) {
    case 'createContact':
        $manageContact->createContact();
        break;
    case 'deleteContact':
        if (isset($_REQUEST['id'])) {
            $manageContact->deleteContact($_REQUEST['id']);
        }
        break;
    case 'updateContact':
        $manageContact->updateContact();
        break;
    default:
        $manageContact->view();
        break;
}
