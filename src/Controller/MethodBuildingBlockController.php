<?php

namespace App\Controller;

use App\Entity\Artifact;
use App\Entity\BusinessModelDefinition;
use App\Entity\MethodBuildingBlock;
use App\Entity\Process;
use App\Entity\SituationalFactor;
use App\Form\BusinessModelDefinitionType;
use App\Form\MethodBuildingBlockType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MethodBuildingBlockController extends AbstractController
{
    /**
     * @Route("/method/building/blocks", name="method_building_blocks")
     */
    public function list(): Response
    {
        $buildingBlocks = $this->getDoctrine()->getRepository(MethodBuildingBlock::class)->findAll();

        return $this->render('method_building_block/list.html.twig', [
            'buildingBlocks' => $buildingBlocks
        ]);
    }

    /**
     * @Route("/method/building/block/create", name="create_method_building_block")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        if (!$request->isXmlHttpRequest()) {

            $newMethodBuildingBlock = new MethodBuildingBlock();
            $form = $this->createForm(MethodBuildingBlockType::class, $newMethodBuildingBlock, $this->getFormChoices());

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($newMethodBuildingBlock);
                $entityManager->flush();

                return $this->redirectToRoute("method_building_blocks");
            }

            return $this->render("method_building_block/create.html.twig", [
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
    public function edit(Request $request, int $id): Response
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

            return $this->render("method_building_block/edit.html.twig", [
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
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        $block = $this->getDoctrine()->getRepository(MethodBuildingBlock::class)->find($id);
        return $this->render('method_building_block/show.html.twig', [
            'block' => $block
        ]);
    }

    /**
     * @Route("/method/building/block/delete/{id?}", name="delete_method_building_block")
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $block = $entityManager->getRepository(MethodBuildingBlock::class)->find($id);
        $entityManager->remove($block);
        $entityManager->flush();

        return $this->redirectToRoute("method_building_blocks");
    }


    public function getFormChoices()
    {
        $situationalFactors = $this->getDoctrine()->getRepository(SituationalFactor::class)->findAll();
        $businessModelDefinitions = $this->getDoctrine()->getRepository(BusinessModelDefinition::class)->findAll();
        $artifacts = $this->getDoctrine()->getRepository(Artifact::class)->findAll();
        $situationalChoices = [];
        $artifactChoices = [];
        $businessComponentChoices = [];

        foreach ($artifacts as $artifact)
            $artifactChoices[$artifact->getName()] = $artifact->getName();

        foreach ($situationalFactors as $situationalFactor) {
            foreach ($situationalFactor->getVariants() as $variant) {
                $situationalChoices [$situationalFactor->getName() . " : " . $variant] = $situationalFactor->getName() . " : " . $variant;
            }
        }
        foreach ($businessModelDefinitions as $businessModelDefinition) {
            foreach ($businessModelDefinition->getComponents() as $component) {
                $businessComponentChoices [$businessModelDefinition->getType() . " : " . $component] = $businessModelDefinition->getType() . " : " . $component;
            }
        }
        asort($situationalChoices);
        asort($artifactChoices);
        asort($businessComponentChoices);

        return [
            'situationalChoices' => $situationalChoices,
            'artifactChoices' => $artifactChoices,
            'businessComponentChoices' => $businessComponentChoices
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
