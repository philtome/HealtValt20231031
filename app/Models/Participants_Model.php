<?php

// File: app/Models/SampleModel.php

namespace App\Models;

class Participants_Model
{
    private $pdo;

//    public function __construct(PDO $pdo)
//    {
//        $this->pdo = $pdo;
//    }

    public function getCareplanList2()
    {
        // Replace this with your actual database query to fetch the list of books
        // For this example, we'll use a static array as sample data
        return [
            ['title' => 'Book 1', 'author' => 'Author 1'],
            ['title' => 'Book 2', 'author' => 'Author 2'],
            ['title' => 'Book 3', 'author' => 'Author 3'],
        ];
    }
    public function getParticipantsList($limit = null)
    {

        require __DIR__.'/../../config/config.php';
        $pdo = get_connection();
        $query = 'SELECT * FROM participants';
        if ($limit)
        {
            $query = $query.' LIMIT :resultLimit';
        }
        $stmt = $pdo->prepare($query);
        if ($limit)
        {
            $stmt->bindParam('resultLimit', $limit, PDO::PARAM_INT); //added this line new
        }
        $stmt->execute();  //added this line new
        $contactList = $stmt->fetchAll();

        return $contactList;
    }

    function get_participant($id)
    {
        require_once __DIR__ . '/../../config/config.php';
        $pdo = get_connection();
        $query = 'SELECT * FROM participants WHERE id = :idVal';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('idVal', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
    function update_participant($participantToSave, $id = null): string
    {
        require_once __DIR__ . '/../../config/config.php';
        $pdo = get_connection();

        $participantFirstN = $participantToSave['first_name'];
        $participantLastN = $participantToSave['last_name'];
        $participantType = $participantToSave['contact_type'];
        $participantCompany = $participantToSave['company_practice'];
        $participantEmail = $participantToSave['email'];
        $participantPhone = $participantToSave['phone'];
        if ($id) {
            $query = 'UPDATE contacts SET last_name = ?, first_name = ?, contact_type = ?, company_practice =?, email = ?, phone = ? WHERE id = ?';
            $stmt = $pdo->prepare($query);
            $stmt->execute([$participantLastN, $participantFirstN, $participantType, $participantCompany, $participantEmail, $participantPhone, $id]);
        } else {
            $query = 'INSERT INTO contacts (last_name, first_name, contact_type, company_practice, email, phone) VALUES (?,?,?,?,?,?)';
            $stmt = $pdo->prepare($query);
            $stmt->execute([$participantLastN, $participantFirstN, $participantType, $participantCompany, $participantEmail, $participantPhone]);
        }
        //$stmt = $pdo->prepare($query);
        return "Participant updated";
    }
}