<?php

// File: app/Models/SampleModel.php

namespace App\Models;

class Careplans_Model
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
    public function getCareplanList($limit = null)
    {

        require __DIR__.'/../../config/config.php';
        $pdo = get_connection();
        $query = 'SELECT * FROM care_plans';
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
        $carePlans = $stmt->fetchAll();

        return $carePlans;
    }

}