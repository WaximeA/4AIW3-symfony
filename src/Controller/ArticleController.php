<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(name="app_article_", path="articles")
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
    public function index(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findBy([
                'deleted' => false
        ]);

        return $this->render(
            'Articles/index.html.twig',
            [
                "articles"     => $articles,
                "helloMessage" => "Nique ta mere",
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
    public function show(Article $article)
    {
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
     *
     * @return ??
     */
    public function new(Request $request)
    {
        $article = new Article();
        $form    = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            $this->addFlash(
                'success',
                'You successfully create the produt '.$article->getName().' :)'
            );

            return $this->redirectToRoute('app_article_index');
        }

        return $this->render(
            'Articles/new.html.twig',
            [
                'article' => $article,
                'form'    => $form->createView(),
            ]
        );
    }

    /**
     * @Route(name="edit", path="/edit/{id}", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param Article $article
     *
     * @return ??
     **/
    public function edit(Request $request, Article $article)
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            $this->addFlash(
                'primary',
                'The product '.$article->getName().' have been updated :)'
            );

            return $this->redirectToRoute('app_article_index');
        }

        return $this->render(
            'Articles/edit.html.twig',
            [
                'article' => $article,
                'form'    => $form->createView(),
            ]
        );
    }

    /**
     * @Route(name="delete", path="/delete/{id}", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param Article $article
     *
     * @return ??
     **/
    public function delete(Request $request, Article $article)
    {
        if (!$this->isCsrfTokenValid('delete-item'.$article->getId(), $request->query->get('_token'))) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $article->setDeleted(1);
        $em->flush();

        $this->addFlash(
            'danger',
            'The product '.$article->getName().' have been deleted!'
        );

        return $this->redirectToRoute('app_article_index');
    }
}