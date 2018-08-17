<?php

namespace App\Repository;

use App\Entity\ShoppingList;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ShoppingListRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ShoppingList::class);
    }

    public function getWithSearchQueryBuilder(User $user, ?string $term) : QueryBuilder
    {
        $qb = $this->createQueryBuilder('s');

        $qb->andWhere('s.owner = :owner')
        ->setParameter('owner', $user->getId());

        if($term) {
            $qb->andWhere('s.name LIKE :term')
                ->setParameter('term', '%' . $term . '%');
        }

        return $qb
            ->orderBy('s.createdAt', 'DESC');
    }

//    /**
//     * @return ShoppingList[] Returns an array of ShoppingList objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ShoppingList
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
