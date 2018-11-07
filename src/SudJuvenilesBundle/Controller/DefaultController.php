<?php

namespace SudJuvenilesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {
        return $this->render('SudJuvenilesBundle:Web:index.html.twig');
    }

    /**
     * @Route("/agenda", name="agenda")
     */
    public function agendaAction(Request $request)
    {
        return $this->render('SudJuvenilesBundle:Web:agenda.html.twig');
    }

    /**
     * @Route("/panel",name="panel-general")
     */
    public function panelAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();

    	$tipoUsuarioId = $this->getUser()->getTipoUsuarioId()->getId();

    	if( $tipoUsuarioId == 1 ){

			$tipoUsuarioNombre = $this->getUser()->getTipoUsuarioId()->getNombre();

        	return $this->render('SudJuvenilesBundle:Intranet:intranet-menu.html.twig',array('tipoUsuario'=>$tipoUsuarioNombre));

    	}else if( $tipoUsuarioId == 3 ){

    		return $this->redirectToRoute('panel-delegaciones');
    	}

    }
}