<?php

namespace SudJuvenilesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class DefaultController extends Controller
{

    /**
     * @Route("/panel",name="panel-general")
     */
    public function panelAction(Request $request)
    {

        $tipoUsuario = $this->container->getParameter('tipoUsuario');

    	$em = $this->getDoctrine()->getManager();

        $usuario = $this->getUser();
    	$tipoUsuarioId = $usuario->getTipoUsuarioId()->getId();
        $username = $usuario->getUsername();

    	if( $tipoUsuarioId == $tipoUsuario['administrador'] ){
            
        	return $this->render('SudJuvenilesBundle:Intranet:intranet-menu.html.twig',array('username'=>$username));

    	}else if( $tipoUsuarioId == $tipoUsuario['acreditador'] ){

            return $this->redirectToRoute('panel-delegaciones');

        }else if( $tipoUsuarioId == $tipoUsuario['delegacion'] ){

    		$delegacionId = $usuario->getDelegacionId()->getId();
            return $this->redirectToRoute('delegacion',array('delegacionId'=>$delegacionId));
    	}

    }
}
