<?php

namespace App\Controller;

use App\Entity\Artifact;
use App\Entity\GenericActivity;
use App\Entity\Process;
use App\Entity\Role;
use App\Entity\SituationalFactor;
use App\Form\ArtifactType;
use App\Form\ProcessType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FragmentController extends AbstractController
{

    private $processes;
    private $roles;
    private $artifacts;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->roles = $entityManager->getRepository(Role::class)->findAll();
        $this->artifacts = $entityManager->getRepository(Artifact::class)->findAll();
        $this->processes = $entityManager->getRepository(Process::class)->findAll();
    }


    /**
     * @Route("/fragments", name="fragments")
     */
    public function index(): Response
    {
        return $this->render('fragments/index.html.twig', [
            'artifacts' => $this->artifacts,
            'processes' => $this->processes,
            'roles' => $this->roles
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
        $processForm = $this->createForm(ProcessType::class, $process, [
            'genericActivities' => $genericActivities,
        ]);

        $processForm->handleRequest($request);

        if ($processForm->isSubmitted() && $processForm->isValid()) {
            $this->entityManager->persist($process);
            $this->entityManager->flush();
            return $this->redirectToRoute("fragments");
        }

        //Notify when a particular entity list is empty
        $message = "";

        if (empty($roles)) {
            $message = "Please add some roles to see a list of checkboxes for roles.";
            $this->addFlash("info", $message);
        }
        if (empty($artifacts)) {
            $message = "Please add some artifacts to see a list of checkboxes for artifacts.";
            $this->addFlash("info", $message);
        }
        if (empty($situationalFactors)) {
            $message = "Please add some situational-factors to see a list of checkboxes for them.";
            $this->addFlash("info", $message);
        }
        if (empty($situationalFactors)) {
            $message = "There are no generic activity. Please create at least one!!";
            $this->addFlash("info", $message);
        }


        return $this->render('fragments/processes/create.html.twig', [
            'processForm' => $processForm->createView(),
        ]);
    }

    /**
     * @Route("/role/create", name="create_role")
     * @param Request $request
     * @return Response
     */
    public function createRole(Request $request): Response
    {
        $processes = $this->getDoctrine()->getRepository(Process::class)->findAll();
        return $this->render('fragments/roles/create.html.twig',[]);
    }


    /**
     * @Route("/artifact/create", name="create_artifact")
     * @param Request $request
     * @return Response
     */
    public function createArtifact(Request $request): Response
    {
        $artifact = new Artifact();
        $artifactForm = $this->createForm(ArtifactType::class, $artifact);

        return $this->render('fragments/artifacts/create.html.twig', [
            'artifactForm' => $artifactForm->createView()
        ]);
    }


}
