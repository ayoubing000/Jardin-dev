<?php

namespace JardinBundle\Form;


use JardinBundle\Entity\employee;
use JardinBundle\Entity\transport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class transportType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nbrBus')
            ->add('nbrEnfant')
            ->add('destination')
            ->add('titre')
            ->add('dateDebut' , DateTimeType::class)
            ->add('dateFin' ,DateTimeType::class)
            ->add('employee',EntityType::class ,[
                'class' => employee::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'username',
            ]);

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JardinBundle\Entity\transport'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jardinbundle_transport';
    }


}
