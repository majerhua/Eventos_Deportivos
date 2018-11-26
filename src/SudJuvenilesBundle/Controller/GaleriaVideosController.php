<?php

namespace SudJuvenilesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class GaleriaVideosController extends Controller
{

    /**
     * @Route("galeria/video/editar", name="galeriaEditarVideo")
     * @Method({"POST","GET"})
     */
    public function editarVideoGaleriaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $videoGaleriaId = $request->get('editVideoGaleriaId');
        $linkVideo = $request->get('editLinkVideo');
        $fechaVideo = $request->get('editFechaVideo');

        $usuario = $this->getUser();
        $usuarioId = $usuario->getId();

        $estadoModificar =  $em->getRepository('SudJuvenilesBundle:GaleriaVideos')->modificarVideoGaleria($videoGaleriaId,$linkVideo,$usuarioId ,$fechaVideo); 

        return new JsonResponse($estadoModificar); 
    }

 	/**
     * @Route("/panel/galeria/videos", name="videos")
     */
    public function galeriaVideosAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = $this->getUser();
        $username = $usuario->getUsername();

        $galeriaVideos =  $em->getRepository('SudJuvenilesBundle:GaleriaVideos')->mostrarVideosGaleria(); 
 
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $galeriaVideos,
                $request->query->getInt('page', 1),
                6
        );
        return $this->render( 'SudJuvenilesBundle:Intranet:intranet-videos.html.twig',array( 'username' => $username,'pagination' => $pagination ) );
    }


    /**
     * @Route("galeria/video/eliminar", name="eliminarVideoGaleria")
     * @Method({"POST","GET"})
     */
    public function eliminarVideoGaleriaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $galeriaVideoId = $request->get('galeriaVideoId');

        $usuario = $this->getUser();
        $usuarioId = $usuario->getId();


        $estadoEliminar =  $em->getRepository('SudJuvenilesBundle:GaleriaVideos')->eliminarVideoGaleria($galeriaVideoId,$usuarioId); 

        return new JsonResponse($estadoEliminar); 
    }


    /**
     * @Route("galeria/video/registrar", name="galeriaRegistrarVideo")
     * @Method({"POST","GET"})
     */
    public function registrarVideogaleriaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $linkVideo = $request->get('linkVideo');
        $fechaVideo = $request->get('fechaVideo');

        $usuario = $this->getUser();
        $usuarioId = $usuario->getId();

        $estadoRegistro =  $em->getRepository('SudJuvenilesBundle:GaleriaVideos')->registrarVideoGaleria($linkVideo,$fechaVideo, $usuarioId); 

        return new JsonResponse($estadoRegistro); 
    }

    /**
     * @Route("galeria/video/obtener", name="galeriaObtenerVideo")
     * @Method({"POST","GET"})
     */
    public function obtenerVideogaleriaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $galeriaVideoId = $request->get('galeriaVideoId');

        $videoGaleria =  $em->getRepository('SudJuvenilesBundle:GaleriaVideos')->obtenerVideoGaleria($galeriaVideoId); 

        $encoders = array(new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
              return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($videoGaleria,'json');

        return new JsonResponse($jsonContent); 
    }

}
