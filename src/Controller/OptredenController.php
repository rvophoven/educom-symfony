<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\OptredenService;

#[Route('/optreden', name: 'optreden')]

class OptredenController extends AbstractController
{
    private $os; 

    public function __construct(OptredenService $os) {
        $this->os = $os;      
    }

    #[Route('/save', name: 'optreden_save')]

    public function saveOptreden() {

            $optreden = [
                "id" => 12,
                "poppodium_id" => 1,
                "hoofdprogramma_id" => 1, 
                "voorprogramma_id" => 2,
                "omschrijving" => "Een avondje blues uit het boekje...",
                "datum" => "2022-07-14",
                "prijs" => 3800,
                "ticket_url" => "https://melkweg.nl/ticket/",
                "afbeelding_url" => "https://melkweg.nl/optreden/plaatje.jpg"
            ];
    
            $result = $this->os->saveOptreden($optreden);

            $id = 11;
            $result2 = $this->os->deleteOptreden($id);
            dd($result, $result2);
    }



    
        

}



    /*
    public function index(): Response
    {
        return $this->render('optreden/index.html.twig', [
            'controller_name' => 'OptredenController',
        ]);
    }
    */

