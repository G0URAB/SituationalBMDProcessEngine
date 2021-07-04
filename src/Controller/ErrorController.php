<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController{

    /**
     * @Route("/error", name="error")
     * @param $exception
     * @param SessionInterface $session
     * @return Response
     */
    public function show($exception, SessionInterface $session)
    {
        return $this->render('error/index.html.twig', [
            'exception' => [
                'message' => $exception->getMessage(),
                'code' => $exception->getStatusCode(),
            ],
            'id'=>$session->get('id')
        ]);
    }
}