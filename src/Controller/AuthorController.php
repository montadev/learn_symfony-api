<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends AbstractController
{
   /**
     * @Route("/authors/{id}", name="author_show")
     */
    public function showAction()
    {
       
        
    }
}
