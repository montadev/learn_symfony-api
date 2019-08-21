<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Article;
use JMS\Serializer\SerializationContext;

class ArticleController extends AbstractController
{

     protected $serialize;
     public function __construct(SerializerInterface $serialize)
     {
         $this->serialize=$serialize;
     }
    /**
     * @Route("/articles/{id}", name="article_show")
     */
    public function index(Article $article)
    {
       
       

            $data = $this->serialize->serialize($article, 'json',
             SerializationContext::create()->setGroups(array('list')));

            $response = new Response($data);
            $response->headers->set('Content-Type', 'application/json');
    
            return $response;

    }

    /**
     * @Route("/articles", name="article_create",methods={"POST"})
     */
    public function createAction(Request $request)
    {
        $data = $request->getContent();
        $article = $this->serialize->deserialize($data, 'App\Entity\Article', 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);
    }
}
