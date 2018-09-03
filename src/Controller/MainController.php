<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class MainController extends AbstractController
{
    /**
     * @Route("/{user}", name="homepage")
     */
    public function index(Request $request, $user=null, AuthenticationUtils $authenticationUtils)
    {	
    	 // get the login error if there is one
	    $error = $authenticationUtils->getLastAuthenticationError();

	    // last username entered by the user
	    $lastUsername = $authenticationUtils->getLastUsername();
	    
        return $this->render('home/index.html.twig', [
            'user' => $user,
            'last_username' => $lastUsername,
	        'error'         => $error,
        ]);
    }


    /**
     * @Route("/user/register", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {   
        $user = new User();
        // Form Constructor
        $form = $this->createForm(UserType::class, $user);

        // Recive info
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('homepage', ['user' => 'created']);
        }

        return $this->render('home/register.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}
