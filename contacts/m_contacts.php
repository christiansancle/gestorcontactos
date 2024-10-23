<?php

include_once '../conexion/conexion.php';

class ContactModel{

    public function getContact()
    {


        $con = new Conexion();
        $sql = "SELECT cnto_id,
         cnto_nombre,
         cnto_numerotelefono,
         cnto_email 
         FROM contactos";
        $data = $con->select( $sql );
        return $data;

    }

    public function saveContact($data)
    {
        $con = new Conexion();
        $sql = "INSERT INTO contactos (cnto_nombre, cnto_numerotelefono, cnto_email) VALUES ('".$data['nombre']."', '".$data['telefono']."', '".$data['email']."')";
        $data = $con->insert( $sql );
        return $data;

    }

    public function updateContact($id, $data)
    {
        $con = new Conexion();
        $sql = "UPDATE contactos SET cnto_nombre = '".$data['nombre']."', cnto_numerotelefono = '".$data['telefono']."', cnto_email = '".$data['email']."' WHERE cnto_id = '".$id."'";
        $data = $con->update( $sql );
        return $data;

    }

    public function deleteContact($id)
    {
        $con = new Conexion();
        $sql = "DELETE FROM contactos WHERE cnto_id = '".$id."'";
        $data = $con->delete( $sql );
        return $data;

    }

    public function getContactById($id)
    {

    }
    

    

}