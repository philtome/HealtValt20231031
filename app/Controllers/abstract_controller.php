<?php

namespace App\Controllers;

use App\Controllers\EntityManagerInterface;
use App\Utils\DataSaver;
use Doctrine\Persistence\ObjectManager;

abstract class abstract_controller
{

    protected string $namespace = 'App\Models';
    // note that this is refreences as just namespace in this and children controllers
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

    public function mainDisplay($controllerClassName)
    {
        $modelClassName = $this->namespace.'\\'.ucfirst($controllerClassName);
            // namespace is from $namespace setting in abstract_controller
        $dataToDisplay = $this->em->getRepository($modelClassName)->findAll();
        $templateToDisplay = $controllerClassName.'\\'.$controllerClassName.'_main.twig';

        $arrayKey = $controllerClassName; // You can set this key dynamically
        $templateData = [$arrayKey => $dataToDisplay];
            // example of this is: ['participants' => $dataToDisplay]
        return renderTemplate($templateToDisplay, $templateData);
    }
    public function manageItem($id,$controllerClassName)
    {
        $modelClassName = $this->namespace.'\\'.ucfirst($controllerClassName);
        $dataToDisplay = $this->em->getRepository($modelClassName)->find($id);
        $arrayKey = $controllerClassName; // You can set this key dynamically
        $templateData = [$arrayKey => $dataToDisplay];
        $templateToDisplay = $controllerClassName.'\\'.$controllerClassName.'Details.twig';
        return renderTemplate($templateToDisplay, $templateData);
    }
    public function saveItem($em,$controllerClassName, $id = null)  //save new and existing
    {
        $modelClassName = $this->namespace.'\\'.$controllerClassName;
        $dataSaver = new DataSaver($em);
        $dataToSave = $this->movePostDataToFields($_POST);
        //$templateToDisplay = $controllerClassName.'\\'.$controllerClassName.'_main.twig';
        if ($id !== null & $id !== "") {
            $dataSaver->updateData($modelClassName,$dataToSave, $id);
        }
        else {
            $dataSaver->saveData($modelClassName,$dataToSave);
        }
        //return renderTemplate($templateToDisplay, ['participantsController' => $participants->getParticipantsList()]);
        //return renderTemplate('contacts\contactsDetails.twig', ['contact' => $contactDetails]);
    }


}