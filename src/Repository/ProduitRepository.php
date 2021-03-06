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

    public function getProduitsPaginated(int $page, string $sort, string $order, int $catId =0,int $sousCatId = 0, int $maisonId = 0, string $search = ""): array
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
        if($search != "" ){
            $query->andWhere("(t_shop_produit.prTitre LIKE '%".$search."%' OR t_shop_produit.prDescShort LIKE '%".$search."%' OR t_shop_produit.prDesc LIKE '%".$search."%' OR t_shop_produit.prRef LIKE '%".$search."%')");
        }
        return $query
            ->orderBy($sort,$order)
            ->setFirstResult(3 * ($page - 1))
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    public function countPage(int $catId =0,int $sousCatId = 0, int $maisonId = 0, string $search = ""): int
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
            if($search != "" ){
                $query->andWhere("(t_shop_produit.prTitre LIKE '%".$search."%' OR t_shop_produit.prDescShort LIKE '%".$search."%' OR t_shop_produit.prDesc LIKE '%".$search."%' OR t_shop_produit.prRef LIKE '%".$search."%')");
            }
            return ceil($query->getQuery()->getSingleScalarResult() / 3);
        } catch (NonUniqueResultException|NoResultException $e) {
            return 0;
        }
    }
}