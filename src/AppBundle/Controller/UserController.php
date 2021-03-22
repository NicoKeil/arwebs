<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
class UserController extends Controller
{
    /**
     * @Route("/register", name="user_register")
     */
    public function register(Request $request )
    {
       $user = new User();
      $form = $this->createFormBuilder($user)
       ->add('username', TextType::class, array(
        'label' => 'Nombre'
      ))
      ->add('email', EmailType::class, array(
        'label' => 'Correo electrónico'
      ))
      ->add('password', PasswordType::class, array(
        'label' => 'Constaseña'
      ))
      ->add('submit', SubmitType::class, array(
        'label' => 'Registrarse'
      ))
      ->getForm();
      

      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user, $user->getPassword());
        $user->setPassword($encoded);
        $em = $this->getDoctrine()->getManager();

        $em->persist($user);
         $em->flush();

        return new Response('Saved new product with id '.$user->getId());
      }
        // $user_repo = $this->getDoctrine()->getRepository('AppBundle:User');
        // $users = $user_repo->findAll();
        // foreach($users as $user){
        //   echo $user->getUsername();
        // };
        // replace this example code with whatever you need
        return $this->render('user/register.html.twig', [
           'form' => $form->createView(),
        ] 
        );
    }



    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
      $authenticationUtils = $this->get('security.authentication_utils');

    // get the login error if there is one
    $error = $authenticationUtils->getLastAuthenticationError();

    // last username entered by the user
    $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render('user/login.html.twig', array(
        'last_username' => $lastUsername,
        'error'         => $error,
    ));
    }

}
