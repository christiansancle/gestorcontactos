<?php


include_once 'm_contacts.php'; // Asegúrate de incluir tu modelo

class ContactController {
    private $model;

    public function __construct() {
        $this->model = new ContactModel(); // Inicializa la propiedad model
    }

    public function createContact() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];

            $sql = "INSERT INTO contactos (cnto_nombre, cnto_numerotelefono, cnto_email) VALUES (?, ?, ?)";
            $params = [$nombre, $telefono, $email];

            if ($this->model->insert($sql, $params)) {
                header("Location: index.php"); // Redirige a la lista de contactos
            } else {
                echo "Error al agregar el contacto.";
            }
        }
    }
    

    public function deleteContact($id) {
        $sql = "DELETE FROM contactos WHERE cnto_id = ?";
        $params = [$id];
    
        if ($this->model->delete($sql, $params)) {
            header("Location: index.php"); // Redirige a la lista de contactos
        } else {
            echo "Error al eliminar el contacto.";
        }
    }
    

    public function updateContact($id) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
    
            $sql = "UPDATE contactos SET cnto_nombre = ?, cnto_numerotelefono = ?, cnto_email = ? WHERE cnto_id = ?";
            $params = [$nombre, $telefono, $email, $id];
    
            if ($this->model->update($sql, $params)) {
                header("Location: index.php"); // Redirige a la lista de contactos
            } else {
                echo "Error al actualizar el contacto.";
            }
        }
    }
    

    public function getAllContacts() {
        $model = new ContactModel();
        return $model->getContact();
    }

    public function view() {
        include 'v_contacts.php';
    }
}
