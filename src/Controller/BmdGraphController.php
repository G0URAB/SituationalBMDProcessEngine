<?php

namespace App\Controller;

use App\Entity\ProcessKind;
use App\Entity\SituationalFactor;
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
        $processTypes = $this->getDoctrine()->getRepository(ProcessKind::class)->findAll();
        $situationalFactors = $this->getDoctrine()->getRepository(SituationalFactor::class)->findAll();

        return $this->render('bmd_graphs/create.html.twig', [
            'processTypes' => $processTypes,
            'situationalFactors' => $situationalFactors
        ]);
    }
}
