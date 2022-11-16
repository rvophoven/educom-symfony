<?php

namespace App\Repository;

use App\Entity\Optreden;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Artiest;
use App\Entity\Poppodium;


/**
 * @method Optreden|null find($id, $lockMode = null, $lockVersion = null)
 * @method Optreden|null findOneBy(array $criteria, array $orderBy = null)
 * @method Optreden[]    findAll()
 * @method Optreden[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OptredenRepository extends ServiceEntityRepository
{
    private $artiestRep;
    private $poppodiumRep;


    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Optreden::class);
        //$this->artiestRep = $this->_em->getRepository(Artiest::class);
        //$this->poppodiumRep = $this->_em->getRepository(Poppodium::class);
    }

    public function getAllOptredens() {
        $data = $this->findAll();
        return($data);
    }

    public function saveOptreden($params) {

        if(isset($params["id"]) && $params["id"] != "") {
            $optreden = $this->find($params["id"]);
        } else {
            $optreden = new Optreden();
        }
        
        $optreden->setPoppodium($this->fetchPoppodium($params["poppodium_id"]));
        $optreden->setArtiest($this->fetchArtiest($params["hoofdprogramma_id"]));
        $optreden->setVoorprogramma($this->fetchArtiest($params["voorprogramma_id"]));
        $optreden->setOmschrijving($params["omschrijving"]);
        $optreden->setDatum(new \DateTime($params["datum"]));
        $optreden->setPrijs($params["prijs"]);
        $optreden->setTicketUrl($params["ticket_url"]);
        $optreden->setAfbeelding($params["afbeelding_url"]);

        $this->_em->persist($optreden);
        $this->_em->flush();

        return($optreden);
        
    }

    public function deleteOptreden($id) {
    
        $optreden = $this->find($id);
        if($optreden) {
            $this->_em->remove($optreden);
            $this->_em->flush();
            return(true);
        }
    
        return(false);
    }

    public function findByDate()// search optreden by data
    {
        $date = new \DateTime();
        $data =  $this->createQueryBuilder('o') // ‘o’ is een alias!
            ->andWhere('o.datum >= :val')
            ->setParameter('val', $date)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
        return($data);
    }


    // /**
    //  * @return Optreden[] Returns an array of Optreden objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Optreden
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
