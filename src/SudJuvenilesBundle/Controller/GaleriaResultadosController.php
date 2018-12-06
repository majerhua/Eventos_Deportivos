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


class GaleriaResultadosController extends Controller
{

    /**
     * @Route("galeria/resultados/editar", name="galeriaEditarResultado")
     * @Method({"POST","GET"})
     */
    public function editarResultadogaleriaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $tituloResultado = $request->get('editTituloResultado');
        $fechaResultado = $request->get('editFechaResultado');
        $disciplinaResultado = $request->get('editDisciplinaResultado');
        $descripcionResultado = $request->get('editDescripcionResultado');
        $resultadoGaleriaId = $request->get('editResultadoGaleriaId');


        $usuario = $this->getUser();
        $usuarioId = $usuario->getId();

        $file = $request->files;

        $idDoc = date('Y-m-d-H-i-s');
        $rutaDocumento = "assets/Resultado/$idDoc/";

        $fileResultado = $file->get("editFileResultado");

        if(!empty($fileResultado)){
            $fileNameResultado = $disciplinaResultado.'_'.$idDoc.'.'.$fileResultado->guessExtension();
            $rutaResultadoAll = $rutaDocumento.$fileNameResultado;
        }else{
            $rutaResultadoAll = NULL;
        }

        $estadoModificar =  $em->getRepository('SudJuvenilesBundle:GaleriaResultados')->modificarResultadoGaleria($tituloResultado,$fechaResultado, $rutaResultadoAll, $usuarioId, $descripcionResultado,$disciplinaResultado,$resultadoGaleriaId); 

        if($estadoModificar == 1 ){

            if(!empty($rutaResultadoAll))
                $fileResultado->move($rutaDocumento, $fileNameResultado);
           
        }

        return new JsonResponse($estadoModificar); 
    }


	/**
     * @Route("panel/galeria/resultados", name="galeriaResultados")
     */
    public function galeriaResultadosAction(Request $request)
    {
        $tipoUsuario = $this->container->getParameter('tipoUsuario');
        $em = $this->getDoctrine()->getManager();

        $periodoActivoId = $em->getRepository('SudJuvenilesBundle:Periodo')->getIdPeriodoActivo();

        $disciplinas = $em->getRepository('SudJuvenilesBundle:Disciplina')->getDisciplinas($periodoActivoId);

        $usuario = $this->getUser();
        $username = $usuario->getUsername();
        $tipoUsuarioId = $usuario->getTipoUsuarioId()->getId();

        if($tipoUsuarioId == $tipoUsuario['delegacion']){ //USUARIO DELEGACION

            $delegacionId = $usuario->getDelegacionId()->getId();
            return $this->redirectToRoute('delegacion',array('delegacionId'=>$delegacionId));
        }else if($tipoUsuarioId == $tipoUsuario['acreditador']) {

            $delegacionId = $usuario->getDelegacionId()->getId();
            return $this->redirectToRoute('panel-delegaciones');
        }

        $galeriaResultados =  $em->getRepository('SudJuvenilesBundle:GaleriaResultados')->mostrarResultadosGaleria($periodoActivoId); 
 
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                 $galeriaResultados,
                $request->query->getInt('page', 1),
                 6
        );

        return $this->render('SudJuvenilesBundle:Intranet:intranet-resultados.html.twig',array('username' => $username,'disciplinas' => $disciplinas,'pagination'=>$pagination ));
    }

 	/**
     * @Route("galeria/resultados/registrar", name="galeriaRegistrarResultado")
     * @Method({"POST","GET"})
     */
    public function registrarResultadogaleriaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $tituloResultado = $request->get('tituloResultado');
        $fechaResultado = $request->get('fechaResultado');
        $disciplinaResultado = $request->get('disciplinaResultado');
        $descripcionResultado = $request->get('descripcionResultado');

        $usuario = $this->getUser();
        $usuarioId = $usuario->getId();
        $periodoId = $usuario->getDelegacionId()->getPeriodoId();

        $file = $request->files;

        $idDoc = date('Y-m-d-H-i-s');
        $rutaDocumento = "assets/Resultado/$idDoc/";

        $fileResultado = $file->get("fileResultado");
        $fileNameResultado = $disciplinaResultado.'_'.$idDoc.'.'.$fileResultado->guessExtension();
        $rutaResultadoAll = $rutaDocumento.$fileNameResultado;

        $estadoRegistro =  $em->getRepository('SudJuvenilesBundle:GaleriaResultados')->registrarResultadoGaleria($tituloResultado,$fechaResultado, $rutaResultadoAll, $usuarioId, $descripcionResultado,$disciplinaResultado,$periodoId); 


        if($estadoRegistro == 1 ){
           $fileResultado->move($rutaDocumento, $fileNameResultado);
        }

        return new JsonResponse($estadoRegistro); 
    }

    /**
     * @Route("galeria/resultados/eliminar", name="galeriaEliminarResultado")
     * @Method({"POST","GET"})
     */
    public function eliminarResultadogaleriaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $galeriaResultId = $request->get('galeriaResultId');


        $usuario = $this->getUser();
        $usuarioId = $usuario->getId();


        $estadoEliminar =  $em->getRepository('SudJuvenilesBundle:GaleriaResultados')->eliminarResultadoGaleria($galeriaResultId,$usuarioId); 

        return new JsonResponse($estadoEliminar); 
    }

    /**
     * @Route("galeria/resultados/obtener", name="galeriaObtenerResultado")
     * @Method({"POST","GET"})
     */
    public function obtenerResultadogaleriaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $galeriaResultId = $request->get('galeriaResultId');

        $resultadoGaleria =  $em->getRepository('SudJuvenilesBundle:GaleriaResultados')->obtenerResultadoGaleria($galeriaResultId); 

        $encoders = array(new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
              return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($resultadoGaleria,'json');

        return new JsonResponse($jsonContent); 
    }

}
