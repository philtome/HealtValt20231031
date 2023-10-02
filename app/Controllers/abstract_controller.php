<?php

namespace App\Controllers;

use App\Controllers\EntityManagerInterface;
use App\Utils\DataSaver;
use Doctrine\Persistence\ObjectManager;
use App\Controllers\participants_controller;


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
    public function manageItem($em,$id,$controllerClassName)
    {
        $modelClassName = $this->namespace . '\\' . ucfirst($controllerClassName);

        // getting main model data to display, set up array for TWIG
        $dataToDisplay = $this->em->getRepository($modelClassName)->find($id);

        if ($controllerClassName === 'assessments') {
            $formattedDate = $dataToDisplay->getDate()->format('Y-m-d H:i');

            // Replace the 'assessment.date' property value with the formatted date string
            $dataToDisplay->setDate($formattedDate);
        }
        $arrayKey = $controllerClassName; // You can set this key dynamically
        $templateData = [$arrayKey => $dataToDisplay,];

        //This returns any drop down lists this model needs in ['contactList' => $contacts] format
        // check out participants_controller example, it gets a list of contacts for responsible party
        $dropDownLists = $this->getDropDowns();

        //combine the models array with any drop down lists arrays
        if ($dropDownLists !== null) {
            $templateData = array_merge($templateData, $dropDownLists);
        }

        $templateToDisplay = $controllerClassName.'\\'.$controllerClassName.'Details.twig';
        return renderTemplate($templateToDisplay, $templateData);
    }
    public function saveItem($em,$controllerClassName, $id = null)  //save new and existing
    {
        $modelClassName = $this->namespace.'\\'.$controllerClassName;
        $dataToSave = new $modelClassName;
        $dataSaver = new DataSaver($em);
        $dataToSave = $this->movePostDataToFields($dataToSave,$em);
        //$templateToDisplay = $controllerClassName.'\\'.$controllerClassName.'_main.twig';
        if ($id !== null & $id !== "") {
            $dataSaver->updateData($modelClassName,$dataToSave, $id);
        }
        else {
            $dataSaver->saveData($modelClassName,$dataToSave);
        }
    }
    public function copyItem($em,$controller,$id)
    {
        $namespace = $this->namespace;
        $entityClassName = $namespace.'\\'.$controller;
        $dataSaver = new DataSaver($em);
        $CopyFromItem = $this->em->find($entityClassName,$id);
        $testVariable = $CopyFromItem::class;
        //above - getting fully qalified class name FQCN
        $dataSaver->saveData($entityClassName,$CopyFromItem);
    }

    public function deleteItem($em,$controller,$id)
    {
        $namespace = $this->namespace;
        $entityClassName = $namespace.'\\'.$controller;
        $dataSaver = new DataSaver($em);
        //$deleteItem = $this->em->find($entityClassName,$id);
        $dataSaver->deleteData($entityClassName,$id);
        $templateToDisplay = $controller.'\\'.$controller.'_main.twig';
        //return renderTemplate($templateToDisplay, ['participantsController' => $participants->getParticipantsList()]);
    }

}