<?php

namespace SudJuvenilesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DelegacionController extends Controller
{

	/**
     * @Route("/panel/delegaciones", name="panel-delegaciones")
     * @Method({"POST","GET"})
     */
    public function delegacionesAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$delegaciones = $em->getRepository('SudJuvenilesBundle:Delegacion')->getDelegaciones();

        $usuario = $this->getUser();

        $tipoUsuarioId = $usuario->getTipoUsuarioId()->getId();

        if($tipoUsuarioId == 3){
            $delegacionId = $usuario->getDelegacionId()->getId();
            return $this->redirectToRoute('delegacion',array('delegacionId'=>$delegacionId));
        }else{

            return $this->render('SudJuvenilesBundle:Intranet:intranet-delegaciones.html.twig',array('delegaciones'=>$delegaciones));
        }
    }

	/**
     * @Route("/panel/delegacion/{delegacionId}", name="delegacion")
     * @Method({"POST","GET"})
     */
    public function delegacionAction(Request $request,$delegacionId)
    {
    	$em = $this->getDoctrine()->getManager();

    	$delegacion = $em->getRepository('SudJuvenilesBundle:Delegacion')->getDelegacionById($delegacionId);
        $disciplinasDelegacion = $em->getRepository('SudJuvenilesBundle:Delegacion')->getDisciplinasDelegacionById($delegacionId);
        $tiposParticipante = $em->getRepository('SudJuvenilesBundle:Delegacion')->getTiposParticipante();
        $paises = $em->getRepository('SudJuvenilesBundle:Pais')->getPaises();
        $participantes = $em->getRepository('SudJuvenilesBundle:Participante')->getParticipantesByDisDelegId($delegacionId);
        $modalidades = $em->getRepository('SudJuvenilesBundle:Disciplina')->getModalidades();
        $divisiones = $em->getRepository('SudJuvenilesBundle:Disciplina')->getDivisiones();
        $asignaciones = $em->getRepository('SudJuvenilesBundle:Asignacion')->getAsignaciones();
        $configuracionCondicionDocumento = $em->getRepository('SudJuvenilesBundle:Delegacion')->configuracionCondicionDocumento();

        if( empty($delegacion) ){
            return $this->render('SudJuvenilesBundle:Default:pagina_no_encontrada.html.twig' );
        }

        return $this->render('SudJuvenilesBundle:Intranet:intranet-delegacion.html.twig',array( 'delegacion' => $delegacion[0], 'disciplinasDelegacion' => $disciplinasDelegacion, 'tiposParticipante' => $tiposParticipante,'paises'=>$paises, 'participantes' => $participantes, 'modalidades'=>$modalidades,'divisiones'=>$divisiones, 'asignaciones'=>$asignaciones, 'configuracionCondicionDocumento' => $configuracionCondicionDocumento  ) );
    }

}
