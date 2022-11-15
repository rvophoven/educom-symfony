<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Psr\Log\LoggerInterface;

class BaseController extends AbstractController
{
    private $logger;

    protected function log($msg, $id){
        if($id == 1){
            $this->logger->info($msg);
        }else if($id == 2){
            $this->logger->warning($msg);
        }else{
            $this->logger->error($msg);
        }
        
    }

    public function __construct(LoggerInterface $logger){
        $this->logger = $logger;
    }
    /*
    #[Route('/base', name: 'base')]
    public function index(): Response
    {
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }
    */
}
