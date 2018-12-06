<?php

namespace SudJuvenilesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DelegacionController extends Controller
{

	/**
     * @Route("/panel/delegaciones", name="panel-delegaciones")
     * @Method({"POST","GET"})
     */
    public function delegacionesAction(Request $request)
    {
        $tipoUsuario = $this->container->getParameter('tipoUsuario');

    	$em = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();

        $periodoId = $usuario->getDelegacionId()->getPeriodoId();
        $tipoUsuarioId = $usuario->getTipoUsuarioId()->getId();

    	$delegaciones = $em->getRepository('SudJuvenilesBundle:Delegacion')->getDelegaciones($periodoId);

        if($tipoUsuarioId == $tipoUsuario['delegacion']){ //USUARIO DELEGACION

            $delegacionId = $usuario->getDelegacionId()->getId();
            return $this->redirectToRoute('delegacion',array('delegacionId'=>$delegacionId));
        }else{
            $username = $usuario->getUsername();
            return $this->render('SudJuvenilesBundle:Intranet:intranet-delegaciones.html.twig',array('delegaciones'=>$delegaciones,'username'=>$username));
        }
    }

	/**
     * @Route("/panel/delegacion/{delegacionId}", name="delegacion")
     * @Method({"POST","GET"})
     */
    public function delegacionAction(Request $request,$delegacionId)
    {
    	$em = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();

    	$delegacion = $em->getRepository('SudJuvenilesBundle:Delegacion')->getDelegacionById($delegacionId);
        $disciplinasDelegacion = $em->getRepository('SudJuvenilesBundle:Delegacion')->getDisciplinasDelegacionById($delegacionId);
        $tiposParticipante = $em->getRepository('SudJuvenilesBundle:Delegacion')->getTiposParticipante();
        $paises = $em->getRepository('SudJuvenilesBundle:Pais')->getPaises();
        $participantes = $em->getRepository('SudJuvenilesBundle:Participante')->getParticipantesByDisDelegId($delegacionId);
        $modalidades = $em->getRepository('SudJuvenilesBundle:Disciplina')->getModalidades();
        $divisiones = $em->getRepository('SudJuvenilesBundle:Disciplina')->getDivisiones();
        $asignaciones = $em->getRepository('SudJuvenilesBundle:Asignacion')->getAsignaciones();
        $configuracionCondicionDocumento = $em->getRepository('SudJuvenilesBundle:Delegacion')->configuracionCondicionDocumento();
        $contadorInscritosByDelegacion = $em->getRepository('SudJuvenilesBundle:Participante')->contadorInscritosByDelegacion();

        $estadosInscripcion = $em->getRepository('SudJuvenilesBundle:Inscripcion')->estadosInscripcion();
        $tipoUsuarioId = $usuario->getTipoUsuarioId()->getId();

        $username = $usuario->getUsername();
        $roleUsuario = $usuario->getRoles()[0];

        $delegacionIdByUsuario = $usuario->getDelegacionId()->getId();

        if( $roleUsuario == "ROLE_DELEGACION"){

            if( $delegacionIdByUsuario != $delegacionId )
                return $this->render('SudJuvenilesBundle:Default:pagina_no_encontrada.html.twig' );
        }

        if( empty($delegacion) ){
            return $this->render('SudJuvenilesBundle:Default:pagina_no_encontrada.html.twig' );
        }

        return $this->render('SudJuvenilesBundle:Intranet:intranet-delegacion.html.twig',array( 'delegacion' => $delegacion[0], 'disciplinasDelegacion' => $disciplinasDelegacion, 'tiposParticipante' => $tiposParticipante,'paises'=>$paises, 'participantes' => $participantes, 'modalidades' => $modalidades,'divisiones' => $divisiones, 'asignaciones'=>$asignaciones, 'configuracionCondicionDocumento' => $configuracionCondicionDocumento,'username'=>$username,'roleUsuario'=>$roleUsuario,'delegacionId'=>$delegacionId, 'estadosInscripcion' => $estadosInscripcion, 'tipoUsuarioId' => $tipoUsuarioId,'contadorInscritosByDelegacion' => $contadorInscritosByDelegacion) );
    }

}
