<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default.index")
     */
    public function indexAction(Request $request):Response
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @route("/hello/{firstname}",
     *      name="default.hello",
     *     requirements={"firstname"= "[a-z]+"},
     *      defaults={"firstname"= null}
     *     )
     */
    public function helloAction($firstname, Request $request):Response
    {
        dump($request->get('firstname'));

        /*
            $firstname === null ? $firstname = 'anon' : $firstname = $firstname
        */
        return $this->render('default/hello.html.twig',['firstname' => $firstname ?: 'anonyme']);
    }
}
