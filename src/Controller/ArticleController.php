<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @route(name="app_article_", path="articles")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route(name="index", path="/", methods={"GET"})
     *
     * @param ArticleRepository $articleRepository
     *
     * @return ??
     */
    public function index(ArticleRepository $articleRepository){

        $articles = $articleRepository->findAll();

        return $this->render(
            'Articles/index.html.twig',
            [
                "articles" => $articles,
                "helloMessage" => "Nique ta mere"
            ]
        );
    }

    /**
     * @Route(name="show", path="/show/{id}", methods={"GET"})
     *
     * @param Article $article
     *
     * @return ??
     */
    public function show(Article $article){

        return $this->render(
            'Articles/show.html.twig',
            [
                "article" => $article,
            ]
        );
    }

    /**
     * @Route(name="new", path="/new/", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param Article $article
     *
     * @return ??
     */
    public function new(Request $request){

        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('app_article_index');
        }

        return $this->render(
            'Articles/new.html.twig',
            [
                'Article' => $article,
                'form' => $form->createView()
            ]
        );
    }
}