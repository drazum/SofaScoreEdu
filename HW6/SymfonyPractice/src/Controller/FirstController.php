<?php


namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    /**
     * @Route ("/", methods = {"GET"}, name = "index")
     * @return Response
     */
    public function index(){
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
        return $this->render("first/first.html.twig", ["articles" => $articles]);
    }

    /**
     * @Route ("/article/{id}", name = "article_show")
     */
    public function show($id){
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        return $this->render("first/show.html.twig", ["article" => $article]);
    }
//    /**
//     * @Route ("/article/save")
//     */
//    public function save(){
//        $entityManager = $this->getDoctrine()->getManager();
//
//        $article = new Article();
//        $article->setTitle("Second Article");
//        $article->setBody("This is body for the second article!");
//
//        $entityManager->persist($article);
//        $entityManager->flush();
//
//        return new Response("Saved article with id " . $article->getId());
//
//    }
}