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

class ParticipanteController extends Controller
{

  /**
     * @Route("participante/get",name="participanteObtener")
     * @Method({"POST","GET"})
     */

    public function participanteObtenerAction(Request $request)
    {
      $idInscripcion = $request->get('inscripcionId');

      $em = $this->getDoctrine()->getManager();
      $participante = $em->getRepository('SudJuvenilesBundle:Participante')->getPariticipanteInscripcionById($idInscripcion);

      $encoders = array(new JsonEncoder());
      $normalizer = new ObjectNormalizer();
      $normalizer->setCircularReferenceLimit(1);
      $normalizer->setCircularReferenceHandler(function ($object) {
          return $object->getId();
      });
      $normalizers = array($normalizer);
      $serializer = new Serializer($normalizers, $encoders);
      $jsonContent = $serializer->serialize($participante,'json');
      
      return new JsonResponse($jsonContent);
    }
	/**
     * @Route("participante/registrar",name="participanteRegistrar")
     * @Method({"POST","GET"})
     */
    public function participanteRegistrarAction(Request $request)
    {

    	$em = $this->getDoctrine()->getManager();

      
        //DISCIPLINA-DELEGACION

        $disDelegId = $request->get('disDelegId');
        //

      	//PERSONA
      	$tipoDocumento = $request->get('tipoDocumento');
      	$sexoId = $request->get('sexoId');
      	$numeroDocumento = $request->get('numeroDocumento');
      	$nombre = $request->get('nombre');
      	$apellidoPaterno = $request->get('apellidoPaterno');
      	$apellidoMaterno = $request->get('apellidoMaterno');
      	$fechaNacimiento = $request->get('fechaNacimiento');
      	$correo = $request->get('correo');
      	$paisOrigenId = $request->get('paisOrigen');

      	//PARTICIPANTE
        
      	$paisRepresentaId = $request->get('paisRepresenta');
      	$tipoParticipanteId = $request->get('tipoParticipante');
      	$estadoDis = $request->get('estadoDis');

        //MODALIDADES
        $modalidades = $request->get('modalidades');

        if( !empty($modalidades) ) //SI EXISTEN MODALIDADES
          $arrayModalidades = explode(',',$modalidades);
        else
          $arrayModalidades = Array();

        //DIVISIONES
        $divisiones = $request->get('divisiones');

        if(!empty($divisiones)) //SI EXISTEN DIVISIONES
          $arrayDivisiones = explode(',',$divisiones);
        else
          $arrayDivisiones = Array();
        
      	$file = $request->files;
        $idDoc = date('Y-m-d-H-i-s');
        $rutaDocumento = "assets/Documentos/Participante/$numeroDocumento/$idDoc/";

      	//FILE DOCUMENTO IDENTIDAD
        $fileDocumentoIdentidad = $file->get("documentoIdentidad");
        $fileNameDocIdent = 'DocumentoIdentidad'.'.'.$fileDocumentoIdentidad->guessExtension();
        $rutaDocumentoIdentidadAll = $rutaDocumento.$fileNameDocIdent;

        //FILE CONSTANCIA DE ESTUDIO
        $fileConstanciaEstudio = $file->get("constEstudio");
        $fileNameConstEstud = 'ConstanciaEstudio'.'.'.$fileConstanciaEstudio->guessExtension();
        $rutaConstanciaEstudioAll = $rutaDocumento.$fileNameConstEstud;
        // 

        //FILE FICHA MEDICA VIGENTE
        $fileFichaMedicaVigente = $file->get("fichaMedicaVigente");
        $fileNameFichMed = 'FichaMedicaVigente'.'.'.$fileFichaMedicaVigente->guessExtension();
        $rutaFichaMedicaVigenteAll = $rutaDocumento.$fileNameFichMed;
        // 

        //FILE FORMULARIO INSCRIPCION
        $fileFormularioInscripcion = $file->get("formularioInscripcion");
        $fileNameFormIns = 'FormularioInscripcion'.'.'.$fileFormularioInscripcion->guessExtension();
        $rutaFormularioInscripcionAll = $rutaDocumento.$fileNameFormIns;
        //

        //FILE POLIZA DE SEGURO
        $filePolizaSeguro = $file->get("polizaSeguro");
        $fileNamePolizSeg = 'PolizaSeguro'.'.'.$filePolizaSeguro->guessExtension();
        $rutaPolizaSeguroAll = $rutaDocumento.$fileNamePolizSeg;
        //

        //FILE FOTO PERFIL
        $fileFotoPerfil = $file->get("fotoPerfil");
        $fileNameFotoPerfil = 'FotoPerfil'.'.'.$fileFotoPerfil->guessExtension();
        $rutaFotoPerfilAll = $rutaDocumento.$fileNameFotoPerfil;

        if(empty($estadoDis)){
          $estadoDis=0;
          $rutacertificadoDiscapacidad = NULL; 
        }

        $estadoRegistro =  $em->getRepository('SudJuvenilesBundle:Participante')->registrar($paisOrigenId, $tipoDocumento, $sexoId,$numeroDocumento, $nombre,$apellidoPaterno,$apellidoMaterno,$fechaNacimiento,$correo,$paisRepresentaId,$tipoParticipanteId,$rutaDocumentoIdentidadAll,$rutaConstanciaEstudioAll,$rutaFichaMedicaVigenteAll,$rutaFormularioInscripcionAll,$rutaPolizaSeguroAll,$estadoDis,$rutacertificadoDiscapacidad,$disDelegId,$rutaFotoPerfilAll,$arrayModalidades,$arrayDivisiones);        

        if($estadoRegistro == 1){//SI SE REGISTRO CORRECTAMENTE

          $fileDocumentoIdentidad->move($rutaDocumento, $fileNameDocIdent);
          $fileConstanciaEstudio->move($rutaDocumento, $fileNameConstEstud);
          $fileFichaMedicaVigente->move($rutaDocumento, $fileNameFichMed);
          $fileFormularioInscripcion->move($rutaDocumento, $fileNameFormIns);
          $filePolizaSeguro->move($rutaDocumento, $fileNamePolizSeg);
          $fileFotoPerfil->move($rutaDocumento, $fileNameFotoPerfil);
        }

        return new JsonResponse($estadoRegistro);
    }
}
