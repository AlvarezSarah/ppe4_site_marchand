<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Commande;
use App\Entity\Produit;
use App\Form\LicenceType;
use App\Form\CommandeType;
use App\Form\ImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('description')
            ->add('auteur')
            ->add('prixht')
            ->add('stock')
            ->add('idCategorie', EntityType::class, [
                'required' => false,
                'label' => false,
                'class' => Categorie::class,
                'multiple' => true
            ])
            ->add('imageFile', FileType::class, [
                'required' => false
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
