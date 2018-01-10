<?php
/**
 * Created by PhpStorm.
 * User: wabap2-5
 * Date: 09/01/18
 * Time: 11:52
 */

namespace AppBundle\Controller;
use AppBundle\Entity\Formation;
use AppBundle\Entity\Module;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FormationController extends Controller
{
    /**
     * @Route("/formation", name="formation.index");
     */
    public function indexAction(ManagerRegistry $doctrine):Response
    {
        //on commente le code ci dessou car on importe avec la fonction twig render_menu()
      /*  $rc = $doctrine->getRepository(Formation::class);
        $results = $rc->findAll();*/
        return $this->render('formation/formation-module-page01.html.twig'/*,['result'=>$results]*/);
    }

    /**
     * @Route("/formation/info/{id}", name="formation.info",defaults={"id"= null}));
     */
    public function infoAction(ManagerRegistry $doctrine, $id):Response
    {
        $rc = $doctrine->getRepository(Formation::class);


        //$results = $rc->findAll();

        $entity = $rc->find($id);



        return $this->render('formation/formation-module-page02.html.twig',['formation'=> $entity/*,'result'=> $results*/]);
    }

}