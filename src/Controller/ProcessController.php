<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Process;
use App\Form\ProcessType;

/**
 * @Route("/process")
 */
class ProcessController extends AbstractController
{
    /**
     * @Route("/list/{db}", name="list")
     */
    public function index(Request $request, $db = null)
    {   
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Process::class);

        $process = $repository->findAll();

        return $this->render('process/list.html.twig', [
            'process' => $process,
            'db' => $db
        ]);
    }


    /**
     * @Route("/details/{idProcess}", name="detailsProcess", requirements={"id_process"="\d+"})
     */
    public function detailsProcess(Request $request, $idProcess)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Process::class);

        $process = $repository->find($idProcess);
        $thePlace = $process->getProcessPlace()->getPlaces();

        return $this->render('process/details.html.twig', [
            'process' => $process,
        ]);
    }


    /**
     * @Route("/new", name="newProcess")
     */
    public function newProcess(Request $request)
    {   
        $process = new Process();
        // Form Constructor
        $form = $this->createForm(ProcessType::class, $process);

        // Recive info
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Fill Entity Process
            $process = $form->getData();
            $process->setDateCreate( new \DateTime('@'.strtotime('now')) );

            // Save new process
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($process);
            $entityManager->flush();

            return $this->redirectToRoute('list', ['db' => 'add']);
        }

        return $this->render('process/new.html.twig', [
            'form'=>$form->createView()
        ]);
    }


    /**
     * @Route("/edit/{idProcess}", name="editProcess")
     */
    public function editProcess(Request $request, $idProcess)
    {   
        $repository = $this->getDoctrine()->getRepository(Process::class);
        $process = $repository->find($idProcess); 

        // Form Constructor
        $form = $this->createForm(ProcessType::class, $process);

        // Recive info
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Fill Entity Process
            $process = $form->getData();

            // Save new process
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($process);
            $entityManager->flush();

            return $this->redirectToRoute('list', ['db' => 'edit']);
        }

        return $this->render('process/new.html.twig', [
            'form'=>$form->createView()
        ]);
    }


    /**
     * @Route("/listByDate/{date}", name="byDate")
     */
    public function listByDate(Request $request, $date=null)
    {   
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Process::class);

        if ($date) {
            $process = $repository->findByDateCreate($date);
        }else{
            $process = $repository->findAll();
        }

        return $this->render('process/list.html.twig', [
            'process' => $process,
            'db' => null
        ]);
    }
}
