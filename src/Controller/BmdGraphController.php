<?php

namespace App\Controller;

use App\Entity\BmdGraph;
use App\Entity\ProcessKind;
use App\Entity\SituationalFactor;
use App\Form\BmdGraphType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @return Response
     */
    public function create(Request $request, SessionInterface $session): Response
    {
        $processTypes = $this->getDoctrine()->getRepository(ProcessKind::class)->findAll();
        $submittedToken = $request->request->get('token');

        $bmdGraph = new BmdGraph();
        $form = $this->createForm(BmdGraphType::class, $bmdGraph, ['situationalChoices' => $this->getSituationalChoices()]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$this->isCsrfTokenValid('bmd-graph', $submittedToken)) {
                $form->addError(new FormError("Looks like this form has been hacked!!"));
                return $this->render('bmd_graphs/create.html.twig', [
                    'processTypes' => $processTypes,
                    'situationalFactors' => $this->getSituationalChoices(),
                    'form' => $form->createView()
                ]);
            }

            $bmdGraph = $this->processBMDGraph($bmdGraph, $session->get("nodes"), $session->get("edges"));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bmdGraph);
            $entityManager->flush();
            return $this->redirectToRoute("bmd_graphs");
        }

        return $this->render('bmd_graphs/create.html.twig', [
            'processTypes' => $processTypes,
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
     * @Route("/bmd/graph/show/{id}", name="show_bmd_graph")
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
     * @return Response
     */
    public function editGraph($id, Request $request, SessionInterface $session)
    {
        $processTypes = $this->getDoctrine()->getRepository(ProcessKind::class)->findAll();
        $submittedToken = $request->request->get('token');

        $bmdGraph = $this->getDoctrine()->getRepository(BmdGraph::class)->find($id);
        $form = $this->createForm(BmdGraphType::class, $bmdGraph, ['situationalChoices' => $this->getSituationalChoices()]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$this->isCsrfTokenValid('bmd-graph', $submittedToken)) {
                $form->addError(new FormError("Looks like this form has been hacked!!"));
                return $this->render('bmd_graphs/update.html.twig', [
                    'processTypes' => $processTypes,
                    'situationalFactors' => $this->getSituationalChoices(),
                    'form' => $form->createView()
                ]);
            }

            $bmdGraph = $this->processBMDGraph($bmdGraph, $session->get("nodes"), $session->get("edges"));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bmdGraph);
            $entityManager->flush();
            return $this->redirectToRoute("bmd_graphs");
        }

        return $this->render("bmd_graphs/update.html.twig", [
            'processTypes' => $processTypes,
            'form' => $form->createView(),
            'graph'=>$bmdGraph
        ]);
    }

    public function getSituationalChoices()
    {
        $situationalFactors = $this->getDoctrine()->getRepository(SituationalFactor::class)->findAll();
        $situationalChoices = [];

        $situationalChoices['All Situations'] = "All Situations";
        foreach ($situationalFactors as $situationalFactor) {
            foreach ($situationalFactor->getVariants() as $variant) {
                $situationalChoices [$situationalFactor->getName() . " : " . $variant] = $situationalFactor->getName() . " : " . $variant;
            }
        }
        asort($situationalChoices);

        return $situationalChoices;
    }

    public function processBMDGraph($bmdGraph, $nodes, $edges)
    {
        $id_of_new_process_types = [];
        $id_of_old_process_types = [];
        $id_of_process_types_to_remove = [];

        foreach ($bmdGraph->getChildProcessKinds() as $processKind)
            array_push($id_of_old_process_types,$processKind->getId());

        //Add child-processes to the graph
        foreach ($nodes as $node) {
            if ($node["shape"] === "box") {
                array_push($id_of_new_process_types,$node["tableId"]);
                $childProcessType = $this->getDoctrine()->getRepository(ProcessKind::class)->find($node["tableId"]);
                $bmdGraph->addChildProcessKind($childProcessType);
            }
        }

        //find old process types that needs to be removed
        foreach ($id_of_old_process_types as $oldId) {
            if(!in_array($oldId,$id_of_new_process_types))
                array_push($id_of_process_types_to_remove,$oldId);
        }

        //Remove child-process from the graph
        foreach ($id_of_process_types_to_remove as $id)
        {
            foreach ($bmdGraph->getChildProcessKinds()->toArray() as $processType)
            {
                if($processType->getId()==$id)
                {
                    $bmdGraph->removeChildProcessKind($processType);
                }

            }
        }

        $bmdGraph->setNodes(json_encode($nodes));
        $bmdGraph->setEdges(json_encode($edges));

        return $bmdGraph;
    }
}
