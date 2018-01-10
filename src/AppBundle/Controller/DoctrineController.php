<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use Doctrine\Common\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DoctrineController extends Controller
{
    /**
     * @Route("/query", name="doctrine.index")
     */
    public function indexAction(ManagerRegistry $doctrine):Response
    {
        //$results = $doctrine->getRepository(Contact::class)->testQuery();
        //$results = $doctrine->getRepository(Contact::class)->testUpdate();
        $results = $doctrine->getRepository(Contact::class)->testDelete();
        dump($results);exit;
    }

}
