<?php

namespace App\Form;

use App\Entity\Licence;
use App\Entity\Marque;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('description')
            ->add('taille')
            ->add('prixht')
            ->add('stock')
            ->add('idLicence', EntityType::class, [
                'required' => false,
                'label' => false,
                'class' => Licence::class,
                'multiple' => true
            ])
            ->add('idMarque', EntityType::class, [
                'required' => false,
                'label' => false,
                'class' => Marque::class,
                'multiple' => true
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
