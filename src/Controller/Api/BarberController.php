<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Barber;
use App\Form\Barber\BarberUpdateType;
use App\Form\Barber\BarberCreateType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Undocumented class
 * @Route("/api/barber", name="api_barber_")
 */
class BarberController extends FOSRestController
{
    /**
     * @FOSRest\Put("/profile", name="update_profile")
     */
    public function updateProfile(Request $request)
    {
        $user = $this->getUser();
        $entityManager = $this->getDoctrine()->getManager();
        $barber = $user->getBarber();

        if (!$barber) {
            throw $this->createNotFoundException(
                'No barber found for this profile '
            );
        }

        $form = $this->createForm(BarberUpdateType::class, $barber, ['method' => 'PUT']);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $barber = $form->getData();
            $entityManager->flush();

            
            return $this->handleView($this->view($barber, Response::HTTP_CREATED));
        }
        
        return $this->handleView($this->view($form->createView(), Response::HTTP_BAD_REQUEST));
    }

    /**
     * @FOSRest\Post("", name="create")
     */
    public function create(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $barber = new Barber();
        $form = $this->createForm(BarberCreateType::class, $barber);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $barber = $form->getData();
            $encoded = $encoder->encodePassword($barber->getUser(), $barber->getUser()->getPassword());
            $barber->getUser()->setPassword($encoded);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($barber);
            $entityManager->flush();
    
            return $this->handleView($this->view($barber, Response::HTTP_CREATED));
        }
        
        return $this->handleView($this->view($form, Response::HTTP_BAD_REQUEST));
    }
}
