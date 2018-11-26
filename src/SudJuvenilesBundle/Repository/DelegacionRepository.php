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


    public function configuracionCondicionDocumento(){
        
        try {
            $query="  SELECT *FROM configuracion_condicion_documentos";
            $stmt = $this->getEntityManager()->getConnection()->prepare($query);
            $stmt->execute();
            $confCondDoc = $stmt->fetchAll();

            return $confCondDoc;

        }catch (DBALException $e) {
            $message = $e->getCode();
            return $message;
        }
    }


	public function getDelegaciones($periodoId){

		try {
            $query="WITH grupoDelegacion AS(
                        SELECT TOP 1000000 pa.nombre nombre,del.url_imagen imagen
                        ,del.tipo_grupo_id,del.id delegacionId, del.periodo_id periodoId 
                        FROM delegacion del
                                            INNER JOIN pais pa ON pa.id = del.pais_id 
                                            WHERE del.estado=1 AND del.tipo_grupo_id=2 AND
                                            del.periodo_id = $periodoId
                                            ORDER BY del.tipo_grupo_id DESC
                        ), grupoOrganizacion AS
                        (SELECT TOP 1000000 pa.nombre nombre,del.url_imagen imagen 
                        ,del.tipo_grupo_id,del.id delegacionId,del.periodo_id periodoId 
                        FROM delegacion del
                                            INNER JOIN pais pa ON pa.id = del.pais_id 
                                            WHERE del.estado=1 AND del.tipo_grupo_id=1 AND
                                            del.periodo_id = $periodoId
                                            ORDER BY del.tipo_grupo_id DESC)                                               
                   SELECT *FROM grupoDelegacion
                   UNION
                   SELECT *FROM grupoOrganizacion
                   ORDER BY tipo_grupo_id DESC";
            $stmt = $this->getEntityManager()->getConnection()->prepare($query);
            $stmt->execute();
            $delegaciones = $stmt->fetchAll();

            return $delegaciones;

        }catch (DBALException $e) {
          	$message = $e->getCode();
            return $message;
    	}
	}


public function getDelegacionesWeb($periodoId){

        try {
            $query="SELECT  pa.nombre nombre,del.url_imagen imagen 
                        ,del.tipo_grupo_id,del.id delegacionId,del.periodo_id periodoId 
                        FROM delegacion del
                        INNER JOIN pais pa ON pa.id = del.pais_id 
                        WHERE del.estado=1 AND del.tipo_grupo_id=2 AND
                        del.periodo_id = $periodoId 
                     ORDER BY del.tipo_grupo_id DESC; " ;                                           

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


    public function getPeriodoIdActivo(){
        try {
            
            $query="SELECT TOP 1  id FROM periodo WHERE estado=1 ";
            $stmt = $this->getEntityManager()->getConnection()->prepare($query);
            $stmt->execute();
            $periodoId = $stmt->fetchAll();

            return $periodoId[0]['id'];

        }catch (DBALException $e) {
            $message = $e->getCode();
            return $message;
        }
    }

}
