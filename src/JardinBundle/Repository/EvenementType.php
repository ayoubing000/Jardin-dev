<?php

namespace JardinBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JardinBundle\Entity\Evenement'
        ));
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('titre')
            ->add('image', FileType::class, ['mapped' => false])
            ->add('dateDebut')
            ->add('dateFin')
            ->add('type')
            ->add('description')
            ->add('active')
            ->add('nombreDePlace')
            ->add('Enregistrer',SubmitType::class);

    }



    public function getBlockPrefix()
    {
        return 'jardinbundle_evenement';
    }


}
