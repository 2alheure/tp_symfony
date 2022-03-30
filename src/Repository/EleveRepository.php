<?php

namespace App\Repository;

use App\Entity\Eleve;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Eleve|null find($id, $lockMode = null, $lockVersion = null)
 * @method Eleve|null findOneBy(array $criteria, array $orderBy = null)
 * @method Eleve[]    findAll()
 * @method Eleve[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EleveRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Eleve::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Eleve $entity, bool $flush = true): void {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Eleve $entity, bool $flush = true): void {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findBySearch(string $search) {
        return $this->createQueryBuilder('e')
            ->where('e.nom LIKE :search')
            ->orWhere('e.prenom LIKE :search')
            ->setParameter('search', '%' . $search . '%')
            ->getQuery() // Récupère la requête (SQL)
            ->getResult(); // Récupère le résultat (execute + fetch)
    }

    /*
    public function findOneBySomeField($value): ?Eleve
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
