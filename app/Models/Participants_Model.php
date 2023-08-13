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
        $participantAddress = $participantToSave['street_address_1'];
        $participantAddress2 = $participantToSave['street_address_2'];
        $participantCity = $participantToSave['city'];
        $participantState = $participantToSave['state'];
        $participantZip = $participantToSave['zip'];
        $participantResponParty = $participantToSave['responsible_party'];
        $participantPhone = $participantToSave['phone'];
        if ($id) {
            $query = 'UPDATE participants SET last_name = ?, first_name = ?, street_address_1 = ?, street_address_2 =?, city = ?, state = ?, zip = ?, responsible_party =?, phone = ? WHERE id = ?';
            $stmt = $pdo->prepare($query);
            $stmt->execute([$participantLastN, $participantFirstN, $participantAddress, $participantAddress2, $participantCity, $participantState, $participantZip, $participantResponParty, $participantPhone, $id]);
        } else {
            $query = 'INSERT INTO participants (last_name, first_name, street_address1, street_address_2, city, state, zip, responsible_party, phone) VALUES (?,?,?,?,?,?,?,?,?)';
            $stmt = $pdo->prepare($query);
            $stmt->execute([$participantLastN, $participantFirstN, $participantAddress, $participantAddress2, $participantCity, $participantState, $participantZip, $participantResponParty, $participantPhone]);
        }
        //$stmt = $pdo->prepare($query);
        return "Participant updated";
    }
    function delete_participant($id): string {
        require __DIR__ . '/../../config/config.php';
        $pdo = get_connection();
        $query = 'DELETE FROM participants WHERE id = ?';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        //$stmt = $pdo->prepare($query);
        return "Participant Deleted";
    }
}