<?php

namespace App\Controller;

use App\Entity\Artifact;
use App\Entity\GenericActivity;
use App\Entity\Process;
use App\Entity\Role;
use App\Entity\SituationalFactor;
use App\Form\ProcessType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FragmentController extends AbstractController
{
    /**
     * @Route("/fragments", name="fragments")
     */
    public function index(): Response
    {
        return $this->render('fragments/index.html.twig', [
            'controller_name' => 'FragmentController',
        ]);
    }

    /**
     * @Route("/process/create", name="create_process")
     * @param Request $request
     * @return Response
     */
    public function createProcess(Request $request): Response
    {
        $process = new Process();
        $genericActivities = $this->getDoctrine()->getRepository(GenericActivity::class)->findAll();
        $roles = $this->getDoctrine()->getRepository(Role::class)->findAll();
        $artifacts = $this->getDoctrine()->getRepository(Artifact::class)->findAll();
        $situationalFactors = $this->getDoctrine()->getRepository(SituationalFactor::class)->findAll();

        $processForm = $this->createForm(ProcessType::class, $process, [
            'genericActivities' => $genericActivities,
            'roles' => $roles,
            'artifacts' => $artifacts,
            'situationalFactors' => $situationalFactors
        ]);

        $processForm->handleRequest($request);

        if ($processForm->isSubmitted() && $processForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($process);
            $entityManager->flush();
            return $this->redirectToRoute("fragments");
        }

        //Notify when a particular entity list is empty
        $message = "";

        if(empty($roles))
        {
            $message = "Please add some roles to see a list of checkboxes for roles.";
            $this->addFlash("info",$message);
        }
        if(empty($artifacts))
        {
            $message = "Please add some artifacts to see a list of checkboxes for artifacts.";
            $this->addFlash("info",$message);
        }
        if(empty($situationalFactors))
        {
            $message = "Please add some situational-factors to see a list of checkboxes for them.";
            $this->addFlash("info",$message);
        }
        if(empty($situationalFactors))
        {
            $message = "There are no generic activity. Please create at least one!!";
            $this->addFlash("info",$message);
        }


        return $this->render('fragments/processes/create.html.twig', [
            'processForm' => $processForm->createView(),
        ]);
    }
}
