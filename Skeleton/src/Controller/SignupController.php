<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Security\UserAuthenticator;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class SignupController extends AbstractController

{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder){
        $this->passwordEncoder;
    }

    
    /**
     * @Route("/signup", name="signup")
     */
    public function index(): Response
    {
        return $this->render('signup/index.html.twig', [
            'controller_name' => 'SignupController',
        ]);
    }



        /**
         * @Route("/save_user", name="save_user")
         */
            public function save_user(){
                return $this->render("home/save_user.html.twig");
            }











            /**
             * @Route("/encoder", name="encoder")
             */

            public function signuptreat(Request $request, UserAuthenticator $authenticator, GuardAuthenticatorHandler $guardHanddler){
               
                $datas = $request->request->all();
                $user = new user();
                $user->setEmail($datas['email']);
                $user->setPassword($this->passwordEncoder->encodePassword( 
                
                $user,
                $datas['password']

                ));
                $user->setNom($datas['nom']);
                $user->setPrix($datas['prix']);
                $user->setDescription($datas['description']);
                $user->setRoles(["role_user"]);

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();



            }






















}
