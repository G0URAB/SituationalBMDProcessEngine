<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="root_path")
     */
    public function root(): Response
    {
        if($this->getUser())
            return $this->redirectToRoute('index');
        else
            return $this->redirectToRoute('app_login');
    }


    /**
     * @Route("/index", name="index")
     */
    public function index(): Response
    {

        $notifications = [];

        foreach ($this->getUser()->getNotifications() as $notification)
        {
            $notificationDate = $notification->getDateTime();
            $today = date_create("now");
            $entityManager = $this->getDoctrine()->getManager();

            if(date_diff($today,$notificationDate)->days<15)
            {
                $notifications[] = $notification;
            }
            else
            {
                $this->getUser()->removeNotification($notification);
                $entityManager->persist($this->getUser());
            }
            $entityManager->flush();
        }

        return $this->render('index.html.twig', [
            'notifications' => $notifications
        ]);
    }


}
