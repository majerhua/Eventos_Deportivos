<?php

namespace SudJuvenilesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class GaleriaFotosController extends Controller
{

    /**
     * @Route("galeria/foto/editar", name="galeriaEditarFoto")
     * @Method({"POST","GET"})
     */
    public function editarFotogaleriaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $tituloFoto = $request->get('editTituloFoto');
        $fechaFoto = $request->get('editFechaFoto');
        $descripcionFoto = $request->get('editDescripcionFoto');
        $fotoGaleriaId = $request->get('editFotodoGaleriaId');

        $usuario = $this->getUser();
        $usuarioId = $usuario->getId();

        $file = $request->files;

        $idDoc = date('Y-m-d-H-i-s');
        $rutaDocumento = "assets/Galeria/$idDoc/";

        $fileFoto = $file->get("editFileFoto");

        if(!empty($fileFoto)){
            $fileNameFoto = $tituloFoto.'.'.$fileFoto->guessExtension();
            $rutaFotoAll = $rutaDocumento.$fileNameFoto;
        }else{
            $rutaFotoAll = NULL;
        }

        $estadoModificar =  $em->getRepository('SudJuvenilesBundle:GaleriaFotos')->modificarFotoGaleria($tituloFoto,$fechaFoto, $rutaFotoAll, $usuarioId, $descripcionFoto,$fotoGaleriaId); 

        if($estadoModificar == 1 ){

            if(!empty($rutaFotoAll))
                $fileFoto->move($rutaDocumento, $fileNameFoto);
           
        }

        return new JsonResponse($estadoModificar); 
    }


    /**
     * @Route("galeria/foto/eliminar", name="galeriaEliminarFoto")
     * @Method({"POST","GET"})
     */
    public function eliminarFotogaleriaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $galeriaFotId = $request->get('galeriaFotId');

        $usuario = $this->getUser();
        $usuarioId = $usuario->getId();

        $estadoEliminar =  $em->getRepository('SudJuvenilesBundle:GaleriaFotos')->eliminarFotoGaleria($galeriaFotId,$usuarioId); 

        return new JsonResponse($estadoEliminar); 
    }

	/**
     * @Route("panel/galeria/fotos", name="galeria")
     */
    public function galeriaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $usuario = $this->getUser();
        $username = $usuario->getUsername();

        $periodoActivoId = $em->getRepository('SudJuvenilesBundle:Periodo')->getIdPeriodoActivo();
        $galeriaFotos =  $em->getRepository('SudJuvenilesBundle:GaleriaFotos')->mostrarFotoGaleria($periodoActivoId); 
 
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $galeriaFotos,
                $request->query->getInt('page', 1),
                6
        );

        return $this->render( 'SudJuvenilesBundle:Intranet:intranet-galeria.html.twig',array('username'=>$username,'pagination'=>$pagination) );
    }


    /**
     * @Route("galeria/fotos/registrar", name="galeriaRegistrarFoto")
     * @Method({"POST","GET"})
     */
    public function registrarFotogaleriaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $tituloFoto = $request->get('tituloFoto');
        $fechaFoto = $request->get('fechaFoto');
        $descripcionFoto = $request->get('descripcionFoto');

        $usuario = $this->getUser();
        $usuarioId = $usuario->getId();
        $periodoId = $usuario->getDelegacionId()->getPeriodoId();

        $file = $request->files;

        $idDoc = date('Y-m-d-H-i-s');
        $rutaDocumento = "assets/Galeria/$idDoc/";

        $fileFoto = $file->get("fileFoto");
        $fileNameFoto = $tituloFoto.'.'.$fileFoto->guessExtension();
        $rutaFotoAll = $rutaDocumento.$fileNameFoto;

        $estadoRegistro =  $em->getRepository('SudJuvenilesBundle:GaleriaFotos')->registrarFotoGaleria($tituloFoto,$fechaFoto, $rutaFotoAll, $usuarioId, $descripcionFoto,$periodoId); 

        if($estadoRegistro == 1 ){
           $fileFoto->move($rutaDocumento, $fileNameFoto);
        }

        return new JsonResponse($estadoRegistro); 
    }


    /**
     * @Route("galeria/foto/obtener", name="galeriaObtenerFoto")
     * @Method({"POST","GET"})
     */
    public function obtenerFotogaleriaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $galeriaFotoId = $request->get('galeriaFotoId');

        $fotoGaleria =  $em->getRepository('SudJuvenilesBundle:GaleriaFotos')->obtenerResultadoGaleria($galeriaFotoId); 

        $encoders = array(new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
              return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($fotoGaleria,'json');

        return new JsonResponse($jsonContent); 
    }

}
