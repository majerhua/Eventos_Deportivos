<?php

namespace SudJuvenilesBundle\Repository;

/**
 * ParticipanteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
use Doctrine\DBAL\DBALException;
class ParticipanteRepository extends \Doctrine\ORM\EntityRepository
{

  public function eliminarParticipanteInscripcion($inscripcionId){

      $query="EXEC eliminarParticipanteInscripcion $inscripcionId";
      $stmt = $this->getEntityManager()->getConnection()->prepare($query);
      $stmt->execute();
      $estadoElim = $stmt->fetchAll();

      return $estadoElim[0]['estadoElim'];
  }


  public function getPariticipanteInscripcionById($id){

    try {
          $query="  SELECT 
                      per.tipo_documento tipoDocumento,
                      tipDoc.nombre nombreTipoDocumento,
                      per.numero_documento numeroDocumento,
                      per.nombre nombre,
                      per.apellido_paterno apellidoPaterno,
                      per.apellido_materno apellidoMaterno,
                      per.sexo_id sexoId,
                      sex.nombre sexoNombre,
                      per.fecha_nacimiento fechaNacimiento,
                      per.correo correo,
                      per.pais_origen_id paisOrigen,
                      pais.nombre paisOrigenNombre,
                      par.tipo_participante_id tipoParticipante,
                      par.estado_dis estadoDiscipacidad,
                      CONVERT(VARCHAR(100),STUFF(( SELECT  ',' +
                           CONVERT(VARCHAR(100),asig.id)
                              FROM    inscripcion_asignacion AS insAsig
                              INNER JOIN asignacion asig ON asig.id = insAsig.asignacion_id
                              WHERE   insAsig.inscripcion_id = ins.id
                              FOR
                              XML PATH('')
                          ), 1, 1, '') ) AS asignaciones,
                      CONVERT(VARCHAR(100),STUFF(( SELECT  ',' +
                           CONVERT(VARCHAR(100),modal.id)
                              FROM    inscripcion_modalidad AS insMod
                              INNER JOIN modalidad modal ON modal.id = insMod.modalidad_id
                              WHERE   insMod.inscripcion_id = ins.id
                              FOR
                              XML PATH('')
                          ), 1, 1, '') ) AS modalidades,
                      CONVERT(VARCHAR(100),STUFF(( SELECT  ',' +
                           CONVERT(VARCHAR(100),divi.id)
                              FROM    inscripcion_divisiones AS insDiv
                              INNER JOIN divisiones divi ON divi.id = insDiv.divisiones_id
                              WHERE   insDiv.inscripcion_id = ins.id
                              FOR
                              XML PATH('')
                          ), 1, 1, '') ) AS divisiones,
                        par.ruta_certificado_dis rutaCertificadoDiscapacidad,
                        par.ruta_const_estudio rutaConstanciaEstudio,
                        par.ruta_doc_identidad rutaDocumentoIdentidad,
                        par.ruta_ficha_medica_vigente rutaFichaMedica,
                        par.ruta_formulario_inscripcion rutaFormularioInscripcion,
                        par.ruta_foto_perfil rutaFotoPerfil,
                        par.ruta_poliza_seguro rutaPolizaSeguro

                      FROM inscripcion ins
                      INNER JOIN participante par ON par.id = ins.participante_id
                      INNER JOIN tipo_participante tipoPar ON tipoPar.id = par.tipo_participante_id
                      INNER JOIN persona per ON per.id = par.persona_id
                      INNER JOIN tipo_documento tipDoc ON tipDoc.id = per.tipo_documento
                      INNER JOIN sexo sex ON sex.id = per.sexo_id
                      INNER JOIN pais pais ON pais.id = per.pais_origen_id 
                      WHERE ins.id = '$id'";

            $stmt = $this->getEntityManager()->getConnection()->prepare($query);
            $stmt->execute();
            $participante = $stmt->fetchAll();

            return $participante;

        }catch (DBALException $e) {
            $message = $e->getCode();
            return $message;
        }

  }

	public function registrar($paisOrigenId,$tipoDocumentoId,$sexoId,$numeroDocumento,$nombre,$apellidoPaterno,$apellidoMaterno,$fechaNacimiento,$correo,$paisRepresentaId,$tipoParticipanteId,$rutaDocIdentidad,$rutaConstEstudio,$rutaFichaMedicaVigente,$rutaFormularioInscripcion,$rutaPolizaSeguro,$estadoDis,$rutaCertificadoDis,$disDelegId,$rutaFotoPerfil,$arrayModalidades,$arrayDivisiones){

		//try {
              $query="EXEC registrarParticipante $paisOrigenId,$tipoDocumentoId,$sexoId,'$numeroDocumento','$nombre','$apellidoPaterno','$apellidoMaterno','$fechaNacimiento','$correo',$paisRepresentaId,$tipoParticipanteId,'$rutaDocIdentidad','$rutaConstEstudio','$rutaFichaMedicaVigente','$rutaFormularioInscripcion','$rutaPolizaSeguro',$estadoDis,'$rutaCertificadoDis','$rutaFotoPerfil',$disDelegId";
              $stmt = $this->getEntityManager()->getConnection()->prepare($query);
              $stmt->execute();

              $result = $stmt->fetchAll();

              $estadoRegistro = $result[0]['estadoRegistro'];

              if($estadoRegistro == 1){
                $inscripcionId = $result[0]['inscripcionId'];
                $tipoGrupoId = $result[0]['tipoGrupoId'];
              }

              if( $estadoRegistro >= 1 ){//SI NO OCURRE UN ERROR  EN EL REGISTRO DE PARTICIPANTE E INSCRIPCION

                for ($i = 0; $i < count($arrayModalidades) ; $i++) {

                  $modalidadId = $arrayModalidades[$i];

                  $query="INSERT INTO inscripcion_modalidad(inscripcion_id,modalidad_id,estado)
                          VALUES($inscripcionId,$modalidadId,1)";
                  $stmt = $this->getEntityManager()->getConnection()->prepare($query);
                  $stmt->execute();
                }

                for ($i = 0; $i < count($arrayDivisiones) ; $i++) {

                  $divisionId = $arrayDivisiones[$i];

                  $query="INSERT INTO inscripcion_divisiones(inscripcion_id,divisiones_id,estado)
                          VALUES($inscripcionId , $divisionId ,1)";
                  $stmt = $this->getEntityManager()->getConnection()->prepare($query);
                  $stmt->execute();

                }

                $query="SELECT id FROM asignacion";
                $stmt = $this->getEntityManager()->getConnection()->prepare($query);
                $stmt->execute();
                $asignaciones = $stmt->fetchAll();

                for ($i = 0; $i < count($asignaciones) ; $i++) {

                  if($tipoGrupoId == 2){
                    
                    $paramAsignacionId = $asignaciones[$i]['id'];

                    $query="INSERT INTO inscripcion_asignacion(inscripcion_id,asignacion_id,estado)
                            VALUES($inscripcionId , $paramAsignacionId ,1)";
                    $stmt = $this->getEntityManager()->getConnection()->prepare($query);
                    $stmt->execute();

                  }
                  
                }

              }



              return $estadoRegistro;

            //}catch (DBALException $e) {
            //  $message = $e->getCode();
            //}
	}


public function editar($idInscripcion,$paisOrigenId,$tipoDocumentoId,$sexoId,$numeroDocumento,$nombre,$apellidoPaterno,$apellidoMaterno,$fechaNacimiento,$correo,$tipoParticipanteId,$rutaDocIdentidad,$rutaConstEstudio,$rutaFichaMedicaVigente,$rutaFormularioInscripcion,$rutaPolizaSeguro,$estadoDis,$rutaCertificadoDis,$rutaFotoPerfil,$disciplinaDelegacionId){

    //try {
              $query="EXEC editarParticipante $idInscripcion,$paisOrigenId,$tipoDocumentoId,$sexoId,'$numeroDocumento','$nombre','$apellidoPaterno','$apellidoMaterno','$fechaNacimiento','$correo',$tipoParticipanteId,'$rutaDocIdentidad','$rutaConstEstudio','$rutaFichaMedicaVigente','$rutaFormularioInscripcion','$rutaPolizaSeguro',$estadoDis,'$rutaCertificadoDis','$rutaFotoPerfil',$disciplinaDelegacionId";
              $stmt = $this->getEntityManager()->getConnection()->prepare($query);
              $stmt->execute();

              $result = $stmt->fetchAll();
              $estadoRegistro = $result[0]['estadoRegistro'];
              //$inscripcionId = $result[0]['inscripcionId'];

              return $estadoRegistro;

            //}catch (DBALException $e) {
            //  $message = $e->getCode();
            //}
  }


  public function getParticipantesByDisDelegId($delegId){

    try {
          $query="    SELECT 
                      dis.id disciplinaId,
                      per.nombre+' '+per.apellido_paterno+' '+per.apellido_materno nombresApellidos,
                      per.numero_documento numeroDocumento,
                      tipoPar.nombre tipoParticipante,
                      sex.nombre sexo,
                      estadoIns.nombre estado,
                      ins.id inscripcionId
                      FROM inscripcion ins
                      INNER JOIN disciplina_delegacion disDeleg ON disDeleg.id = ins.disciplina_delegacion_id
                      INNER JOIN delegacion deleg ON deleg.id = disDeleg.delegacion_id
                      INNER JOIN disciplina dis ON dis.id = disDeleg.disciplina_id
                      INNER JOIN participante par ON par.id = ins.participante_id
                      INNER JOIN tipo_participante tipoPar ON tipoPar.id = par.tipo_participante_id
                      INNER JOIN persona per ON per.id = par.persona_id
                      INNER JOIN sexo sex ON sex.id = per.sexo_id
                      INNER JOIN estado_inscripcion estadoIns ON estadoIns.id = ins.estado 
                      WHERE deleg.id = '$delegId' AND ins.estado = 1;";

            $stmt = $this->getEntityManager()->getConnection()->prepare($query);
            $stmt->execute();
            $participantes = $stmt->fetchAll();

            return $participantes;

        }catch (DBALException $e) {
            $message = $e->getCode();
            return $message;
        }
  }

}
