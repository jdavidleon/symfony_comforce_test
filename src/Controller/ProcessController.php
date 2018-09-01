<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/process")
 */
class ProcessController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function index()
    {
        return $this->render('process/list.html.twig', [
            'controller_name' => 'ProcessController',
        ]);
    }

    /**
     * @Route("/details/{idProcess}", name="detailsProcess", requirements={"id_process"="\d+"})
     */
    public function detailsProcess($idProcess = null)
    {
        return $this->render('process/details.html.twig', [
            'controller_name' => 'ProcessController',
        ]);
    }


    /**
     * @Route("/new", name="newProcess")
     */
    public function newProcess()
    {
        return $this->render('process/new.html.twig', [
            'controller_name' => 'ProcessController',
        ]);
    }


    /**
     * @Route("/edit/{idProcess}", name="editProcess")
     */
    public function editProcess()
    {
        return $this->render('process/edit.html.twig', [
            'controller_name' => 'ProcessController',
        ]);
    }


    /**
     * @Route("/delete/{idProcess}", name="delete")
     */
    public function deleteProcess()
    {
        return $this->render('process/edit.html.twig', [
            'controller_name' => 'ProcessController',
        ]);
    }
}
