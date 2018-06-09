<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Post::class);
    }

    
    /**
     * params pageCount
     * @return Post[]
     */
    public function getPosts($pageCount = 1): array
    {
        // gets posts for specific page
        $qb = $this->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->setFirstResult($pageCount * 5 - 5)
            ->setMaxResults(5);

        return $qb->execute();
    }

    public function getMaxPageCount($pageCount = 1)
    {
        // gets max page for pagination
        $qb = $this->createQueryBuilder('p')
            ->select('count(p.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return ceil($qb/5);
    }

}
