<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;


/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 */
class ProductRepository extends ServiceEntityRepository
{

    private PaginatorInterface $paginator;

    /**
     *
     * @param ManagerRegistry $registry
     * @param PaginatorInterface $paginator
     */


    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Product::class);
        $this->paginator = $paginator;
    }


    /**
     * @param SearchData $search
     * @return PaginationInterface
     */
    public function findSearch(SearchData $search): PaginationInterface

    {
        $query = $this
            ->createQueryBuilder('p')
            ->select('a', 'c', 't', 'p')
            ->join('p.appellation', 'a')
            ->join('p.color', 'c')
            ->join('p.type', 't');


        if (!empty($search->q)) {
            $query = $query
                ->andWhere('p.cuveeDomaine LIKE :q')
                ->setParameter('q', "%{$search->q}%");
        }

        if (!empty($search->min)) {
            $query = $query
                ->andWhere('p.price >= :min')
                ->setParameter('min', $search->min);
        }

        if (!empty($search->max)) {
            $query = $query
                ->andWhere('p.price <= :max')
                ->setParameter('max', $search->max);
        }

        if (!empty($search->appellation)) {
            $query = $query
                ->andWhere('a.id IN (:appellation)')
                ->setParameter('appellation', $search->appellation);
        }

        if (!empty($search->color)) {
            $query = $query
                ->andWhere('c.id IN (:color)')
                ->setParameter('color', $search->color);
        }

        if (!empty($search->type)) {
            $query = $query
                ->andWhere('t.id IN (:type)')
                ->setParameter('type', $search->type);
        }

        $query = $query->getQuery();
        return $this->paginator->paginate($query, $search->page, 9);


    }


    private function getSearchQuery(SearchData $search, $ignorePrice = false): QueryBuilder
    {
    }
}
