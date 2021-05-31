<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MethodBaseController extends AbstractController
{

    /**
     * @Route("/methodbase", name="method_base")
     */
    public function methodBase(): Response
    {

        return $this->render('listMethodParts.html.twig', [
            'patterns' => "hmm"
        ]);
    }


}
