<?php

namespace App\Repository;

use App\Entity\Produit;
use App\Entity\ProduitSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p');
    }

    /**
     * @return Query
     */

    public function findAllVisibleQuery(ProduitSearch $search): Query
    {
        $query =  $this->findVisibleQuery();

        if ($search->getLicences()->count()>0){
            foreach($search->getLicences() as $k => $licence){
                $query=$query
                    ->andWhere(":licence$k MEMBER OF p.idLicence")
                    ->setParameter("licence$k",$licence);
            }
        }

        if ($search->getLibelle()){
            $query = $query
                ->andWhere('p.libelle = :libelle')
                ->setParameter('libelle', $search->getLibelle());
        }

        if ($search->getMarques()->count()>0){
            foreach($search->getMarques() as $k => $marque){
                $query=$query
                    ->andWhere(":marque$k MEMBER OF p.idMarque")
                    ->setParameter("marque$k",$marque);
            }
        }

        return $query->getQuery();
    }
}

