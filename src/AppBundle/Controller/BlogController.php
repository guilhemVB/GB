<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    public function blogDashboardAction()
    {
        return $this->render('AppBundle:Blog:dashboard.html.twig');
    }

    public function blogArticleAction($slug)
    {
        return $this->render('AppBundle:Blog:article.html.twig', ['article' => $this->getArticleFromSlug($slug)]);
    }

    private function getArticleFromSlug($slug)
    {

        return [
            'slug' => $slug,
            'fileName' => 'behat.html.twig',
            'title' => 'Mise en place de Behat 3',
            'synopsis' => "Viens lire l'article il est trop cool !!",
        ];
    }
}
