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

    public function mainDisplay() {
        $contacts = new Contacts_Model();
        return renderTemplate('contacts_main.twig',['contacts' => $contacts->getContactssList()]);
    }
    public function getList() {
        $contacts = new Contacts_Model();
        $listItems = $contacts->getContactsList();
        return renderTemplate('contacts_main.twig', ['param1' => $listItems]);
    }
    public function manageContact($id) {
        $contacts = new Contacts_Model();
        $contactDetails = $contacts->get_contact($id);
        return renderTemplate('contactDetails.twig', ['contact' => $contactDetails]);
}

}