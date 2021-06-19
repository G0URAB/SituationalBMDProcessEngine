<?php

namespace App\Controller;

use App\Entity\Artifact;
use App\Entity\MethodBuildingBlock;
use App\Entity\Process;
use App\Entity\SituationalFactor;
use App\Form\MethodBuildingBlockType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MethodBuildingBlocksController extends AbstractController
{
    /**
     * @Route("/method/building/blocks", name="method_building_blocks")
     */
    public function index(): Response
    {
        $buildingBlocks = $this->getDoctrine()->getRepository(MethodBuildingBlock::class)->findAll();

        return $this->render('method_building_blocks/index.html.twig', [
            'buildingBlocks' => $buildingBlocks
        ]);
    }

    /**
     * @Route("/method/building/blocks/create", name="create_method_building_block")
     * @param Request $request
     * @return Response
     */
    public function createMethodBuildingBlocks(Request $request): Response
    {
        if (!$request->isXmlHttpRequest()) {
            $form = $this->createForm(MethodBuildingBlockType::class, null, $this->getFormChoices());

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($form->getData());
                $entityManager->flush();

                return $this->redirectToRoute("method_building_blocks");
            }

            return $this->render("method_building_blocks/create.html.twig", [
                'form' => $form->createView()
            ]);
        } else if ($request->isXmlHttpRequest()) {
            return $this->handleAsyncRequestForProcessTypes($request);
        }
        return new Response('Invalid request', 400);
    }

    /**
     * @Route("/method/building/block/edit/{id?}", name="edit_method_building_block")
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function editMethodBuildingBlock(Request $request, int $id): Response
    {
        if (!$request->isXmlHttpRequest()) {
            $buildingBlock = $this->getDoctrine()->getRepository(MethodBuildingBlock::class)->find($id);
            $form = $this->createForm(MethodBuildingBlockType::class, $buildingBlock, $this->getFormChoices());

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($form->getData());
                $entityManager->flush();

                return $this->redirectToRoute("method_building_blocks");
            }

            $process = $buildingBlock->getProcess();

            return $this->render("method_building_blocks/update.html.twig", [
                'form' => $form->createView(),
                'processType' => $process->getParentProcessKind()
            ]);
        } else if ($request->isXmlHttpRequest()) {
            $this->handleAsyncRequestForProcessTypes($request);
        }
        return new Response('Invalid request', 400);
    }

    /**
     * @Route("/method/building/block/{id?}", name="show_method_building_block")
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function showMethodBuildingBlock(Request $request, int $id): Response
    {
        $block = $this->getDoctrine()->getRepository(MethodBuildingBlock::class)->find($id);
        return $this->render('method_building_blocks/show.html.twig', [
            'block' => $block
        ]);
    }


    public function getFormChoices()
    {
        $situationalFactors = $this->getDoctrine()->getRepository(SituationalFactor::class)->findAll();
        $artifacts = $this->getDoctrine()->getRepository(Artifact::class)->findAll();
        $situationalChoices = [];
        $artifactChoices = [];

        foreach ($artifacts as $artifact)
            $artifactChoices[$artifact->getName()] = $artifact->getName();

        $situationalChoices['All Situations'] = "All Situations";
        foreach ($situationalFactors as $situationalFactor) {
            foreach ($situationalFactor->getVariants() as $variant) {
                $situationalChoices [$situationalFactor->getName() . " : " . $variant] = $situationalFactor->getName() . " : " . $variant;
            }
        }
        asort($situationalChoices);
        asort($artifactChoices);

        return [
            'situationalChoices' => $situationalChoices,
            'artifactChoices' => $artifactChoices
        ];
    }

    public function handleAsyncRequestForProcessTypes(Request $request)
    {
        $process = $this->getDoctrine()->getRepository(Process::class)->find($request->get('id'));
        $processTypes = "";
        $processTypes .= $process->getParentProcessKind()->getName();
        if ($process) {
            foreach ($process->getOtherRelatedProcessKinds() as $processKind) {
                if (!empty($processTypes))
                    $processTypes .= ", " . $processKind->getName();
                else
                    $processTypes .= $processKind->getName();
            }
        }

        return new JsonResponse(['processTypes' => $processTypes]);
    }
}
