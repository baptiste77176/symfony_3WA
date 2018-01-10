<?php
/**
 * Created by PhpStorm.
 * User: wabap2-5
 * Date: 10/01/18
 * Time: 09:32
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LanguageFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /*
         * utilisation des entités
         *  attention chaque insertion des données de ce bundle va vider toutes les tables de la BDD symfony , car le principe est d'insérer des données fctive  pour faire des tests
         * */
        //faker
        $faker = \Faker\Factory::create('fr_FR');
        for ($i = 0 ;$i<20;$i++)
        {

            $entity = new Language();
            $entity->setName($faker->unique()->languageCode);
        /*
         *   concaténation sans point grace au double cote "
         *   $entity->setName("country$i");
        */

        //$manager = synthaxe pour doctrine dans ce bundle
        $manager->persist($entity);
        /*
         * addReference
         *          - stocke l'entité en mémoire
     *              - permet d'utiliser l'entité dans une relation entree entités
         * */
        $this->addReference('language'.$i, $entity);

        $manager->flush();
        }
    }

}