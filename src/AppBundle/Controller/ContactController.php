<?php
/**
 * Created by PhpStorm.
 * User: wabap2-5
 * Date: 05/01/18
 * Time: 14:30
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{   //suppression
    /**
     * @Route("/contact/delete/{id}", name="contact.form.delete");
     */
    public function deleteAction( ManagerRegistry $doctrine,int $id):Response
    {
        //suppression : selection de l'entité puis suppression
        $em = $doctrine->getManager();
        $rc = $doctrine->getRepository(Contact::class);

        //selection de l'entité
        $entity = $rc->find($id);
        //dump($entity);exit;
        $em->remove($entity);
        $em->flush();
        //message flash
        $message = 'le contact a été supprimer';
        $this->addFlash('notice', $message);
        return $this->redirectToRoute('contact.index');
    }



    /**
     * @Route("/contact", name="contact.index")
     */
    public function indexAction(ManagerRegistry $doctrine):Response
    {
        /*
         * getRepository : cible la classe Repository d'une entité
         *  methode de selection fournie par default :
         *
         *      - findAll() : renvoie un array d'entité
         *      - find() : renvoie une entité par son id
         *      - findOneBy($conditions) : renvoie une entité en ciblant la valeur de colonne
         *      - findBy : renvoie un array d'entité
         *
         * */
        // rc pour repositoryClass
        //::class = équivallent from contact
        $rc = $doctrine->getRepository(Contact::class);

        $results = $rc->findAll();
       // dump($result); exit;

        return $this->render('contact/index.html.twig',['result' => $results]);
    }


    /**
     * @Route("/contact/form", name="contact.form",
     *      defaults={"id"= null})
     * @Route("/contact/form/update{id}", name="contact.form.update")
     */
    public function formAction(Request $request, ManagerRegistry $doctrine, $id):Response/*ne pas typer le $id car dans certain cas le id peut etre null et null !== int*/
    {
        // doctrine
        /*
         * 2 branches:
         *              - getManager : update / delete / insert
         *              - getRepository : select (
         * update et select possible mais moin frequent)
         *
         *
         * */

        //em : utiliser pour dire entity manager
        $em = $doctrine->getManager();
        $rc = $doctrine->getRepository(Contact::class);

        /*instance /
        *si id n'est pas null action de modification
        *si l'id est null : action de création
        */
        $entity = $id ? $rc->find($id) : new Contact();
        /*équivalent de :
        *
        * if ($id !== null)
        {
            $entity = $rc->find($id);
        }else
        {
            $entity = new Contact();
        }
        */

        $entityType = ContactType::class;
        $form = $this->createForm($entityType, $entity);

        // récupération des données dans la requete
        $form->handleRequest($request);

        // formulaire valide
        if ($form->isSubmitted() && $form->isValid())
        {
            // récupération des donnees une fois que le form est valide
            $data = $form->getData();

            // persist : mise en memoire de la requete / file d'attente
            $em->persist($data);

            // executer la requete
            $em->flush();

            // dump($data);
            // exit;

            /*
            *
            *insertion de message flash( messag en sesison qui s'affiche une seule fois*
             * 2 parametres :
             *      - clé crée en session
             *      - valeur de la clé
            *
            */
            $message = $id ? 'le contact a été modifier' : 'le contact a été ajouté'
;            $this->addFlash('notice', $message);
            return $this->redirectToRoute('contact.index');
        }

        // createView : création des champs HTML
        return $this->render('contact/form.html.twig',['form'=>$form->createView()]);
    }
}