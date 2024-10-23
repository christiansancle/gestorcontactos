<?php



class ContactController 
{


  

    public function createContact()
    {

    }

    public function deleteContact($id)
    {

    }

    public function updateContact($id)
    {

    }

    public function getAllContacts()
    {

        $model = new ContactModel();
        $data =$model->getContact();
        return $data;

    }

    public function view(){
         echo 'Hello World!';  // Replace with your logic to display contact details
    }
    
}
