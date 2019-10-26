<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\User\UserCreateType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * Undocumented class
 * @Route("/api/user", name="user_")
 */
class UserController extends FOSRestController
{
    /**
     * @FOSRest\Get("/profile", name="get_profile")
     */
    public function index(Request $request)
    {
        return $this->handleView($this->view($this->getUser()));
    }

    /**
     * @param Request $request
     *
     * @return Response
     * @FOSRest\Post("", name="create")
    */
    public function create(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(UserCreateType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
    
            return $this->handleView($this->view($user, Response::HTTP_CREATED));
        }
        
        return $this->handleView($this->view($form, Response::HTTP_BAD_REQUEST));
    }
}
