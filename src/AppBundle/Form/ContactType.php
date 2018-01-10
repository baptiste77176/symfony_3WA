<?php

namespace AppBundle\Form;

use AppBundle\Entity\Country;
use AppBundle\Entity\Language;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*
         *
         * add: ajouter un champ au formulaire
         * parametres:
         *          -nom du champ récupéré par la vue
         *          - type de champ
     *              -option
         *              -Contraintes de valdiations
         *
         * */
        $builder/*les contrainte ici permette une validation coter server :  regex ect ect*/
            ->add('firstname',TextType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => "vous n'avez pas saissie votre prénom"
                    ])
                ]
            ])/*::class instancie le namespace*/
            ->add('lastname', TextType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => "vous n'avez pas saissie votre nom"
                    ]),
                    new Regex([
                        'message' => "votre prénon n'est pas valide",
                        'pattern' => "/^[a-zA-Z '-éèöïù]+$/"
                    ])
                ]
            ])
            ->add('email', EmailType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => "vous n'avez pas saissie votre prénom"
                    ]),
                    new Email([
                        'message' => "votre email est incorrect",
                        'checkHost' => true,
                        'checkMX' => true
                    ])
                ]
            ])
            ->add('message', TextType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => "vous n'avez pas saissie votre msg"
                    ])
                ]
            ])

            /*
             * champ relié a une entité : EntityType
             *      class : permet de cibler l'entité
             *      choice_label : permet de définir la propriété de l'entité a afficher dans le champ
             *      placeholder : permet de definir le texte a afficher dans le champ
             * */
        ->add('country',EntityType::class, [
            'class'=>Country::class,
                'choice_label'=>'name',
                'placeholder'=>'name',
                'constraints'=>[
                    new NotBlank([
                        'message' => "vous n'avez pas selectionné votre pays"
                    ])
                ]

        ])
            /*gestion de l'affichage des champs multiples
             *      expanded  : afficher plusieurs champs
             *      multiple : selectionner plusieurs valeurs
             * pour des manyToMany faire obligatoirement des checkbox
             *      par default les 2 valeur sont a false sur les 2 propriété
             *      select : par default / multiple => false
             *      radio : expanded=> true / multiple => false
             *      checkbox : expanded => true / multiple => true
             * */
            ->add('languages',EntityType::class, [
                'class'=>Language::class,
                'choice_label'=>'name',
                'expanded' => true,
                'multiple'=> true,
                'constraints'=>[
                    new Count([
                        'min'=> 1,
                        'minMessage'=>"vous devez selectionner au minimum {{limit}} langue."
                    ])
                ]

            ]);/*on associe le champ country a une entité
    *fait un select sur l'entité
    */
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Contact'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_contact';
    }


}
