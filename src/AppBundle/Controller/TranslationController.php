<?php
/**
 * Created by PhpStorm.
 * User: wabap2-5
 * Date: 11/01/18
 * Time: 14:08
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @Route("/{_locale}")
 *
 */
class TranslationController extends Controller
{
    /**
     * @Route("/translation", name="translation.index")
     */
    public function indexAction(Request $request, TranslatorInterface $translator):Response
    {
        /*
         * acceder a la locale :a partir de la requete
         * acceder aux service de traduction : TranslatorInterface
         * */
        dump($request->getLocale(), $translator->trans('content.remplacement', ['%name%' => 'harry cover']));
        return $this->render('translation/index.html.twig',['now'=> new \DateTime()]);
    }
}