<?php

namespace App\Controller;

use App\Entity\BmdGraph;
use App\Form\BmdGraphType;
use App\Service\DataService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class BmdGraphController extends AbstractController
{
    /**
     * @Route("/bmd/graphs", name="bmd_graphs")
     */
    public function index(): Response
    {
        $bmdGraphs = $this->getDoctrine()->getRepository(BmdGraph::class)->findAll();
        return $this->render('bmd_graphs/list.html.twig', [
            'graphs' => $bmdGraphs
        ]);
    }

    /**
     * @Route("/bmd/graph/create", name="create_bmd_graph")
     * @param Request $request
     * @param SessionInterface $session
     * @param dataService $graphService
     * @return Response
     */
    public function create(Request $request, SessionInterface $session, dataService $graphService): Response
    {
        $submittedToken = $request->request->get('token');

        $bmdGraph = new BmdGraph();
        $form = $this->createForm(BmdGraphType::class, $bmdGraph, ['situationalChoices' => $graphService->getSituationalChoices()]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$this->isCsrfTokenValid('bmd-graph', $submittedToken)) {
                $form->addError(new FormError("Looks like this form has been hacked!!"));
                return $this->render('bmd_graphs/create.html.twig', [
                    'processTypes' => $graphService->getAllProcessTypes(),
                    'situationalFactors' => $graphService->getSituationalChoices(),
                    'form' => $form->createView()
                ]);
            }

            $bmdGraph = $graphService->processBMDGraph($bmdGraph, $session->get("nodes"), $session->get("edges"));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bmdGraph);
            $entityManager->flush();
            return $this->redirectToRoute("bmd_graphs");
        }

        return $this->render('bmd_graphs/create.html.twig', [
            'processTypes' => $graphService->getAllProcessTypes(),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/bmd/graph/set_nodes", name="set_graph_nodes_in_session")
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     */
    public function setGraphNodes(Request $request, SessionInterface $session): Response
    {
        if ($request->isXmlHttpRequest()) {
            $nodes = $request->get("nodes");
            $edges = $request->get("edges");
            $session->set("nodes", $nodes);
            $session->set("edges", $edges);
            return new JsonResponse(['status' => "ok", 'nodes' => $nodes]);
        } else
            return new Response("invalid request", 400);
    }

    /**
     * @Route("/bmd/graph/show/{id?}", name="show_bmd_graph")
     * @param $id
     * @return Response
     */
    public function showGraph($id)
    {
        $bmdGraph = $this->getDoctrine()->getRepository(BmdGraph::class)->find($id);
        return $this->render("bmd_graphs/view.html.twig", [
            'graph' => $bmdGraph
        ]);
    }

    /**
     * @Route("/bmd/graph/edit/{id}", name="edit_bmd_graph")
     * @param $id
     * @param Request $request
     * @param SessionInterface $session
     * @param dataService $graphService
     * @return Response
     */
    public function editGraph($id, Request $request, SessionInterface $session, dataService $graphService)
    {
        $submittedToken = $request->request->get('token');

        $bmdGraph = $this->getDoctrine()->getRepository(BmdGraph::class)->find($id);
        $form = $this->createForm(BmdGraphType::class, $bmdGraph, ['situationalChoices' => $graphService->getSituationalChoices()]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$this->isCsrfTokenValid('bmd-graph', $submittedToken)) {
                $form->addError(new FormError("Looks like this form has been hacked!!"));
                return $this->render('bmd_graphs/update.html.twig', [
                    'processTypes' => $graphService->getAllProcessTypes(),
                    'situationalFactors' => $graphService->getSituationalChoices(),
                    'form' => $form->createView(),
                    'graph'=>$bmdGraph
                ]);
            }

            $bmdGraph = $graphService->processBMDGraph($bmdGraph, $session->get("nodes"), $session->get("edges"));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bmdGraph);
            $entityManager->flush();
            return $this->redirectToRoute("bmd_graphs");
        }

        return $this->render("bmd_graphs/update.html.twig", [
            'processTypes' => $graphService->getAllProcessTypes(),
            'form' => $form->createView(),
            'graph'=>$bmdGraph
        ]);
    }

    /**
     * @Route("/bmd/graph/delete/{id}", name="delete_bmd_graph")
     * @param int $id
     * @return RedirectResponse
     */
    public function deleteBmdGraph(int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $block = $entityManager->getRepository(BmdGraph::class)->find($id);
        $entityManager->remove($block);
        $entityManager->flush();

        return $this->redirectToRoute("bmd_graphs");
    }
}
