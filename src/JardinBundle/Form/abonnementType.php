<?php

namespace JardinBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class abonnementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dataDebut')
            ->add('dateFin')
            ->add('type')
            ->add('description')
            ->add('enfant',EntityType::class,array(
                'class'=>'JardinBundle:enfant',
                'choice_label'=>'nom',
                'multiple'=>false
            ))
            ->add('factures',EntityType::class,array(
                'class'=>'JardinBundle:facture',
                'choice_label'=>'id',
                'multiple'=>false
            ))->add('submit',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JardinBundle\Entity\abonnement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jardinbundle_abonnement';
    }


}
