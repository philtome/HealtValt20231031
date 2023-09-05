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

    public function mainDisplay($controller)
    {
        $model = $this->namespace.'\\'.ucfirst($controller);
            // namespace is from $namespace setting in abstract_controller
        $dataToDisplay = $this->em->getRepository($model)->findAll();
        $templateToDisplay = $controller.'\\'.$controller.'_main.twig';

        $key = $controller; // You can set this key dynamically
        $templateData = [$key => $dataToDisplay];
            // example of this is: ['participants' => $dataToDisplay]
        return renderTemplate($templateToDisplay, $templateData);
    }

}