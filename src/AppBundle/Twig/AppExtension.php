<?php
/**
 * Created by PhpStorm.
 * User: wabap2-5
 * Date: 04/01/18
 * Time: 12:19
 */

namespace AppBundle\Twig;

/*
 *      création de fonctions et de filtre twig
 *      classe extend twig extension
 * */
use AppBundle\Entity\Formation;
use Doctrine\Common\Persistence\ManagerRegistry;

class AppExtension extends \Twig_Extension
{

    /*injection de services dans une classe autre que un controleur
     *      - créer une propirété par service
     *      - injection les services par le constructeur
     */


private $doctrine;
private $twig;

public function __construct(ManagerRegistry $doctrine, \Twig_Environment $twig)
{
    $this->doctrine = $doctrine;
    $this->twig = $twig;

}

    /*  creation d'une fonction :
    *        -renvoie un array de nouvelles fonctions
    *        -1er parametre : nom de la fonction dans twig
    *        -2em parametre callable php
    *        -objet possédant la methode a appellée: $this correspond a la classe
    *        -nom de la methode php a appelée
    */

    public function getFunctions():array
    {
        return [

            new \Twig_SimpleFunction('my_test',[$this,'myTest']),
            new \Twig_SimpleFunction('date_diff',[$this,'dateDiff']),
            new \Twig_SimpleFunction('render_menu',[$this,'renderMenu'])

        ];
    }

    public function renderMenu()
    {
        //requete avec le service doctrine que on a injecter precedement
        $rc = $this->doctrine->getRepository(Formation::class);
        $result = $rc->findAll();

        //envoie des resultat de la requete a une vue partielle
        return $this->twig->render('inc/menu.html.twig',['result'=>$result]);
    }

    public function myTest():string
    {
        return 'my test';
    }

    public function dateDiff(\DateTime $postDate)
    {
        $now = new \DateTime();
        $diff = $now->diff($postDate);
        dump($diff);
        /*
         * possibiliter de dump($diff->y);
         * */
        return $diff;
    }

    public function getFilters()
    {
        return [

        new \Twig_SimpleFilter('slugify',[$this, 'slugify'])
     ];
    }

    /*
     * les filtre recoivent obligatoirement la chaine de caracteres en parametre
     * */

    public function slugify($string)
    {
        $string = transliterator_transliterate("Any-Latin;        NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove;        Lower();", $string);
        $string = preg_replace('/[-\s]+/', '_',            $string);
        return trim($string, '_');
    }
}