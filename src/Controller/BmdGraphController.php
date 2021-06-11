<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BmdGraphController extends AbstractController
{
    /**
     * @Route("/bmd/graphs", name="bmd_graphs")
     */
    public function index(): Response
    {
        return $this->render('bmd_graphs/list.html.twig', [

        ]);
    }

    /**
     * @Route("/bmd/graph/create", name="create_bmd_graph")
     */
    public function create(): Response
    {
        return $this->render('bmd_graphs/create.html.twig', [

        ]);
    }
}
