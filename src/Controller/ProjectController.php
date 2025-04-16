<?php

namespace App\Controller;

use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProjectController extends AbstractController
{
    #[Route('/project/{keyCode}', name: 'project_show')]
    public function show(?Project $project): Response
    {
        return $this->render('project/index', [
            'controller_name' => 'ProjectController',
        ]);
    }
}
