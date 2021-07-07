<?php

namespace App\Controller;

use App\Entity\SituationalMethod;
use App\Entity\Task;
use App\Entity\User;
use App\Service\DataService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class MethodEnactmentController extends AbstractController
{

    /**
     * @Route("/enactments", name="enactments")
     * @param Request $request
     * @param DataService $dataService
     * @return Response
     */
    public function enactments(Request $request, DataService $dataService): Response
    {
        return $this->render("situational_method/enactments.html.twig", [
            'situationalMethods' => $dataService->getAllSituationalMethods()
        ]);
    }

    /**
     * @Route("/enactment/{id}", name="enactment")
     * @param Request $request
     * @param DataService $dataService
     * @param int $id
     * @return Response
     */
    public function enactment(Request $request, DataService $dataService, int $id): Response
    {
        $situationalMethod = $this->getDoctrine()->getRepository(SituationalMethod::class)->find($id);

        $teamMembers = [];
        foreach ($this->getDoctrine()->getRepository(User::class)->findAll() as $member) {

            if ($member->getImplodedRoles() != 'ROLE_SUPER_ADMIN' && $member->getImplodedRoles() != 'ROLE_METHOD_ENGINEER'
                && $member->getImplodedRoles() != 'ROLE_PROJECT_MANAGER')
                $teamMembers[$member->getId()]= $member->getEmployeeName()." : ".$member->getImplodedRoles();
        }

        $tools = [];
        $roles = [];
        foreach ($dataService->getAllTools() as $tool)
            $tools [$tool->getType()] = $tool->getImplodedVariants();
        foreach ($dataService->getAllRoles() as $role)
            $roles [] = $role->getName();

        return $this->render("situational_method/enactment.html.twig", [
            'situationalMethod' => $situationalMethod,
            'situationalFactors' => $dataService->getAllSituationalFactors(),
            'graphsAndTheirSituationalFactors' => $situationalMethod->getGraphsAndTheirSituationalFactors(),
            'tools' => $tools,
            'roles' => $roles,
            'teamMembers'=> $teamMembers
        ]);
    }

    /**
     * @Route("/task/update", name="task_update")
     * @param Request $request
     * @param SluggerInterface $slugger
     * @return JsonResponse|Response
     */
    public function updateTask(Request $request, SluggerInterface $slugger)
    {
        if ($request->isXmlHttpRequest()) {

            $entityManager = $this->getDoctrine()->getManager();

            if ($request->get('update_type') === 'upload_artifact') {

                $file = $request->files->get('file_name');

                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();


                // Move the file to the directory where brochures are stored
                try {
                    $file->move(
                        $this->getParameter('artifacts_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                return new JsonResponse(['status' => 'success', 'fileName' => $newFilename]);
            }

            //Update Json Tasks
            if ($request->get('update_type') == "update_jsonTasks") {

                /* @var SituationalMethod $method */
                $method = $entityManager->getRepository(SituationalMethod::class)->find($request->get('method_id'));
                $method->setJsonTasks(json_encode($request->get('tasks')));
                $entityManager->flush();

                return new JsonResponse(['status' => 'success', 'msg' => 'Json tasks for the situational method updated']);
            }

            //Delete artifact
            if($request->get('update_type')=="delete_artifact")
            {
                $method = $entityManager->getRepository(SituationalMethod::class)->find($request->get('method_id'));
                $method->setJsonTasks(json_encode($request->get('tasks')));

                $fileSystem = new Filesystem();
                $fileSystem->remove($this->getParameter('kernel.project_dir')."/public/images/artifacts/".$request->get('fileName'));

                $entityManager->flush();
                return new JsonResponse(['status' => 'success', 'msg' => 'Artifact '.$request->get('fileName')." was removed."]);
            }
        }
        return new Response("Invalid request", 400);
    }

}