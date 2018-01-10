<?php
/**
 * Created by PhpStorm.
 * User: wabap2-5
 * Date: 04/01/18
 * Time: 10:27
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class TwigController extends Controller
{
    /**
     * @Route("/twig/layout", name="twig.layout")
     */
    public function layoutAction():Response
    {
        return $this->render('twig/layout.html.twig',[]);
    }


    /**
     * @Route("/twig", name="twig.index")
     */
    public function indexAction():Response
    {
        $array= [
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
            'key4' => 'value4',
            'key5' => 'value5',

        ];
        return $this->render('twig/index.html.twig',['list' => $array]);
    }
}