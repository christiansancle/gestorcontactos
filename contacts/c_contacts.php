<?php



class ContactController 
{


  

    public function createContact()
    { 
       $nomrbre = $_POST['nombre'];
       $telefono = $_POST['telefono'];
       $email = $_POST['email'];

       $data = array(
        'nombre' => $nomrbre,
        'telefono' => $telefono,
        'email' => $email,
       ); 
       $model = new ContactModel();
       $model->saveContact($data);
        
    }

    public function deleteContact($id)
    {
        $model = new ContactModel();
        $model->deleteContact($id);

    }

    public function updateContact($id)
    {
        $nomrbre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $id = $_POST['id'];
        $data = array(
            'nombre' => $nomrbre,
            'telefono' => $telefono,
            'email' => $email
           ); 
           $model = new ContactModel();
           $model->updateContact($id, $data);
    }

    public function getAllContacts()
    {

        $model = new ContactModel();
        $data =$model->getContact();
        return $data;

    }

    public function view(){
        include 'v_contacts.php';
    }
    
}
