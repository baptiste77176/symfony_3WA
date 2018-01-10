<?php
/**
 * Created by PhpStorm.
 * User: wabap2-5
 * Date: 10/01/18
 * Time: 09:32
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ContactFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /*
         * utilisation des entités
         *  attention chaque insertion des données de ce bundle va vider toutes les tables de la BDD symfony , car le principe est d'insérer des données fctive  pour faire des tests
         * */
        for ($i = 0 ;$i<500;$i++)
        {
            $entity = new Contact();
            $entity->setFirstname('firstname'.$i);
            $entity->setLastname('lastname'.$i);
            $entity->setEmail('email'.$i.'@email.com');
            $entity->setMessage('yolo');
        /*
         *   concaténation sans point grace au double cote "
         *   $entity->setName("country$i");
        */

        /*
         * getReference :
         *      - récupérer une référence crée dans une autre classe
         *      - recommandé : utiliser la methode getDependencies qui permet de gerer l'ordre de création des obgjets la classe contact a besoin de country avant
         * il faut bien reutiliser la clés choisi prédédemment
         * */
        $rand = mt_rand(0,19);
        $entity->setCountry(
            $this->getReference('country'.$rand)
        );
        $entity->addLanguage(
            $this->getReference('language10')
        );
        $entity->addLanguage(
            $this->getReference('language7')
        );

        //$manager = synthaxe pour doctrine dans ce bundle
        $manager->persist($entity);
        /*
         * addReference
         *          - stocke l'entité en mémoire
     *              - permet d'utiliser l'entité dans une relation entree entités
         * */
        $this->addReference('Contact '.$i, $entity);

        $manager->flush();
        }
    }
    /*
     * la methode getDependencies permet de gerer l'ordre de création des obgjets la classe contact a besoin de country avant
     * */
    public function getDependencies()
    {
        return [
            CountryFixtures::class,
            LanguageFixtures::class
        ];
    }

}