<?php

    namespace App\Controller\Public;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    class HomeController extends AbstractController
    {
        #[Route(path: '/', name: 'home')]
        public function home(): Response
        {
            return $this->render('public/home.html.twig');
        }
    }