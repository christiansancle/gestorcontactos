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
        // Utiliza la conexión existente desde $this->db
        $conn = $this->db->connect(); // Obtener conexión desde el objeto db
        $stmt = $conn->prepare($sql);
        
        // Verificar si la preparación fue exitosa
        if ($stmt === false) {
            die("Error al preparar la consulta: " . htmlspecialchars($conn->error));
        }

        // Asignar los parámetros a la declaración
        $stmt->bind_param("sssi", ...$params); // "sssi" indica el tipo de cada parámetro: string, string, string, integer
    
        // Ejecutar la consulta
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            return true;
        } else {
            echo "Error al ejecutar la consulta: " . htmlspecialchars($stmt->error);
            $stmt->close();
            $conn->close();
            return false;
        }
    }
    


    public function getAllContacts() {
        $sql = "SELECT * FROM contactos";
        return $this->db->select($sql);
    }

    public function getContact() {
        $sql = "SELECT cnto_id, cnto_nombre, cnto_numerotelefono, cnto_email FROM contactos";
        return $this->db->select($sql);
    }

    public function saveContact($data) {
        $sql = "INSERT INTO contactos (cnto_nombre, cnto_numerotelefono, cnto_email) VALUES (?, ?, ?)";
        return $this->db->insert($sql, [$data['nombre'], $data['telefono'], $data['email']]);
    }

    public function updateContact($id, $data) {
        $sql = "UPDATE contactos SET cnto_nombre = ?, cnto_numerotelefono = ?, cnto_email = ? WHERE cnto_id = ?";
        return $this->update($sql, [$data['nombre'], $data['telefono'], $data['email'], $id]);
    }

    public function delete($sql, $params) {
        $conn = $this->db->connect(); // Conexión a la base de datos
        $stmt = $conn->prepare($sql);

        // Verificar si la preparación fue exitosa
        if ($stmt === false) {
            die("Error al preparar la consulta: " . htmlspecialchars($conn->error));
        }

        // Asignar el parámetro id a la consulta
        $stmt->bind_param("i", ...$params); // "i" para indicar un entero (id)

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            return true;
        } else {
            echo "Error al ejecutar la consulta: " . htmlspecialchars($stmt->error);
            $stmt->close();
            $conn->close();
            return false;
        }
    }

    public function deleteContact($id) {
        $sql = "DELETE FROM contactos WHERE cnto_id = ?";
        return $this->delete($sql, [$id]);
    }


    public function getContactById($id) {
        // Implement this method if you need to fetch a contact by ID
    }
    

    

}