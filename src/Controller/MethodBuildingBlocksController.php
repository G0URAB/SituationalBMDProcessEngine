<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MethodBuildingBlocksController extends AbstractController
{
    /**
     * @Route("/method/building/blocks", name="method_building_blocks")
     */
    public function index(): Response
    {
        return $this->render('method_building_blocks/index.html.twig', [

        ]);
    }
}
