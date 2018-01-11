<?php
/**
 * Created by PhpStorm.
 * User: wabap2-5
 * Date: 11/01/18
 * Time: 09:20
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Film;
use Doctrine\Common\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FilmController extends Controller
{
    /**
     * @Route("/film", name="film.index")
     */
    public function indexAction(ManagerRegistry $doctrine):Response
    {
        $results = $doctrine->getRepository(Film::class)->testQuery();
        //$results = $doctrine->getRepository(Contact::class)->testUpdate();
        // $results = $doctrine->getRepository(Contact::class)->testDelete();
        dump($results);exit;
    }
}