<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "agenda_contactos";



class Conexion {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "agenda_contactos";

    public function connect() {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }
        return $conn;
    }
    
    
    public function select($sql) {
        $conn = $this->connect();
        $result = $conn->query($sql);
        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        $conn->close();
        return $data;
    }
    
    // Función para ejecutar una consulta INSERT
// Modificaciones en la clase Conexion
public function insert($sql, $params) {
    $conn = $this->connect();
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $types = str_repeat('s', count($params)); // Asumimos que todos son strings
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true;
    } else {
        echo "Error al ejecutar la consulta: " . $stmt->error;
        return false;
    }
}

public function update($sql, $params) {
    $conn = $this->connect();
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $types = str_repeat('s', count($params)); // Asumimos que todos son strings
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true;
    } else {
        echo "Error al ejecutar la consulta: " . $stmt->error;
        return false;
    }
}

public function delete($sql, $params) {
    $conn = $this->connect();
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    // Asumimos que el id es un entero
    $stmt->bind_param('i', $params[0]); // solo un parámetro

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true;
    } else {
        echo "Error al ejecutar la consulta: " . $stmt->error;
        return false;
    }
}

}


?>
