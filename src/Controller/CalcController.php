<?php

namespace App\Controller;

use App\Response\CalcSimple\CalcSimpleMessageResponse;
use App\Response\CalcSimple\CalcSimpleResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\CalcSimple;

class CalcController extends AbstractController
{
    #[Route(path:'/',methods: ['GET'])]
    public function show(Request $request): Response
    {
        $response = new CalcSimpleResponse(
            new CalcSimpleMessageResponse(false, ''),
            new CalcSimpleMessageResponse(true, 'Enter numbers and press Calculate'),
        );

        return $this->render('calc.html.twig', $response->toArray());
    }

    #[Route(path:'/', methods: ['POST'])]
    public function calc(Request $request, CalcSimple $calcSimple): Response
    {
        $response = new CalcSimpleResponse(
            new CalcSimpleMessageResponse(false, ''),
            new CalcSimpleMessageResponse(false, ''),
        );
        $calcSimple->setRequest($request);
        $calcSimple->setResponse($response);

        return $this->render('calc.html.twig', $calcSimple->getResponse()->toArray());
    }
}