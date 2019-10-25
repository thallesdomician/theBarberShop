<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Undocumented class
 * @Route("/api/user", name="user")
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
}
