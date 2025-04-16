<?php

namespace App\Twig\Components;

use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Type\ProjectType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\ValidatableComponentTrait;
use Symfony\Component\HttpFoundation\Response;

#[AsLiveComponent]
class ProjectForm extends AbstractController
{
    use ComponentWithFormTrait;
    use DefaultActionTrait;
    use ValidatableComponentTrait;

    #[LiveProp]
    public ?Project $initialFormData = null;

    protected function instantiateForm(): FormInterface
    {
        $this->initialFormData = new Project();

        return $this->createForm(ProjectType::class, $this->initialFormData);
    }

    #[LiveAction]
    public function save(EntityManagerInterface $em): Response
    {
        $this->validate();

        $this->submitForm();

        /** @var Project $project */
        $project = $this->getForm()->getData();

        $em->persist($project);
        $em->flush();

        return $this->redirectToRoute('project_show', [
            'keyCode' => $project->getKeyCode(),
        ]);
    }
}