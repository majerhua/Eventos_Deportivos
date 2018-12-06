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

class WebController extends Controller
{

    /**
     * @Route("/",name="inicio")
     */
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $periodoActivoId = $em->getRepository('SudJuvenilesBundle:Periodo')->getIdPeriodoActivo();
        $galeriaFotos =  $em->getRepository('SudJuvenilesBundle:GaleriaFotos')->mostrarFotoGaleria($periodoActivoId);
        $galeriaVideos =  $em->getRepository('SudJuvenilesBundle:GaleriaVideos')->mostrarVideosGaleria($periodoActivoId);  

        return $this->render('SudJuvenilesBundle:Web:index.html.twig',array('galeriaFotos'=>$galeriaFotos,'galeriaVideos'=>$galeriaVideos) );
    }

    /**
     * @Route("/agenda", name="agenda")
     */
    public function agendaAction(Request $request)
    {
        return $this->render('SudJuvenilesBundle:Web:agenda.html.twig');
    }

    /**
     * @Route("/multimedia/fotos", name="multimediaFotos")
     */
    public function multimediaFotosAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        
        $periodoActivoId = $em->getRepository('SudJuvenilesBundle:Periodo')->getIdPeriodoActivo();
        $galeriaFotos =  $em->getRepository('SudJuvenilesBundle:GaleriaFotos')->mostrarFotoGaleria($periodoActivoId); 
 
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $galeriaFotos,
                $request->query->getInt('page', 1),
                6
        );

        return $this->render( 'SudJuvenilesBundle:Web:multimedia_fotos.html.twig',array('pagination'=>$pagination) );
    }


    /**
     * @Route("/multimedia/videos", name="multimediaVideos")
     */
    public function multimediaVideosAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $periodoActivoId = $em->getRepository('SudJuvenilesBundle:Periodo')->getIdPeriodoActivo();
        $galeriaVideos =  $em->getRepository('SudJuvenilesBundle:GaleriaVideos')->mostrarVideosGaleria($periodoActivoId); 
 
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $galeriaVideos,
                $request->query->getInt('page', 1),
                6
        );

        return $this->render( 'SudJuvenilesBundle:Web:multimedia_videos.html.twig',array('pagination'=>$pagination) );
    }

    /**
     * @Route("/resultados", name="resultados")
     */
    public function resultadosAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $periodoActivoId = $em->getRepository('SudJuvenilesBundle:Periodo')->getIdPeriodoActivo();
        $disciplinas = $em->getRepository('SudJuvenilesBundle:Disciplina')->getDisciplinas($periodoActivoId);

        $galeriaResultados =  $em->getRepository('SudJuvenilesBundle:GaleriaResultados')->mostrarResultadosGaleria($periodoActivoId); 
        $pagination = $galeriaResultados;

        return $this->render('SudJuvenilesBundle:Web:resultados.html.twig', array( 'disciplinas'=>$disciplinas,'pagination'=>$pagination ) );
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

        $em = $this->getDoctrine()->getManager();
        $periodoId = $em->getRepository('SudJuvenilesBundle:Delegacion')->getPeriodoIdActivo();

        $delegaciones = $em->getRepository('SudJuvenilesBundle:Delegacion')->getDelegacionesWeb($periodoId);
        return $this->render('SudJuvenilesBundle:Web:delegaciones.html.twig',array('delegaciones'=>$delegaciones));
    }
	
}
