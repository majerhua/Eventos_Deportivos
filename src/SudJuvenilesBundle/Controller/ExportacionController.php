<?php

namespace SudJuvenilesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ExportacionController extends Controller
{

    /**
     * @Route("/export/participantes/{delegacionId}", name="participantesExport",defaults={"_format"="xls","_filename"="participantes"}, requirements={"_format"="csv|xls|xlsx"})
     * @Template("SudJuvenilesBundle:Excel:participantes.xlsx.twig")
     */
    
    public function participantesExportAction($_filename,$delegacionId)
    {
        $em = $this->getDoctrine()->getManager();
        $participantes =  $em->getRepository('SudJuvenilesBundle:Participante')->getParticipantesByDisDelegId($delegacionId);
        return ['data' => $participantes]; 
    }

}
