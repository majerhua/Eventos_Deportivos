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

  public function getPariticipanteInscripcionById($id){

    try {
          $query="  SELECT 
                    per.tipo_documento tipoDocumento,
                    per.numero_documento numeroDocumento,
                    per.nombre nombre,
                    per.apellido_paterno apellidoPaterno,
                    per.apellido_materno apellidoMaterno,
                    per.sexo_id sexoId,
                    per.fecha_nacimiento fechaNacimiento,
                    per.correo correo,
                    per.pais_origen_id paisOrigen,
                    par.tipo_participante_id tipoParticipante,
                    par.estado_dis estadoDiscipacidad
                    FROM inscripcion ins
                    INNER JOIN participante par ON par.id = ins.participante_id
                    INNER JOIN tipo_participante tipoPar ON tipoPar.id = par.tipo_participante_id
                    INNER JOIN persona per ON per.id = par.persona_id
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
              //$inscripcionId = $result[0]['inscripcionId'];

              echo $estadoRegistro;
              exit;
              if( $estadoRegistro < 1 ){//SI NO OCURRE UN ERROR  EN EL REGISTRO DE PARTICIPANTE E INSCRIPCION

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

              }

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
                      WHERE deleg.id = '$delegId'; ";

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
