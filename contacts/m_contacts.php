<?php

include_once './conexion/conexion.php';

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

    }

    public function updateContact($id, $data)
    {

    }

    public function deleteContact($id)
    {

    }

    public function getContactById($id)
    {

    }

    

}