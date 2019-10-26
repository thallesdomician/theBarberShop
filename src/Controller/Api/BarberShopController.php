<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Undocumented class
 * @Route("/api/barber-shop", name="barber_shop_")
 */
class BarberShopController extends FOSRestController
{
    /**
     * @FOSRest\Get("", name="get_all")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function index(Request $request)
    {
        return $this->handleView($this->view('sucess!'));
    }
}
