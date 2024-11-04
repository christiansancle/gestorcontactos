<?php

include_once './conexion/conexion.php';


class ContactModel {
    private $db;

    public function __construct() {
        $this->db = new Conexion(); // Inicializa la conexión a la base de datos
    }

    public function insert($sql, $params) {
        return $this->db->insert($sql, $params);
    }

    public function update($sql, $params) {
        return $this->db->update($sql, $params);
    }

    public function delete($sql, $params) {
        return $this->db->delete($sql, $params);
    }

    public function getAllContacts() {
        $sql = "SELECT * FROM contactos";
        return $this->db->select($sql);
    }


    public function getContact() {
        $con = new Conexion();
        $sql = "SELECT cnto_id, cnto_nombre, cnto_numerotelefono, cnto_email FROM contactos";
        return $con->select($sql);
    }

    public function saveContact($data) {
        $con = new Conexion();
        $sql = "INSERT INTO contactos (cnto_nombre, cnto_numerotelefono, cnto_email) VALUES (?, ?, ?)";
        return $con->insert($sql, [$data['nombre'], $data['telefono'], $data['email']]);
    }

    public function updateContact($id, $data) {
        $con = new Conexion();
        $sql = "UPDATE contactos SET cnto_nombre = ?, cnto_numerotelefono = ?, cnto_email = ? WHERE cnto_id = ?";
        return $con->update($sql, [$data['nombre'], $data['telefono'], $data['email'], $id]);
    }

    public function deleteContact($id) {
        $con = new Conexion();
        $sql = "DELETE FROM contactos WHERE cnto_id = ?";
        return $con->delete($sql, [$id]);
    }

    public function getContactById($id) {
        // Implement this method if you need to fetch a contact by ID
    }
}
