<?php

namespace App\Controllers;

use App\Controllers\EntityManagerInterface;
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
    public function manageItem($id,$controller)
    {
        $namespace = $this->namespace;
        $model = $namespace.'\\'.ucfirst($controller);
        $dataToDisplay = $this->em->getRepository($model)->find($id);
        $key = $controller; // You can set this key dynamically
        $templateData = [$key => $dataToDisplay];
        $templateToDisplay = $controller.'\\'.$controller.'Details.twig';
        return renderTemplate($templateToDisplay, $templateData);
    }
}