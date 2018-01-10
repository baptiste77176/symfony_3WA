<?php
/**
 * Created by PhpStorm.
 * User: wabap2-5
 * Date: 05/01/18
 * Time: 09:52
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class listeController extends Controller
{

private $tab =
[

'id_1'=> ['name'=>'toto','firstname'=>"yolo",'mail' => 'yolo@gmail.com', 'photo'=>'img1.jpeg'],
'id_2'=> ['name'=>'popo','firstname'=>"zolo",'mail' => 'zolo@gmail.com','photo'=>'img2.jpeg'],
'id_3'=> ['name'=>'koko','firstname'=>"wolo",'mail' => 'wolo@gmail.com','photo'=>'img3.jpeg'],

];
/**
 *
 * @Route ("/members", name="members.index")
 */
    public function indexAction(Request $request):Response
    {
        return $this->render('members/index.html.twig',['tab'=> $this->tab]);
    }



    /**
     *
     * @Route ("/members/{id}", name="members.userId",
     *     requirements={""= "[0-9]"},
     *      defaults={"id"= null})
     */
    public function userIdAction($id ,Request $request):Response
    {

        return $this->render('members/userId.html.twig',['tab' => $this->tab[$id]]);

    }
}