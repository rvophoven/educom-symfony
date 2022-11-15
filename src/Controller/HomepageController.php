<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Optreden;



#[Route('/homepage')]

class HomepageController extends AbstractController
{
    private $em;
    private $optredenRep;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
        $this->optredenRep = $this->em->getRepository(Optreden::class);
    }

    #[Route('/', name: 'homepage')]
    //#[Template()]

     public function index() :Response
    {
        
        $data = $this->optredenRep->getAllOptredens();

        dump($data);
        die();

    }

    #[Route('/backhome', name: 'backhome')]

    public function backhome() {

        return $this->redirectToRoute('homepage');
    }

    #[Route(['en' => '/contact-us' ,  "nl" => 'neem-contact-op' ]  , name: 'contact' )]

    public function contact(Request $request)
    {
        $locale = $request->getLocale();
        $msg = "This page is in English";
        if($locale == "nl") {
            $msg = "Deze pagina is in het Nederlands";
        }
        return new Response(
            "<html><body>$msg</body></html>"
        ); 
    }

    #[Route('/data.{_format}',name: 'api_output', requirements: ['_format' => 'xml|json'])]

    public function api($_format) {
        $data = [
            ["id" => 1, "naam" => "Piet"],
            ["id" => 2, "naam" => "Wilma"],
            ["id" => 3, "naam" => "Harrie"]
        ];
        if($_format == 'json') {
            return($this->json($data));
        } else {
        
        /// Om een array naar XML om te zetten is een parser nodig.
        /// Hier even een very quick en very dirty oplossing
        /// - die je eventueel ook met Twig zou kunnen maken.
        $d = "<data>";
            foreach($data as $record) {
                    $id = $record["id"];
                    $naam = $record["naam"];
                    $d .= "<record id='$id'>$naam</record>";
            }   
            $d .= "</data>";
            return(new Response($d));
        }
  }


}

