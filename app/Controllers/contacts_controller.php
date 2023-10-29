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

    public function createContact()
    {
        $contacts = new Contacts_Model();
        //$contactDetails = $contacts->get_contact();
        return renderTemplate('contacts\contactsDetails.twig');
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

    public function movePostDataToFields($dataToSave,$em = null)
    {

        $dataToSave->setId(1);
        $dataToSave->setlastName(isset($_POST['contactLastName']) ? filter_var($_POST['contactLastName'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setfirstName(isset($_POST['contactFirstName']) ? filter_var($_POST['contactFirstName'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setcontactType(isset($_POST['contacttype']) ? filter_var($_POST['contacttype'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setemail(isset($_POST['contactemail']) ? filter_var($_POST['contactemail'], FILTER_VALIDATE_EMAIL) : null);
        $dataToSave->setphone(isset($_POST['contactphone']) ? filter_var($_POST['contactphone'], FILTER_SANITIZE_NUMBER_INT) : null);
        $dataToSave->setcompanyPractice(isset($_POST['companypractice']) ? filter_var($_POST['companypractice'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setisDriver(isset($_POST['isDriver']) && $_POST['isDriver'] === 'on' ? 1 : 0);
        $dataToSave->setisEmployee(isset($_POST['isEmployee']) && $_POST['isEmployee'] === 'on' ? 1 : 0);
        $dataToSave->setisCaregiver(isset($_POST['isCaregiver']) && $_POST['isCaregiver'] === 'on' ? 1 : 0);
        $dataToSave->setisCna(isset($_POST['isCna']) && $_POST['isCna'] === 'on' ? 1 : 0);
        $dataToSave->setisRn(isset($_POST['isRn']) && $_POST['isRn'] === 'on' ? 1 : 0);
        $dataToSave->setaddress1(isset($_POST['contactAddress1']) ? filter_var($_POST['contactAddress1'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setaddress2(isset($_POST['contactAddress2']) ? filter_var($_POST['contactAddress2'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setcity(isset($_POST['contactCity']) ? filter_var($_POST['contactCity'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setstate(isset($_POST['contactState']) ? filter_var($_POST['contactState'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setzip(isset($_POST['contactZip']) ? filter_var($_POST['contactZip'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setphone1(isset($_POST['contactPhone1']) ? filter_var($_POST['contactPhone1'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setphone1x(isset($_POST['contactPhone1x']) ? filter_var($_POST['contactPhone1x'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setphone2(isset($_POST['contactPhone2']) ? filter_var($_POST['contactPhone2'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setphone2x(isset($_POST['contactPhone2x']) ? filter_var($_POST['contactPhone2x'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setphone3(isset($_POST['contactPhone3']) ? filter_var($_POST['contactPhone3'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setphone3x(isset($_POST['contactPhone3x']) ? filter_var($_POST['contactPhone3x'], FILTER_SANITIZE_SPECIAL_CHARS) : null);


        Return $dataToSave;
    }

}