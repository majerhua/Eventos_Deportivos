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
     * @Route("/multimedia", name="multimedia")
     */
    public function multimediaAction(Request $request)
    {
        return $this->render('SudJuvenilesBundle:Web:multimedia.html.twig');
    }

    /**
     * @Route("/resultados", name="resultados")
     */
    public function resultadosAction(Request $request)
    {
        return $this->render('SudJuvenilesBundle:Web:resultados.html.twig');
    }

    /**
     * @Route("/escenarios", name="escenarios")
     */
    public function escenariosAction(Request $request)
    {
        return $this->render('SudJuvenilesBundle:Web:escenarios.html.twig');
    }    

    /**
     * @Route("/delegaciones", name="delegaciones")
     */
    public function delegacionesAction(Request $request)
    {
        return $this->render('SudJuvenilesBundle:Web:delegaciones.html.twig');
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
