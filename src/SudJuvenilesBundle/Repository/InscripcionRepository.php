<?php

namespace SudJuvenilesBundle\Repository;

/**
 * InscripcionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InscripcionRepository extends \Doctrine\ORM\EntityRepository
{

	public function getDivisionesByInscripcionId($inscripcionId){

    	try {
          $query="    SELECT 
					  CONVERT(VARCHAR(100),STUFF(( SELECT  ',' +
					       CONVERT(VARCHAR(100),div.id)
					          FROM    inscripcion_divisiones AS insDiv
					          INNER JOIN divisiones div ON div.id = insDiv.divisiones_id
					          WHERE   insDiv.inscripcion_id = ins.id
					          FOR
					          XML PATH('')
					      ), 1, 1, '') ) AS divisiones
					FROM inscripcion ins
					WHERE ins.id = $inscripcionId;";

            $stmt = $this->getEntityManager()->getConnection()->prepare($query);
            $stmt->execute();
            $divisiones = $stmt->fetchAll();

            return $divisiones[0]['divisiones'];

        }catch (DBALException $e) {
            $message = $e->getCode();
            return $message;
        }
  	}

	public function updateInscripcionDivision($inscripcionId, $divisionId, $newDivisionId){

    	try {
          $query="   UPDATE inscripcion_divisiones SET divisiones_id = $newDivisionId, fecha_actualizacion=getDate() 
					WHERE inscripcion_id = $inscripcionId AND divisiones_id = $divisionId";

            $stmt = $this->getEntityManager()->getConnection()->prepare($query);
            $stmt->execute();

            $result = '1';
            return $result;

        }catch (DBALException $e) {
            $message = $e->getCode();
            return $message;
        }
  	}

	public function removeInscripcionDivision($inscripcionId){
		try {
	        $query = "DELETE FROM inscripcion_divisiones  WHERE inscripcion_id = '$inscripcionId';";
	        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
	        $stmt->execute();
            $result = '1';
            return $result;
        }catch (DBALException $e) {
            $message = $e->getCode();
            return $message;
        }
    }

	public function insertInscripcionDivision($inscripcionId, $divisionId){

    	try {
          $query="  INSERT INTO inscripcion_divisiones(inscripcion_id,divisiones_id,estado)
					VALUES($inscripcionId,$divisionId,1)";

            $stmt = $this->getEntityManager()->getConnection()->prepare($query);
            $stmt->execute();

            $result = '1';
            return $result;

        }catch (DBALException $e) {
            $message = $e->getCode();
            return $message;
        }
  	}

	public function getModalidadesByInscripcionId($inscripcionId){

    	try {
          $query="    SELECT 
					  CONVERT(VARCHAR(100),STUFF(( SELECT  ',' +
					       CONVERT(VARCHAR(100),modal.id)
					          FROM    inscripcion_modalidad AS insMod
					          INNER JOIN modalidad modal ON modal.id = insMod.modalidad_id
					          WHERE   insMod.inscripcion_id = ins.id
					          FOR
					          XML PATH('')
					      ), 1, 1, '') ) AS modalidades
					FROM inscripcion ins
					WHERE ins.id = $inscripcionId;";

            $stmt = $this->getEntityManager()->getConnection()->prepare($query);
            $stmt->execute();
            $modalidades = $stmt->fetchAll();

            return $modalidades[0]['modalidades'];

        }catch (DBALException $e) {
            $message = $e->getCode();
            return $message;
        }
  	}

	public function updateInscripcionModalidad($inscripcionId, $modalidadId, $newModalidadId){

    	try {
          $query="   UPDATE inscripcion_modalidad SET modalidad_id = $newModalidadId, fecha_actualizacion=getDate() 
					WHERE inscripcion_id = $inscripcionId AND modalidad_id = $modalidadId";

            $stmt = $this->getEntityManager()->getConnection()->prepare($query);
            $stmt->execute();

            $result = '1';
            return $result;

        }catch (DBALException $e) {
            $message = $e->getCode();
            return $message;
        }
  	}


	public function removeInscripcionModalidad($inscripcionId){
		try {
	        $query = "delete from inscripcion_modalidad  where inscripcion_id='$inscripcionId';";
	        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
	        $stmt->execute();
            $result = '1';
            return $result;
        }catch (DBALException $e) {
            $message = $e->getCode();
            return $message;
        }
    }

	public function insertInscripcionModalidad($inscripcionId, $modalidadId){

    	try {
          $query="  INSERT INTO inscripcion_modalidad(inscripcion_id,modalidad_id,estado)
					VALUES($inscripcionId,$modalidadId,1)";

            $stmt = $this->getEntityManager()->getConnection()->prepare($query);
            $stmt->execute();

            $result = '1';
            return $result;

        }catch (DBALException $e) {
            $message = $e->getCode();
            return $message;
        }
  	}

}
