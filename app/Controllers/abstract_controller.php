<?php

namespace App\Controllers;

use App\Controllers\EntityManagerInterface;
use App\Utils\DataSaver;
use Doctrine\Persistence\ObjectManager;
use App\Controllers\participants_controller;

use Dompdf\Dompdf;
use Dompdf\Options;

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

    protected function generatePdf($htmlContent, $outputFilename)
    {
        // Create an instance of Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);

        // Load HTML content into Dompdf
        $dompdf->loadHtml($htmlContent);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF (stream or save to file)
        $dompdf->render();

        // Output the PDF (e.g., save to a file or stream to the browser)
        $dompdf->stream($outputFilename, ['Attachment' => 0]);
    }

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    protected function saveEntity($entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function mainDisplay($controllerClassName, $userId, $subListId = null, $subListClass = null, $sortBy = null, $sortOrder = null, $outputType = null, $templateDir = null, $showInactive = 'false')
    {
        $modelClassName = $this->namespace . '\\' . ucfirst($controllerClassName);
        // namespace is from $namespace setting in abstract_controller

        $metadata = $this->em->getClassMetadata($modelClassName);
        $hasInactiveFlagField = $metadata->hasField('inactive');

        if ($subListId !== null) {
            // Fetch assessments for the specified participant
            $subListClass = $this->namespace . '\\' . ucfirst($subListClass);
            $subListItem = $this->em->getRepository($subListClass)->find($subListId);
            if (!$subListItem) {
                // Handle the case where the participant with the given ID doesn't exist
                // You can return an error or display a message as needed
                // Example: throw new NotFoundHttpException('Participant not found');
            }
            // Get the assessments associated with the participant
            $dataToDisplay = $subListItem->getAssessments();
        } else {
            if (!$userId) {
                $dataToDisplay = $this->beforeDisplayExit($this->em->getRepository($modelClassName)->findAll());
            }
            else {
                // next: check for inactive flag, if has one check for that
                if ($hasInactiveFlagField) { // This has inactive flag field
                    // Construct the filter array conditionally
                    $filter = ['userID' => $userId];
                    if ($showInactive === 'true') {
                        $filter['inactive'] = ['on', null];
                    } else {
                        $filter['inactive'] = null;
                    }
                    // show only actives, if 'showinactive' is false (by default) do not show if 'inactive' is 'ON'
                    $dataToDisplay = $this->beforeDisplayExit(
                        $this->em->getRepository($modelClassName)
                            ->findBy(
                                $filter,
                                $sortBy ? [$sortBy => $sortOrder] : []
                            )
                    );
                }
                else { // this has no inacive flag fields
                $dataToDisplay = $this->beforeDisplayExit(
                    $this->em->getRepository($modelClassName)
                        ->findBy([
                            'userID' => $userId,
                        ],
                            $sortBy ? [$sortBy => $sortOrder] : []));
                }
            }
        }

        // set the template directory to classname, or what was passed
        if (is_null($templateDir)) {
            // If null, set it to $controllerClassName
            $templateDir = $controllerClassName;
        }
        $templateToDisplay = $templateDir.'\\'.$controllerClassName.'_main.twig';
        $arrayKey = $controllerClassName; // You can set this key dynamically
        //$navHeader = ucfirst($controllerClassName." list");
        $navHeader = ucwords(str_replace('_', ' ', $controllerClassName)." list");

        $templateData = [$arrayKey => $dataToDisplay, 'outputType' => $outputType,'navHeader' => $navHeader, 'inactives' => $showInactive];
            // example of this is: ['participants' => $dataToDisplay]
        $htmlContent = renderTemplate($templateToDisplay, $templateData, $outputType);
        if ($outputType === "PDF") {
            $this->generatePdf($htmlContent,'example.pdf');
        }
        //return renderTemplate($templateToDisplay, $templateData);
    }
    public function manageItem($em,$id = null,$controllerClassName = null, $outputType = null, $templateDir = null)
    {
        $dataToDisplay = null;
        $modelClassName = $this->namespace . '\\' . ucfirst($controllerClassName);

        // getting main model data to display, set up array for TWIG
        if ($id !== null & $id !== '') {
            $dataToDisplay = $this->em->getRepository($modelClassName)->find($id);

            if ($controllerClassName === 'visits') {
                $formattedDate = $dataToDisplay->getDate()->format('Y-m-d H:i');

                // Replace the 'assessment.date' property value with the formatted date string
                $dataToDisplay->setDate($formattedDate);
            }

            if ($controllerClassName === 'blood_pressures') {
                $formattedDate = $dataToDisplay->getBloodPressureDate()->format('Y-m-d H:i');

                // Replace the 'assessment.date' property value with the formatted date string
                $dataToDisplay->setBloodPressureDate($formattedDate);
            }

            if ($controllerClassName === 'creatinines') {
                $formattedDate = $dataToDisplay->getCreatinineDate()->format('Y-m-d H:i');

                // Replace the 'assessment.date' property value with the formatted date string
                $dataToDisplay->setCreatinineDate($formattedDate);
            }

            if ($controllerClassName === 'a1cs') {
                $formattedDate = $dataToDisplay->getA1cDate()->format('Y-m-d H:i');

                // Replace the 'assessment.date' property value with the formatted date string
                $dataToDisplay->setA1cDate($formattedDate);
            }

            if ($controllerClassName === 'cholesterols') {
                $formattedDate = $dataToDisplay->getCholesterolDate()->format('Y-m-d H:i');

                // Replace the 'assessment.date' property value with the formatted date string
                $dataToDisplay->setCholesterolDate($formattedDate);
            }

            if ($controllerClassName === 'procedures') {
                $formattedDate = $dataToDisplay->getProcedureDate()->format('Y-m-d');

                // Replace the 'assessment.date' property value with the formatted date string
                $dataToDisplay->setProcedureDate($formattedDate);
            }
            if ($controllerClassName === 'weights') {
                $formattedDate = $dataToDisplay->getWeightDate()->format('Y-m-d');

                // Replace the 'assessment.date' property value with the formatted date string
                $dataToDisplay->setWeightDate($formattedDate);
            }

        }
        $arrayKey = $controllerClassName; // You can set this key dynamically
        $navHeader = $controllerClassName." list";

        $templateData = [$arrayKey => $dataToDisplay,'outputType' => $outputType, 'navHeader' => $navHeader];

        //This returns any drop down lists this model needs in ['contactList' => $contacts] format
        // check out participants_controller example, it gets a list of contacts for responsible party
        $dropDownLists = $this->getDropDowns();

        //combine the models array with any drop down lists arrays
        if ($dropDownLists !== null) {
            $templateData = array_merge($templateData, $dropDownLists);
        }

        // set the template directory to classname, or what was passed
        if (is_null($templateDir)) {
            // If null, set it to $controllerClassName
            $templateDir = $controllerClassName;
        }
        $templateToDisplay = $templateDir.'\\'.$controllerClassName.'Details.twig';
        $htmlContent = renderTemplate($templateToDisplay, $templateData, $outputType);
        if ($outputType === "PDF") {
            $this->generatePdf($htmlContent,'example.pdf');
        }             //return renderTemplate($templateToDisplay, $templateData);
    }
    public function saveItem($em,$controllerClassName, $userId, $id = null)  //save new and existing
    {
        $modelClassName = $this->namespace.'\\'.ucfirst($controllerClassName);
        $dataToSave = new $modelClassName;
        $dataSaver = new DataSaver($em);
        $dataToSave = $this->movePostDataToFields($dataToSave, $userId, $em);
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
        $entityClassName = $namespace.'\\'.ucfirst($controller);
        $dataSaver = new DataSaver($em);
        $CopyFromItem = $this->em->find($entityClassName,$id);
        $testVariable = $CopyFromItem::class;
        //above - getting fully qalified class name FQCN
        $dataSaver->saveData($entityClassName,$CopyFromItem);
    }

    public function deleteItem($em,$controller,$id, $templateDir = null)
    {
        $namespace = $this->namespace;
        $entityClassName = $namespace.'\\'.ucfirst($controller);
        $dataSaver = new DataSaver($em);
        //$deleteItem = $this->em->find($entityClassName,$id);
        $dataSaver->deleteData($entityClassName,$id);
        // set the template directory to classname, or what was passed
        if (is_null($templateDir)) {
            // If null, set it to $controllerClassName
            $templateDir = $controller;
        }
        $templateToDisplay = $templateDir.'\\'.$controller.'_main.twig';
        //return renderTemplate($templateToDisplay, ['participantsController' => $participants->getParticipantsList()]);
    }

    Public function getDropDowns()
    {
        return null;
    }
    public function beforeDisplayExit($dataToDisplay): array {
        return $dataToDisplay;
    }

}