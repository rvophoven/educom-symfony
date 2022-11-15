<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Artiest;

class ArtiestController extends AbstractController
{
    #[Route('/artiest', name: 'artiest')]
    public function index(): Response
    {
        $artiest = [
            "naam" => "Nicky",
            "genre" => "Metal",
            "omschrijving" => "jgnjgddskfkfsdmkkkdfkgagak",
            "afbeelding" => "placeholder3.jpg",
            "website" => "https://melkweg.nl",
           ];

           $rep = $this->getDoctrine()->getRepository(Artiest::class);
            $result = $rep->saveArtiest($artiest);

           dd($result);
    }
    
}
