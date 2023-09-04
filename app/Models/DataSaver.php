<?php

namespace App\Models;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;


class DataSaver
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function saveData($entityClassName, $data)
    {
        // Check if the entity class exists
        if (!class_exists($entityClassName)) {
            throw new \InvalidArgumentException("Entity class '$entityClassName' does not exist.");
        }

        // Create a new instance of the entity
        $entity = new $entityClassName();

        // Set entity properties based on the provided data
        foreach ($data as $property => $value) {
            // Make sure the property exists in the entity
            if (property_exists($entity, $property)) {
                $setterMethod = 'set' . ucfirst($property);
                // Check if the setter method exists before calling it
                if (method_exists($entity, $setterMethod)) {
                    $entity->$setterMethod($value);
                }
            }
        }

        // Persist and flush the entity

        $this->persistIt($entity);
    }

    public function updateData($entityClassName, $data, $id)
    {
        // Check if the entity class exists
        if (!class_exists($entityClassName)) {
            throw new \InvalidArgumentException("Entity class '$entityClassName' does not exist.");
        }

        $entity = $this->em->getRepository($entityClassName)->find($id);

        // Set entity properties based on the provided data
        foreach ($data as $property => $value) {
            // Make sure the property exists in the entity
            if (property_exists($entity, $property)) {
                $setterMethod = 'set' . ucfirst($property);
                // Check if the setter method exists before calling it
                if (method_exists($entity, $setterMethod)) {
                    $entity->$setterMethod($value);
                }
            }
        }

        // Persist and flush the entity

        $this->persistIt($entity);
    }

    public function deleteData($entityClassName, $id)
    {
        if (!class_exists($entityClassName)) {
            throw new \InvalidArgumentException("Entity class '$entityClassName' does not exist.");
        }

        // Fetch the entity to delete by ID
        $entity = $this->em->find($entityClassName, $id);

        if (!$entity) {
            throw new \InvalidArgumentException("Entity with ID $id not found.");
        }

        // Remove the entity
        $this->em->remove($entity);
        $this->em->flush();
    }


    public function persistIt($entity) {
        $this->em->persist($entity);
        $this->em->flush();
    }


}