<?php

namespace App\Controller;

use App\Entity\BmdGraph;
use App\Entity\SituationalFactor;

use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MethodConstructionController extends AbstractController
{

    /**
     * @Route("/method/construction", name="method_construction")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        if (!$request->isXmlHttpRequest()) {
            $entityManager = $this->getDoctrine()->getManager();
            $situationalFactors = $entityManager->getRepository(SituationalFactor::class)->findAll();
            return $this->render('method_construction/index.html.twig', [
                'situationalFactors' => $situationalFactors,
            ]);
        }

        $matchingGraphs = [];
        if ($request->get('situationalFactors')) {
            $queriedFactors = $request->get("situationalFactors");
            $countOfQueriedFactors = count($queriedFactors);
            $totalGraphs = $this->getDoctrine()->getRepository(BmdGraph::class)->findAll();
            foreach ($totalGraphs as $graph) {

                $countFound = 0;
                foreach ($graph->getSituationalFactors() as $factor) {

                    if (in_array($factor, $queriedFactors)) {
                        $countFound++;
                    }
                }
                if ($countOfQueriedFactors == $countFound) {
                    $obj = new stdClass;
                    $obj->id = $graph->getId();
                    $obj->name = $graph->getName();
                    $obj->situationalFactors = $graph->getImplodedSituationalFactors();
                    $matchingGraphs[] = $obj;
                }

            }
        }


        return new JsonResponse(['status' => "ok", 'graphs' => $matchingGraphs]);
    }


}
