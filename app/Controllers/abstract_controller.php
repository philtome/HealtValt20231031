<?php

namespace App\Controllers;

use App\Controllers\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

abstract class abstract_controller
{

    protected string $namespace = 'App\Models';
    public function createEntityInstance(string $entityName)
    {
        $entityClassName = $this->namespace . '\\' . $entityName;

        if (class_exists($entityClassName)) {
            return new $entityClassName();
        }

        return null;
    }
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    protected function saveEntity($entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }
}