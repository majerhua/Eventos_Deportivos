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
     * @Route("participante/delete",name="participanteEliminar")
     * @Method({"POST","GET"})
     */
    public function participanteEliminarAction(Request $request)
    {
      $inscripcionId = $request->get('inscripcionId');

      $em = $this->getDoctrine()->getManager();
      $estadoElim = $em->getRepository('SudJuvenilesBundle:Participante')->eliminarParticipanteInscripcion($inscripcionId);

      
      return new JsonResponse($estadoElim);
    }

  /**
     * @Route("participante/get",name="participanteObtener")
     * @Method({"POST","GET"})
     */
    public function participanteObtenerAction(Request $request)
    {
      $inscripcionId = $request->get('inscripcionId');

      $em = $this->getDoctrine()->getManager();
      $participante = $em->getRepository('SudJuvenilesBundle:Participante')->getPariticipanteInscripcionById($inscripcionId);

      // $encoders = array(new JsonEncoder());
      // $normalizer = new ObjectNormalizer();
      // $normalizer->setCircularReferenceLimit(1);
      // $normalizer->setCircularReferenceHandler(function ($object) {
      //     return $object->getId();
      // });
      // $normalizers = array($normalizer);
      // $serializer = new Serializer($normalizers, $encoders);
      // $jsonContent = $serializer->serialize($participante,'json');
      
      return new JsonResponse($participante);
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

        if(!empty($fileDocumentoIdentidad)){
          $fileNameDocIdent = 'DocumentoIdentidad'.'.'.$fileDocumentoIdentidad->guessExtension();
          $rutaDocumentoIdentidadAll = $rutaDocumento.$fileNameDocIdent;         
        }else{
          $rutaDocumentoIdentidadAll = NULL;
        }

        //FILE CONSTANCIA DE ESTUDIO
        $fileConstanciaEstudio = $file->get("constEstudio");

        if(!empty($fileConstanciaEstudio)){
          $fileNameConstEstud = 'ConstanciaEstudio'.'.'.$fileConstanciaEstudio->guessExtension();
          $rutaConstanciaEstudioAll = $rutaDocumento.$fileNameConstEstud;
        }else{
          $rutaConstanciaEstudioAll = NULL;
        }
        // 

        //FILE FICHA MEDICA VIGENTE
        $fileFichaMedicaVigente = $file->get("fichaMedicaVigente");

        if(!empty($fileFichaMedicaVigente)){
          $fileNameFichMed = 'FichaMedicaVigente'.'.'.$fileFichaMedicaVigente->guessExtension();
          $rutaFichaMedicaVigenteAll = $rutaDocumento.$fileNameFichMed;          
        }else{
          $rutaFichaMedicaVigenteAll = NULL;
        }
        // 

        //FILE FORMULARIO INSCRIPCION
        $fileFormularioInscripcion = $file->get("formularioInscripcion");

        if(!empty($fileFormularioInscripcion)){
          $fileNameFormIns = 'FormularioInscripcion'.'.'.$fileFormularioInscripcion->guessExtension();
          $rutaFormularioInscripcionAll = $rutaDocumento.$fileNameFormIns;       
        }else{
          $rutaFormularioInscripcionAll = NULL;
        }
        //

        //FILE POLIZA DE SEGURO
        $filePolizaSeguro = $file->get("polizaSeguro");

        if(!empty($filePolizaSeguro)){
          $fileNamePolizSeg = 'PolizaSeguro'.'.'.$filePolizaSeguro->guessExtension();
          $rutaPolizaSeguroAll = $rutaDocumento.$fileNamePolizSeg;
        }else{
          $rutaPolizaSeguroAll = NULL;
        }
        //

        //FILE FOTO PERFIL
        $fileFotoPerfil = $file->get("fotoPerfil");

        if(!empty($fileFotoPerfil)){
          $fileNameFotoPerfil = 'FotoPerfil'.'.'.$fileFotoPerfil->guessExtension();
          $rutaFotoPerfilAll = $rutaDocumento.$fileNameFotoPerfil;  
        }else{
          $rutaFotoPerfilAll = NULL;
        }
 
        if(empty($estadoDis)){
          $estadoDis=0;
          $rutacertificadoDiscapacidadAll = NULL; 
        }else{

        //FILE CERTIFICADO DISCAPACIDAD
          $fileCertificadoDiscapacidad = $file->get("certificadoDis");
          $fileNameCertificadoDiscapacidad = 'CertificadoDiscapacidad'.'.'.$fileCertificadoDiscapacidad->guessExtension();
          $rutacertificadoDiscapacidadAll = $rutaDocumento.$fileNameCertificadoDiscapacidad;
        }

        $estadoRegistro =  $em->getRepository('SudJuvenilesBundle:Participante')->registrar($paisOrigenId, $tipoDocumento, $sexoId,$numeroDocumento, $nombre,$apellidoPaterno,$apellidoMaterno,$fechaNacimiento,$correo,$paisRepresentaId,$tipoParticipanteId,$rutaDocumentoIdentidadAll,$rutaConstanciaEstudioAll,$rutaFichaMedicaVigenteAll,$rutaFormularioInscripcionAll,$rutaPolizaSeguroAll,$estadoDis,$rutacertificadoDiscapacidadAll,$disDelegId,$rutaFotoPerfilAll,$arrayModalidades,$arrayDivisiones);        

        if($estadoRegistro == 1){//SI SE REGISTRO CORRECTAMENTE

          if(!empty($rutaDocumentoIdentidadAll ))
            $fileDocumentoIdentidad->move($rutaDocumento, $fileNameDocIdent);

          if(!empty($rutaConstanciaEstudioAll))
            $fileConstanciaEstudio->move($rutaDocumento, $fileNameConstEstud);

          if(!empty($rutaFichaMedicaVigenteAll))
            $fileFichaMedicaVigente->move($rutaDocumento, $fileNameFichMed);

          if(!empty($rutaFormularioInscripcionAll))
            $fileFormularioInscripcion->move($rutaDocumento, $fileNameFormIns);

          if(!empty($rutaPolizaSeguroAll))
            $filePolizaSeguro->move($rutaDocumento, $fileNamePolizSeg);
          
          if(!empty($rutaFotoPerfilAll))
            $fileFotoPerfil->move($rutaDocumento, $fileNameFotoPerfil);
          
          if(!empty($estadoDis))
            $fileCertificadoDiscapacidad->move($rutaDocumento, $fileNameCertificadoDiscapacidad);
        }

        return new JsonResponse($estadoRegistro);
    }

  /**
     * @Route("participante/editar",name="participanteEditar")
     * @Method({"POST","GET"})
     */
    public function participanteEditarAction(Request $request)
    {

      $em = $this->getDoctrine()->getManager();

      //INSCRIPCION
      $inscripcionId = $request->get('editInscribiteId');
      
      //PERSONA
      $paisOrigenId = $request->get('editPaisOrigen');
      $tipoDocumento = $request->get('editTipoDocumento');
      $sexoId = $request->get('editSexoId');
      $numeroDocumento = $request->get('editNumeroDocumento');
      $nombre = $request->get('editNombre');
      $apellidoPaterno = $request->get('editApellidoPaterno');
      $apellidoMaterno = $request->get('editApellidoMaterno');
      $fechaNacimiento = $request->get('editFechaNacimiento');
      $correo = $request->get('editCorreo');
      
      //DELEGACION DISCIPLINA
      $disciplinaDelegacionId = $request->get('editDisDelegId');

      //PARTICIPANTE
      $tipoParticipanteId = $request->get('editTipoParticipante');
      $estadoDis = $request->get('editEstadoDis');

        //MODALIDADES
        $modalidades = $request->get('editModalidades');

        if( !empty($modalidades) ) //SI EXISTEN MODALIDADES
          $arrayModalidades = explode(',',$modalidades);
        else
          $arrayModalidades = Array();


        //DIVISIONES
        $divisiones = $request->get('editDivisiones');

        if(!empty($divisiones)) //SI EXISTEN DIVISIONES
          $arrayDivisiones = explode(',',$divisiones);
        else
          $arrayDivisiones = Array();
        
        $file = $request->files;
        $idDoc = date('Y-m-d-H-i-s');
        $rutaDocumento = "assets/Documentos/Participante/$numeroDocumento/$idDoc/";

        //FILE DOCUMENTO IDENTIDAD
        $fileDocumentoIdentidad = $file->get("editDocumentoIdentidad");

        if(!empty($fileDocumentoIdentidad)){

          $fileNameDocIdent = 'DocumentoIdentidad'.'.'.$fileDocumentoIdentidad->guessExtension();
          $rutaDocumentoIdentidadAll = $rutaDocumento.$fileNameDocIdent;

        }else{
          $rutaDocumentoIdentidadAll = NULL;
        }

        //FILE CONSTANCIA DE ESTUDIO
        $fileConstanciaEstudio = $file->get("editConstEstudio");
        if(!empty($fileConstanciaEstudio)){

          $fileNameConstEstud = 'ConstanciaEstudio'.'.'.$fileConstanciaEstudio->guessExtension();
          $rutaConstanciaEstudioAll = $rutaDocumento.$fileNameConstEstud;

        }else{
          $rutaConstanciaEstudioAll = NULL;
        }

        //FILE FICHA MEDICA VIGENTE
        $fileFichaMedicaVigente = $file->get("editFichaMedicaVigente");

        if(!empty($fileFichaMedicaVigente)){

          $fileNameFichMed = 'FichaMedicaVigente'.'.'.$fileFichaMedicaVigente->guessExtension();
          $rutaFichaMedicaVigenteAll = $rutaDocumento.$fileNameFichMed;

        }else{
          $rutaFichaMedicaVigenteAll = NULL;
        }

        //FILE FORMULARIO INSCRIPCION
        $fileFormularioInscripcion = $file->get("editFormularioInscripcion");

        if(!empty($fileFormularioInscripcion)){

          $fileNameFormIns = 'FormularioInscripcion'.'.'.$fileFormularioInscripcion->guessExtension();
          $rutaFormularioInscripcionAll = $rutaDocumento.$fileNameFormIns;

        }else{
          $rutaFormularioInscripcionAll = NULL;
        }

        //FILE POLIZA DE SEGURO
        $filePolizaSeguro = $file->get("editPolizaSeguro");

        if(!empty($filePolizaSeguro)){
          $fileNamePolizSeg = 'PolizaSeguro'.'.'.$filePolizaSeguro->guessExtension();
          $rutaPolizaSeguroAll = $rutaDocumento.$fileNamePolizSeg;
        }else{
          $rutaPolizaSeguroAll = NULL;
        }

        //FILE FOTO PERFIL
        $fileFotoPerfil = $file->get("editFotoPerfil");

        if(!empty($fileFotoPerfil)){
          $fileNameFotoPerfil = 'FotoPerfil'.'.'.$fileFotoPerfil->guessExtension();
          $rutaFotoPerfilAll = $rutaDocumento.$fileNameFotoPerfil;
        }else{
          $rutaFotoPerfilAll = NULL;
        }

        if(empty($estadoDis)){
          $estadoDis=0;
          $rutacertificadoDiscapacidadAll = NULL; 
        }else{

        //FILE CERTIFICADO DISCAPACIDAD
          $fileCertificadoDiscapacidad = $file->get("editCertificadoDis");
          $fileNameCertificadoDiscapacidad = 'CertificadoDiscapacidad'.'.'.$fileCertificadoDiscapacidad->guessExtension();
          $rutacertificadoDiscapacidadAll = $rutaDocumento.$fileNameCertificadoDiscapacidad;
        }

          $estadoRegistro =  $em->getRepository('SudJuvenilesBundle:Participante')->editar($inscripcionId,$paisOrigenId,$tipoDocumento, $sexoId,$numeroDocumento, $nombre,$apellidoPaterno,$apellidoMaterno,$fechaNacimiento,$correo,$tipoParticipanteId,$rutaDocumentoIdentidadAll,$rutaConstanciaEstudioAll,$rutaFichaMedicaVigenteAll,$rutaFormularioInscripcionAll,$rutaPolizaSeguroAll,$estadoDis,$rutacertificadoDiscapacidadAll,$rutaFotoPerfilAll,$disciplinaDelegacionId);        

        if($estadoRegistro == 1){//SI SE REGISTRO CORRECTAMENTE

            if(!empty($rutaDocumentoIdentidadAll))
              $fileDocumentoIdentidad->move($rutaDocumento, $fileNameDocIdent);

            if(!empty($rutaConstanciaEstudioAll))
              $fileConstanciaEstudio->move($rutaDocumento, $fileNameConstEstud);
            
            if(!empty($rutaFichaMedicaVigenteAll))
              $fileFichaMedicaVigente->move($rutaDocumento, $fileNameFichMed);

            if(!empty($rutaFormularioInscripcionAll))
              $fileFormularioInscripcion->move($rutaDocumento, $fileNameFormIns);
            
            if(!empty($rutaPolizaSeguroAll))
              $filePolizaSeguro->move($rutaDocumento, $fileNamePolizSeg);
          
            if(!empty($rutaFotoPerfilAll))
              $fileFotoPerfil->move($rutaDocumento, $fileNameFotoPerfil);

            if(!empty($rutacertificadoDiscapacidadAll))
              $fileCertificadoDiscapacidad->move($rutaDocumento, $fileNameCertificadoDiscapacidad);

             //MODALIDADES INSCRIPCION
            $modalidadesInicio = $em->getRepository('SudJuvenilesBundle:Inscripcion')->getModalidadesByInscripcionId($inscripcionId);

            if( !empty($modalidadesInicio) ) //SI EXISTEN MODALIDADES
              $arrayModalidadesInicio = explode(',',$modalidadesInicio);
            else
              $arrayModalidadesInicio = Array();

            if(count($arrayModalidades) >= count($arrayModalidadesInicio)){

              for ($i=0; $i < count($arrayModalidades) ; $i++) { 

                  $em = $this->getDoctrine()->getManager();
                  if($i < count($arrayModalidadesInicio)){
                      $em->getRepository('SudJuvenilesBundle:Inscripcion')->updateInscripcionModalidad($inscripcionId, $arrayModalidadesInicio[$i], $arrayModalidades[$i]);
                  }else{
                      $em->getRepository('SudJuvenilesBundle:Inscripcion')->insertInscripcionModalidad($inscripcionId,$arrayModalidades[$i]);
                  }    
              }
            }

            else if( count($arrayModalidades) < count($arrayModalidadesInicio)  && count($arrayModalidades)> -1 ){

                $em = $this->getDoctrine()->getManager();
                $em->getRepository('SudJuvenilesBundle:Inscripcion')->removeInscripcionModalidad($inscripcionId);

                for ($i=0; $i < count($arrayModalidades) ; $i++) { 

                    $em->getRepository('SudJuvenilesBundle:Inscripcion')->insertInscripcionModalidad($inscripcionId,$arrayModalidades[$i]);
                }
            }
            //FIN MODALIDADES INSCRIPCION

            //DIVISIONES INSCRIPCION

            $divisionesInicio = $em->getRepository('SudJuvenilesBundle:Inscripcion')->getDivisionesByInscripcionId($inscripcionId);

            if( !empty($divisionesInicio) ) //SI EXISTEN divisiones
              $arrayDivisionesInicio = explode(',',$divisionesInicio);
            else
              $arrayDivisionesInicio = Array();
              
            if(count($arrayDivisiones) >= count($arrayDivisionesInicio)){

              for ($i=0; $i < count($arrayDivisiones) ; $i++) { 

                  $em = $this->getDoctrine()->getManager();
                  if($i < count($arrayDivisionesInicio)){
                      $em->getRepository('SudJuvenilesBundle:Inscripcion')->updateInscripcionDivision($inscripcionId, $arrayDivisionesInicio[$i], $arrayDivisiones[$i]);
                  }else{
                      $em->getRepository('SudJuvenilesBundle:Inscripcion')->insertInscripcionDivision($inscripcionId,$arrayDivisiones[$i]);
                  }    
              }
            }

            else if( count($arrayDivisiones) < count($arrayDivisionesInicio)  && count($arrayDivisiones)> -1 ){

                $em = $this->getDoctrine()->getManager();
                $em->getRepository('SudJuvenilesBundle:Inscripcion')->removeInscripcionDivision($inscripcionId);

                for ($i=0; $i < count($arrayDivisiones) ; $i++) { 

                    $em->getRepository('SudJuvenilesBundle:Inscripcion')->insertInscripcionDivision($inscripcionId,$arrayDivisiones[$i]);
                }
            }
            //FIN DIVISIONES INSCRIPCION 

        }

        return new JsonResponse($estadoRegistro);
    }


}
