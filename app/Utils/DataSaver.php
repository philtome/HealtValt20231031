<?php

namespace App\Utils;

use App\Models\Participants;
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


        $propertiesList = $this->getPropertyNames($entity);
        $dataPropertiesList = $this->getPropertyNames($data);

//        $methods = get_class_methods($data);
//        foreach($methods as $getterMethod) {
//            if (str_starts_with($getterMethod,"get")) {
//                $setterMethod = 's' . substr($getterMethod,1);
//                $entity->$setterMethod($data->$getterMethod());
//            }
//        }
        // Loop through the updated fields and set them on the entity
        $methods = get_class_methods($data);
        foreach ($methods as $getterMethod) {
            if (str_starts_with($getterMethod, "get")) {
                $setterMethod = 's' . substr($getterMethod, 1);
                $propertyName = lcfirst(substr($getterMethod, 3));
                if (in_array($propertyName, $dataPropertiesList)) {
                    $propertyValue = $data->$getterMethod();

                    // Check if the property value is not null before setting it in the entity
//                    if ($propertyValue !== null) {
                        $entity->$setterMethod($propertyValue);
//                    }
                }
            }
        }



//        foreach ($data as $fieldName => $fieldValue) {
//            $setterMethod = 'set' . ucfirst($fieldName);
//            if (method_exists($entity, $setterMethod)) {
//                $entity->$setterMethod($fieldValue);
//            } else {
//                // Handle the case where the setter method doesn't exist for the field.
//                // You can log an error or throw an exception as needed.
//            }
//        }

//        $reflectionClass = new \ReflectionClass($data);
//        foreach ($reflectionClass->getProperties() as $property) {
//            $propertyName = $property->getName();
//
//            if (property_exists($data, $propertyName)) {
//                $getterMethod = 'get' . ucfirst($propertyName);
//
//                if (method_exists($data, $getterMethod)) {
//                    $setterMethod = 'set' . ucfirst($propertyName);
//                    $propertyValue = $data->$getterMethod();
//
//                    // Check if the property has a non-null value
//                    if ($propertyValue !== null) {
//                        if (method_exists($entity, $setterMethod)) {
//                            $entity->$setterMethod($propertyValue);
//                        }
//                    }
//                }
//            }
//        }

        // Persist and flush the entity

        $this->persistIt($entity);
    }


//    public function getPropertyNames($entity){
//        $reflectionClass = new \ReflectionClass($entity);
//        $propertyNames = array();
//        foreach ($reflectionClass->getProperties() as $property) {
//            $propertyNames[] = $property->getName();
//        }
//        return $propertyNames;
//    }


    public function getPropertyNames($dataToSave)
    {
        $reflectionClass = new \ReflectionClass($dataToSave);
        $propertyNames = array();
        foreach ($reflectionClass->getProperties() as $property) {
            $propertyName = $property->getName();

            if ($propertyName !== 'pwd') {
            // Form the getter and setter method names
            $getterMethod = 'get' . ucfirst($propertyName);
            $setterMethod = 'set' . ucfirst($propertyName);

            // Check if the getter and setter methods exist
            if (method_exists($dataToSave, $getterMethod) && method_exists($dataToSave, $setterMethod)) {
                // Use the getter to access the value
                $propertyValue = $dataToSave->$getterMethod();

                // Check if the value is not null
//                if ($propertyValue !== null) {
                    // Use the setter to insert the value into the database
                    $propertyNames[] = $property->getName();
                } //}
            }
        }
        return $propertyNames;
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
        if ($entityClassName === 'App\Models\contacts') {
            // Check if the contact is linked to a participant
            $isLinkedToParticipant = $this->isContactLinkedToParticipant($entity);

            if ($isLinkedToParticipant) {
                // Handle the case where the contact is linked to a participant
                // WAS: throw new \RuntimeException("Cannot delete the contact. It is linked to a participant.");
                // Assuming there's an error
                $errorMessage = "Cannot delete contact, it is connected to a Participant.";
                // Send the error message as a JSON response
                header('Content-Type: application/json');
                http_response_code(500); // Set an appropriate status code
                echo json_encode(['error' => $errorMessage]);
                exit;
                }
            }
        // Remove the entity
        $this->em->remove($entity);
        $this->em->flush();

        header('Content-Type: application/json');
        //echo json_encode(['response' => 'Entity deleted successfully']);
        echo json_encode(['message' => 'Entity deleted successfully']);
        // I can use message as well later
    }

    private function isContactLinkedToParticipant($contact)
    {
        // Assuming you have a $entityManager instance available in your class
        $entityManager = $this->em;
        $participantRepository = $entityManager->getRepository(Participants::class);
        $participantCount = $participantRepository->count(['responsibleParty' => $contact]);
            // If $participant is not null, it means the contact is linked to a participant
          if ($participantCount == 0) {
              return false; //$participant !== null;
              //}
          }

        // If it's not a Contact entity, return false
        return true;
    }

    public function persistIt($entity) {
        $this->em->persist($entity);
        $this->em->flush();
    }


}