<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Barber;
use App\Form\BarberType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Undocumented class
 * @Route("/api/barber", name="barber")
 */
class BarberController extends FOSRestController
{
    /**
     * @FOSRest\Post("", name="create")
     */
    public function create(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $barber = new Barber();
        $form = $this->createForm(BarberType::class, $barber);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $barber = $form->getData();
            $encoded = $encoder->encodePassword($barber->getUser(), $barber->getUser()->getPassword());
            $barber->getUser()->setPassword($encoded);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($barber);
            $entityManager->flush();
    
            return $this->handleView($this->view($form, Response::HTTP_CREATED));
        }
        
        return $this->handleView($this->view($form->createView(), Response::HTTP_BAD_REQUEST));
    }
}
