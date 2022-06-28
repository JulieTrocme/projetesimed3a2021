<?php


namespace App\Repository;


use App\Entity\TShopProduit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TShopProduit::class);
    }

    public function getProduitsPaginated(int $page, string $sort, string $order, int $catId =0,int $sousCatId = 0, int $maisonId = 0): array
    {
        $query = $this
            ->createQueryBuilder('t_shop_produit')
            ->andWhere('t_shop_produit.prArchive = 0')
            ->andWhere('t_shop_produit.prActif = 1');
        if($catId != 0 ){
            $query->andWhere('t_shop_produit.prIdCat1 = :catId')
                ->setParameter('catId', $catId);
        }
        if($sousCatId != 0 ){
            $query->andWhere('t_shop_produit.prIdCat2 = :sousCatId')
                ->setParameter('sousCatId', $sousCatId);
        }
        if($maisonId != 0 ){
            $query->andWhere('t_shop_produit.prIdMaison = :maisonId')
                ->setParameter('maisonId', $maisonId);
        }
        return $query
            ->orderBy($sort,$order)
            ->setFirstResult(2 * ($page - 1))
            ->setMaxResults(2)
            ->getQuery()
            ->getResult();
    }

    public function countPage(int $catId =0,int $sousCatId = 0, int $maisonId = 0): int
    {
        try {
            $query = $this
                ->createQueryBuilder('t_shop_produit')
                ->select('COUNT(t_shop_produit.prId)')
                ->andWhere('t_shop_produit.prArchive = 0')
                ->andWhere('t_shop_produit.prActif = 1');
            if($catId != 0 ) {
                $query->andWhere('t_shop_produit.prIdCat1 = :catId')
                    ->setParameter('catId', $catId);
            }
            if($sousCatId != 0 ){
                $query->andWhere('t_shop_produit.prIdCat2 = :sousCatId')
                    ->setParameter('sousCatId', $sousCatId);
            }
            if($maisonId != 0 ){
                $query->andWhere('t_shop_produit.prIdMaison = :maisonId')
                    ->setParameter('maisonId', $maisonId);
            }
            return $query
                ->getQuery()
                ->getSingleScalarResult() / 2;
        } catch (NonUniqueResultException|NoResultException $e) {
            return 0;
        }
    }
}