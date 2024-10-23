<?php

$servername = "localhost"; 
$username = "root"; 
$password = "root"; 
$database = "agenda_contactos";


class Conexion{


    public function connect() {
        global $servername, $username, $password, $database;
        $conn = new mysqli($servername, $username, $password, $database);
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
    public function insert($sql) {
        $conn = $this->connect();
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
        $conn->close();
    }
    
    // Función para ejecutar una consulta UPDATE
    public function update($sql) {
        $conn = $this->connect();
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
        $conn->close();
    }
    
    // Función para ejecutar una consulta DELETE
    public function delete($sql) {
        $conn = $this->connect();
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
        $conn->close();
    }

}


?>
