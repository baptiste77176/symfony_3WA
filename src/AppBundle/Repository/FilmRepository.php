<?php

namespace AppBundle\Repository;

/**
 * FilmRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FilmRepository extends \Doctrine\ORM\EntityRepository
{
    public function testQuery()
    {
        $results = $this->createQueryBuilder('film')
        // 1ere requete
       /*
            ->select('film.titre,film.dateSortie,film.description')
           */


       // 2em requete

        /*
            ->select("realisateurs.nom")
            ->join('film.realisateurs','realisateurs')*/


        // 3em requete
        /*
            ->select('film.titre AS t, film.description AS d')*/

        //4em requete

        /*
            ->select('film.titre')
            ->where('film.titre LIKE :paramTitre')
            ->andWhere('YEAR(film.dateSortie) > :paramDate')
            ->setParameters([
                'paramTitre'=>'%les%',
                'paramDate'=> 1980
            ])*/


        //5 em requete
       /*
            ->select('film.titre')
            ->where('realisateurs.nom = :paramReal')
            ->join('film.realisateurs','realisateurs')
            ->setParameters([
                'paramReal' => 'Kurosawa'
            ])*/

        //6em requete
       /*
            ->select("GROUP_CONCAT(film.titre SEPARATOR '/'), genres.nom")
            ->join('film.genres','genres')
            ->join('film.realisateurs','realisateurs')
            ->groupBy('genres.nom')
            ->where('realisateurs.nom = :paramReal')
            ->setParameters([
                'paramReal' => 'Leone'
            ])*/
       //7em requete
        /*
            ->select('acteurs.nom')
            ->join('film.acteurs','acteurs')
            ->join('film.realisateurs','realisateurs')
            ->join('acteurs.pays','pays')
            ->where('realisateurs.nom = :paramReal')
            ->andWhere('pays.nom = :paramPays')
            ->setParameters([
                'paramReal'=>'Spielberg',
                'paramPays'=>'france'
            ])*/

        //8em requete
        /*
            ->select('film.titre, film.dateSortie, realisateurs.nom ')
            ->join('film.realisateurs','realisateurs')
            ->where('YEAR(film.dateSortie) >= :paramDate')
            ->andWhere('YEAR(film.dateSortie) <= :paramDateMax')
            ->setParameters([
                'paramDate'=> 1990,
                'paramDateMax'=> 2000
            ])*/

        //9em requete
            /*->select('acteurs.nom, acteurs.prenom')
            ->join('film.acteurs','acteurs')
            ->orderBy('acteurs.nom, acteurs.prenom','ASC')*/

        //10 em requete
            /*->select('COUNT(film.titre) AS result, realisateurs.nom')
            ->join('film.realisateurs','realisateurs')
            ->groupBy('realisateurs.nom')*/


        //11em requete
            /*->select('COUNT(film.titre) AS result, YEAR(film.dateSortie) AS sortie')
            ->where('YEAR(film.dateSortie) = :paramDate')
            ->groupBy('sortie')
            ->setParameters(
                [
                    'paramDate'=> 1968
                ]
            )*/

        //12em requete
            /*->select('film.titre, film.dateSortie')
            ->setMaxResults(1)
            ->orderBy('film.dateSortie','DESC')*/

        //13em requete


            ->select('film.id,film.titre,film.dateSortie,film.description,realisateurs.nom,genres.nom,acteurs.nom')
            ->join('film.realisateurs','realisateurs')
            ->join('film.genres','genres')
            ->join('film.acteurs','acteurs')
            ->setMaxResults(1)
            ->orderBy('RAND()')
            /*quand le rand est dans un orderBy : chiffre completement aléatorire
            quand rand est dans un select il cherche entre 0 et 1
            */

            ->getQuery()
            ->getArrayResult()
            /*->getOneOrNullResult() permet de resortir un seul tableau et null si vide*/
                ;
            return $results;
    }

}
