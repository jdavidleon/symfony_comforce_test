<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProcessController extends AbstractController
{
    /**
     * @Route("/process", name="process")
     */
    public function index()
    {
        return $this->render('process/index.html.twig', [
            'controller_name' => 'ProcessController',
        ]);
    }
}
