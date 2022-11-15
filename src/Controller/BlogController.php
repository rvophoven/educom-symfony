<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

use Psr\Log\LoggerInterface;

#[Route('/blog')]

class BlogController extends BaseController //AbstractController
{
    public function index()
    {

         return ['controller_name' => 'BlogController'];
        
    }

    #[Route('/{page}', name: 'blog_list' /*, requirements: ["page" => "\d+"]*/)]

    public function list($page)
    {
        dd($page);
    }
   
    /*
    #[Route('/{slug}', name: 'blog_show')]

    public function show($slug) {
        // ...
    }
    */

    #[Route('/show/{id}',name: 'blog_show')]

    public function show($id = 1){
        $this->log("info Message from extended BaseController",$id);       
       dd($id);
    }

    
    //public function show($id = 1, LoggerInterface $logger){
    //    $logger->info("info message");
    //    $logger->warning("Warning message");
     //   $logger->error("De waarde van id is: $id");
////
     //   dd($id);
    //}


}
