<?php

namespace SudJuvenilesBundle\Repository;

/**
 * DelegacionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
use Doctrine\DBAL\DBALException;

class DelegacionRepository extends \Doctrine\ORM\EntityRepository
{




	public function getDelegaciones(){

		try {
            $query="	SELECT del.id delegacionId,pa.nombre nombre,del.url_imagen imagen FROM delegacion del
						INNER JOIN pais pa ON pa.id = del.pais_id 
						WHERE del.estado=1;";
            $stmt = $this->getEntityManager()->getConnection()->prepare($query);
            $stmt->execute();
            $delegaciones = $stmt->fetchAll();

            return $delegaciones;

        }catch (DBALException $e) {
          	$message = $e->getCode();
            return $message;
    	}
	}


    public function getDelegacionById($id){

        try {
            $query="    SELECT del.id delegacionId,pa.nombre nombre,del.url_imagen imagen, del.pais_id paisId FROM delegacion del
                        INNER JOIN pais pa ON pa.id = del.pais_id 
                        WHERE del.estado=1 AND del.id='$id'; ";
            $stmt = $this->getEntityManager()->getConnection()->prepare($query);
            $stmt->execute();
            $delegacion = $stmt->fetchAll();

            return $delegacion;

        }catch (DBALException $e) {
            $message = $e->getCode();
            return $message;
        }
    }

    public function getDisciplinasDelegacionById($id){

        try {
            $query="    SELECT 
                        disDeleg.id disDelegId,
                        dis.id disciplinaId,
                        deleg.id delegacionId,
                        dis.nombre disciplinaNombre,
                        dis.categoria_id disciplinaCategoria,
                        deleg.tipo_grupo_id delegacionTipoGrupo
                        FROM disciplina_delegacion disDeleg
                        INNER JOIN disciplina dis ON dis.id = disDeleg.disciplina_id
                        INNER JOIN delegacion deleg ON deleg.id = disDeleg.delegacion_id
                        WHERE deleg.id = '$id'; ";
            $stmt = $this->getEntityManager()->getConnection()->prepare($query);
            $stmt->execute();
            $delegacionDisciplina = $stmt->fetchAll();

            return $delegacionDisciplina;

        }catch (DBALException $e) {
            $message = $e->getCode();
            return $message;
        }

    }


    public function getTiposParticipante(){

        try {
            
            $query="  SELECT *FROM tipo_participante WHERE estado=1 ";
            $stmt = $this->getEntityManager()->getConnection()->prepare($query);
            $stmt->execute();
            $tiposParticipante = $stmt->fetchAll();

            return $tiposParticipante;

        }catch (DBALException $e) {
            $message = $e->getCode();
            return $message;
        }

    }

}
