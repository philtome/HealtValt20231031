<?php

namespace App\Utils;

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
        // loop through the getters, not properties, get it then set it
        // Set entity properties based on the public getter methods
        $methods = get_class_methods($data);
        foreach($methods as $getterMethod) {
            if (str_starts_with($getterMethod,"get")) {
                $setterMethod = 's' . substr($getterMethod,1);
                $entity->$setterMethod($data->$getterMethod());
            }
        }

        $this->persistIt($entity);
    }

    public function updateData($entityClassName, $data, $id)
    {
        // Check if the entity class exists
        if (!class_exists($entityClassName)) {
            throw new \InvalidArgumentException("Entity class '$entityClassName' does not exist.");
        }
        $entity = $this->em->getRepository($entityClassName)->find($id);
        // loop through the getters, not properties, get it then set it
        // Set entity properties based on the public getter methods
        $methods = get_class_methods($data);
        foreach($methods as $getterMethod) {
            if (str_starts_with($getterMethod,"get")) {
                $setterMethod = 's' . substr($getterMethod,1);
                $entity->$setterMethod($data->$getterMethod());
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