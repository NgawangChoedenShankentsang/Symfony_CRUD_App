<?php

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository<Project>
 *
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }
    
    /**
     * Find projects with applied filters and sorting.
     *
     * @param array $filterParams Filter parameters
     * @param array $sortParams Sorting parameters
     * @return Project[] Returns an array of Project objects
     */
    public function findWithFilters(array $filterParams, array $sortParams, int $page = 1, int $limit = 9): Paginator
    {
        $qb = $this->createQueryBuilder('p');

        // Apply filters
        if (!empty($filterParams['name'])) {
            $qb->andWhere('p.name LIKE :name')
               ->setParameter('name', '%' . $filterParams['name'] . '%');
        }
        if (!empty($filterParams['description'])) {
            $qb->andWhere('p.description LIKE :description')
               ->setParameter('description', '%' . $filterParams['description'] . '%');
        }

        // Apply sorting
        foreach ($sortParams as $field => $order) {
            $qb->addOrderBy('p.' . $field, $order);
        }

        $query = $qb->getQuery()
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);

        return new Paginator($query);
    }


//    /**
//     * @return Project[] Returns an array of Project objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Project
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
