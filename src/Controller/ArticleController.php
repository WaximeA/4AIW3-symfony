<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}