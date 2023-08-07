<?php

// File: app/Models/SampleModel.php

namespace App\Models;

class Contacts_Model
{
    private $pdo;

    public function getContactsList2()
    {
        // Replace this with your actual database query to fetch the list of books
        // For this example, we'll use a static array as sample data
        return [
            ['title' => 'Book 1', 'author' => 'Author 1'],
            ['title' => 'Book 2', 'author' => 'Author 2'],
            ['title' => 'Book 3', 'author' => 'Author 3'],
        ];
    }
    public function getContactssList($limit = null)
    {
        require __DIR__ . '/../../config/config.php';
        $pdo = get_connection();
        $query = 'SELECT * FROM contacts';
        if ($limit) {
            $query = $query . ' LIMIT :resultLimit';
        }
        $stmt = $pdo->prepare($query);
        if ($limit) {
            $stmt->bindParam('resultLimit', $limit, PDO::PARAM_INT); //added this line new
        }
        $stmt->execute();  //added this line new
        $contactList = $stmt->fetchAll();

        return $contactList;
    }

    function get_contact($id)
    {
        require __DIR__ . '/../../config/config.php';
        $pdo = get_connection();
        $query = 'SELECT * FROM contacts WHERE id = :idVal';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('idVal', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
    function update_contact($contactToSave, $id): string
    {
        require __DIR__ . '/../../config/config.php';
        $pdo = get_connection();

        $contactFirstN = $contactToSave['first_name'];
        $contactLastN = $contactToSave['last_name'];
        $contactType = $contactToSave['contact_type'];
        $contactCompany = $contactToSave['company_practice'];
        $contactEmail = $contactToSave['email'];
        $contactPhone = $contactToSave['phone'];
        if ($id) {
            $query = 'UPDATE contacts SET last_name = ?, first_name = ?, contact_type = ?, company_practice =?, email = ?, phone = ? WHERE id = ?';
            $stmt = $pdo->prepare($query);
            $stmt->execute([$contactLastN, $contactFirstN, $contactType, $contactCompany, $contactEmail, $contactPhone, $id]);
        } else {
            $query = 'INSERT INTO contacts (last_name, first_name, contact_type, company_practice, email, phone) VALUES (?,?,?,?,?,?)';
            $stmt = $pdo->prepare($query);
            $stmt->execute([$contactLastN, $contactFirstN, $contactType, $contactCompany, $contactEmail, $contactPhone]);
        }
        //$stmt = $pdo->prepare($query);
        return "Contact updated";
    }
    function delete_contact($id): string {
        require __DIR__ . '/../../config/config.php';
        $pdo = get_connection();
        $query = 'DELETE FROM contacts WHERE id = ?';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        //$stmt = $pdo->prepare($query);
        return "Contact Deleted";
    }
}