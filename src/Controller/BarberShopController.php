<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Undocumented class
 * @Route("/api/barber-shop", name="barber_shop")
 */
class BarberShopController extends FOSRestController
{
    /**
     * @FOSRest\Get("", name="get_all")
     */
    public function index()
    {
        return $this->handleView($this->view('sucess!'));
    }
}
