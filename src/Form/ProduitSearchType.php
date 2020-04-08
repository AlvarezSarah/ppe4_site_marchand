<?php

namespace App\Form;

use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Entity\Licence;
use App\Entity\Marque;
use App\Entity\ProduitSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('licences', EntityType::class, [
                'required' => false,
                'label' => false,
                'class' => Licence::class,
                'multiple' => true
            ])
            ->add('libelle', null, [
                'label' => false,
                'required' => false,
            ])
            ->add('marques', EntityType::class, [
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
            'data_class' => ProduitSearch::class,
            'method' => 'get',
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

}

