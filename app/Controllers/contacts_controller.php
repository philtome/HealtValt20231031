<?php

namespace App\Controllers;

use App\Models\Contacts_Model;
use App\Models\Contacts;
use App\Utils\DataSaver;
use Doctrine\Persistence\ObjectManager;

class contacts_controller extends abstract_controller
{
    protected ObjectManager $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

//    public function mainDisplay($controller)
//    {
//        $namespace = $this->namespace;
//        $model = $namespace.'\\'.ucfirst($controller);
//        $dataToDisplay = $this->em->getRepository($model)->findAll();
//        $templateToDisplay = $controller.'\\'.$controller.'_main.twig';
//
//
//        $key = $controller; // You can set this key dynamically
//        $templateData = [$key => $dataToDisplay];
//        return renderTemplate($templateToDisplay, $templateData);
//
//        //return renderTemplate($templateToDisplay,['participants' => $dataToDisplay]);
//    }

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
        //return renderTemplate('contacts\contactsDetails.twig', ['contact' => $contactDetails]);
    }
    public function deleteContact($id)
    {
        $contacts = new Contacts_Model();
        $sucessful = $contacts->delete_contact($id);
        return renderTemplate('contacts\contacts_main.twig', ['contacts' => $contacts->getContactssList()]);
        //return renderTemplate('contacts\contactsDetails.twig', ['contact' => $contactDetails]);
    }

    public function createContact()
    {
        $contacts = new Contacts_Model();
        //$contactDetails = $contacts->get_contact();
        return renderTemplate('contacts\contactDetails.twig');
    }

    public function copyContact($id)
    {
        $contacts = new Contacts_Model();
        $contactDetails = $contacts->get_contact($id);
        $contactsSave = new Contacts_Model();
        $temppor = $contactsSave->update_contact($contactDetails);
        // want to do the save here
        return renderTemplate('contacts\contacts_main.twig', ['contacts' => $contacts->getContactssList()]);
    }

    public function movePostDataToFields($contactDetails)
    {

        $contactLastN = isset($_POST['contactLastName']) ? filter_var($_POST['contactLastName'], FILTER_SANITIZE_SPECIAL_CHARS) : null;
        $contactFirstN = isset($_POST['contactFirstName']) ? filter_var($_POST['contactFirstName'], FILTER_SANITIZE_SPECIAL_CHARS) : null;
        $contactType = isset($_POST['contacttype']) ? filter_var($_POST['contacttype'], FILTER_SANITIZE_SPECIAL_CHARS) : null;
        $contactEmail = isset($_POST['contactemail']) ? filter_var($_POST['contactemail'], FILTER_VALIDATE_EMAIL) : null;
        $contactPhone = isset($_POST['contactphone']) ? filter_var($_POST['contactphone'], FILTER_SANITIZE_NUMBER_INT) : null;
        $contactCompany = isset($_POST['companypractice']) ? filter_var($_POST['companypractice'], FILTER_SANITIZE_SPECIAL_CHARS) : null;
        $contactDriver = isset($_POST['isDriver']) && $_POST['isDriver'] === 'on' ? 1 : 0;
        $contactEmployee = isset($_POST['isEmployee']) && $_POST['isEmployee'] === 'on' ? 1 : 0;
        $contactCaregiver = isset($_POST['isCaregiver']) && $_POST['isCaregiver'] === 'on' ? 1 : 0;
        $contactCna = isset($_POST['isCna']) && $_POST['isCna'] === 'on' ? 1 : 0;
        $contactRn = isset($_POST['isRn']) && $_POST['isRn'] === 'on' ? 1 : 0;
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
                'is_driver' => $contactDriver,
                'is_employee' => $contactEmployee,
                'is_caregiver' => $contactCaregiver,
                'is_cna' => $contactCna,
                'is_rn' => $contactRn,
                // Add more fields as needed
            ];
        }
    }
}