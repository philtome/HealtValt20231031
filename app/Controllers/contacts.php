<?php

namespace App\Controllers;

use App\Models\Contacts_Model;

class contacts
{
    public function action1($param1, $param2, $param3)
    {
        // Your controller logic here using $param1, $param2, $param3
        return renderTemplate('template2.twig', [
            'param1' => $param1,
            'param2' => $param2,
            'param3' => $param3
        ]);
    }

    public function mainDisplay()
    {
        $contacts = new Contacts_Model();
        return renderTemplate('contacts\contacts_main.twig', ['contacts' => $contacts->getContactssList()]);
    }

    public function getList()
    {
        $contacts = new Contacts_Model();
        $listItems = $contacts->getContactsList();
        return renderTemplate('contacts\contacts_main.twig', ['param1' => $listItems]);
    }

    public function manageContact($id)
    {
        $contacts = new Contacts_Model();
        $contactDetails = $contacts->get_contact($id);
        return renderTemplate('contacts\contactDetails.twig', ['contact' => $contactDetails]);
    }

    public function saveContact($id)
    {
        $contacts = new Contacts_Model();
        $dataToSave = $this->movePostDataToFields($_POST);
        $temppor = $contacts->update_contact($dataToSave, $id);
        // want to do the save here
        if ($id == null) {
            $successful = $contacts->update_contact($dataToSave);
        }
        else {
            $successful = $contacts->update_contact($dataToSave, $id);
        }
        return renderTemplate('contacts\contacts_main.twig', ['contacts' => $contacts->getContactssList()]);
        //return renderTemplate('contacts\contactDetails.twig', ['contact' => $contactDetails]);
    }
    public function deleteContact($id)
    {
        $contacts = new Contacts_Model();
        $sucessful = $contacts->delete_contact($id);
        return renderTemplate('contacts\contacts_main.twig', ['contacts' => $contacts->getContactssList()]);
        //return renderTemplate('contacts\contactDetails.twig', ['contact' => $contactDetails]);
    }


    public function createContact()
    {
        $contacts = new Contacts_Model();
        //$contactDetails = $contacts->get_contact();
        return renderTemplate('contacts\contactDetails.twig');
    }

    public function movePostDataToFields($contactDetails)
    {

        $contactLastN = isset($_POST['contactLastName']) ? filter_var($_POST['contactLastName'], FILTER_SANITIZE_SPECIAL_CHARS) : null;
        $contactFirstN = isset($_POST['contactFirstName']) ? filter_var($_POST['contactFirstName'], FILTER_SANITIZE_SPECIAL_CHARS) : null;
        $contactType = isset($_POST['contacttype']) ? filter_var($_POST['contacttype'], FILTER_SANITIZE_SPECIAL_CHARS) : null;
        $contactEmail = isset($_POST['contactemail']) ? filter_var($_POST['contactemail'], FILTER_VALIDATE_EMAIL) : null;
        $contactPhone = isset($_POST['contactphone']) ? filter_var($_POST['contactphone'], FILTER_SANITIZE_NUMBER_INT) : null;
        $contactCompany = isset($_POST['companypractice']) ? filter_var($_POST['companypractice'], FILTER_SANITIZE_SPECIAL_CHARS) : null;
        // Add more fields as needed

        // Check if data is valid
        if ($contactLastN !== null && $contactPhone !== null) {
            // Data is valid, proceed to update the database
            Return $dataToReturn = [
                'first_name' => $contactFirstN,
                'last_name' => $contactLastN,
                'contact_type' => $contactType,
                'company_practice' => $contactCompany,
                'phone' => $contactPhone,
                'email' => $contactEmail,
                // Add more fields as needed
            ];
        }
    }
}