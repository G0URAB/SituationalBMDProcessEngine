<?php

namespace App\Controller;

use App\Entity\BmdGraph;
use App\Entity\ProcessKind;
use App\Entity\SituationalFactor;

use App\Form\BmdGraphType;
use App\Service\FormHelperService;
use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
                    $obj->nodes = $graph->getNodes();
                    $obj->edges = $graph->getEdges();
                    $obj->situationalFactors = $graph->getImplodedSituationalFactors();
                    $matchingGraphs[] = $obj;
                }

            }
        }
        return new JsonResponse(['status' => "ok", 'graphs' => $matchingGraphs]);
    }

    /**
     * @Route("/construct/method/{id?}", name="construct_method")
     * @param Request $request
     * @param SessionInterface $session
     * @param FormHelperService $formHelperService
     * @param $id
     * @return Response
     */
    public function construct(Request $request, SessionInterface $session, FormHelperService $formHelperService,$id): Response
    {
        $submittedToken = $request->request->get('token');

        $bmdGraph = $this->getDoctrine()->getRepository(BmdGraph::class)->find($id);
        $form = $this->createForm(BmdGraphType::class, $bmdGraph, ['situationalChoices' => $formHelperService->getSituationalChoices()]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$this->isCsrfTokenValid('bmd-graph', $submittedToken)) {
                $form->addError(new FormError("Looks like this form has been hacked!!"));
                return $this->render('bmd_graphs/update.html.twig', [
                    'processTypes' => $formHelperService->getAllProcessTypes(),
                    'situationalFactors' => $formHelperService->getSituationalChoices(),
                    'form' => $form->createView()
                ]);
            }

            $bmdGraph = $formHelperService->processBMDGraph($bmdGraph, $session->get("nodes"), $session->get("edges"));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bmdGraph);
            $entityManager->flush();
            return $this->redirectToRoute("bmd_graphs");
        }

        return $this->render("method_construction/construct.html.twig", [
            'processTypes' => $formHelperService->getAllProcessTypes(),
            'form' => $form->createView(),
            'graph'=>$bmdGraph
        ]);
    }



}
