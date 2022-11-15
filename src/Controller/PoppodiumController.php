<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Poppodium;

class PoppodiumController extends AbstractController
{
    #[Route('/poppodium', name: 'poppodium')]
    public function index(): Response
    {
        
        $podium = [
            "naam" => "De Melkweg",
            "adres" => "Lijnbaansgracht 234a",
            "postcode" => "1017PH",
            "woonplaats" => "Amsterdam",
            "telefoonnummer" => "0205318181",
            "email" => "info@melkweg.nl",
            "website" => "https://melkweg.nl",
            "logo" => "placholder1",
            "afbeelding" => "placeholder2",
           ];
           
           $rep = $this->getDoctrine()->getRepository(Poppodium::class);
            $result = $rep->savePodium($podium);
           


           dd($result);
           
    }
}
